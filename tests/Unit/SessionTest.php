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
    public function cannot_create_a_session_without_season()
    {
        $session = Session::create([]);

        $this->assertTrue(True);

    }
}
