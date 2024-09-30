<?php

namespace Modules\FeedsXML\Models;

use Illuminate\Database\Eloquent\Model;

class FeedFields extends Model
{
    protected $fillable = [
        'produc_filed', 'is_visible', 'category_field'
    ];

    public static function getDb(): string
    {
        return 'feed_fields';
    }
}
