<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $fillable = ['name','user_id'];

    public function songs()
    {
        return $this->belongsToMany(Song::class, 'playlist_song')->withTimestamps()->orderBy('playlist_song.order');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
