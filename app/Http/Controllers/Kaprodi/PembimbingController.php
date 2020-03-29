<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Http\Services\Dosen\DosenBaseService;
use App\Http\Services\Dosen\PembimbingService;
use App\Http\Services\Mahasiswa\MahasiswaBaseService;
use App\Http\Services\TugasAkhir\TugasAkhirBaseService;
use Illuminate\Http\Request;

class PembimbingController extends Controller
{
    private $tugasAkhirService;
    private $mhsService;
    private $dosService;
    private $pembimbingService;

    public function __construct(
        TugasAkhirBaseService $tugasAkhirService,
        MahasiswaBaseService $mhsService,
        DosenBaseService $dosService,
        PembimbingService $pembimbingService
    ) {
        $this->tugasAkhirService = $tugasAkhirService;
        $this->mhsService = $mhsService;
        $this->dosService = $dosService;
        $this->pembimbingService = $pembimbingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_ta = $this->tugasAkhirService->getAllTugasAkhir(['status_ta' => 'diterima']);
        return view('kaprodi.pembimbing.index', compact('list_ta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mahasiswa = $this->mhsService->findByNim($id, 'pem');
        $pem1 = $this->pembimbingService->getKetPembimbing($mahasiswa, 1);
        $pem2 = $this->pembimbingService->getKetPembimbing($mahasiswa, 2);
        return view('kaprodi.pembimbing.show', compact('mahasiswa', 'pem1', 'pem2'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mahasiswa = $this->mhsService->findByNim($id, 'pem');
        $pembimbing = $this->pembimbingService->getAvailPembimbing()->pluck('nama', 'id');
        $pem1 = $this->pembimbingService->getKetPembimbing($mahasiswa, 1);
        $pem2 = $this->pembimbingService->getKetPembimbing($mahasiswa, 2);
        return view('kaprodi.pembimbing.edit', compact('mahasiswa', 'pembimbing', 'pem1', 'pem2'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->pembimbingService->update($id);
        return redirect()->route('kaprodi.pembimbing.index')->withSuccess('Berhasil di tambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
