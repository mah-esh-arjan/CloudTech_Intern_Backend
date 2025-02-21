<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = "books";
    protected $primaryKey = "id";

    protected $fillable = ['title', 'desc', 'image_path'];

    public function students(){
        return $this->belongsToMany(Student::class,'student_book','book_id','student_id');
    }

}
