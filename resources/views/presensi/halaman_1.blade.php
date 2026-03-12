<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Presensi ITWASUM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(180deg, #BDE4FF 0%, #FFFFFF 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
        }
        .form-container {
            width: 100%;
            max-width: 480px; /* Ukuran ideal mobile web */
            padding: 30px 20px;
        }
        .logo-section {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 25px;
        }
        .logo-section img { height: 75px; object-fit: contain; }
        .title {
            font-weight: 800;
            font-size: 24px;
            text-align: center;
            margin-bottom: 30px;
            color: #212529;
        }
        label { font-weight: 600; margin-bottom: 8px; display: block; color: #333; }
        
        /* Input & Select dioptimasi untuk sentuhan jari (Touch Friendly) */
        .form-control, .form-select {
            border-radius: 12px;
            height: 55px; /* Lebih tinggi agar mudah di-tap */
            border: 1px solid #ced4da;
            margin-bottom: 18px;
            font-size: 16px; /* Mencegah auto-zoom di iOS */
        }
        .btn-selanjutnya {
            background-color: #4DAFFF;
            border: none;
            border-radius: 12px;
            height: 55px;
            font-weight: bold;
            color: white;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(77, 175, 255, 0.3);
        }
    </style>
</head>
<body>
<div class="form-container">
    <div class="logo-section">
        <img src="{{ asset('img/logo-polri.png') }}"> 
        <img src="{{ asset('img/logo-itwasum.png') }}">
    </div>
    <h2 class="title">Presensi ITWASUM Polri</h2>
    <form action="{{ route('presensi.signature') }}" method="POST">
        @csrf
        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan Nama Lengkap" required>
        
        <label>Pangkat / NRP</label>
        <input type="text" name="pangkat_nrp" class="form-control" placeholder="Masukkan Pangkat / NRP" required>

        <label>Jabatan Struktural</label>
        <select name="jabatan_struktural" class="form-select" required>
            <option value="" selected disabled>Pilih Jabatan</option>
            <option value="Irwil I">Irwil I</option>
            <option value="Irwil II">Irwil II</option>
            <option value="Irwil III">Irwil III</option>
        </select>

        <label>Jabatan Panitia</label>
        <select name="jabatan_panitia" class="form-select" required>
            <option value="" selected disabled>Pilih Jabatan</option>
            <option value="Ketua">Ketua</option>
            <option value="Sekretaris">Sekretaris</option>
            <option value="Anggota">Anggota</option>
        </select>

        <label>Satker</label>
        <select name="satker" class="form-select" required>
            <option value="" selected disabled>Pilih Satker</option>
            <option value="Itwasum">Itwasum</option>
            <option value="Bareskrim">Bareskrim</option>
        </select>

        <label>Pelaksanaan</label>
        <select name="pelaksanaan" class="form-select" required>
            <option value="" selected disabled>Pilih Hari</option>
            <option value="Hari ke-1">Hari ke-1</option>
            <option value="Hari ke-2">Hari ke-2</option>
            <option value="Hari ke-3">Hari ke-3</option>
        </select>

        <button type="submit" class="btn-selanjutnya">Selanjutnya <svg width="20" height="20" fill="white" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg></button>
    </form>
</div>
</body>
</html>