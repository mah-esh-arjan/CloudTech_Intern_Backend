<?php

namespace App\Traits;

trait GetAll
{
    public function getAll($model){
       return $model::all();
    }
}
