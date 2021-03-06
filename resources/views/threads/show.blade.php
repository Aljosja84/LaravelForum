@extends('layouts.app')

@section('content')
    <thread-view :initial-replies-count="{{ $thread->replies_count }}" inline-template>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="level">
                                <span class="flex">
                                    <a href="/profiles/{{ $thread->creator->name }}">{{ $thread->creator->name }}</a> posted:
                                    {{ $thread->title }}
                                </span>
                                @can('destroy', $thread)
                                    <form action="{{ $thread->path() }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-link">Delete Thread</button>
                                    </form>
                                @endcan
                            </div>

                        </div>
                        <div class="card-body">
                            {{ $thread->body }}
                        </div>
                    </div>
                    <div>&nbsp;</div>

                    <replies :data="{{ $thread->replies }}" @removed="repliesCount--"></replies>

                    @foreach($replies as $reply)
                        @include('threads.reply')
                    @endforeach

                    {{ $replies->links() }}

                    @if(auth()->check())

                        <form method="POST" action="{{ $thread->path() . '/replies' }}">
                            @csrf
                            <div class="form-group">
                                <label for="body">Your reply (logged in as {{ auth()->user()->name }})</label>
                                <textarea name="body" id="body" class="form-control" rows="5" style="resize: none"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Post</button>
                        </form>

                    @else
                        <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to comment on this thread</p>
                    @endif
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <p>
                                This thread was published {{ $thread->created_at->diffForHumans() }} by
                                <a href="#">{{ $thread->creator->name }}</a>, and currently has
                                <span v-text="repliesCount"></span> {{ Str::plural('comment', $thread->replies_count) }}.
                            </p>

                            <p>
                                <subscribe-button :active="{{ $thread->isSubscribedTo ? 'true' : 'false' }}"></subscribe-button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </thread-view>
@endsection
