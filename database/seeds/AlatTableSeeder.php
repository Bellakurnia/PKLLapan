<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      DB::table('alat')->insert([
        [
          'id_alat' => 1,
          'nama_alat' => 'airglow',
        ],
        [
          'id_alat' => 2,
          'nama_alat' => 'ale',
        ],
        [
          'id_alat' => 3,
          'nama_alat' => 'geomagnet',
        ],
        [
          'id_alat' => 4,
          'nama_alat' => 'gps',
        ],
        [
          'id_alat' => 5,
          'nama_alat' => 'ionosonda',
        ],
        [
          'id_alat' => 6,
          'nama_alat' => 'scin1',
        ],
        [
          'id_alat' => 7,
          'nama_alat' => 'scin3',
        ],
        [
          'id_alat' => 8,
          'nama_alat' => 'beacon',
        ],
        [
          'id_alat' => 9,
          'nama_alat' => 'cadi',
        ],
        [
          'id_alat' => 10,
          'nama_alat' => 'gistm',
        ],
        [
          'id_alat' => 11,
          'nama_alat' => 'mwr',
        ],
        [
          'id_alat' => 12,
          'nama_alat' => 'aws',
        ],
        [
          'id_alat' => 13,
          'nama_alat' => 'meteo',
        ],
        [
          'id_alat' => 14,
          'nama_alat' => 'winradio',
        ],
        [
          'id_alat' => 15,
          'nama_alat' => 'esir',
        ],
        [
          'id_alat' => 16,
          'nama_alat' => 'sallisto',
        ],
        [
          'id_alat' => 17,
          'nama_alat' => 'celestron',
        ],
        [
          'id_alat' => 18,
          'nama_alat' => 'sn-4000',
        ],
        [
          'id_alat' => 19,
          'nama_alat' => 'co2',
        ],
        [
          'id_alat' => 20,
          'nama_alat' => 'epam',
        ],
        [
          'id_alat' => 21,
          'nama_alat' => 'h_alpha',
        ],
        [
          'id_alat' => 22,
          'nama_alat' => 'matahari',
        ],
        [
          'id_alat' => 23,
          'nama_alat' => 'ozon_permukaan',
        ],
        [
          'id_alat' => 24,
          'nama_alat' => 'rain_gauge',
        ],
        [
          'id_alat' => 25,
          'nama_alat' => 'spektrograf_atmosfer',
        ],
        [
          'id_alat' => 26,
          'nama_alat' => 'sqm',
        ],
        [
          'id_alat' => 27,
          'nama_alat' => 'sqm_2',
        ],
        [
          'id_alat' => 28,
          'nama_alat' => 'uv_b',
        ],
        [
          'id_alat' => 29,
          'nama_alat' => 'beacon_ygy',
        ],
        [
          'id_alat' => 30,
          'nama_alat' => 'maws',
        ],
        [
          'id_alat' => 31,
          'nama_alat' => 'ozon',
        ],
      ]);
    }
}
