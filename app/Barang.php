<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'kategori_id','nama', 'harga', 'jumlah', 'foto',
    ];

    public function kategori()
    {
        return $this -> belongsTo('App\Kategori');
    }
    
}
