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
            'email' => 'admin@mail.com',
            'password' => '$2a$12$xqMTZE.BYpng9euifhd39.VtUSklM.IX3TvJK6PU4Ov/MCMW3D2rS' //password: 1234
        ]);

        $admin->assignRole('admin');


        $operations = User::create([
            'name' => 'operations',
            'email' => 'operations@mail.com',
            'password' => '$2a$12$xqMTZE.BYpng9euifhd39.VtUSklM.IX3TvJK6PU4Ov/MCMW3D2rS'//password: 1234
        ]);

        $operations->assignRole('operations');


    }
}
