<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Kaprodi\KaprodiBaseService;
use App\Http\Services\Mahasiswa\MahasiswaBaseService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MasterKaprodiController extends Controller
{
    private $kaprodiService;

    public function __construct(KaprodiBaseService $kaprodiService)
    {
        $this->kaprodiService = $kaprodiService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $kaprodi = $this->kaprodiService->getDataTable();
            return DataTables::of($kaprodi)
                ->addIndexColumn()
                ->editColumn('nama', function ($data) {
                    return $data->nama;
                })
                ->editColumn('email', function ($data) {
                    return $data->email;
                })
                ->addColumn('aksi', function ($data) {
                    $btn = "<a href='" . route('admin.master.kaprodi.show', $data->id) . "' class='btn btn-sm btn-primary'>Detail</a>";
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin.master.kaprodi.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $res = $this->kaprodiService->insert();
        if ($res) {
            return redirect()->back()->withSuccess('Berhasil');
        }
    }

    public function show($id)
    {
        $kaprodi = $this->kaprodiService->find($id);
        return view('admin.master.kaprodi.show', compact('kaprodi'));
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
