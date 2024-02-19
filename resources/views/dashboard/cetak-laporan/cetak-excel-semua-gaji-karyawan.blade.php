<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data-data Gaji Karyawan</title>
</head>
<body>
    Dari Tanggal {{ date('d-m-Y', strtotime($tanggal['awal'])) }} Sampai {{ date('d-m-Y', strtotime($tanggal['akhir'])); }}

    <br>

    <table>
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
    
</body>
</html>