<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
        }
        .navbar {
            background: linear-gradient(135deg, #6f42c1, #4e3188);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }
        .table thead {
            background-color: #6f42c1;
            color: white;
        }
        .img-thumbnail {
            border-radius: 8px;
            object-fit: cover;
        }
        .btn-custom-add {
            background-color: #6f42c1;
            color: white;
            border-radius: 8px;
            transition: 0.3s;
        }
        .btn-custom-add:hover {
            background-color: #59359a;
            color: white;
            transform: translateY(-2px);
        }
        .badge-email {
            background-color: #e9ecef;
            color: #495057;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            text-decoration: none;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            <i class="fa-solid fa-gift me-2"></i>Inventaris Laboratorium
        </a>
        <div class="navbar-nav ms-auto">
            <span class="nav-link text-light me-3">
                <i class="fa-solid fa-user-circle me-1"></i> Hi, <?= $this->session->userdata('username'); ?>
            </span>
            <a class="btn btn-sm btn-danger px-3 rounded-pill" href="<?= site_url('auth/logout'); ?>">
                <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
            </a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row mb-3 align-items-center">
        <div class="col">
            <h3 class="fw-bold text-secondary">Manajemen Barang</h3>
        </div>
        <div class="col text-end">
            <a href="<?php echo site_url('produk/tambah');?>" class="btn btn-custom-add px-4">
                <i class="fa-solid fa-plus me-1"></i> Tambah Barang
            </a>
        </div>
    </div>

    <div class="card p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Barang</th>
                        <th>Deskripsi</th>
                        <th>Kontak</th>
                        <th width="120">Gambar</th>
                        <th width="150" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if(!empty($produk)): ?>
                        <?php $no = 1; foreach($produk as $p): ?>
                        <tr>
                            <td class="fw-bold text-muted"><?= $no++; ?></td>
                            <td class="fw-semibold"><?= $p->nama_produk; ?></td>
                            <td class="text-muted small"><?= (strlen($p->deskripsi) > 50) ? substr($p->deskripsi, 0, 50).'...' : $p->deskripsi; ?></td>
                            <td>
                                <a href="mailto:<?= $p->email_kontak; ?>" class="badge-email">
                                    <i class="fa-regular fa-envelope me-1"></i><?= $p->email_kontak; ?>
                                </a>
                            </td>
                            <td>
                                <?php if($p->gambar): ?>
                                    <img src="<?= base_url('upload/'.$p->gambar); ?>" width="70" height="70" class="img-thumbnail">
                                <?php else: ?>
                                    <span class="text-muted small italic">No image</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="<?= site_url('produk/edit/'.$p->id); ?>" class="btn btn-outline-warning btn-sm px-3">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="<?= site_url('produk/delete/'.$p->id); ?>" 
                                       class="btn btn-outline-danger btn-sm px-3"
                                       onclick="return confirm('Yakin ingin menghapus barang ini?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada data barang.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <p class="text-center mt-4 text-muted small">&copy; 2026 Inventaris Laboratorium</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>