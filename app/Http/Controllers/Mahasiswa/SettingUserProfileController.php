<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Dosen;
use App\Http\Controllers\Controller;
use App\Http\Services\Mahasiswa\MahasiswaBaseService;
use App\Kaprodi;
use App\Mahasiswa;
use Illuminate\Http\Request;

class SettingUserProfileController extends Controller
{
    private $mhsBaseService;

    public function __construct(MahasiswaBaseService $mhsBaseService)
    {
        $this->mhsBaseService = $mhsBaseService;
    }

    public function index(Request $request)
    {
        $mahasiswa = $request->user();
        return view('mahasiswa.edit_profile', compact('mahasiswa'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $mahasiswa = Mahasiswa::find($id);
        if ($request->password != null) {
            $res = $this->mhsBaseService->update($mahasiswa, 'password');
        } else {
            $res = $this->mhsBaseService->update($mahasiswa);
        }
        if ($res) {
            return redirect()->route('mahasiswa.profile.index')->withSuccess('Berhasil di edit');
        }
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
