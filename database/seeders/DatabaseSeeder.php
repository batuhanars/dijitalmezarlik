<?php

namespace Database\Seeders;

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
        $this->call([
            UserSeeder::class,
            ProvinceSeeder::class,
            DistrictSeeder::class,
            UserRoleSeeder::class,
            UserProvinceSeeder::class,
            UserDistrictSeeder::class,
            UserOrganisationSeeder::class,
        ]);
    }
}
