<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Admin Dashboard - ITWASUM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(180deg, #BDE4FF 0%, #FFFFFF 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Navbar Responsive */
        .navbar-custom {
            background: white;
            padding: 10px 15px;
            border-bottom: 3px solid #4DAFFF;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .logo-nav { height: 40px; }
        .nav-title {
            font-weight: 800;
            font-size: 16px;
            color: #212529;
            margin-left: 10px;
        }

        /* Container & Card */
        .main-content {
            padding: 15px;
        }
        .card-custom {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            background: white;
            overflow: hidden;
        }

        /* Styling Tabel agar bisa di scroll di HP */
        .table-responsive {
            border: 0;
        }
        .table {
            font-size: 14px; /* Sedikit lebih kecil agar muat banyak di HP */
            margin-bottom: 0;
        }
        .table thead {
            background-color: #4DAFFF;
            color: white;
            white-space: nowrap;
        }
        .table td {
            vertical-align: middle;
            white-space: nowrap; /* Mencegah teks turun ke bawah yang bikin tabel tinggi banget */
        }

        /* Badge & Image */
        .badge-hari {
            background-color: #E3F2FD;
            color: #0D47A1;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 8px;
        }
        .img-signature {
            height: 45px;
            width: auto;
            border: 1px solid #eee;
            background: #fff;
            border-radius: 4px;
        }

        /* Ukuran khusus Mobile */
        @media (max-width: 576px) {
            .nav-title { font-size: 14px; }
            .logo-nav { height: 35px; }
            .main-content { padding: 10px; }
            .table { font-size: 13px; }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-custom shadow-sm">
    <div class="container-fluid d-flex justify-content-start align-items-center">
        <img src="{{ asset('img/logo-polri.png') }}" class="logo-nav">
        <img src="{{ asset('img/logo-itwasum.png') }}" class="logo-nav ms-2">
        <span class="nav-title text-uppercase">Data Master Presensi</span>
    </div>
</nav>

<div class="main-content">
    <div class="card card-custom">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 fw-bold text-primary">Rekapitulasi Kehadiran</h6>
        </div>
        <div class="card-body p-0"> <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Pangkat/NRP</th>
                            <th>Jabatan</th>
                            <th>Satker</th>
                            <th>Pelaksanaan</th>
                            <th>Tanda Tangan</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $key => $item)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td><strong>{{ $item->nama_lengkap }}</strong></td>
                            <td>{{ $item->pangkat_nrp }}</td>
                            <td>
                                {{ $item->jabatan_struktural }}<br>
                                <small class="text-muted">{{ $item->jabatan_panitia }}</small>
                            </td>
                            <td>{{ $item->satker }}</td>
                            <td><span class="badge-hari">{{ $item->pelaksanaan }}</span></td>
                            <td>
                                @if($item->tanda_tangan)
                                    <img src="{{ $item->tanda_tangan }}" class="img-signature">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td><small>{{ $item->created_at->format('d/m H:i') }}</small></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">Belum ada data masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="mt-3 px-2">
        <p class="text-muted" style="font-size: 11px;">
            * Geser tabel ke samping untuk melihat data lengkap.<br>
            * Data diperbarui otomatis dari sistem presensi online.
        </p>
    </div>
</div>

</body>
</html>