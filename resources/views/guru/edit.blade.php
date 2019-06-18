@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-9">
        <!-- TABLE HOVER -->
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Input Data Guru</h3>
                <form action="{{ route('guru.update', $guru->id) }}" method="POST" >
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label>NIP</label>
                        <input name="nip" type="text" class="form-control" placeholder="Masukkan NIP" value="{{ $guru->nip }}">
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input name="name" type="text" class="form-control" placeholder="Masukkan Nama" value="{{ $guru->name }}">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input name="lahir" type="date" class="form-control" placeholder="Masukkan Tanggal Lahir" value="{{ $guru->lahir }}">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3">{{ $guru->alamat }}</textarea>
                    </div>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
                <div class="float-right">
                    <a class="btn btn-danger" href="{{ route('buku.index') }}">Batal</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection