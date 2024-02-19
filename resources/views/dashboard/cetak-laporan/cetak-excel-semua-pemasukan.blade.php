<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
</head>

<body>


    <div>
        Dari Tanggal {{ date('d-m-Y', strtotime($tanggal['awal'])) }} Sampai {{ date('d-m-Y', strtotime($tanggal['akhir'])); }}
    </div>
        
    <br>
    <table>
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

    {{-- Biar halaman printnya tampil --}}
    <script>
        window.print();
    </script>

</body>
</html>