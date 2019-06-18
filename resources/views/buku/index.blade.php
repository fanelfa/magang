@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-9">
        <!-- TABLE HOVER -->
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Daftar Buku</h3>
                <br/>
                <br/>
                <label for="tambah-data"><a href="{{ url('/buku/create') }}">Tambah Data Buku</a></label>
                <br/>
                <br/>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Judul</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Tahun</th>
                                <th>Kota</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($buku as $value)
                            <tr>
                                <td>{{$value->judul}}</td>
                                <td>{{$value->pengarang}}</td>
                                <td>{{$value->penerbit}}</td>
                                <td>{{$value->tahun_terbit}}</td>
                                <td>{{$value->kota}}</td>
                                <td>
                                    {{-- <a href="/siswa/edit/{{$value->id}}" class="btn btn-warning btn-sm">EDIT</a> --}}
                                    <a href="{{ route('buku.edit', ['data'=>Crypt::encrypt($value->id)]) }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> EDIT</a>

                                    <a class="btn btn-danger btn-xs btn-delete" data-file="{{$value->id}}"><i class="fa fa-trash-o"></i> HAPUS</a>

                                    <form action="{{ route('buku.destroy', $value->id) }}" method="POST" style="display: none;" id="{{$value->id}}">
                                    @method('DELETE')
                                    @csrf
                                    </form>

                                    {{-- <a href="/siswa/delete/{{$value->id}}" onClick="return confirm('Yakin mau menghapus data siswa {{$value->name}}?')" class="btn btn-danger btn-sm">HAPUS</a></td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
    <script>
        $('.btn-delete').on('click', function(e){
            e.preventDefault();
            var data = $(this).attr('data-file');

            $("#"+data).submit();
        });
    </script>
@endsection