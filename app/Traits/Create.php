<?php

namespace App\Traits;

trait Create
{
    public function getAll($model){
       return $model::all();
    }
}
