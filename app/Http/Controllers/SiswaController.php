<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Siswa;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $siswa = Siswa::all();

        // Untuk Pencarian
        if ($request->has('cari')) {
            $siswa = Siswa::where('name', 'LIKE', '%' . $request->cari . '%')->get();
        }

        $data = [
            'siswa' => $siswa,
        ];

        return view('siswa.siswaData', $data);
    }

    public function create()
    {
        return view('siswa.siswaInput');
    }

    public function store(Request $request)
    {
        // dd($request->name);
        // $data = $request->except('_token');
        $uuid = (string)Str::uuid();
        // $data['id'] = $uuid;

        // Siswa::create($data);

        $addSiswa = new Siswa();

        // $addSiswa = Siswa::where('id', $uuid)->first();
        
        $this->validate($request,[
            'name' => 'required|min:3|max:255',
            'agama' => 'required|min:5|max:15',
            'alamat' => 'required|min:5|max:255',
            'lahir' => 'required|date'
        ]);

        $addSiswa->id = $uuid;
        $addSiswa->name = $request->name;
        $addSiswa->agama = $request->agama;
        $addSiswa->alamat = $request->alamat;        
        $addSiswa->lahir = $request->lahir;        

        $addSiswa->save();

        // dd($data);

        return redirect()->route('siswa.index');
    }

    function delete($id){
        // dd($id);
        $siswa = Siswa::find($id);
        // dd($siswa);
        $siswa->delete($siswa);

        return redirect()->route('siswa.index');
    }

    public function edit($id){
        $siswa = Siswa::find($id);
        
        $data = [
            'siswa' => $siswa
        ];

        return view('siswa.update', $data);
    }
    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);

        $siswa->id = $id;
        $siswa->name = $request->name;
        $siswa->agama = $request->agama;
        $siswa->alamat = $request->alamat;
        $siswa->lahir = $request->lahir;

        $siswa->save();

        return redirect()->route('siswa.index');
    }
    // function tambah(Request $request){
    //     Siswa::create($request->all());

    //     return $this->index();
    // }
    // function index(){
    //     $siswa = Siswa::all();

    //     $data = [
    //         'siswa' => $siswa,
    //     ];

    //     dd($siswa);
    // }
}
