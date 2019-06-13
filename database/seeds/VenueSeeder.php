<?php

use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      if (DB::table('venues')->where('name', 'Glouster Place')->count() == 0) {
        DB::table('venues')->insert([
          'name'     => 'Glouster Place',
          'contact_name'    => 'Ben S',
          'contact_number' => '07777777777',
          'capacity' => '50',
        ]);
      }

      factory('App\Models\Venue', 3)->create([]);
    }
}

