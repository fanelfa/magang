<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use Illuminate\Support\Str;
use Crypt;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $guru = Guru::all();
        
        if ($request->has('cari')) {
            $guru = Guru::where('name', 'LIKE', '%' . $request->cari . '%')->get();
        }

        $data = [
            'guru' => $guru,
        ];

        return view('guru.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('guru.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['id'] = (string)Str::uuid();
        Guru::create($data);

        return redirect()->route('guru.index');

        // $this->validate($request, [
        //     'avatar' => 'required|image',
        // ]);
        // $gambar = $request->avatar;
        // dd($gambar);
        // $namaFile = $gambar->getClientOriginalName();
        // dd($namaFile);
        // $request->file('avatar')->move('uploadgambar', $namaFile);
        
        // $do = $request->except('_token');
        // $do['id'] = (string)Str::uuid();
        // $do['avatar'] = $namaFile;
        // Guru::create($do);

        // return redirect()->route('guru.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guru = Guru::find($id);
        
        $data = [
            'guru' => $guru,
        ];

        return view('guru.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $guru = Guru::find($id);

        $data = [
            'guru' => $guru,
        ];

        return view('guru.edit', $data);
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
        // $guru = Guru::find($id);

        // $data = $request->except('_token');

        // $guru->update($data);

        // return redirect()->route('guru.index');

        $guru = Guru::find($id);
        $guru->update($request->except(['_token','avatar']));
        if ($request->hasFile('avatar')) {
            // dd($request->file('avatar'));
            //memindahkan request file avatar ke folder public/images dengan original name nya
            $request->file('avatar')->move('storage/', $request->file('avatar')->getClientOriginalName());
            $guru->avatar = $request->file('avatar')->getClientOriginalName();
            dd($guru);
            // $guru->save(); //simpan ke database
        }
        dd($guru);
        return redirect()->route('guru.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guru = Guru::find($id);

        $guru->delete();

        return redirect()->route('guru.index');
    }
}
