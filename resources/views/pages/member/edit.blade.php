@extends('layout.index')

<!-- main content -->
<!-- page Title -->
@section('page-title','Edit Data Member')
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
        <form action="{{route('updatemember')}}" method="POST">
            @method('PUT')
            @csrf
            <label for="">Username</label>
            <input type="hidden" class="form-control" name="id_member" value="{{$data->id_member}}">
            <input type="text" class="form-control" id="username" name="username" value="{{$data->username}}">
            <label for="">Password</label>
            <input type="text" class="form-control" id="password" name="password" value="{{$data->password1}}">
            <label for="">Ulangi Password</label>
            <input type="text" class="form-control" id="password1" name="password1" value="{{$data->password1}}">
            <label for="">Nama Member</label>
            <input type="text" class="form-control" id="nama_member" name="nama_member" value="{{$data->nama_member}}">
            <label for="">Pangkat</label>
            <input type="text" class="form-control" id="pangkat" name="pangkat" value="{{$data->pangkat}}">
            <label for="">Satuan Kerja</label>
            <input type="text" class="form-control" id="satuan_kerja" name="satuan_kerja" value="{{$data->satuan_kerja}}">
            <label for="">Tempat Tanggal Lahir</label>
            <input type="text" class="form-control" id="lahir" name="lahir" value="{{$data->lahir}}">
            <label for="">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{$data->alamat}}">
            <label for="">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                <option value="Perempuan">Perempuan</option>
                <option value="Pria">Pria</option>
            </select>
            <label for="">BPJS</label>
            <input type="text" class="form-control" id="bpjs" name="bpjs" value="{{$data->bpjs}}">
            <label for="">Kelas Pasien</label>
            <select name="pasien" id="pasien" class="form-control">
                <option value="Militer">Militer</option>
                <option value="PNS">PNS</option>
                <option value="Keluarga Militer">Keluarga Militer</option>
                <option value="Keluarga PNS">Keluarga PNS</option>
                <option value="BPJS">BPJS</option>
                <option value="Non BPJS">Non BPJS</option>
            </select>
            <br>
            <button class="btn btn-sm btn-primary" id="simpan">Simpan</button>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#jenis_kelamin').val('<?php echo $data->jenis_kelamin ?>')
        $('#pasien').val('<?php echo $data->pasien ?>')
    });
</script>
@endsection
