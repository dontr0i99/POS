@extends('layouts.app')
{{-- Customize layout section --}}
@section('subtitle','User')
@section('content_header_title','User')
@section('content_header_subtitle','Create')
{{-- Content body: main page content --}}
@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Buat User Baru</h3>
            </div>

            <form method="POST" action="../kategori">
                <div class="card-body">
                    <div class="form-group">
                        <label for="kodeKategori">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="userame">
                    </div>
                    <div class="form-group">
                        <label for="namaKategori">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label for="namaKategori">Password</label>
                        <input type="text" class="form-control" id="password" name="password" placeholder="password">
                    </div>
                    <div class="form-group">
                        <label for="namaKategori">Level</label>
                        <input type="text" class="form-control" id="level" name="level" placeholder="level">
                    </div>
                </div>
                <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection