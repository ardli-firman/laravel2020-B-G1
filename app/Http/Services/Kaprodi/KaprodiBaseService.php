<?php

namespace App\Http\Services\Kaprodi;

use App\Http\Inter\UploadAbstract;
use App\Http\Tools\FileTrait;
use App\Kaprodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KaprodiBaseService
{

    use FileTrait;

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function find($id)
    {
        return Kaprodi::find($id);
    }

    public function getDataTable()
    {
        return Kaprodi::latest()->get();
    }

    public function getPaginate($total = 5)
    {
        return Kaprodi::paginate($total);
    }

    public function insert()
    {
        $res = $this->request->validate($this->rules());
        $res['password'] = Hash::make($res['password']);
        $res['foto'] = $this->uploadFoto();
        $kaprodi = Kaprodi::create($res);
        return $kaprodi;
    }

    public function update(Kaprodi $kaprodi, $type = 'profile')
    {
        if ($type == 'profile') {
            $res = $this->request->validate($this->rules('update', $kaprodi));
        }
        if ($type == 'password') {
            $res = $this->request->validate($this->rules('password', $kaprodi));
            $kaprodi->password = Hash::make($this->request->password);
        }

        if ($kaprodi->email != $this->request->email) {
            $kaprodi->email = $this->request->email;
        }

        if ($this->request->foto != null) {
            $kaprodi->foto = $this->uploadFoto($kaprodi->foto);
        }

        $kaprodi->nama = $this->request->nama;
        return $kaprodi->saveOrFail();
    }

    public function delete(Kaprodi $kaprodi)
    {
        $this->deleteFoto($kaprodi->foto);
        $res = $kaprodi->delete();
        return $res;
    }

    public function rules(...$params)
    {
        $rules = [
            'nama' => 'required',
            'email' => 'required|email|unique:kaprodi',
            'password' => 'required|confirmed',
        ];

        if ($params != null) {
            if ($params[0] == 'update') {
                $rules['email'] = $rules['email'] . ',id,' . $params[1]->id;
                unset($rules['password']);
            }
            if ($params[0] == 'password') {
                $rules['email'] = $rules['email'] . ',id,' . $params[1]->id;
            }
        }

        return $rules;
    }
}
