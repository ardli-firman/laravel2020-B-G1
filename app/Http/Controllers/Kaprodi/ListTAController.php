<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Http\Services\TugasAkhir\TugasAkhirBaseService;
use Illuminate\Http\Request;

class ListTAController extends Controller
{

    private $tugasAkhirService;

    public function __construct(TugasAkhirBaseService $tugasAkhirService)
    {
        $this->tugasAkhirService = $tugasAkhirService;
    }

    public function index()
    {
        $ta = $this->tugasAkhirService->getTugasAkhir();
        if (!$ta) {
            return view('kaprodi.no_ta');
        }
        return view('kaprodi.ta', compact('ta'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $res = $this->tugasAkhirService->insert();
        if ($res) {
            return redirect()->route('kaprodi.TA.index')->withSuccess('Berhasil di tambahkan');
        }
    }

    public function show($id)
    {
        //
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