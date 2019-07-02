@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-9">
        <!-- TABLE HOVER -->
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Daftar Buku</h3>
                <!-- Button trigger modal -->
                <div class="right">
                    <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle"></i></button>
                </div>
            </div>
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
                                {{-- <a href="{{ route('buku.edit', ['data'=>Crypt::encrypt($value->id)]) }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> EDIT</a> --}}
                                <button type="button" class="btn btn-warning btn-xs" data-id="{{encrypt($value->id)}}" data-judul="{{$value->judul}}" data-pengarang="{{$value->pengarang}}" data-penerbit="{{$value->penerbit}}" data-tahun_terbit="{{$value->tahun_terbit}}" data-kota="{{$value->kota}}" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i> EDIT</button>

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


<!-- Tambah Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title id="exampleModalLabel">Tambah Data Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('buku.store') }}" method="POST">
                @csrf
                @include('buku.include.form')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title id="editModalLabel">Edit Data Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- <form action="" method="POST"> --}}
                <form action="{{ route('buku.update',['id'=>'1']) }}" method="POST">
                @method('PUT')
                @csrf
                @include('buku.include.form')
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script>
            
    $('.btn-delete').on('click', function(e){
        e.preventDefault();
        var data = $(this).attr('data-file');

        $("#"+data).submit();
    });

    // modal edit data
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')  
        var judul = button.data('judul') 
        var pengarang = button.data('pengarang') 
        var penerbit = button.data('penerbit') 
        var tahun_terbit = button.data('tahun_terbit') 
        var kota = button.data('kota') 

        var modal = $(this)

        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #judul').val(judul)
        modal.find('.modal-body #pengarang').val(pengarang)
        modal.find('.modal-body #penerbit').val(penerbit)
        modal.find('.modal-body #tahun_terbit').val(tahun_terbit)
        modal.find('.modal-body #kota').val(kota)
    });

</script>

@endsection