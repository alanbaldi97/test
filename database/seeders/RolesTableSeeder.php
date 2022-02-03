<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $viewFlights = Permission::create(['name' => 'view flights']);
        $createFlight = Permission::create(['name' => 'create flight']);
        $updateFlight = Permission::create(['name' => 'update flight']);
        $destroyFlight = Permission::create(['name' => 'delete flight']);

        $viewAirlines = Permission::create(['name' => 'view airlines']);
        $createAirline = Permission::create(['name' => 'create airline']);
        $updateAirline = Permission::create(['name' => 'update airline']);
        $destroyAirline = Permission::create(['name' => 'delete airline']);

        $viewAirports = Permission::create(['name' => 'view airports']);
        $createAirport = Permission::create(['name' => 'create airport']);
        $updateAirport = Permission::create(['name' => 'update airport']);
        $destroyAirport = Permission::create(['name' => 'delete airport']);



        $adminRole = Role::create(['name' => 'admin']);

        $viewFlights->assignRole($adminRole);

       

        $adminRole->syncPermissions([
            $viewFlights,
            $createFlight,
            $updateFlight,
            $destroyFlight,
        ]);
        
        $operationsRole = Role::create(['name' => 'operations']);

        $operationsRole->syncPermissions([
            $viewAirlines,
            $createAirline,
            $updateAirline,
            $destroyAirline,
            $viewAirports,
            $createAirport,
            $updateAirport,
            $destroyAirport
        ]);
    }
}
