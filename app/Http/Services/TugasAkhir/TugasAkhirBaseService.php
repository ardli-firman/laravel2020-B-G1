<?php

namespace App\Http\Services\TugasAkhir;

use App\JudulTugasAkhir;
use App\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasAkhirBaseService
{
    private $auth;
    private $request;

    public function __construct(Request $request)
    {
        $this->auth = Auth::guard('mahasiswa');
        $this->request = $request;
    }

    public function getTugasAkhir()
    {
        return $this->auth->user()->judul_tugas_akhir->first();
    }

    public function insert()
    {
        $res = $this->request->validate($this->rules());
        $ta = new JudulTugasAkhir();
        $ta->judul = $res['judul'];
        $ta->manfaat = $res['manfaat'];
        $ta->deskripsi = $res['deskripsi'];
        $ta->status_ta = 'menunggu';

        $ta->mahasiswa()->associate($this->auth->user());
        return $ta->save();
    }

    public function update($nim)
    {
        $this->request->validate(['status_ta' => 'required']);
        $res = JudulTugasAkhir::where('nim', $nim)->update(['status_ta' => $this->request->status_ta]);
        return $res;
    }

    public function rules()
    {
        return [
            'judul' => 'required',
            'manfaat' => 'required',
            'deskripsi' => 'required'
        ];
    }
}
