@extends('layout.index')

<!-- main content -->
<!-- page Title -->
@section('page-title','Laporan')
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
        {{-- <button class="btn btn-sm btn-primary" onclick="tambah()"><i class="fa fa-plus"></i> Tambah Catatan</button> --}}
        <table id="table" class="table table-striped table-bordered table-responsive" style="width: 100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th style="width: 10%">Nama Member</th>
                    <th style="width: 10%">Jenis Pelayanan</th>
                    <th style="width: 20%">Tanggal Booking</th>
                    <th style="width: 20%">Catatan</th>
                    <th style="width: 20%">Catatan</th>
                    <th style="width: 20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporan as $no => $item)
                    <tr>
                        <td>{{$no+1}}</td>
                        <td>{{$item->nama_member}}</td>
                        <td>{{$item->pelayanan}}</td>
                        <td>{{tanggal_indonesia($item->tanggal_booking)}}</td>
                        <td>{{$item->catatan1}}</td>
                        <td>{{$item->catatan2}}</td>
                        <td>
                            <?php if($item->catatan1 || $item->catatan2 != null){?>
                                <a href="{{route('editcatatan', $item->id_booking)}}" class="btn btn-sm btn-warning">Ubah Catatan</a>
                            <?php } else {?>
                                <a href="{{route('addcatatan', $item->id_booking)}}" class="btn btn-sm btn-primary">Tambah Catatan</a>
                            <?php } ?>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $('#table').DataTable()
</script>
@endsection
