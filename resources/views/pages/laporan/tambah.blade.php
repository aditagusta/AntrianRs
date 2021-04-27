@extends('layout.index')

<!-- main content -->
<!-- page Title -->
@section('page-title','Tambah Catatan Hasil Tes')
<!-- Page Content -->
@section('content')
<div class="row mt-3">
    <div class="col-sm-12 col-md-12">
        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <form action="{{url('tambah/data/laporan')}}" method="POST">
            @csrf
            <input type="hidden" class="form-control" name="id_booking" value="{{$data->id_booking}}">
            <label for="">Nama Pasien</label>
            <input type="text" class="form-control" value="{{$data->nama_member}}" readonly>
            <label for="">Jenis Pelayanan</label>
            <input type="text" class="form-control" value="{{$data->pelayanan}}" readonly>
            <label for="">Tanggal Booking</label>
            <input type="text" class="form-control" value="{{$data->tanggal_booking}}" readonly>
            <label for="">Catatan 1</label>
            <textarea name="catatan1" id="" cols="30" rows="10" class="form-control"></textarea>
            <label for="">Catatan 2</label>
            <textarea name="catatan2" id="" cols="30" rows="10" class="form-control"></textarea>
            <br>
            <button class="btn btn-sm btn-primary" id="simpan">Simpan</button>
        </form>
    </div>
</div>
@endsection
