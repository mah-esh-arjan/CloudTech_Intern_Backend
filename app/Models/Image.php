<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Image extends Model
{
    protected $fillable = [
        'url','imageable_id','imageable_type'
    ];

    public function imageable() {
        $this->morphTo();
    }
}
