<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;
use App\Models\Subject;
use App\Models\Image;
use Laravel\Sanctum\HasApiTokens;


class Student extends Model
{
    use HasApiTokens;
    use HasFactory;
    protected $table = "student";
    protected $primaryKey = "student_id";

    protected $hidden = ['password'];
    
    protected $fillable = [
        'name',
        'password',
        'age',
        'gender',
        'course',
        'image_path'
    ];

    public function books(){
        return $this->belongsToMany(Book::class,'student_book','student_id','book_id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'student_id');
    }

    public function subject(){
        return $this->hasMany(Subject::class, 'student_id');
    }

    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }

}
