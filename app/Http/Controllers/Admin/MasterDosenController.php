<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Dosen\DosenBaseService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MasterDosenController extends Controller
{
    private $dosenService;

    public function __construct(DosenBaseService $dosenService)
    {
        $this->dosenService = $dosenService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $dosen = $this->dosenService->getDataTable();
            return DataTables::of($dosen)
                ->addIndexColumn()
                ->editColumn('nama', function ($data) {
                    return $data->nama;
                })
                ->editColumn('email', function ($data) {
                    return $data->email;
                })
                ->addColumn('aksi', function ($data) {
                    $btn = "<a href='" . route('admin.master.dosen.show', $data->id) . "' class='btn btn-sm btn-primary'>Detail</a>";
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('admin.master.dosen.index');
    }

    public function indexDosen(Request $request)
    {
        // dd($this->dosenService->getDataTable());
        if ($request->ajax()) {
            $dosen = $this->dosenService->getDataTable();
            return DataTables::of($dosen)
                ->addIndexColumn()
                ->editColumn('nama', function ($data) {
                    return $data->nama;
                })
                ->editColumn('email', function ($data) {
                    return $data->email;
                })
                ->addColumn('aksi', function ($data) {
                    $btn = "<a href='" . route('kaprodi.dosen.show', $data->id) . "' class='btn btn-sm btn-primary'>Detail</a>";
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('kaprodi.dosen.index');   
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $res = $this->dosenService->insert();
        if ($res) {
            return redirect()->back()->withSuccess('Berhasil');
        }
    }

    public function show($id)
    {
        $dosen = $this->dosenService->find($id);
        return view('admin.master.dosen.show', compact('dosen'));
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
