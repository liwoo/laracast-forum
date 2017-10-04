<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadThreadsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }

    public function testThatUserCanViewAllThreads()
    {

        $this->get('/threads')
            ->assertSee($this->thread->title);
    }

    public function testThatUserCanReadASingleThread()
    {

        $this->get('/threads/' . $this->thread->id)
            ->assertSee($this->thread->title);
    }

    public function testThatUserCanReadRepliesAssociatedWithThread()
    {
        $reply = factory('App\Reply')
            ->create(['thread_id' => $this->thread->id]);

        $this->get('/threads/' . $this->thread->id)
            ->assertSee($reply->body);
    }
}
