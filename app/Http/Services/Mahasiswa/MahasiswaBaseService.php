<?php

namespace App\Http\Services\Mahasiswa;

use App\Http\Inter\UploadAbstract;
use App\Http\Tools\FileTrait;
use App\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\UpdateMahasiswaNotif;
use App\Notifications\DeleteMhsNotification;

class MahasiswaBaseService
{
    use FileTrait;

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function total()
    {
        return Mahasiswa::count();
    }

    public function getAll()
    {
        return Mahasiswa::all();
    }

    public function getDataTable()
    {
        return Mahasiswa::latest()->get();
    }

    public function getMahasiswasTA(Mahasiswa $mhs = null)
    {
        if ($mhs == null) {
            $mahasiswasTA = [];
            $mahasiswas = Mahasiswa::with('judul_tugas_akhir')->latest()->get();
            foreach ($mahasiswas as $mahasiswa) {
                if ($mahasiswa->judul_tugas_akhir()->exists()) {
                    $mahasiswasTA[] = $mahasiswa;
                }
            }
            return collect($mahasiswasTA);
        }
    }

    public function findByNim($nim, $params = null)
    {
        if ($params == 'ta') {
            return Mahasiswa::with('judul_tugas_akhir')->get()->find($nim);
        } else if ($params = 'pem') {
            return Mahasiswa::with('pembimbing')->get()->find($nim);
        }

        return Mahasiswa::find($nim);
    }

    public function search($value, $paginate = 5)
    {
        $mahasiswa = Mahasiswa::where('kelas', 'LIKE', "%{$value}%")->orWhere('nim', 'LIKE', "%{$value}%")->paginate($paginate);
        return $mahasiswa->appends(['search' => $value]);
    }

    public function getPaginate($total = 5)
    {
        return Mahasiswa::paginate($total);
    }

    public function insert()
    {
        $res = $this->request->validate($this->rules());
        $res['password'] = Hash::make($res['nim']);
        $res['foto'] = $this->uploadFoto();
        $res['file'] = $this->uploadFile();
        $mahasiswa = Mahasiswa::create($res);
        return $mahasiswa;
    }

    public function update(Mahasiswa $mahasiswa, $type = 'profile')
    {
        if ($type == 'profile') {
            $res = $this->request->validate($this->rules(['update' => true]));
        }
        if ($type == 'password') {
            $res = $this->request->validate($this->rules(['update' => true, 'password' => true]));
            $mahasiswa->password = Hash::make($this->request->password);
        }
        if ($mahasiswa->nim != $this->request->nim) {
            $mahasiswa->nim = $this->request->nim;
        }

        if ($mahasiswa->email != $this->request->email) {
            $mahasiswa->email = $this->request->email;
        }

        if ($this->request->foto != null) {
            $mahasiswa->foto = $this->uploadFoto($mahasiswa->foto);
        }

        if ($this->request->file != null) {
            $mahasiswa->file = $this->uploadFile($mahasiswa->file);
        }

        $mahasiswa->kelas = $this->request->kelas;
        $mahasiswa->nama = $this->request->nama;
        $mahasiswa->semester = $this->request->semester;
        $mahasiswa->tahun = $this->request->tahun;

        $mahasiswa->notify(new UpdateMahasiswaNotif($mahasiswa));

        return $mahasiswa->saveOrFail();
    }

    public function delete(Mahasiswa $mahasiswa)
    {
        $this->deleteFoto($mahasiswa->foto);
        $mahasiswa->notify(new DeleteMhsNotification($mahasiswa));
        $res = $mahasiswa->delete();
        return $res;
    }

    public function insertBatch()
    {
        $res = $this->request->validate($this->rulesBatch());
        $result = file_get_contents($res['file']->getRealPath(), true);
        $resDecode = json_decode($result);
        if ($resDecode != null) {
            for ($i = 0; $i < count($resDecode); $i++) {
                $arrResult[] = (array) $resDecode[$i];
                $arrResult[$i]['password'] = Hash::make($arrResult[$i]['nim']);
            }
            foreach ($arrResult as $value) {
                validator($value, $this->rules(), ['nim.unique' => 'NIM ' . $value['nim'] . ' has already been taken.'])->validate();
            }
            $mahasiswa = Mahasiswa::insert($arrResult);
            return $mahasiswa;
        }
        return false;
    }

    public function rulesBatch()
    {
        return [
            'file' => 'required|mimetypes:application/json'
        ];
    }

    public function rules($params = null)
    {
        $rules = [
            'nama' => 'required',
            'kelas' => 'required',
            'email' => 'required|email',
            'nim' => 'required|unique:mahasiswa|regex:/(([0-9]){8})/',
            'semester' => 'required|regex:/[1-8]/',
            'tahun' => 'required',
        ];

        if (isset($params['update'])) {
            $rules['nim'] = 'required|regex:/(([0-9]){8})/';
        }

        if (isset($params['password'])) {
            $rules['password'] = 'required|confirmed';
            $rules['password_confirmation'] = 'required';
        }

        return $rules;
    }
}
