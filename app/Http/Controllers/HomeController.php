<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Barang;
use App\Order;
use Cart;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $cart = 0;
        if($user->id_admin == 0)
        {
            foreach(Cart::content() as $row){
                if($row->options->user_id === Auth::user()->id){
                    $cart += $row->qty;
                }
            }
            $barang = Barang::all();
            return view('home',compact('user','barang', 'cart'));
        }
        else if($user->id_admin == 1)
        {
            $user = Auth::user();
            $users = User::all();
            $barang = Barang::all();
            $order = Order::all();
            return view('admin.home',compact('user','users','barang','order'));
        }
    }
}
