<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    
</head>
<body>

    Laporan Tanggal {{ date('d-m-Y', strtotime($tanggal['awal'])) }} sampai {{ date('d-m-Y', strtotime($tanggal['akhir'])); }}

    <br>

    <table>
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal Pinjam</th>
                <th scope="col">Jumlah Hutang</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Jatuh Tempo</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($reports as $debt)
            <tr>
                <td>{{ $loop->iteration }}</td> 
                <td>{{ $debt->employee->nama }}</td>
                <td>{{ date('d-M-Y', strtotime($debt->tgl_pinjam)); }}</td>
                
                <td>@currency($debt->jumlah_hutang)</td>

                <td>{{ $debt->keterangan }}</td>
                <td>{{ date('d-M-Y', strtotime($debt->tgl_jatuh_tempo)); }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>


</body>
</html>
            