<h2>Edit Produk</h2>

<form action="<?php echo site_url('produk/update/'.$produk->id);?>" method="post">

Nama Produk <br>
<input type="text" name="nama_produk" value="<?php echo $produk->nama_produk;?>"><br><br>

Deskripsi <br>
<textarea name="deskripsi"><?php echo $produk->deskripsi;?></textarea><br><br>

Email Kontak <br>
<input type="email" name="email_kontak" value="<?php echo $produk->email_kontak;?>"><br><br>

<button type="submit">Update</button>

</form>