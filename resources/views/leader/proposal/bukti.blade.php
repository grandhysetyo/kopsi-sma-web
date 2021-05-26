<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    .bg {
            background-image: url("kopsi/img/bg-bukti.jpg");
            background-repeat: no-repeat;
            background-size: contain;
        }

        .center {
        margin-left: auto;
        margin-right: auto;
        }
    </style>
</head>
<body class="bg">
    <div style="text-align: center; margin-top: 100px">
        <h3>NOMOR PENDAFTARAN KoPSI 2020</h3>
        <h2>{{$proposal->kode_registrasi}}</h2>
    </div>
    <div style="text-align: center">
        <table style="font-size: 23px" class="center">
            <tr class="details">
                <td>
                    Email Akun
                </td>
                <td>
                    :
                </td>
                <td>
                    {{$proposal->tim->ketua->user->email}}
                </td>
            </tr>
            <tr class="details">
                <td>
                    Judul Penelitian
                </td>
                <td>
                    :
                </td>
                <td>
                    {{$proposal->tim->nama_karya}}
                </td>
            </tr>
            <tr class="details">
                <td>
                    Kategori Bidang
                </td>
                <td>
                    :
                </td>
                <td>
                    {{$proposal->tim->bidang->bidang->nama_bidang}}
                </td>
            </tr>
            <tr class="details">
                <td>
                    Sub Bidang Penelitian
                </td>
                <td>
                    :
                </td>
                <td>
                    {{$proposal->tim->bidang->nama_sub}}
                </td>
            </tr>
            <tr class="details">
                <td>
                    Sekolah
                </td>
                <td>
                    :
                </td>
                <td>
                    {{$proposal->tim->sekolah->nama_sekolah}}
                </td>
            </tr>
            <tr class="details">
                <td>
                    Kabupaten/Kota
                </td>
                <td>
                    :
                </td>
                <td>
                    {{$proposal->tim->sekolah->kelurahan->district->regency->name ?? ' '}}
                </td>
            </tr>
            <tr class="details">
                <td>
                    Provinsi
                </td>
                <td>
                    :
                </td>
                <td>
                    {{$proposal->tim->sekolah->kelurahan->district->regency->province->name ?? ' '}}
                </td>
            </tr>
            <tr class="details">
                <td>
                    Nama Peneliti
                </td>
                <td>
                    
                </td>
                <td>
                    
                </td>
            </tr>
            <tr class="details">
                <td>
                    Ketua Peneliti
                </td>
                <td>
                    :
                </td>
                <td>
                    {{$proposal->tim->ketua->user->name}}
                </td>
            </tr>
            <tr class="details">
                <td>
                    Anggota Peneliti
                </td>
                <td>
                    :
                </td>
                <td>
                    @forelse ($proposal->tim->anggota as $item)
                        {{$item->user->name}}
                    @empty
                        -
                    @endforelse
                </td>
            </tr>
            <tr class="details">
                <td>
                    Nama Guru Pembimbing
                </td>
                <td>
                    :
                </td>
                <td>
                    {{$proposal->tim->pembimbing->nama}}
                </td>
            </tr>
        </table>
          
    </div>
    <div style="text-align: center">
        <h1>#menelitiituseru</h1>
    </div>
    
</body>
</html>