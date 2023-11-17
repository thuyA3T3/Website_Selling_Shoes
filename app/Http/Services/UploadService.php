<?php

namespace App\Http\Services;

use Exception;

class UploadService
{
    public function store($request)
    {
        if ($request->hasFile('file')) {
            try {
                $name = $request->file('file')->getClientOriginalName();
                $path = $request->file('file')->storeAs(
                    'public/uploads/' . date("Y/m/d"),
                    $name
                );
                $pathFull = 'uploads/' . date("Y/m/d");
                return '/storage' . '/' . $pathFull . '/' . $name;
            } catch (Exception $error) {
                return false;
            }
        }
    }
}
