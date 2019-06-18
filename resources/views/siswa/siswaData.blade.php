@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-9">
        <!-- TABLE HOVER -->
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Input Data Siswa</h3>
                <br/>
                <br/>
                <label for="tambah-data"><a href="/siswa/create">Tambah Data</a></label>
                <br/>
                <br/>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                                <th>Agama</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $paket)
                                <tr>
                                    <td>{{$paket->name}}</td>
                                    <td>{{$paket->lahir}}</td>
                                    <td>{{$paket->agama}}</td>
                                    <td>{{$paket->alamat}}</td>
                                    <td>
                                        <a href="/siswa/edit/{{$paket->id}}" class="btn btn-warning btn-sm">EDIT</a>
                                        <a href="/siswa/delete/{{$paket->id}}" onClick="return confirm('Yakin mau menghapus data siswa {{$paket->name}}?')" class="btn btn-danger btn-sm">HAPUS</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


@stop