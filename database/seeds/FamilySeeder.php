<?php

use Illuminate\Database\Seeder;

class FamilySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $families = factory('App\Models\Family', 10)->create([]);

    foreach ($families as $family) {
      factory('App\Models\Child', random_int(1,4))->create(['family_id' => $family->id]);
      factory('App\Models\Adult')->create(['family_id' => $family->id, 'primary' => '1']);
      if (rand(0,100) > 90) {
        factory('App\Models\Adult')->create(['family_id' => $family->id, 'primary' => '0']);
      }
    }
  }
}
