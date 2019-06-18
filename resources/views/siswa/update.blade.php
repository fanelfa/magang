@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-9">
        <!-- TABLE HOVER -->
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Input Data Siswa</h3>
                    <form action="/siswa/update/{{ $siswa->id }}" method="POST" >
                        @csrf
                        <div class="form-group">
                            <label>Nama</label>
                        <input name="name" type="text" class="form-control" placeholder="Nama" value="{{ $siswa->name }}">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input name="lahir" type="date" class="form-control" placeholder="Tanggal Lahir" value="{{ $siswa->lahir }}">
                        </div>
                        <div class="form-group">
                            <label>Agama</label>
                            <input name="agama" type="text" class="form-control" placeholder="Agama" value="{{ $siswa->agama }}">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3">{{ $siswa->alamat }}</textarea>
                        </div>
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                <a href="{{ route('siswa.index') }}">Batal</a>
            </div>
        </div>
    </div>

    
@endsection