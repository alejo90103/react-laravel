<?php
# @Author: Codeals
# @Date:   04-08-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 01-11-2019
# @Copyright: Codeals

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \DB::table('users')->truncate();

        $user1 = [
        	'name' => 'Ian',
        	'email' => 'iankamisama@gmail.com',
            'admin' => 1,
        	'password' => Hash::make('123123'),
        ];

        User::create($user1);

        $user2 = [
            'name' => 'ale',
            'email' => 'alejo90103@gmail.com',
            'admin' => 0,
            'password' => Hash::make('123123'),
        ];

        User::create($user2);

    }
}
