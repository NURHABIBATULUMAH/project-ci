<h2>Data Produk</h2>

<a href="<?php echo site_url('produk/tambah');?>">Tambah Produk</a>

<table border="1">
<tr>
<th>ID</th>
<th>Nama Produk</th>
<th>Deskripsi</th>
<th>Email</th>
<th>Gambar</th>
<th>Aksi</th>
</tr>

<?php foreach($produk as $p){ ?>

<tr>
<td><?php echo $p->id;?></td>
<td><?php echo $p->nama_produk;?></td>
<td><?php echo $p->deskripsi;?></td>
<td><?php echo $p->email_kontak;?></td>

<td>
<?php if($p->gambar){ ?>
<img src="<?php echo base_url('upload/'.$p->gambar);?>" width="80">
<?php } ?>
</td>

<td>
<a href="<?php echo site_url('produk/edit/'.$p->id);?>">Edit</a>
<a href="<?php echo site_url('produk/delete/'.$p->id);?>">Delete</a>
</td>

</tr>

<?php } ?>

</table>