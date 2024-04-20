@extends('layouts.app')
{{-- Customize layout section --}}
@section('subtitle','Level')
@section('content_header_title','Level')
@section('content_header_subtitle','Create')
{{-- Content body: main page content --}}
@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Buat Level Baru</h3>
            </div>

            <form method="POST" action="../kategori">
                <div class="card-body">
                    <div class="form-group">
                        <label for="kodeKategori">Kode Level</label>
                        <input type="text" class="form-control" id="kodeLevel" name="kodeLevel" placeholder="kode level">
                    </div>
                    <div class="form-group">
                        <label for="namaKategori">Nama Level</label>
                        <input type="text" class="form-control" id="namaLevel" name="namaLevel" placeholder="Nama Level">
                    </div>
                </div>
                <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection