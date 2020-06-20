@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @foreach($threads as $thread)
                    <div class="card" style="margin-bottom: 10px">
                        <div class="card-header">
                            <div class="level">
                                <h4 class="flex">
                                    <a href="{{ $thread->path() }}">
                                        {{ $thread->title }}
                                    </a>
                                </h4>
                                <strong><a href="{{ $thread->path() }}">{{ $thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }}</a></strong>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="body">{{ $thread->body }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-12">This is the footer</div>
@endsection
