<?php

namespace Modules\FeedXML\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Fields extends Model
{
    protected $fillable = [
        'feed_field_id',
        'product_field'
    ];

    public function feeds(){
        return $this->belongToMany(Feeds::class);
    }
}
