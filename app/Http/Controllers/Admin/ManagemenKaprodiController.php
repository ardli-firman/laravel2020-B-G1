<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Kaprodi\KaprodiBaseService;
use App\Kaprodi;
use Illuminate\Http\Request;

class ManagemenKaprodiController extends Controller
{
    private $kaprodiService;

    public function __construct(KaprodiBaseService $kaprodiService)
    {
        $this->kaprodiService = $kaprodiService;
    }

    public function index()
    {
        $kaprodi = $this->kaprodiService->getPaginate(5);
        return view('admin.managemen_user.kaprodi.index', compact('kaprodi'));
    }
    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(Kaprodi $kaprodi)
    {
    }

    public function edit(Kaprodi $kaprodi)
    {
        return view('admin.managemen_user.kaprodi.edit', compact('kaprodi'));
    }

    public function update(Request $request, Kaprodi $kaprodi)
    {
        if ($request->password != null) {
            $res = $this->kaprodiService->update($kaprodi, 'password');
        } else {
            $res = $this->kaprodiService->update($kaprodi);
        }
        if ($res) {
            return redirect()->route('admin.managemen.kaprodi.index')->withSuccess('Berhasil di edit');
        }
    }

    public function destroy(Kaprodi $kaprodi)
    {
        $res = $this->kaprodiService->delete($kaprodi);
        if ($res) {
            return redirect()->back()->withSuccess('Berhasil di hapus');
        }
        return redirect()->back()->withErrors('Gagal dihapus');
    }
}
