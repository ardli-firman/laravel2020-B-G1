<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Mahasiswa\MahasiswaBaseService;
use App\Mahasiswa;
use Illuminate\Http\Request;

class MasterMahasiswaController extends Controller
{
    private $mhsService;

    public function __construct(MahasiswaBaseService $mhsService)
    {
        $this->mhsService = $mhsService;
    }

    public function index(Request $request)
    {
        $mahasiswa = $this->mhsService->getPaginate();
        if ($request->query('search')) {
            $mahasiswa = $this->mhsService->search($request->search);
        }
        return view('admin.master.mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $res = $this->mhsService->insertBatch();
        } else {
            $res = $this->mhsService->insert();
        };
        if ($res) {
            return redirect()->back()->withSuccess('Berhasil');
        }
    }

    public function show($nim)
    {
        $mahasiswa = $this->mhsService->findByNim($nim);
        return view('admin.master.mahasiswa.show', compact('mahasiswa'));
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
        //
    }
}
