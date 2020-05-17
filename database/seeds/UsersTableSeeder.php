<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
            [
                'name' => 'Teguh\' Kurniawan',
                'email' => 'teguhkrniawan@gmail.com',
                'password'=> bcrypt('12345678'),
                'foto' => 'user.png',
                'level' => '1' //Admin
            ], 

            [
            'name' => 'Joko Wahyudi',
            'email' => 'jokowahyudi@gmail.com',
            'password'=> bcrypt('12345678'),
            'foto' => 'user.png',
            'level' => '2' //Kasir
            ]
        ));
    }
}
