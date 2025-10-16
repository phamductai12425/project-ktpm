<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecentPlay extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id','song_id','played_at'];

    public function song()
    {
        return $this->belongsTo(Song::class);
    }
}
