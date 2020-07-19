<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_id','user_id','alamat','pos','kategori','nama_barang','jumlah','harga',
    ];
}
