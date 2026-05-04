<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pinjam - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; }
        .navbar { background: linear-gradient(135deg, #6f42c1, #4e3188); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .card { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        
        .table-header-custom { background-color: #f8f9fa; color: #4e3188; border-bottom: 2px solid #eee; }
        .table-header-custom th { font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.5px; padding: 15px; }

        /* Badge Custom */
        .status-badge { padding: 5px 12px; border-radius: 8px; font-size: 11px; font-weight: 600; }
        .badge-pending { background: #fff4e5; color: #bc6d00; border: 1px solid #ffe5cc; }
        .badge-dipinjam { background: #e7f5ff; color: #1971c2; border: 1px solid #d0ebff; }
        .badge-kembali { background: #f3f0ff; color: #6f42c1; border: 1px solid #e5dbff; }
        .badge-selesai { background: #ebfbee; color: #2b8a3e; border: 1px solid #d3f9d8; }
        .badge-ditolak { background: #fff5f5; color: #e03131; border: 1px solid #ffe3e3; }

        .btn-primary { background-color: #6f42c1; border: none; }
        .btn-primary:hover { background-color: #5a32a3; }
        .btn-success { background-color: #2b8a3e; border: none; }
        .btn-outline-danger { color: #ff4757; border-color: #ff4757; }
        .btn-outline-danger:hover { background-color: #ff4757; color: white; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="<?= site_url('produk'); ?>">
            <i class="fa-solid fa-gift me-2 text-warning"></i> Inventaris Laboratorium
        </a>
        <div class="navbar-nav ms-auto">
            <a href="<?= site_url('produk'); ?>" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</nav>

<div class="container mb-5">
    <div class="row mb-3">
        <div class="col">
            <h3 class="fw-bold text-dark mb-0">Permintaan Pinjaman</h3>
            <p class="text-muted small">Verifikasi status peminjaman dan pengembalian barang user.</p>
        </div>
    </div>

    <div class="card p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr class="table-header-custom text-center">
                        <th>Peminjam</th>
                        <th>Barang & Jumlah</th>
                        <th>Status Saat Ini</th>
                        <th width="20%">Aksi Admin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($pinjaman)): foreach($pinjaman as $p): ?>
                    <tr class="text-center">
                        <td class="text-start">
                            <div class="fw-bold text-dark"><i class="fa-solid fa-user me-2 text-muted"></i><?= $p->username; ?></div>
                        </td>
                        <td class="text-start">
                            <div class="fw-semibold"><?= $p->nama_produk; ?></div>
                            <small class="text-muted"><?= $p->jumlah_pinjam; ?> Unit</small>
                        </td>
                        <td>
                            <?php if($p->status == 'pending'): ?>
                                <span class="status-badge badge-pending">MINTA PINJAM</span>
                            <?php elseif($p->status == 'disetujui'): ?>
                                <span class="status-badge badge-dipinjam">SEDANG DIPINJAM</span>
                            <?php elseif($p->status == 'menunggu_kembali'): ?>
                                <span class="status-badge badge-kembali">MINTA BALIK</span>
                            <?php elseif($p->status == 'selesai'): ?>
                                <span class="status-badge badge-selesai">SELESAI</span>
                            <?php else: ?>
                                <span class="status-badge badge-ditolak">DITOLAK</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end">
                            <?php if($p->status == 'pending'): ?>
                                <a href="<?= site_url('produk/acc_pinjam/'.$p->id); ?>" class="btn btn-sm btn-primary px-3 shadow-sm rounded-pill mb-1">Setujui</a>
                                <button class="btn btn-sm btn-outline-danger px-3 rounded-pill mb-1" data-bs-toggle="modal" data-bs-target="#modalTolak<?= $p->id; ?>">Tolak</button>
                            
                            <?php elseif($p->status == 'menunggu_kembali'): ?>
                                <a href="<?= site_url('produk/terima_kembali/'.$p->id); ?>" 
                                   class="btn btn-sm btn-success px-3 shadow-sm rounded-pill"
                                   onclick="return confirm('Apakah barang sudah kembali dalam kondisi baik?')">
                                   <i class="fa-solid fa-check-circle me-1"></i> Terima Barang
                                </a>

                            <?php elseif($p->status == 'selesai'): ?>
                                <small class="text-success fw-bold"><i class="fa-solid fa-check-double me-1"></i> Transaksi Selesai</small>
                            <?php else: ?>
                                <small class="text-muted">Tidak ada aksi</small>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalTolak<?= $p->id; ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <form action="<?= site_url('produk/tolak_pinjam/'.$p->id); ?>" method="post" class="modal-content border-0 shadow">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title fw-bold">Alasan Penolakan</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <textarea name="alasan" class="form-control" rows="3" placeholder="Sebutkan alasan penolakan..." required></textarea>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger px-4">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php endforeach; else: ?>
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">Belum ada permintaan masuk.</td>
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