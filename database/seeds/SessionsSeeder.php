<?php

use Illuminate\Database\Seeder;

class SessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory('App\Models\Season')->create(['open' => 1]);
      factory('App\Models\Season')->create(['open' => 0]);
      for ($i = 0; $i < 40; $i++) {
        factory('App\Models\Session')->create([
          'venue_id' => random_int(1, 4),
          'season_id' => random_int(1,2),
        ]);
      }

    }
}
