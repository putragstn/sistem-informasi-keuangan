<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
</head>
<body>

    <h1>{{ $judul }}</h1>


    {{-- Laporan Tanggal {{ date('d-m-Y', strtotime($tanggal['awal'])) }} sampai {{ date('d-m-Y', strtotime($tanggal['akhir'])); }} --}}

    <table border="1" cellspacing="0">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Operator</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Nominal</th>
                <th scope="col">Kategori</th>
                <th scope="col">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($reports as $income)
                <tr>
                    <td>{{ $loop->iteration }}</td> 
                    <td>
                        @foreach ($users as $user)
                            @if ($income->user_id == $user->id)
                                {{ $user->name }}
                            @endif
                        @endforeach
                    </td>

                    <td>{{ date('d/m/Y H:i', strtotime($income->tanggal)); }}</td>
                    
                    <td>@currency($income->nominal)</td>

                    <td>

                        @foreach ($categories as $category)

                            {{-- Tampilin Kategori Sesuai category_id yang lagi di looping --}}
                            @if ($income->category_id == $category->id)
                                {{ $category->nama_kategori }}
                            @endif
                        @endforeach
                    </td>

                    <td>{{ $income->keterangan }}</td>
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
            