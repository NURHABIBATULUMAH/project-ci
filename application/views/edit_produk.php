<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang Inventaris</title>
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
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
        .form-label {
            font-weight: 600;
            color: #495057;
        }
        .form-control:focus {
            border-color: #6f42c1;
            box-shadow: 0 0 0 0.25rem rgba(111, 66, 193, 0.25);
        }
        .btn-update {
            background-color: #6f42c1;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            transition: 0.3s;
        }
        .btn-update:hover {
            background-color: #59359a;
            color: white;
            transform: translateY(-2px);
        }
        .btn-back {
            border-radius: 8px;
            padding: 10px 25px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark mb-5">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= site_url('produk'); ?>">
            <i class="fa-solid fa-gift me-2"></i>Inventaris-Laboratorium
        </a>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4 p-md-5">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                        <i class="fa-solid fa-pen-to-square fs-4"></i>
                    </div>
                    <div>
                        <h2 class="mb-0 fw-bold">Edit Barang</h2>
                        <p class="text-muted mb-0">Perbarui informasi barang</p>
                    </div>
                </div>

                <hr class="mb-4">

                <form action="<?php echo site_url('produk/update/'.$produk->id);?>" method="post">

                    <div class="mb-3">
                        <label class="form-label"><i class="fa-solid fa-tag me-2 text-muted"></i>Nama Barang</label>
                        <input type="text" name="nama_produk" 
                        value="<?php echo $produk->nama_produk;?>" 
                        class="form-control form-control-lg" placeholder="Contoh: Keyboard">
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fa-solid fa-align-left me-2 text-muted"></i>Deskripsi Barang</label>
                        <textarea name="deskripsi" class="form-control" rows="4" placeholder="Jelaskan detail produk..."><?php echo $produk->deskripsi;?></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label"><i class="fa-solid fa-envelope me-2 text-muted"></i>Email Penanggung Jawab</label>
                        <input type="email" name="email_kontak" 
                        value="<?php echo $produk->email_kontak;?>" 
                        class="form-control form-control-lg" placeholder="email@contoh.com">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-update">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Update Barang
                        </button>
                        <a href="<?php echo site_url('produk');?>" class="btn btn-outline-secondary btn-back">
                            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>

                </form>
            </div>
            <p class="text-center mt-4 text-muted small">Sedang mengedit: <strong><?php echo $produk->nama_produk;?></strong></p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>