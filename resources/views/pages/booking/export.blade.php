<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Data Booking Member.xls");
    ?>
    <table id="table" class="table table-striped table-bordered table-responsive" style="width: 100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Member</th>
                <th>BPJS</th>
                <th>Jenis Pelayanan</th>
                <th>Tanggal Booking</th>
                <th>Nomor Antrian</th>
                <th>Status</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
