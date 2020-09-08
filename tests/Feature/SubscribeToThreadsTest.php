<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscribeToThreadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_subscribe_to_threads()
    {
        $this->signIn();

        $thread = create('App\Thread');

        $this->post($thread->path() . '/subscriptions');

        // Each time a reply is left on the thread
        $thread->addReply([
            'user_id' => auth()->id(),
            'body' => 'foobar'
        ]);

        // We should see a notification being sent to the user
        $this->assertcount(1, auth()->user()->notifications);
    }
}
