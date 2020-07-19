<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Kategori;
use App\User;
use File;
use App\Order;
use Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::all();
        $i = 0;
        foreach($barang as $b){
            $i++;
        }
        return view('admin.list',compact('barang','i'));
    }

    public function pengguna()
    {
        $users = User::all();
        $i=0;
        foreach($users as $user){
            if($user->id_admin == 0){
                $i++;
            }
        }
        return view('admin.pengguna',compact('users','i')); 
    }

    public function terjual()
    {
        $user = Auth::user();
        $order = Order::all();
        $jumlah=0;
        foreach($order as $o){
            $jumlah++;
        }
        $groupInvoice = $order->groupBy('order_id');
        return view('admin.terjual',compact('groupInvoice','user','jumlah'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        $i=0;
        foreach($kategori as $k){
            $i++;
        }
        return view('admin.create',compact('kategori','i'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = array(
            'nama.required' => 'Harap masukkan nama barang.',
            'nama.min' => 'Harap masukkan nama barang minimal 5 karakter.',
            'nama.max' => 'Harap masukkan nama barang maksimal 80 karakter.',
            'jumlah.required' => 'Harap masukkan jumlah barang.',
            'jumlah.integer' => 'Harap masukkan jumlah yang terdiri dari angka.',
            'harga.required' => 'Harap masukkan harga barang.',
            'harga.regex' => 'Harap masukkan harga yang terdiri dari angka.',
        );
        $request->validate([
            'nama' => 'required|min:5|max:80',
            'jumlah' => 'required|integer',
            'harga' => 'required|regex:/[0-9]/',
            'foto' => 'required',
        ],$message);

        $file = $request->file('foto');
        $filenama = time() . '_' . $file->getClientOriginalName();
        $destinasi = 'data_foto';
        $file->move($destinasi, $filenama);

        $barang = Barang::create([
            'kategori_id' => $request->kategori,
            'nama' => $request->nama,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'foto' => $filenama,
        ]);

        return redirect('/list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategori = Kategori::all();
        return view('admin.edit',compact('barang','kategori'));
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
        $message = array(
            'nama.min' => 'Harap masukkan nama barang minimal 5 karakter.',
            'nama.max' => 'Harap masukkan nama barang maksimal 80 karakter.',
            'jumlah.integer' => 'Harap masukkan jumlah yang terdiri dari angka.',
            'harga.regex' => 'Harap masukkan harga yang terdiri dari angka.',
        );
        $request->validate([
            'nama' => 'min:5|max:80',
            'jumlah' => 'integer',
            'harga' => 'regex:/[0-9]/',
        ],$message);

        if($request->hasFile('foto'))
        {
            $barang = Barang::findOrFail($id)->first();
            File::delete('data_foto/' . $barang->foto);

            $file = $request->file('foto');
            $filenama = time() . '_' . $file->getClientOriginalName();
            $destinasi = 'data_foto';
            $file->move($destinasi, $filenama);
            Barang::where('id',$id)
                    ->update([
                        'kategori_id' => $request->kategori,
                        'nama' => $request->nama,
                        'harga' => $request->harga,
                        'jumlah' => $request->jumlah,
                        'foto' => $filenama,
                    ]);
        }
        else
        {
            Barang::where('id',$id)
                ->update([
                    'kategori_id' => $request->kategori,
                    'nama' => $request->nama,
                    'harga' => $request->harga,
                    'jumlah' => $request->jumlah
                ]);
        }
        
        return redirect('/list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id)->first();
        File::delete('data_foto/' . $barang->foto);

        Barang::findOrFail($id)->delete();
        return redirect('/list');
    }
}
