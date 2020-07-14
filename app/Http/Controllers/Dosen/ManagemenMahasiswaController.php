<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Services\Mahasiswa\MahasiswaBaseService;
use App\Mahasiswa;

class ManagemenMahasiswaController extends Controller
{

    private $mhsService;

    public function __construct(MahasiswaBaseService $mhsService)
    {
        $this->mhsService = $mhsService;
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $mahasiswa = $this->mhsService->getDataTable();
            return DataTables::of($mahasiswa)
                ->addIndexColumn()
                ->editColumn('nama', function ($data) {
                    return $data->nama;
                })
                ->editColumn('email', function ($data) {
                    return $data->email;
                })
                ->editColumn('nim', function ($data) {
                    return $data->nim;
                })
                ->editColumn('kelas', function ($data) {
                    return $data->kelas;
                })
                ->addColumn('aksi', function ($data) {
                    $btn = "<a href='" . route('dosen.mahasiswa.show', $data->nim) . "' class='btn btn-sm btn-primary'>Detail</a>";
                    $btn .= view('dosen.mahasiswa.action', compact('data'));
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('dosen.mahasiswa.index');
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
        $res = $this->mhsService->insert();
        
        if ($res) {
            return redirect()->back()->withSuccess('Berhasil');
        }
        return redirect()->back()->withErrors('Gagal ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nim)
    {
        $mahasiswa = $this->mhsService->findByNim($nim);
        return view('dosen.mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('dosen.mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        if ($request->password != null) {
            $res = $this->mhsService->update($mahasiswa, 'password');
        } else {
            $res = $this->mhsService->update($mahasiswa);
        }
        if ($res) {
            return redirect()->route('dosen.mahasiswa.index')->withSuccess('Berhasil di edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $res = $this->mhsService->delete($mahasiswa);
        if ($res) {
            return redirect()->back()->withSuccess('Berhasil di hapus');
        }
        return redirect()->back()->withErrors('Gagal dihapus');
    }
}
