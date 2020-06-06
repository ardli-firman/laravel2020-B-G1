<?php

namespace App\Http\Services\Admin;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminBaseService
{
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function updateProfile($id = null)
    {
        $rules = $this->rules();
        if ($this->request->password != null || $this->request->password_confirmation != null) {
            $rules = $this->rules('password');
        }
        $this->request->validate($rules);
        $admin = Admin::find($id);
        if (isset($rules['password'])) {
            $admin->password = Hash::make($this->request->password);
        }
        $admin->nama = $this->request->nama;
        $admin->email = $this->request->email;
        return $admin->save();
    }

    private function rules($params = null)
    {
        $rules = [
            'nama' => 'required',
            'email' => 'required'
        ];

        if ($params == 'password') {
            $rules['password'] = 'required|confirmed';
            $rules['password_confirmation'] = 'required';
        }

        return $rules;
    }
}
