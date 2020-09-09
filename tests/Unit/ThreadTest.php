<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;
    protected $thread;

    public function setUp() : void
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }

    /** @test */
    public function a_thread_can_make_a_string_path()
    {
        $thread = create('App\Thread');

        $this->assertEquals('/threads/' . $thread->channel->slug . '/' . $thread->id, $thread->path());
    }

    /** @test */
    public function a_thread_has_replies()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    /** @test */
    public function a_thread_has_a_creator()
    {
        $this->assertInstanceOf('App\User', $this->thread->creator);
    }

    /** @test */
    public function a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body' => 'Foobar',
            'user_id' => 1
        ]);

        $this->assertCount(1, $this->thread->replies);
    }

    /** @test */
    public function a_thread_belongs_to_a_channel()
    {
        $this->assertInstanceOf('App\Channel', $this->thread->channel);
    }

    /** @test */
    function a_thread_can_be_subscribed_to()
    {
        // we have a thread
        $thread = create('App\Thread');

        // log in
        $this->signIn();

        // subscribe to the thread
        $thread->subscribe();

        // fetch all threads the user has subscribed to
        $this->assertEquals(1, $thread->subscriptions()->where('user_id', auth()->id())->count());
    }

    /** @test */
    function a_thread_can_be_unsubscribed_from()
    {
        // we have a thread
        $thread = create('App\Thread');

        // and a user who is subscribed to the thread
        $thread->subscribe($userId = 1);

        // this user will now unsubscribe
        $thread->unsubscribe($userId);

        // will yield no results when called upon
        $this->assertCount(0, $thread->subscriptions);
    }

    /** @test */
    function it_knows_if_the_logged_in_user_is_subscribed_to_it()
    {
        // we have a thread
        $thread = create('App\Thread');

        // we're logged in
        $this->signIn();

        // we are not subscribed?
        $this->assertFalse($thread->isSubscribedTo);

        // we subscribe to the thread
        $thread->subscribe();

        // we are now subscribed?
        $this->assertTrue($thread->isSubscribedTo);
    }
}
