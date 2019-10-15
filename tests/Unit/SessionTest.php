<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Session;

class SessionTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function a_created_session_appears_on_the_sign_up_form()
    {
        $season = factory(App\Models\Season::class)->make();
        $venue = factory(App\Models\Venue::class)->make();
        $leader = factory(App\Models\Leader::class)->make();
        $session = factory(App\Models\Session::class)->make(['season_id' => $season->id, 'venue_id' => $venue->id, 'leader']);

        $response = $this->call('GET', '/select-session');
        $this->assertEquals(200,$response->status());

    }
}
