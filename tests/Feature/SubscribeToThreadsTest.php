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

        $this->assertCount(1, $thread->fresh()->subscriptions);
    }

    /** @test */
    public function a_user_can_unsubscribe_from_threads()
    {
        $this->signIn();

        $thread = create('App\Thread');

        // subscribe to the thread
        $thread->subscribe();

        // The user will unsubscribe from the thread
        $this->delete($thread->path() . '/subscriptions');

        // We should have zero thread subscriptions
        $this->assertCount(0, $thread->subscriptions);
    }
}
