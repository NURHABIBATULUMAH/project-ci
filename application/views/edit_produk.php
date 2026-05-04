<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; }
        .navbar { background: linear-gradient(135deg, #6f42c1, #4e3188); box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }
        .card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08); }
        .btn-update { background-color: #6f42c1; color: white; border: none; padding: 10px 25px; border-radius: 8px; transition: 0.3s; }
        .btn-update:hover { background-color: #59359a; color: white; transform: translateY(-2px); }
        .img-preview { border-radius: 10px; border: 2px solid #ddd; object-fit: cover; }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-5">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= site_url('produk'); ?>">
                <i class="fa-solid fa-gift me-2"></i>Inventaris Laboratorium
            </a>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4 p-md-5">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                            <i class="fa-solid fa-pen-to-square fs-4"></i>
                        </div>
                        <div>
                            <h2 class="mb-0 fw-bold">Edit Barang</h2>
                            <p class="text-muted mb-0">Update data: <?= $produk->nama_produk; ?></p>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <?= form_open_multipart('produk/update/' . $produk->id); ?>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Barang</label>
                            <input type="text" name="nama_produk" value="<?= $produk->nama_produk; ?>" class="form-control form-control-lg" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Stok Barang</label>
                            <input type="number" name="stok" value="<?= $produk->stok; ?>" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi Barang</label>
                            <textarea name="deskripsi" class="form-control" rows="4" required><?= $produk->deskripsi; ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email Penanggung Jawab</label>
                            <input type="email" name="email_kontak" value="<?= $produk->email_kontak; ?>" class="form-control form-control-lg" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Gambar Produk</label>
                            <div class="row align-items-center">
                                <div class="col-sm-3 mb-2">
                                    <img src="<?= base_url('upload/' . $produk->gambar); ?>" class="img-fluid img-preview" alt="Lama">
                                    <p class="text-center small text-muted mt-1">Foto Lama</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="file" name="gambar" class="form-control">
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-update">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Update Data
                            </button>
                            <a href="<?= site_url('produk'); ?>" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    <?= form_close(); ?>

                </div>
            </div>
        </div>
    </div>
</body>
</html>