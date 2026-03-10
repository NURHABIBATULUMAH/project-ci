<!DOCTYPE html>
<html>
<head>
<title>Tambah Produk</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

<h2>Tambah Produk</h2>

<form action="<?php echo site_url('produk/simpan');?>" method="post" enctype="multipart/form-data">

<div class="mb-3">
<label class="form-label">Nama Produk</label>
<input type="text" name="nama_produk" class="form-control">
</div>

<div class="mb-3">
<label class="form-label">Deskripsi</label>
<textarea name="deskripsi" class="form-control"></textarea>
</div>

<div class="mb-3">
<label class="form-label">Email Kontak</label>
<input type="email" name="email_kontak" class="form-control">
</div>

<div class="mb-3">
<label class="form-label">Upload Gambar</label>
<input type="file" name="gambar" class="form-control">
</div>

<button class="btn btn-success">Simpan</button>
<a href="<?php echo site_url('produk');?>" class="btn btn-secondary">Kembali</a>

</form>

</div>

</body>
</html>