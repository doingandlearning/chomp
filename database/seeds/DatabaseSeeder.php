<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(VenueSeeder::class);
        $this->call(FamilySeeder::class);
        $this->call(SessionsSeeder::class);
    }
}
