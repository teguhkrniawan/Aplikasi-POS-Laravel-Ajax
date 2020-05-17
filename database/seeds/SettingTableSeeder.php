<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting')->insert(array(
            [
                'nama_perusahaan' => 'Heymart',
                'alamat' => 'Jl. Citarum No 21 Jakarta Barat',
                'telepon' => '061-2665-012',
                'logo' => 'logo.png',
                'kartu_member' => 'card.png',
                'diskon_member' => '10',
                'tipe_nota' => '0'
            ]
        ));
    }
}
