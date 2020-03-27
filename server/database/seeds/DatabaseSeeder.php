<?php
# @Author: Codeals
# @Date:   04-08-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 04-08-2019
# @Copyright: Codeals

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
        $this->call(UsersTableSeeder::class);
    }
}
