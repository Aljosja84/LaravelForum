<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotificationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_notification_is_prepared_when_a_subscribed_thread_receives_a_new_reply_that_is_not_ours()
    {
        // Given we are signed in
        $this->signIn();

        // Given we have subscribed to a thread
        $thread = create('App\Thread')->subscribe();

        // We shouldn't have any notifications yet
        $this->assertCount(0, auth()->user()->notifications);

        // We leave a reply on the thread
        $thread->addReply([
            'user_id' => auth()->id(),
            'body' => 'foobar'
        ]);

        // We should see 0 notification, because we left it ourselves
        $this->assertCount(0, auth()->user()->fresh()->notifications);

        // Now, someone else leaves a reply
        $thread->addReply([
            'user_id' => create('App\User')->id,
            'body' => 'random text'
        ]);

        // We should see 1 notification
        $this->assertCount(1, auth()->user()->fresh()->notifications);
    }
}
