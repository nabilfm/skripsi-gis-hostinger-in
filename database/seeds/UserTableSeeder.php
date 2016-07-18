<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		$admin = array(
            array(
                'name'				=> 'Muhammad Nabil Fauzan',
                'uname'				=> 'nabizan',
                'email'				=> 'nabilfm39@gmail.com',
                'password'			=> bcrypt('asdasd123'),
//                'level'				=> 3,
                'phone'				=> '087875028099',
//                'organization'		=> 'nabilfm',
                'ip_addr'			=> '127.221.222'
            )
        );
		$users = array(
            array(
                'fieldguide_id'		=> 1,
                'fname'				=> 'Dani',
                'lname'				=> 'Mahardika',
                'email'				=> 'danizz@gmail.com',
                'uname'				=> 'danizz',
                'password'			=> bcrypt('asdasd123'),
                'level'				=> 2,
                'phone'				=> '087875028099',
                'organization'		=> 'nabilfm',
                'ip_addr'			=> '127.221.222'
            )
        );
		DB::table('users')->insert($admin);
    }
}
