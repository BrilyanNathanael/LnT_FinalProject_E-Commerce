<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;

class KategoriController extends Controller
{
    public function create()
    {
        return view('admin.kategori');
    }

    public function store(Request $request)
    {
        
        Kategori::create([
            'kategori' => $request->kategori,
        ]);

        return redirect('/list');
    }
}
