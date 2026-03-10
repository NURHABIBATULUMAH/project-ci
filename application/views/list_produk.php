<!DOCTYPE html>
<html>
<head>
<title>Data Produk</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

<h2 class="mb-4">Data Produk</h2>

<a href="<?php echo site_url('produk/tambah');?>" class="btn btn-primary mb-3">
Tambah Produk
</a>

<table class="table table-bordered table-striped">

<thead class="table-dark">
<tr>
<th>No</th>
<th>Nama Produk</th>
<th>Deskripsi</th>
<th>Email</th>
<th>Gambar</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>
<?php $no = 1; ?>
<?php foreach($produk as $p){ ?>

<tr>
<td><?php echo $no++; ?></td>
<td><?php echo $p->nama_produk;?></td>
<td><?php echo $p->deskripsi;?></td>
<td><?php echo $p->email_kontak;?></td>

<td>
<?php if($p->gambar){ ?>
<img src="<?php echo base_url('upload/'.$p->gambar);?>" width="80" class="img-thumbnail">
<?php } ?>
</td>

<td>
<a href="<?php echo site_url('produk/edit/'.$p->id);?>" class="btn btn-warning btn-sm">Edit</a>

<a href="<?php echo site_url('produk/delete/'.$p->id);?>" 
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin hapus data?')">
Delete
</a>
</td>

</tr>

<?php } ?>
</tbody>

</table>

</div>

</body>
</html>