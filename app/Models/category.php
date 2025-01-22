<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;

class Category extends Model
{
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_category');
    }
}
