@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a href="{{url('user/create')}}" class="btn btn-sm btn-primary mt-1">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif
            <table class="table table-bordered table-striped table-hover table-sm" id="table_user">
                <thead>
                    <tr><th>ID</th><th>Username</th><th>Nama</th><th>Level Pengguna</th><th>Aksi</th></tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('css')
@endpush

@push('js')
    <script>
        $(document).ready(function(){
            var dataUser = $('#table_user').DataTable({
                serverSide: true, //serverside true jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ url('user/list') }}",
                    "dataType": "json",
                    "type": "POST"
                },
                columns: [
                    {
                        data: "DT_RowIndex", //nomor urut dari laravel datatable addindexcolumn()
                        classname: "text-center",
                        orderable: false,
                        searchable: false
                    },{
                        data: "username",
                        classname: "",
                        orderable: true, //orderable true jika ingin kolom bisa diurutkan
                        searchable: true //searchable true jika ingin kolom bisa dicari
                    },{
                        data: "nama",
                        classname: "",
                        orderable: true, //orderable true jika ingin kolom bisa diurutkan
                        searchable: true //searchable true jika ingin kolom bisa dicari
                    },{
                        data: "level.level_nama",
                        classname: "",
                        orderable: false, //orderable true jika ingin kolom bisa diurutkan
                        searchable: false //searchable true jika ingin kolom bisa dicari
                    },{
                        data: "aksi",
                        classname: "",
                        orderable: false, //orderable true jika ingin kolom bisa diurutkan
                        searchable: false //searchable true jika ingin kolom bisa dicari
                    }
                ]
            });
        });
    </script>
@endpush