<?php

namespace App\Traits;

trait GetOne
{
    public function GetOne($model, $id)
    {

        $data = $model::find($id);

        if (!$data) {
            abort(jsonResponse($data, 'Data was not found', 404));
        }

        return $data;
    }
}
