<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    
    {{-- CSS ASSETS --}}
    {{-- <link href="{{ URL::asset('css1/styles.css') }}" rel="stylesheet" /> --}}
    <style>
        header {
            text-align: center;
        }
        
        .table1 {
        font-family: sans-serif;
        color: #232323;
        border-collapse: collapse;
        width: 100%;
        margin: 0 auto;
    }

    .table1, th, td {
        border: 1px solid #999;
        padding: 4px 10px;
    }
    </style>
</head>
<body>

    <header>
        <div class="header-text">
            <h1>CV. CAHAYA BINTANG</h1>
            <h1>{{ $judul }}</h1>
    </header>
    <hr>

    <br>

    <div>
        Periode: {{ date('F', strtotime($tanggal['awal'])) }}
    </div>
    
    Dari Tanggal {{ date('d-m-Y', strtotime($tanggal['awal'])) }} Sampai {{ date('d-m-Y', strtotime($tanggal['akhir'])); }}
    
    <br><br>

    {{-- Detail Gaji --}}
    <table class="table1">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Gajian</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Gaji Pokok</th>
                <th>Tunjangan Transport</th>
                <th>Uang Makan</th>
                <th>Total Gaji</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($reports as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date('d-m-Y', strtotime($data->tgl_gajian)) }}</td>
                    <td>{{ $data->employee->nama }}</td>
                    <td>{{ $data->salary->jabatan }}</td>
                    <td>@currency($data->salary->gaji_pokok)</td>
                    <td>@currency($data->salary->tj_transport)</td>
                    <td>@currency($data->salary->uang_makan)</td>
                    <th>@currency($data->salary->gaji_pokok + $data->salary->tj_transport + $data->salary->uang_makan)</th>
                </tr>
            @endforeach

        </tbody>
    </table>
        {{-- End Detail Gaji --}}

        {{-- <br><br><br><br><br>

        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4"></div>
            <div class="col-lg-4">Tangerang, {{ date('d-M-Y', strtotime($data->tgl_gajian)) }}</div>
        </div>
        <br><br><br>
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4"></div>
            <div class="col-lg-4">_______________________________</div>
        </div> --}}
    
    
    <script>
        window.print();
    </script>
</body>
</html>