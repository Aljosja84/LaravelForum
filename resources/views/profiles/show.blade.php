@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="page-header">
                <h1 style="padding-bottom: 30px">
                    {{ $profileUser->name }}
                    <small>, a user since {{ $profileUser->created_at->diffForHumans() }}</small>
                </h1>
            </div>
        </div>
    </div>


    @foreach($activities as $date => $activity)
        <h3 class="page-header">{{ $date }}</h3>

        @foreach($activity as $record)
            @if (view()->exists("profiles.activities.{$record->type}"))
                @include("profiles.activities.{$record->type}", ['activity' => $record])
            @endif
            <br>
        @endforeach
    @endforeach
     {{ $threads->links() }}
</div>
@endsection
