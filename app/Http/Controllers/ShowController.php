<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use Cart;
use Auth;

class ShowController extends Controller
{
    public function show($id)
    {
        $user = Auth::user();
        $barang = Barang::findOrFail($id);
        $cart = 0;
        foreach(Cart::content() as $row){
            if($row->options->user_id === Auth::user()->id){
                $cart += $row->qty;
            }
        }
        return view('show',compact('user','barang', 'cart'));
    }
}
