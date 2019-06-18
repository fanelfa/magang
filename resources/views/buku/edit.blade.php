@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-9">
        <!-- TABLE HOVER -->
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Input Data Guru</h3>
                <form action="{{ route('buku.update', $buku->id) }}" method="POST" >
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label>Judul</label>
                        <input name="judul" type="text" class="form-control" placeholder="Masukkan Judul" value="{{ $buku->judul }}">
                    </div>
                    <div class="form-group">
                        <label>Pengarang</label>
                        <input name="pengarang" type="text" class="form-control" placeholder="Masukkan Nama Pengarang" value="{{ $buku->pengarang }}">
                    </div>
                    <div class="form-group">
                        <label>Penerbit</label>
                        <input name="penerbit" type="text" class="form-control" placeholder="Masukkan Penerbit" value="{{ $buku->penerbit }}">
                    </div>
                    <div class="form-group">
                        <label>Tahun Terbit</label>
                        <input name="tahun_terbit" type="text" class="form-control" placeholder="Masukkan Tahun Buku Diterbitkan" value="{{ $buku->tahun_terbit }}">
                    </div>
                    <div class="form-group">
                        <label>Kota</label>
                        <input name="kota" type="text" class="form-control" placeholder="Masukkan Kota" value="{{ $buku->kota }}">
                    </div>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
                <br/>
                <br/>
                <div class="float-right">
                    <a class="btn btn-danger" href="{{ route('buku.index') }}">Batal</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection