<?php

namespace App\Http\Tools;

use Illuminate\Support\Facades\Storage;

/**
 * Upload file
 */
trait FileTrait
{
    protected $uploadFotoLocation = 'public/photos';

    public function uploadFoto($photo = null)
    {
        request()->validate($this->photoRule());
        if (request()->file('foto')->isValid()) {

            if ($photo != null) {
                $this->deleteFoto($photo);
            }

            $path = request('foto')->store($this->uploadFotoLocation);
            if (is_string($path)) {
                $photo = explode('/', $path);
                return $photo[1] . '/' . $photo[2];
            }
        }
        return false;
    }

    public function deleteFoto($path = null)
    {
        $res = $this->checkFoto($path);
        if ($res) {
            return Storage::delete([$res]);
        }
        return false;
    }

    public function checkFoto($path = null)
    {
        $realPath = 'public/' . $path;
        if (Storage::exists($realPath)) {
            return $realPath;
        };
        return false;
    }

    private function photoRule()
    {
        return [
            'foto' => 'required|mimes:jpeg,gif,jpg,png'
        ];
    }
}
