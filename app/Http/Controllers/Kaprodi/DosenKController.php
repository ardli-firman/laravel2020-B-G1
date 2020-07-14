<?php

namespace App\Http\Controllers\Kaprodi;

use App\Dosen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Dosen\DosenBaseService;
use Yajra\DataTables\DataTables;


class DosenKController extends Controller
{
    private $dosenService;

    public function __construct(DosenBaseService $dosenService)
    {
        $this->dosenService = $dosenService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
                    $btn .= view('kaprodi.dosen.view.viewform', compact('data'));
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('kaprodi.dosen.index');
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
        $res = $this->dosenService->insert();
        if ($res) {
            return redirect()->back()->withSuccess('Berhasil');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dosen = $this->dosenService->find($id);
        return view('kaprodi.dosen.show', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dosen $dosen)
    {
        return view('kaprodi.dosen.edit', compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dosen $dosen)
    {
        if ($request->password != null) {
            $res = $this->dosenService->update($dosen, 'password');
        } else {
            $res = $this->dosenService->update($dosen);
        }
        if ($res) {
            return redirect()->route('kaprodi.dosen.index')->withSuccess('Berhasil di edit');
        }
    }

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dosen $dosen)
    {
        // dd($dosen)
        $res = $this->dosenService->delete($dosen);
        if ($res) {
            return redirect()->back()->withSuccess('Berhasil di hapus');
        }
        return redirect()->back()->withErrors('Gagal dihapus');
    }
}
