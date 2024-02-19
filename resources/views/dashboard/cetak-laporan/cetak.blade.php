<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
</head>
<style>
    
    header {
        display: flex;
        justify-content: space-between;
    }
    
    .header-text {
        margin-left: -150px;
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
        padding: 8px 20px;
    }

</style>
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


    <div class="container">
        <br>

            <div>
                Periode: {{ date('F', strtotime($tanggal['awal'])) }}
            </div>
            
            <div>
                Dari Tanggal {{ date('d-m-Y', strtotime($tanggal['awal'])) }} Sampai {{ date('d-m-Y', strtotime($tanggal['akhir'])); }}
            </div>
            
        <br><br>
        <table border="1" cellspacing="0" class="table1">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nominal</th>
                    <th scope="col">Kategori</th>
                    {{-- <th scope="col">Keterangan</th> --}}
                </tr>
            </thead>
            <tbody>
                
                @foreach ($reports as $report)
                <tr>
                    <td>{{ $loop->iteration }}</td> 
                    {{-- <td>{{ $income->tanggal }}</td> --}}
                    <td>{{ date('d-M-Y H:i', strtotime($report->tanggal)); }}</td>
                    
                    <td>@currency($report->nominal)</td>

                    <td>

                        @foreach ($categories as $category)

                            {{-- Tampilin Kategori Sesuai category_id yang lagi di looping --}}
                            @if ($report->category_id == $category->id)
                                {{ $category->nama_kategori }}
                            @endif
                        @endforeach
                    </td>

                    
                    {{-- <td>{{ $report->keterangan }}</td> --}}
                </tr>
                @endforeach

                <tr>
                    <th colspan="2">Total</th>
                    <th colspan="2">@currency($total)</th>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Biar halaman printnya tampil --}}
    <script>
        window.print();
    </script>

</body>
</html>