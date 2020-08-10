<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favorable, RecordsActivity;

    protected $guarded = [];

    protected $with = ['owner', 'favorites'];

    // the $appends var gets sent with a Json request
    // in this case our Vue favorites component
    protected $appends = ['favoritesCount'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($reply) {
            $reply->favorites->each->delete();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function thread()
    {
        return $this->belongsTo('App\Thread');
    }

    public function path()
    {
        return $this->thread->path() . "#reply-{$this->id}";
    }
}
