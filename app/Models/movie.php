<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Movie extends Model
{
    protected $fillable = ['name'];

    public function categories()
    {
        return $this->belongstoMany(Category::class, 'movie_category');
    }
}
