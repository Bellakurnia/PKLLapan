<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CabangTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      DB::table('cabang')->insert([
        [
          'id_cabang' => 1,
          'nama_cabang' => 'Biak',
        ],
        [
          'id_cabang' => 2,
          'nama_cabang' => 'Pontianak',
        ],
        [
          'id_cabang' => 3,
          'nama_cabang' => 'Sumedang',
        ],
        [
          'id_cabang' => 4,
          'nama_cabang' => 'Garut',
        ],
        [
          'id_cabang' => 5,
          'nama_cabang' => 'Pasuruan',
        ],
        [
          'id_cabang' => 6,
          'nama_cabang' => 'Kupang',
        ],
        [
          'id_cabang' => 7,
          'nama_cabang' => 'Manado',
        ],
        [
          'id_cabang' => 8,
          'nama_cabang' => 'Agam',
        ],
        [
          'id_cabang' => 9,
          'nama_cabang' => 'Yogyakarta',
        ],
      ]);
    }
}
