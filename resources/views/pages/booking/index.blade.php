@extends('layout.index')

<!-- main content -->
<!-- page Title -->
@section('page-title','Data Booking Member')
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
        <a href="{{route('exportbooking')}}" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-excel-o"></i> Export Excel</a>
        <table id="table" class="table table-striped table-bordered table-responsive" style="width: 100%">
            <thead>
                <tr>
                    <th style="width: 5%">No</th>
                    <th style="width: 10%">Nama Member</th>
                    <th style="width: 10%">BPJS</th>
                    <th style="width: 10%">Jenis Pelayanan</th>
                    <th style="width: 10%">Tanggal Booking</th>
                    <th style="width: 5%">Nomor Antrian</th>
                    <th style="width: 15%">Status</th>
                    <th style="width: 10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $no => $item)
                    <tr>
                        <td>{{$no+1}}</td>
                        <td>{{$item->nama_member}}</td>
                        <td>{{$item->bpjs}}</td>
                        <td>{{$item->pelayanan}}</td>
                        <td>{{tanggal_indonesia($item->tanggal_booking)}}</td>
                        <td>{{$item->no_antrian}}</td>
                        <td>
                            <?php
                                $today = date('Y-m-d');
                                if($item->tanggal_booking < $today){
                            ?>
                            <div class="alert alert-danger" align=center role="alert">
                                Expired
                            </div>
                            <?php } else { ?>
                            <div class="alert alert-success" align=center role="alert">
                                Available
                            </div>
                            <?php } ?>
                        </td>
                        <td>
                            <form action="{{route('hapusbooking', $item->id_booking)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-sm btn-danger" type="submit"> Hapus</button>
                            </form>
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
