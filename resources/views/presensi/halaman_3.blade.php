<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(180deg, #BDE4FF 0%, #FFFFFF 100%); min-height: 100vh; display: flex; justify-content: center; align-items: center; font-family: 'Segoe UI', sans-serif; text-align: center; padding: 20px; }
        .logo-section { display: flex; justify-content: center; gap: 20px; margin-bottom: 30px; }
        .logo-section img { height: 80px; }
        h2 { font-weight: 800; font-size: 28px; color: #212529; }
    </style>
</head>
<body>
<div class="container">
    <div class="logo-section">
        <img src="{{ asset('img/logo-polri.png') }}"> 
        <img src="{{ asset('img/logo-itwasum.png') }}">
    </div>
    <h2>Terima kasih telah mengisi form presensi</h2>
</div>
</body>
</html>