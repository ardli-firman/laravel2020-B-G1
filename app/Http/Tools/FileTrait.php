<?php

namespace App\Http\Tools;

use Illuminate\Support\Facades\Storage;

/**
 * Upload file
 */
trait FileTrait
{
    protected $uploadFotoLocation = 'public/photos';
    protected $uploadFileLocation = 'public/files';

    public function uploadFoto($photo = null)
    {
        request()->validate($this->photoRule());
        if (request()->file('foto')->isValid()) {

            if ($photo != null) {
                $this->deleteFoto($photo);
            }

            $path = request('foto')->store($this->uploadFotoLocation);
            if (is_string($path)) {
                return $this->getInsertedDb($path);
            }
        }
        return false;
    }

    public function uploadFile($file = null)
    {
        request()->validate($this->fileRule());
        if (request()->file('file')->isValid()) {

            if ($file != null) {
                $this->deleteFile($file);
            }

            $path = request('file')->store($this->uploadFileLocation);
            if (is_string($path)) {
                return $this->getInsertedDb($path);
            }
        }
        return false;
    }

    public function deleteFile($path = null)
    {
        $res = $this->checkFile($path);
        if ($res) {
            return Storage::delete([$res]);
        }
        return false;
    }

    public function deleteFoto($path = null)
    {
        $res = $this->checkFile($path);
        if ($res) {
            return Storage::delete([$res]);
        }
        return false;
    }

    public function checkFile($path = null)
    {
        $realPath = 'public/' . $path;
        if (Storage::exists($realPath)) {
            return $realPath;
        };
        return false;
    }

    public function getInsertedDb($path = null)
    {
        $file = explode('/', $path);
        return $file[1] . '/' . $file[2];
    }

    private function photoRule()
    {
        return [
            'foto' => 'required|mimes:jpeg,gif,jpg,png'
        ];
    }

    private function fileRule()
    {
        return [
            'file' => 'required|mimes:pdf'
        ];
    }
}
