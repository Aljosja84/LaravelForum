<reply inline-template>
    <div id="reply-{{ $reply->id }}" class="card">
        <div class="card-header">
            <div class="level">
                <h6 class="flex">
                    <a href="/profiles/{{ $reply->owner->name }}">
                        {{ $reply->owner->name }}
                    </a> said {{ $reply->created_at->diffForHumans() }}
                </h6>

                <div>
                    <form method="POST" action="/replies/{{ $reply->id }}/favorites">
                        @csrf
                        <button type="submit" class="btn btn-primary" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                            {{ $reply->favorites_count }} {{ Str::plural('Favorite', $reply->favorites_count) }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div v-if="editing">
                <textarea></textarea>
            </div>

            <div v-else>
                {{ $reply->body }}
            </div>
        </div>

        @can('destroy', $reply)
            <div class="panel-footer">
                <div class="card-header level">
                    <button class="btn btn-xs mr-1" @click="editing = true">Edit</button>
                    <form method="POST" action="/replies/{{ $reply->id }}">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                    </form>
                </div>
            </div>
        @endcan
    </div>
    <br/>
</reply>
