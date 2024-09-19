<?php

namespace Modules\FeedXML\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeds extends Model
{
    protected $fillable = [
        'feeds'
    ];

    public function feed_fileds()
    {
        return $this->belongsToMany(Feed_Fields::class);
    }
}