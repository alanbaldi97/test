<?php

namespace Database\Seeders;

use App\Models\User;
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
        //
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '$2a$12$xqMTZE.BYpng9euifhd39.VtUSklM.IX3TvJK6PU4Ov/MCMW3D2rS'
        ]);

        $admin->assignRole('admin');


        $operations = User::create([
            'name' => 'operations',
            'email' => 'operations@gmail.com',
            'password' => '$2a$12$xqMTZE.BYpng9euifhd39.VtUSklM.IX3TvJK6PU4Ov/MCMW3D2rS'
        ]);

        $operations->assignRole('operations');


    }
}
