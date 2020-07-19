<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Auth;
use Validator;
use App\Barang;
use App\Order;
use DB;
use App\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $harga = 0;
        $barang = 0;
        $i = 0;
        foreach(Cart::content() as $row){
            if($row->options->user_id === Auth::user()->id){
                $harga = $harga + ($row->price * $row->qty);
                $barang += $row->qty;
                $i++;
            }
        }
        return view('cart',compact('user','harga','barang','i'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
            $cart_id = $cartItem->options->user_id;
            if($cart_id === Auth::user()->id){
                return $cartItem->id === $request->id;
            }
        });

        if (!$duplicates->isEmpty()) {
            return redirect('cart')->withSuccessMessage('Item is already in your cart!');
        }

        $user_id = Auth::user()->id;
        Cart::add($request->id, $request->name, 1, $request->price,['user_id' => $user_id])->associate('App\Barang');

        return redirect('cart')->withSuccessMessage('Item was added to your cart!');
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false]);
        }

        $cart = Cart::update($id, $request->quantity);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return redirect('cart');
    }

    public function checkout()
    {
        $user = Auth::user();
        $harga = 0;
        $barang = 0;
        $i = 0;
        foreach(Cart::content() as $row){
            if($row->options->user_id === Auth::user()->id){
                $harga = $harga + ($row->price * $row->qty);
                $barang += $row->qty;
                $i++;
            }
        }
        if($i == 0){
            return redirect()->back();
        }
        return view('checkout',compact('user','harga','barang'));
    }

    public function processing(Request $request)
    {
        $id = IdGenerator::generate(['table' => 'orders', 'field' => 'order_id', 'length' => 10, 'prefix' =>'INV-']);
        
        foreach(Cart::content() as $row)
        {
            if($row->options->user_id == Auth::user()->id){
                $barang = Barang::find($row->id);

                $message = array(
                    'alamat.required' => 'Harap masukkan alamat pengiriman',
                    'alamat.min' => 'Harap masukkan alamat minimal 10 karakter',
                    'alamat.max' => 'Harap masukkan alamat maksimal 100 karakter',
                    'pos.required' => 'Harap masukkan kode pos',
                    'pos.regex' => 'Harap masukkan kode pos yang terdiri angka',
                    'pos.min' => 'Harap masukkan kode pos yang terdiri 5 digit angka',
                    'pos.max' => 'Harap masukkan kode pos yang terdiri 5 digit angka',
                );
                $request->validate([
                    'alamat' => 'required|min:10|max:100',
                    'pos' => 'required|regex:/[0-9]/|min:5|max:5',
                ],$message);

                $user_id = Auth::user()->id;
                Order::create([
                    'order_id' => $id,
                    'user_id' => $user_id,
                    'alamat' => $request->alamat,
                    'pos' => $request->pos,
                    'kategori' => $row->model->kategori->kategori,
                    'nama_barang' => $row->name,
                    'jumlah' => $row->qty,
                    'harga' => $row->price,
                ]);
                
                $jumlah = $barang->jumlah - $row->qty;
                Barang::where('id', $row->id)
                    ->update([
                        'nama' => $row->name,
                        'harga' => $row->price,
                        'jumlah' => $jumlah,
                    ]);
                Cart::remove($row->rowId);
            }
        }
        return redirect('/home');
    }

    public function invoice()
    {
        $user = Auth::user();
        $order = Order::all();
        $groupInvoice = $order->groupBy('order_id');
        $barang = 0;
        $transaksi = 0;
        foreach(Cart::content() as $row)
        {
            if($row->options->user_id === Auth::user()->id){
                $barang += $row->qty;
            }
        }
        foreach($order as $o)
        {
            if($o->user_id == Auth::user()->id)
            {
                $transaksi++;
            }
        }
        return view('transaksi',compact('groupInvoice','user', 'barang', 'transaksi'));
    }

    public function detail($id)
    {
        $order = Order::find($id);
        $orders = Order::where('order_id', $order->order_id)->get();
        $jumlahBarang  = 0;
        $totalHarga = 0;
        foreach($orders as $o)
        {
            $jumlahBarang = $jumlahBarang + $o->jumlah;
            $totalHarga = $totalHarga + ($o->harga * $o->jumlah);
        }
        $user = Auth::user();
        $barang = 0;

        if(Auth::user()->id_admin == 0)
        {
            foreach(Cart::content() as $row){
                if($row->options->user_id === Auth::user()->id){
                    $barang += $row->qty;
                }
            }
            return view('detail-order',compact('order','orders', 'barang', 'user','jumlahBarang','totalHarga'));
        }
        else{
            $customer = User::find($order->user_id);
            return view('admin.orders-customer',compact('order','orders','user', 'customer', 'jumlahBarang','totalHarga'));
        }
    }

    public function reimburse($id)
    {
        $order = Order::find($id);
        $orders = Order::where('order_id',$order->order_id)->get();
        foreach($orders as $o)
        {
            Order::findOrFail($o->id)->delete();
        }
        return redirect('/invoice');
    }
}
