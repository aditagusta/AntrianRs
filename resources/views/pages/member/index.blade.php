@extends('layout.index')

<!-- main content -->
<!-- page Title -->
@section('page-title','Data Member')
<!-- Page Content -->
@section('content')
<div class="row mt-3">
    <div class="col-sm-12 col-md-12">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif

        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <button class="btn btn-sm btn-primary" onclick="tambah()"><i class="fa fa-plus"></i> Member</button>
        <table id="table" class="table table-striped table-bordered table-responsive">
            <thead>
                <tr>
                    <th>No</th>
                    <th style="width: 10%">Nama Member</th>
                    <th style="width: 10%">Pangkat</th>
                    <th style="width: 10%">Satuan Kerja</th>
                    <th style="width: 20%">Lahir</th>
                    <th style="width: 10%">Alamat</th>
                    <th style="width: 10%">Jenis Kelamin</th>
                    <th style="width: 10%">BPJS</th>
                    <th style="width: 10%">Kelas Pasien</th>
                    <th style="width: 10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $no => $item)
                    <tr>
                        <td>{{$no+1}}</td>
                        <td>{{$item->nama_member}}</td>
                        <td>{{$item->pangkat}}</td>
                        <td>{{$item->satuan_kerja}}</td>
                        <td>{{$item->lahir}}</td>
                        <td>{{$item->alamat}}</td>
                        <td>{{$item->jenis_kelamin}}</td>
                        <td>{{$item->bpjs}}</td>
                        <td>{{$item->pasien}}</td>
                        <td>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <a href="{{route('editmember',$item->id_member)}}" class="btn btn-sm btn-warning"> Ubah</a>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <form action="{{route('hapusmember',$item->id_member)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-sm btn-danger" type="submit"> Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="judul">Form Tambah Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('tambahmember')}}" method="POST">
              @csrf
              <label for="">Username</label>
              <input type="text" class="form-control" id="username" name="username">
              <label for="">Password</label>
              <input type="text" class="form-control" id="password" name="password">
              <label for="">Ulangi Password</label>
              <input type="text" class="form-control" id="password1" name="password1">
              <label for="">Nama Member</label>
              <input type="text" class="form-control" id="nama_member" name="nama_member">
              <label for="">Pangkat</label>
              <input type="text" class="form-control" id="pangkat" name="pangkat">
              <label for="">Satuan Kerja</label>
              <input type="text" class="form-control" id="satuan_kerja" name="satuan_kerja">
              <label for="">Tempat Tanggal Lahir</label>
              <input type="text" class="form-control" id="lahir" name="lahir">
              <label for="">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat">
              <label for="">Jenis Kelamin</label>
              <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                  <option value="Perempuan">Perempuan</option>
                  <option value="Pria">Pria</option>
              </select>
              <label for="">BPJS</label>
              <input type="text" class="form-control" id="bpjs" name="bpjs">
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
    </div>
  </div>
<script>
    function tambah()
    {
        $('#addModal').modal('show')
    }

    $('#table').DataTable()
</script>
@endsection
