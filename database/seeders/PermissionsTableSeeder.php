<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'view_role',
                'guard_name' => 'web',
                'created_at' => '2024-12-15 19:53:39',
                'updated_at' => '2024-12-15 19:53:39',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'view_any_role',
                'guard_name' => 'web',
                'created_at' => '2024-12-15 19:53:39',
                'updated_at' => '2024-12-15 19:53:39',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'create_role',
                'guard_name' => 'web',
                'created_at' => '2024-12-15 19:53:39',
                'updated_at' => '2024-12-15 19:53:39',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'update_role',
                'guard_name' => 'web',
                'created_at' => '2024-12-15 19:53:39',
                'updated_at' => '2024-12-15 19:53:39',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'delete_role',
                'guard_name' => 'web',
                'created_at' => '2024-12-15 19:53:39',
                'updated_at' => '2024-12-15 19:53:39',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'delete_any_role',
                'guard_name' => 'web',
                'created_at' => '2024-12-15 19:53:39',
                'updated_at' => '2024-12-15 19:53:39',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'restore_role',
                'guard_name' => 'web',
                'created_at' => '2024-12-15 19:53:39',
                'updated_at' => '2024-12-15 19:53:39',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'restore_any_role',
                'guard_name' => 'web',
                'created_at' => '2024-12-15 19:53:39',
                'updated_at' => '2024-12-15 19:53:39',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'force_delete_role',
                'guard_name' => 'web',
                'created_at' => '2024-12-15 19:53:39',
                'updated_at' => '2024-12-15 19:53:39',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'force_delete_any_role',
                'guard_name' => 'web',
                'created_at' => '2024-12-15 19:53:39',
                'updated_at' => '2024-12-15 19:53:39',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'view_user',
                'guard_name' => 'web',
                'created_at' => '2024-12-15 19:53:39',
                'updated_at' => '2024-12-15 19:53:39',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'view_any_user',
                'guard_name' => 'web',
                'created_at' => '2024-12-15 19:53:39',
                'updated_at' => '2024-12-15 19:53:39',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'create_user',
                'guard_name' => 'web',
                'created_at' => '2024-12-15 19:53:39',
                'updated_at' => '2024-12-15 19:53:39',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'update_user',
                'guard_name' => 'web',
                'created_at' => '2024-12-15 19:53:39',
                'updated_at' => '2024-12-15 19:53:39',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'delete_user',
                'guard_name' => 'web',
                'created_at' => '2024-12-15 19:53:39',
                'updated_at' => '2024-12-15 19:53:39',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'delete_any_user',
                'guard_name' => 'web',
                'created_at' => '2024-12-15 19:53:39',
                'updated_at' => '2024-12-15 19:53:39',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'restore_user',
                'guard_name' => 'web',
                'created_at' => '2024-12-15 19:53:39',
                'updated_at' => '2024-12-15 19:53:39',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'restore_any_user',
                'guard_name' => 'web',
                'created_at' => '2024-12-15 19:53:39',
                'updated_at' => '2024-12-15 19:53:39',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'force_delete_user',
                'guard_name' => 'web',
                'created_at' => '2024-12-15 19:53:39',
                'updated_at' => '2024-12-15 19:53:39',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'force_delete_any_user',
                'guard_name' => 'web',
                'created_at' => '2024-12-15 19:53:39',
                'updated_at' => '2024-12-15 19:53:39',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'page_EditProfilePage',
                'guard_name' => 'web',
                'created_at' => '2024-12-15 19:53:39',
                'updated_at' => '2024-12-15 19:53:39',
            ),
        ));
        
        
    }
}