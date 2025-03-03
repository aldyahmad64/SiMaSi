<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'Super Admin',
                    'email' => 'superadmin@admin.com',
                    'email_verified_at' => NULL,
                    'password' => \Illuminate\Support\Facades\Hash::make('superadmin'),
                    'remember_token' => NULL,
                    'created_at' => '2024-12-15 17:30:49',
                    'updated_at' => '2024-12-15 17:30:49',
                    'deleted_at' => NULL,
                    'custom_fields' => NULL,
                    'avatar_url' => NULL,
                ),
        ));


    }
}