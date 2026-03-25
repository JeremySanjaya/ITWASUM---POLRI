<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - ITWASUM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f7fa; font-family: 'Segoe UI', sans-serif; }
        .navbar-custom { background: white; border-bottom: 2px solid #4DAFFF; padding: 10px 20px; }
        .nav-title { font-weight: 800; font-size: 18px; color: #2c3e50; }
        .card-table { border-radius: 12px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05); background: white; margin-top: 20px; }
        .table th { font-size: 11px; text-transform: uppercase; color: #555; padding: 15px 10px; white-space: nowrap; }
        .table td { font-size: 12px; vertical-align: middle; padding: 10px; white-space: nowrap; }
        .filter-label { font-size: 14px; font-weight: 600; min-width: 60px; color: #555; }
        .filter-row { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; }
        .img-sig { height: 35px; border: 1px solid #eee; border-radius: 4px; }
        .no-caret::after { display: none !important; }
    </style>
</head>
<body>

<nav class="navbar navbar-custom sticky-top shadow-sm">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <img src="{{ asset('img/logo-polri.png') }}" style="height:35px">
            <img src="{{ asset('img/logo-itwasum.png') }}" style="height:35px" class="ms-2">
            <span class="nav-title ms-2 text-uppercase">Rekap Presensi ITWASUM</span>
        </div>
        
        <div class="d-flex gap-2">
            <button onclick="exportToExcel()" class="btn btn-success btn-sm fw-bold">📊 Export Excel</button>

            <div class="dropdown">
                <button class="btn btn-outline-dark btn-sm dropdown-toggle fw-bold" data-bs-toggle="dropdown">🔍 Filter</button>
                <div class="dropdown-menu dropdown-menu-end p-4 shadow-lg" style="width: 380px; border-radius: 15px;">
                    <form method="GET">
                        <label class="small fw-bold mb-2 text-muted">PENCARIAN</label>
                        <input type="text" name="search_nama" class="form-control form-control-sm mb-2" placeholder="Nama Personel..." value="{{ request('search_nama') }}">
                        
                        <select name="search_struktural" class="form-select form-select-sm mb-2">
                            <option value="">-- Jabatan Struktural --</option>
                            @foreach($opt_struktural as $os)
                                <option value="{{ $os->nama_opsi }}" {{ request('search_struktural') == $os->nama_opsi ? 'selected' : '' }}>{{ $os->nama_opsi }}</option>
                            @endforeach
                        </select>

                        <select name="search_panitia" class="form-select form-select-sm mb-2">
                            <option value="">-- Jabatan Panitia --</option>
                            @foreach($opt_panitia as $op)
                                <option value="{{ $op->nama_opsi }}" {{ request('search_panitia') == $op->nama_opsi ? 'selected' : '' }}>{{ $op->nama_opsi }}</option>
                            @endforeach
                        </select>

                        <select name="search_satker" class="form-select form-select-sm mb-2">
                            <option value="">-- Satker --</option>
                            @foreach($opt_satker as $ot)
                                <option value="{{ $ot->nama_opsi }}" {{ request('search_satker') == $ot->nama_opsi ? 'selected' : '' }}>{{ $ot->nama_opsi }}</option>
                            @endforeach
                        </select>

                        <select name="search_pelaksanaan" class="form-select form-select-sm mb-3">
                            <option value="">-- Hari Pelaksanaan --</option>
                            <option value="Hari 1" {{ request('search_pelaksanaan') == 'Hari 1' ? 'selected' : '' }}>Hari 1</option>
                            <option value="Hari 2" {{ request('search_pelaksanaan') == 'Hari 2' ? 'selected' : '' }}>Hari 2</option>
                            <option value="Hari 3" {{ request('search_pelaksanaan') == 'Hari 3' ? 'selected' : '' }}>Hari 3</option>
                        </select>
                        
                        <label class="small fw-bold mb-2 text-muted text-uppercase">Rentang Tanggal</label>
                        <div class="filter-row">
                            <div class="filter-label text-muted">Dari</div>
                            <input type="date" name="tgl_mulai" class="form-control form-control-sm" value="{{ request('tgl_mulai') }}">
                        </div>
                        <div class="filter-row mb-4">
                            <div class="filter-label text-muted">s/d</div>
                            <input type="date" name="tgl_akhir" class="form-control form-control-sm" value="{{ request('tgl_akhir') }}">
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-sm fw-bold">Terapkan Filter</button>
                            <a href="{{ url()->current() }}" class="btn btn-light btn-sm border fw-bold text-muted">Reset</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown">
                <button class="btn btn-primary btn-sm dropdown-toggle no-caret" data-bs-toggle="dropdown">⚙️ Settings</button>
                <div class="dropdown-menu dropdown-menu-end shadow p-2">
                    <button class="dropdown-item py-2 fw-bold small" data-bs-toggle="modal" data-bs-target="#modalTambah">➕ Tambah Opsi</button>
                    <button class="dropdown-item py-2 fw-bold small text-danger" data-bs-toggle="modal" data-bs-target="#modalKelola">🗑️ Hapus Pilihan</button>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid px-4">
    <div class="card card-table shadow-sm">
        <div class="table-responsive">
            <table id="tableUtama" class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama Lengkap</th>
                        <th>Pangkat/NRP</th>
                        <th>Struktural</th>
                        <th>Panitia</th>
                        <th>Satker</th>
                        <th>Pelaksanaan</th>
                        <th>Tanda Tangan</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $key => $item)
                    <tr>
                        <td class="text-center fw-bold text-muted">{{ $key + 1 }}</td>
                        <td><strong>{{ $item->nama_lengkap }}</strong></td>
                        <td>{{ $item->pangkat_nrp }}</td>
                        <td>{{ $item->jabatan_struktural }}</td>
                        <td>{{ $item->jabatan_panitia }}</td>
                        <td>{{ $item->satker }}</td>
                        <td>{{ $item->pelaksanaan }}</td>
                        <td><img src="{{ $item->tanda_tangan }}" class="img-sig"></td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td class="text-primary fw-bold">{{ $item->created_at->format('H:i') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="10" class="text-center py-5">Data tidak ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header"><h6>Tambah Pilihan</h6><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <form action="{{ route('admin.add-option') }}" method="POST">
                    @csrf
                    <select name="kategori" class="form-select form-select-sm mb-2" required>
                        <option value="struktural">Struktural</option>
                        <option value="panitia">Panitia</option>
                        <option value="satker">Satker</option>
                    </select>
                    <input type="text" name="nama_opsi" class="form-control form-control-sm mb-3" placeholder="Nama..." required>
                    <button type="submit" class="btn btn-primary btn-sm w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalKelola" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header"><h6>Kelola Data</h6><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body p-0">
                <ul class="list-group list-group-flush">
                    @foreach($options as $opt)
                    <li class="list-group-item d-flex justify-content-between align-items-center small">
                        <div>{{ $opt->nama_opsi }} <span class="badge bg-light text-dark border ms-2">{{ $opt->kategori }}</span></div>
                        <form action="{{ url('/admin/delete-option/'.$opt->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm text-danger border-0">Hapus</button>
                        </form>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.sheetjs.com/xlsx-0.20.1/package/dist/xlsx.full.min.js"></script>
<script>
function exportToExcel() {
    let table = document.getElementById("tableUtama");
    let wb = XLSX.utils.table_to_book(table, {sheet: "Data"});
    XLSX.writeFile(wb, "Rekap_Presensi_ITWASUM.xlsx");
}
</script>
</body>
</html>