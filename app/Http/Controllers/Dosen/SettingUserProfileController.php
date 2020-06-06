<?php

namespace App\Http\Controllers\Dosen;

use App\Dosen;
use App\Http\Controllers\Controller;
use App\Http\Services\Dosen\DosenBaseService;
use Illuminate\Http\Request;

class SettingUserProfileController extends Controller
{
    private $dosenService;

    public function __construct(DosenBaseService $dosenService)
    {
        $this->dosenService = $dosenService;
    }

    public function index(Request $request)
    {
        $dosen = $request->user();
        return view('dosen.edit_profile', compact('dosen'));
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
        $dosen = Dosen::find($id);
        if ($request->password != null) {
            $res = $this->dosenService->update($dosen, 'password');
        } else {
            $res = $this->dosenService->update($dosen);
        }
        if ($res) {
            return redirect()->route('dosen.profile.index')->withSuccess('Berhasil di edit');
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
