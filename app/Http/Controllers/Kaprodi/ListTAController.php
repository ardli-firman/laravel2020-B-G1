<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Http\Services\Mahasiswa\MahasiswaBaseService;
use App\Http\Services\TugasAkhir\TugasAkhirBaseService;
use App\JudulTugasAkhir;
use Illuminate\Http\Request;

class ListTAController extends Controller
{

    private $tugasAkhirService;
    private $mhsService;

    public function __construct(TugasAkhirBaseService $tugasAkhirService, MahasiswaBaseService $mhsService)
    {
        $this->tugasAkhirService = $tugasAkhirService;
        $this->mhsService = $mhsService;
    }

    public function index()
    {
        $list_ta = $this->tugasAkhirService->getAllTugasAkhir();
        return view('kaprodi.list_ta', compact('list_ta'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
        $ta = $this->tugasAkhirService->getTA($id);
        return view('kaprodi.detail', compact('ta'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $res = $this->tugasAkhirService->delete($id);
        if ($res) {
            return redirect()->back()->withSuccess('Berhasil di hapus');
        }
        return redirect()->back()->withErrors('Gagal dihapus');
    }
}
