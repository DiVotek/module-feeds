<?php

namespace Modules\FeedsXML\Models;

use Illuminate\Database\Eloquent\Model;

class Feeds extends Model
{
    protected $fillable = [
        'name'
    ];

    public function fields()
    {
        return $this->hasMany(FeedFields::class, 'feed_id');
    }
}
