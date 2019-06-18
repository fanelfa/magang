@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-9">
        <!-- TABLE HOVER -->
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Input Data Buku</h3>
                <form action="{{ route('buku.store') }}" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label>Judul</label>
                        <input name="judul" type="text" class="form-control" placeholder="Masukkan Judul" value="">
                    </div>
                    <div class="form-group">
                        <label>Pengarang</label>
                        <input name="pengarang" type="text" class="form-control" placeholder="Masukkan Nama Pengarang" value="">
                    </div>
                    <div class="form-group">
                        <label>Penerbit</label>
                        <input name="penerbit" type="text" class="form-control" placeholder="Masukkan Penerbit" value="">
                    </div>
                    <div class="form-group">
                        <label>Tahun Terbit</label>
                        <input name="tahun_terbit" type="text" class="form-control" placeholder="Masukkan Tahun Buku Diterbitkan" value="">
                    </div>
                    <div class="form-group">
                        <label>Kota</label>
                        <input name="kota" type="text" class="form-control" placeholder="Masukkan Kota" value="">
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