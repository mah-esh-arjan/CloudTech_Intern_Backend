<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = "books";
    protected $primaryKey = "id";

    protected $fillable = ['title', 'desc', 'image_path'];
}
