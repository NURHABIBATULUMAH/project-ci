<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pinjam - User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; }
        .navbar { background: linear-gradient(135deg, #6f42c1, #4e3188); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .card { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        
        .table-header-custom { background-color: #f8f9fa; color: #4e3188; border-bottom: 2px solid #eee; }
        .table-header-custom th { font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.5px; padding: 15px; }

        .status-badge { padding: 5px 12px; border-radius: 8px; font-size: 11px; font-weight: 600; }
        .badge-pending { background: #fff4e5; color: #bc6d00; border: 1px solid #ffe5cc; }
        .badge-dipinjam { background: #e7f5ff; color: #1971c2; border: 1px solid #d0ebff; }
        .badge-proses { background: #f3f0ff; color: #6f42c1; border: 1px solid #e5dbff; }
        .badge-selesai { background: #ebfbee; color: #2b8a3e; border: 1px solid #d3f9d8; }
        .badge-ditolak { background: #fff5f5; color: #e03131; border: 1px solid #ffe3e3; }

        .btn-warning { background-color: #ffc107; border: none; color: #2d3436 !important; font-weight: 600; }
        .btn-warning:hover { background-color: #eab000; box-shadow: 0 4px 10px rgba(255,193,7,0.3); }
        .img-item { border-radius: 10px; object-fit: cover; border: 1px solid #eee; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= site_url('produk'); ?>">
            <i class="fa-solid fa-clock-rotate-left me-2"></i> Riwayat Pinjaman
        </a>
        <div class="navbar-nav ms-auto">
            <a href="<?= site_url('produk'); ?>" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm">
                <i class="fa-solid fa-house me-1"></i> Dashboard
            </a>
        </div>
    </div>
</nav>

<div class="container mb-5">
    <?php if($this->session->flashdata('pesan')): ?>
        <div class="alert alert-success border-0 shadow-sm rounded-pill px-4 mb-4">
            <i class="fa-solid fa-circle-check me-2"></i> <?= $this->session->flashdata('pesan'); ?>
        </div>
    <?php endif; ?>

    <div class="card p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr class="table-header-custom text-center">
                        <th width="10%">Foto</th>
                        <th class="text-start">Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th width="20%">Aksi Anda</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($riwayat)): foreach($riwayat as $r): ?>
                    <tr class="text-center">
                        <td>
                            <img src="<?= base_url('upload/'.$r->gambar); ?>" width="55" height="55" class="img-item shadow-sm">
                        </td>
                        <td class="text-start">
                            <div class="fw-bold text-dark"><?= $r->nama_produk; ?></div>
                        </td>
                        <td><span class="badge bg-light text-dark border px-3 rounded-pill"><?= $r->jumlah_pinjam; ?> Unit</span></td>
                        <td>
                            <?php if($r->status == 'pending'): ?>
                                <span class="status-badge badge-pending">MENUNGGU KONFIRMASI</span>
                            <?php elseif($r->status == 'disetujui'): ?>
                                <span class="status-badge badge-dipinjam">SEDANG DIPINJAM</span>
                            <?php elseif($r->status == 'menunggu_kembali'): ?>
                                <span class="status-badge badge-proses">PROSES PENGEMBALIAN</span>
                            <?php elseif($r->status == 'selesai'): ?>
                                <span class="status-badge badge-selesai">SELESAI / KEMBALI</span>
                            <?php elseif($r->status == 'ditolak'): ?>
                                <span class="status-badge badge-ditolak">DITOLAK</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end">
                            <?php if($r->status == 'disetujui'): ?>
                                <a href="<?= site_url('produk/ajukan_kembali/'.$r->id); ?>" 
                                   class="btn btn-sm btn-warning px-4 rounded-pill shadow-sm" 
                                   onclick="return confirm('Kembalikan barang ini?')">
                                   <i class="fa-solid fa-rotate-left me-1"></i> Kembalikan
                                </a>
                            <?php elseif($r->status == 'menunggu_kembali'): ?>
                                <small class="text-primary fw-bold">Tunggu Verifikasi Admin</small>
                            <?php elseif($r->status == 'ditolak'): ?>
                                <div class="bg-light p-2 rounded small text-danger border">
                                    <i class="fa-solid fa-info-circle"></i> <?= $r->alasan_penolakan; ?>
                                </div>
                            <?php elseif($r->status == 'selesai'): ?>
                                <i class="fa-solid fa-circle-check text-success fa-lg"></i>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Anda belum meminjam barang apapun.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>