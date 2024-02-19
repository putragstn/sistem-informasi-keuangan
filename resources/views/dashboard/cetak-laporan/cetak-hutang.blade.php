<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    <style>
        body {
            font-family: sans-serif;
        }
        header {
            display: flex;
            justify-content: space-between;
        }
        
        .header-text {
            margin-left: -150px;
            text-align: center;
        }

        .table1 {
            color: #232323;
            border-collapse: collapse;
            width: 100%;
            margin: 0 auto;
        }

        .table1, th, td {
            border: 1px solid #999;
            padding: 4px 20px;
        }
    </style>
</head>
<body>

    <header>
        {{-- <img src="{{ storage_path('img/transparan-logo-name.png') }}" alt="logo" width="150"> --}}
        <img src="{{ asset('img/transparan-logo-name.png') }}" alt="logo" width="150">
        <div class="header-text">
            <h1>CV. CAHAYA BINTANG</h1>
            <h1>{{ $judul }}</h1>
        </div>
        <div></div>
    </header>
    <hr>
    <br><br>

    <div>
        Periode: {{ date('F', strtotime($tanggal['awal'])) }}
    </div>

    Laporan Tanggal {{ date('d-m-Y', strtotime($tanggal['awal'])) }} sampai {{ date('d-m-Y', strtotime($tanggal['akhir'])); }}

    <br><br>

    <table border="1" cellspacing="0" class="table1">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal Pinjam</th>
                <th scope="col">Jatuh Tempo</th>
                <th scope="col">Jumlah Hutang</th>
                <th scope="col">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($reports as $debt)
            <tr>
                <td>{{ $loop->iteration }}</td> 
                <td>{{ $debt->employee->nama }}</td>
                <td>{{ date('d/m/Y', strtotime($debt->tgl_pinjam)) }}</td>

                <td>
                    @if ($debt->tgl_jatuh_tempo == NULL)
                        -
                    @else
                        {{ date('d/m/Y', strtotime($debt->tgl_jatuh_tempo)) }}
                    @endif
                </td>
                
                <td>@currency($debt->jumlah_hutang)</td>

                <td>{{ $debt->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Biar halaman printnya tampil --}}
    <script>
        window.print();
    </script>

</body>
</html>
            