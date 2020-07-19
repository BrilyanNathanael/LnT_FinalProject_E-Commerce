<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Kategori;
use App\Barang;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id_admin' => '1',
            'name' => 'Nael',
            'email' => 'nael@gmail.com',
            'password' => Hash::make('password123'),
            'no_hp' => '081239128324',
        ]);

        User::create([
            'id_admin' => '0',
            'name' => 'Jeremy',
            'email' => 'jeremy@gmail.com',
            'password' => Hash::make('password123'),
            'no_hp' => '081239103292',
        ]);

        User::create([
            'id_admin' => '0',
            'name' => 'Derren',
            'email' => 'derren@gmail.com',
            'password' => Hash::make('password123'),
            'no_hp' => '088123984283',
        ]);

        User::create([
            'id_admin' => '0',
            'name' => 'Krisna',
            'email' => 'krisna@gmail.com',
            'password' => Hash::make('password123'),
            'no_hp' => '087128342324',
        ]);

        Kategori::create([
            'kategori' => 'Laptop'
        ]);

        Kategori::create([
            'kategori' => 'Sepatu'
        ]);

        Kategori::create([
            'kategori' => 'Handphone'
        ]);

        Barang::create([
            'kategori_id' => 2,
            'nama' => 'nike',
            'harga' => '1500000',
            'jumlah' => '40',
            'foto' => 'nike01.jpg'
        ]);

        Barang::create([
            'kategori_id' => 1,
            'nama' => 'ROG',
            'harga' => '2000000',
            'jumlah' => '23',
            'foto' => 'rog.jpg'
        ]);

        Barang::create([
            'kategori_id' => 3,
            'nama' => 'Xiaomi',
            'harga' => '1500000',
            'jumlah' => '34',
            'foto' => 'xiaomi.jpg'
        ]);
    }
}
