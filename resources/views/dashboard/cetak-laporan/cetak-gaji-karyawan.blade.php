<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    
    {{-- CSS ASSETS --}}
    {{-- Cara dibawah ini bermasalah jika menggunakan dompdf --}}
    {{-- Mengakibatkan loading lama --}}
    <link href="{{ URL::asset('css1/styles.css') }}" rel="stylesheet" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" /> --}}
    
    {{-- Solusinya gunakan inline css --}}
    <style>
        
    </style>
    
</head>
<body>

    <div class="container">
        <center>
            <h1>CV. CAHAYA BINTANG</h1>
            <h1>Gaji Pegawai</h1>
            <hr>
        </center>
    
        <br>
    
        {{-- Informasi Karyawan --}}
        <table border="0">
            <tr>
                <td>Nama</td>
                <td></td>
                <td>:</td>
                <td></td>
                <td>{{ $data->employee->nama }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td></td>
                <td>:</td>
                <td></td>
                <td>{{ $data->salary->jabatan }}</td>
            </tr>
            <tr>
                <td>Kontak</td>
                <td></td>
                <td>:</td>
                <td></td>
                <td>{{ $data->employee->no_telp }}</td>
            </tr>
            <tr>
                <td>No. Rek</td>
                <td></td>
                <td>:</td>
                <td></td>
                <td>{{ $data->employee->no_rek }} ({{ $data->employee->bank }})</td>
            </tr>
            <tr>
                <td>Tgl Gajian </td>
                <td></td>
                <td>:</td>
                <td></td>
                <td>{{ date('d-F-Y', strtotime($data->tgl_gajian)) }}</td>
            </tr>
        </table>
        {{-- End Informasi Karyawan --}}
    
        <br>
    
        {{-- Detail Gaji --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
    
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Gaji Pokok</td>
                    <td>@currency($data->salary->gaji_pokok)</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Tunjangan Transport</td>
                    <td>@currency($data->salary->tj_transport)</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Uang Makan</td>
                    <td>@currency($data->salary->uang_makan)</td>
                </tr>
                <tr>
                    <td></td>
                    <th>Total Gaji : </th>
                    <th>@currency($data->salary->gaji_pokok + $data->salary->tj_transport + $data->salary->uang_makan)</th>
                </tr>
    
            </tbody>
        </table>
        {{-- End Detail Gaji --}}

        <br><br>

        <div class="row">
            <div class="col-lg-4">Karyawan</div>
            <div class="col-lg-4"></div>
            <div class="col-lg-4">Tangerang, {{ date('d-M-Y', strtotime($data->tgl_gajian)) }}</div>
        </div>
        <br><br><br>
        <div class="row">
            <div class="col-lg-4">{{ $data->employee->nama }}</div>
            <div class="col-lg-4"></div>
            <div class="col-lg-4">_______________________________</div>
        </div>
    </div>
    
    
    <script>
        window.print();
    </script>
</body>
</html>