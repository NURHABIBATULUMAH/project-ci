<h2>Tambah Produk</h2>

<form action="<?php echo site_url('produk/simpan');?>" method="post" enctype="multipart/form-data">

Nama Produk <br>
<input type="text" name="nama_produk"><br><br>

Deskripsi <br>
<textarea name="deskripsi"></textarea><br><br>

Email Kontak <br>
<input type="email" name="email_kontak"><br><br>

Upload Gambar <br>
<input type="file" name="gambar"><br><br>

<button type="submit">Simpan</button>

</form>