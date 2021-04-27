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
        <table id="table" class="table table-striped table-bordered table-responsive" style="width: 100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th style="width: 25%">Nama Member</th>
                    <th style="width: 40%">Saran</th>
                    <th style="width: 25%">Tanggal Saran</th>
                    <th style="width: 10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $no => $item)
                    <tr>
                        <td>{{$no+1}}</td>
                        <td>{{$item->nama_member}}</td>
                        <td>{{$item->saran}}</td>
                        <td>{{tanggal_indonesia($item->tanggal_saran)}}</td>
                        <td>
                            <form action="{{route('hapussaran', $item->id_saran)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
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
