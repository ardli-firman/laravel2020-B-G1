<?php

namespace App\Http\Controllers\Kaprodi;

use App\Dosen;
use App\Http\Controllers\Controller;
use App\Http\Services\Kaprodi\KaprodiBaseService;
use App\Kaprodi;
use Illuminate\Http\Request;

class SettingUserProfileController extends Controller
{
    private $kaprodiService;

    public function __construct(KaprodiBaseService $kaprodiService)
    {
        $this->kaprodiService = $kaprodiService;
    }

    public function index(Request $request)
    {
        $kaprodi = $request->user();
        return view('kaprodi.edit_profile', compact('kaprodi'));
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
        $kaprodi = Kaprodi::find($id);
        if ($request->password != null) {
            $res = $this->kaprodiService->update($kaprodi, 'password');
        } else {
            $res = $this->kaprodiService->update($kaprodi);
        }
        if ($res) {
            return redirect()->route('kaprodi.profile.index')->withSuccess('Berhasil di edit');
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
