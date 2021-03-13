<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Site Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('Admin@123'),
                'usertype' => 'admin',
            ],
            ]);
    }
}
