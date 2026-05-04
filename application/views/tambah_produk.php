<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
        }

        .navbar {
            background: linear-gradient(135deg, #198754, #146c43);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .form-label {
            font-weight: 600;
            color: #495057;
        }

        .form-control:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
        }

        .btn-save {
            background-color: #198754;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-save:hover {
            background-color: #146c43;
            color: white;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-5">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= site_url('produk'); ?>">
                <i class="fa-solid fa-plus-circle me-2"></i>Tambah Barang Baru
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4 p-md-5 mb-5">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                            <i class="fa-solid fa-cart-plus fs-4"></i>
                        </div>
                        <div>
                            <h2 class="mb-0 fw-bold">Barang Baru</h2>
                            <p class="text-muted mb-0">Tambahkan Barang ke Inventaris</p>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <form action="<?= site_url('produk/simpan'); ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-gift text-muted"></i></span>
                                <input type="text" name="nama_produk" class="form-control form-control-lg" placeholder="Misal: Router Cisco" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jumlah Stok</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-boxes-stacked text-muted"></i></span>
                                <input type="number" name="stok" class="form-control" placeholder="0" min="1" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi Lengkap</label>
                            <textarea name="deskripsi" class="form-control" rows="4" placeholder="Detail spesifikasi barang..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Penanggung Jawab</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-envelope text-muted"></i></span>
                                <input type="email" name="email_kontak" class="form-control" placeholder="admin@lab.com" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Foto Barang</label>
                            <input type="file" name="gambar" class="form-control" required>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-save">
                                <i class="fa-solid fa-check-circle me-1"></i> Simpan Barang
                            </button>
                            <a href="<?= site_url('produk'); ?>" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>