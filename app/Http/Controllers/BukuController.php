<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buku = Buku::all();

        if ($request->has('cari')) {
            $buku = Buku::where('judul', 'LIKE', '%' . $request->cari . '%')->get();
        }        

        // dd($buku[0]->created_at);

        $data = [
            'buku' => $buku
        ];

        return view('buku.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buku.create');
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

        Buku::create($data);

        return redirect()->route('buku.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buku = Buku::find($id);

        $data = [
            'buku' => $buku
        ];

        return view('buku.show', $data);
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
        $buku = Buku::find($id);

        $data = [
            'buku' => $buku
        ];

        return view('buku.edit', $data);
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
        $buku = Buku::find($id);

        $data = $request->except('_token');
        $buku->update($data);

        // dd($buku->created_at);

        return redirect()->route('buku.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Buku::find($id);

        $buku->delete();

        return redirect()->route('buku.index');
    }

    public function search(){
        $words   = (new Words)->whereHas('translations', function ($q) use ($keywords) {
            $q->where('name', 'like', '%' . $keywords . '%')
                ->orWhere('details', 'like', '%' . $keywords . '%');
        })->get();
    }
}
