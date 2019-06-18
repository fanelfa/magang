@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-9">
        <!-- TABLE HOVER -->
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Input Data Guru</h3>
                <form action="{{ route('guru.store') }}" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label>NIP</label>
                        <input name="nip" type="text" class="form-control" placeholder="Masukkan NIP" value="">
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input name="name" type="text" class="form-control" placeholder="Masukkan Nama" value="">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input name="lahir" type="date" class="form-control" placeholder="Masukkan Tanggal Lahir" value="">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3"></textarea>
                    </div>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
                <a href="{{ route('guru.index') }}">Batal</a>
            </div>
        </div>
    </div>
</div>
@endsection