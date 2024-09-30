<?php

namespace Modules\FeedsXML\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\FeedsXML\Models\Feed_Fields;

class Product_Fields extends Model
{
    protected $fillable = [
        'feed_field_id',
        'product_field'
    ];

    public function feeds(){
        return $this->belongTo(FeedFields::class);
    }
}
