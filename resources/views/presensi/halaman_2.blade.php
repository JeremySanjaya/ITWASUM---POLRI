<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Tanda Tangan Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(180deg, #BDE4FF 0%, #FFFFFF 100%); min-height: 100vh; display: flex; justify-content: center; font-family: 'Segoe UI', sans-serif; }
        .form-container { width: 100%; max-width: 480px; padding: 30px 20px; }
        .btn-back { display: flex; align-items: center; gap: 8px; color: #333; text-decoration: none; font-weight: 600; margin-bottom: 25px; }
        .signature-wrapper { background: white; border: 1px solid #ced4da; border-radius: 15px; position: relative; width: 100%; height: 350px; touch-action: none; margin-bottom: 20px; }
        canvas { width: 100%; height: 100%; border-radius: 15px; }
        .clear-btn { position: absolute; top: 15px; right: 15px; color: #ff4d4d; font-weight: bold; cursor: pointer; z-index: 10; }
        .signature-line { position: absolute; bottom: 60px; left: 10%; right: 10%; border-bottom: 1px solid #999; text-align: center; pointer-events: none; }
        .btn-submit { background-color: #4DAFFF; border: none; border-radius: 12px; height: 55px; font-weight: bold; color: white; width: 100%; font-size: 18px; }
    </style>
</head>
<body>
<div class="form-container">
    <a href="{{ route('presensi.index') }}" class="btn-back"><svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/></svg> Kembali</a>
    <form action="{{ route('presensi.store') }}" method="POST" id="sig-form">
        @csrf
        <label class="fw-bold mb-2">Tanda Tangan Online</label>
        <div class="signature-wrapper">
            <span class="clear-btn" id="clear">Hapus</span>
            <canvas id="signature-pad"></canvas>
            <div class="signature-line"><small class="text-muted">Tanda Tangan Di Sini</small></div>
        </div>
        <input type="hidden" name="tanda_tangan" id="sig-value">
        <button type="submit" class="btn-submit">Kirim Presensi</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script>
    const canvas = document.getElementById('signature-pad');
    const signaturePad = new SignaturePad(canvas);
    function resizeCanvas() {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
        signaturePad.clear();
    }
    window.onresize = resizeCanvas; resizeCanvas();
    document.getElementById('clear').addEventListener('click', () => signaturePad.clear());
    document.getElementById('sig-form').onsubmit = function() {
        if (signaturePad.isEmpty()) { alert("Silakan tanda tangan dulu."); return false; }
        document.getElementById('sig-value').value = signaturePad.toDataURL();
    };
</script>
</body>
</html>