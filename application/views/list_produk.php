<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; }
        .navbar { background: linear-gradient(135deg, #6f42c1, #4e3188); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .card { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        
        /* Header Tabel Custom */
        .table-header-custom {
            background-color: #f8f9fa;
            color: #4e3188;
            border-bottom: 2px solid #eee;
        }
        .table-header-custom th { 
            font-weight: 600; 
            text-transform: uppercase; 
            font-size: 0.75rem; 
            letter-spacing: 0.5px; 
            padding: 15px;
        }
        
        .img-thumbnail { border-radius: 10px; object-fit: cover; border: 1px solid #eee; transition: 0.3s; }
        .img-thumbnail:hover { transform: scale(1.1); }
        
        /* Button Styling */
        .btn-primary { background-color: #6f42c1; border: none; }
        .btn-primary:hover { background-color: #5a32a3; }
        
        .btn-danger { background-color: #ff4757; border: none; font-weight: 600; }
        .btn-danger:hover { background-color: #ff6b81; box-shadow: 0 4px 12px rgba(255, 71, 87, 0.3); }

        .btn-warning { background-color: #ffc107; border: none; color: #2d3436 !important; font-weight: 600; }
        .btn-warning:hover { background-color: #eab000; box-shadow: 0 4px 10px rgba(255, 193, 7, 0.3); }
        
        /* Desain Notifikasi Modern */
        .notif-container {
            position: relative;
            padding: 5px 12px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            transition: 0.3s;
            text-decoration: none;
        }
        .notif-container:hover { background: rgba(255, 255, 255, 0.2); }
        
        .notif-badge-new {
            background-color: #ff4757;
            color: white;
            font-size: 0.65rem;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 6px;
            margin-left: 8px;
            box-shadow: 0 4px 8px rgba(255, 71, 87, 0.3);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="<?= site_url('produk'); ?>">
            <i class="fa-solid fa-gift me-2"></i> Inventaris Laboratorium
        </a>
        
        <div class="navbar-nav ms-auto align-items-center">
            <span class="nav-link text-light me-3">
                <i class="fa-solid fa-user-circle me-1"></i> Hi, <?= $this->session->userdata('username'); ?>
                <span class="badge rounded-pill <?= ($this->session->userdata('role') == 'admin') ? 'bg-warning text-dark' : 'bg-info text-white'; ?>" style="font-size:0.65rem">
                    <?= strtoupper($this->session->userdata('role')); ?>
                </span>
            </span>

            <?php if($this->session->userdata('role') === 'user'): ?>
                <a class="nav-link text-light me-3" href="<?= site_url('produk/pinjaman_saya'); ?>">
                    <i class="fa-solid fa-clock-rotate-left me-1"></i> Riwayat
                </a>
            <?php endif; ?>

            <?php if($this->session->userdata('role') === 'admin'): ?>
                <a class="nav-link text-light me-4 notif-container d-flex align-items-center" href="<?= site_url('produk/daftar_pinjam'); ?>">
                    <i class="fa-solid fa-bell"></i> 
                    <span class="ms-2">Peminjaman</span>
                    <?php if(isset($notif_count) && $notif_count > 0): ?>
                        <span class="notif-badge-new"><?= $notif_count; ?> Baru</span>
                    <?php endif; ?>
                </a>
            <?php endif; ?>

            <a class="btn btn-sm btn-danger px-4 rounded-pill shadow-sm" href="<?= site_url('auth/logout'); ?>" onclick="return confirm('Yakin ingin logout?')">
                <i class="fa-solid fa-power-off me-1"></i> Logout
            </a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row mb-4 align-items-center">
        <div class="col">
            <h3 class="fw-bold text-dark mb-0">Manajemen Barang</h3>
            <p class="text-muted small">Kelola ketersediaan alat & bahan laboratorium secara real-time.</p>
        </div>
        <?php if($this->session->userdata('role') === 'admin'): ?>
            <div class="col text-end">
                <a href="<?= site_url('produk/tambah');?>" class="btn btn-primary rounded-pill px-4 shadow-sm">
                    <i class="fa-solid fa-plus-circle me-1"></i> Tambah Barang
                </a>
            </div>
        <?php endif; ?>
    </div>

    <div class="card p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr class="table-header-custom text-center">
                        <th width="5%">No</th>
                        <th class="text-start">Nama Barang</th>
                        <th>Stok Barang</th>
                        <th width="25%">Deskripsi Produk</th>
                        <th>Petugas / Kontak</th>
                        <th>Foto Barang</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($produk)): $no = 1; foreach($produk as $p): ?>
                        <tr class="text-center">
                            <td class="text-muted"><?= $no++; ?></td>
                            <td class="text-start">
                                <div class="fw-bold text-dark"><?= $p->nama_produk; ?></div>
                            </td>
                            <td>
                                <span class="badge <?= ($p->stok > 0) ? 'bg-success' : 'bg-danger'; ?> rounded-pill px-3 py-2">
                                    <?= $p->stok; ?> Unit
                                </span>
                            </td>
                            <td>
                                <div class="text-muted small" style="line-height: 1.4;">
                                    <?= (strlen($p->deskripsi) > 60) ? substr($p->deskripsi, 0, 60).'...' : $p->deskripsi; ?>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column align-items-center">
                                    <span class="small fw-semibold">
                                        <i class="fa-solid fa-user-shield me-1 text-primary"></i> 
                                        <?= isset($p->nama_admin) ? $p->nama_admin : 'Admin Lab'; ?>
                                    </span>
                                    <a href="mailto:<?= $p->email_kontak; ?>" class="text-primary small" style="text-decoration: none; font-size: 0.75rem;">
                                        <?= $p->email_kontak; ?>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <img src="<?= base_url('upload/'.$p->gambar); ?>" width="50" height="50" class="img-thumbnail shadow-sm" onerror="this.src='<?= base_url('upload/default.jpg') ?>'">
                            </td>
                            <td>
                                <?php if($this->session->userdata('role') === 'admin'): ?>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="<?= site_url('produk/edit/'.$p->id); ?>" class="btn btn-sm btn-light border text-warning shadow-sm" title="Edit">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <a href="<?= site_url('produk/hapus/'.$p->id); ?>" class="btn btn-sm btn-light border text-danger shadow-sm" title="Hapus" onclick="return confirm('Hapus barang ini?')">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                <?php else: ?>
                                    <form action="<?= site_url('produk/pinjam/'.$p->id); ?>" method="post" class="d-flex justify-content-center align-items-center">
                                        <input type="number" name="jumlah_pinjam" class="form-control form-control-sm me-2 text-center shadow-sm" 
                                               value="1" min="1" max="<?= $p->stok; ?>" 
                                               style="width: 50px; border-radius: 8px;" 
                                               <?= ($p->stok <= 0) ? 'disabled' : ''; ?>>
                                        
                                        <button type="submit" 
                                                class="btn btn-sm px-3 rounded-pill shadow-sm <?= ($p->stok > 0) ? 'btn-warning' : 'btn-secondary disabled'; ?>" 
                                                <?= ($p->stok <= 0) ? 'disabled' : ''; ?>>
                                            <i class="fa-solid <?= ($p->stok > 0) ? 'fa-hand-holding' : 'fa-ban'; ?> me-1"></i> 
                                            <?= ($p->stok > 0) ? 'Pinjam' : 'Habis'; ?>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">Belum ada barang di daftar inventaris.</td>
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