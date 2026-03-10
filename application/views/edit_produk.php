<!DOCTYPE html>
<html>
<head>
<title>Edit Produk</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

<h2>Edit Produk</h2>

<form action="<?php echo site_url('produk/update/'.$produk->id);?>" method="post">

<div class="mb-3">
<label class="form-label">Nama Produk</label>
<input type="text" name="nama_produk" 
value="<?php echo $produk->nama_produk;?>" 
class="form-control">
</div>

<div class="mb-3">
<label class="form-label">Deskripsi</label>
<textarea name="deskripsi" class="form-control"><?php echo $produk->deskripsi;?></textarea>
</div>

<div class="mb-3">
<label class="form-label">Email Kontak</label>
<input type="email" name="email_kontak" 
value="<?php echo $produk->email_kontak;?>" 
class="form-control">
</div>

<button class="btn btn-primary">Update</button>
<a href="<?php echo site_url('produk');?>" class="btn btn-secondary">Kembali</a>

</form>

</div>

</body>
</html>