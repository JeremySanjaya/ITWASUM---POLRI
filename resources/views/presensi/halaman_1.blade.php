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
            max-width: 480px; 
            padding: 30px 20px; 
        }
        .logo-section { 
            display: flex; 
            justify-content: center; 
            gap: 20px; 
            margin-bottom: 25px; 
        }
        .logo-section img { 
            height: 75px; 
            object-fit: contain; 
        }
        .title { 
            font-weight: 800; 
            font-size: 24px; 
            text-align: center; 
            margin-bottom: 30px; 
            color: #212529; 
        }
        label { 
            font-weight: 600; 
            margin-bottom: 8px; 
            display: block; 
            color: #333; 
        }
        
        .form-control, .form-select { 
            border-radius: 12px; 
            height: 55px; 
            margin-bottom: 18px; 
            font-size: 16px; 
        }

        .form-control::placeholder {
            color: rgba(33, 37, 41, 0.4);
            font-weight: 400;
        }

        select.form-select {
            color: rgba(33, 37, 41, 0.4); 
        }
        
        select.form-select option {
            color: #212529;
        }

        .text-selected {
            color: #212529 !important;
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
            transition: 0.3s;
            margin-top: 10px;
        }
        .btn-selanjutnya:active {
            transform: scale(0.98);
            background-color: #3d9be6;
        }
    </style>
</head>
<body>

<div class="form-container">
    <div class="logo-section">
        <img src="{{ asset('img/logo-polri.png') }}" alt="Logo Polri"> 
        <img src="{{ asset('img/logo-itwasum.png') }}" alt="Logo Itwasum">
    </div>

    <h2 class="title">Presensi ITWASUM Polri</h2>

    <form action="{{ route('presensi.signature') }}" method="POST">
        @csrf
        
        <label for="nama_lengkap">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Masukkan nama lengkap" required>

        <label for="pangkat_nrp">Pangkat / NRP</label>
        <input type="text" name="pangkat_nrp" id="pangkat_nrp" class="form-control" placeholder="Masukkan Pangkat/NRP" required>

        <label for="jabatan_struktural">Jabatan Struktural</label>
        <select name="jabatan_struktural" id="jabatan_struktural" class="form-select dynamic-select" required>
            <option value="" selected disabled>Jabatan Struktural</option>
            @foreach($struktural as $s)
                <option value="{{ $s->nama_opsi }}">{{ $s->nama_opsi }}</option>
            @endforeach
        </select>

        <label for="jabatan_panitia">Jabatan Panitia</label>
        <select name="jabatan_panitia" id="jabatan_panitia" class="form-select dynamic-select" required>
            <option value="" selected disabled>Pilih jabatan panitia</option>
            @foreach($panitia as $p)
                <option value="{{ $p->nama_opsi }}">{{ $p->nama_opsi }}</option>
            @endforeach
        </select>

        <label for="satker">Satker</label>
        <select name="satker" id="satker" class="form-select dynamic-select" required>
            <option value="" selected disabled>Pilih satker</option>
            @foreach($satker as $sk)
                <option value="{{ $sk->nama_opsi }}">{{ $sk->nama_opsi }}</option>
            @endforeach
        </select>

        <label for="pelaksanaan">Pelaksanaan</label>
        <select name="pelaksanaan" id="pelaksanaan" class="form-select dynamic-select" required>
            <option value="" selected disabled>Pilih pelaksanaan</option>
            <option value="Hari ke-1">Hari ke-1</option>
            <option value="Hari ke-2">Hari ke-2</option>
            <option value="Hari ke-3">Hari ke-3</option>
        </select>

        <button type="submit" class="btn-selanjutnya">
            Selanjutnya 
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
            </svg>
        </button>
    </form>
</div>

<script>
    document.querySelectorAll('.dynamic-select').forEach(select => {
        select.addEventListener('change', function() {
            if (this.value !== "") {
                this.classList.add('text-selected');
            } else {
                this.classList.remove('text-selected');
            }
        });
    });
</script>

</body>
</html>