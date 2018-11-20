<?php 
/* 
 * Sistem Informasi Sekolah
 * Perbaikan Ulang pada v2.0
 * 
 * Program ini adalah program Donasi http://phpbego.wordpress.com
 * Anda hanya saya minta sedikit donasi untuk program ini, tidak lebih.
 * Jika anda menghargai program saya, silakan anda hubungi saya
 * 
 * SMS : 085263616901 
 * Email : phpbego@yahoo.co.id, phpbego@gmail.com
 *
*/

mysql_select_db($database_koneksi, $koneksi);
$query_rec_tampil_peg = "SELECT * FROM pegawai ORDER BY p_id ASC";
$rec_tampil_peg = mysql_query($query_rec_tampil_peg, $koneksi) or die(mysql_error());
$row_rec_tampil_peg = mysql_fetch_assoc($rec_tampil_peg);
$totalRows_rec_tampil_peg = mysql_num_rows($rec_tampil_peg);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-list-alt"></span> Daftar Pegawai</h3>
</div>
<p><img src="Asset/images/print-icon.png" /> <a href="print.php?print=print_peg.php" target="_blank">Print Laporan</a></p>
<table class="table table-bordered">
  <tr>
    <th>#</th>
    <th>NIP</th>
    <th>Nama</th>
    <th>Tempat Lhr</th>
    <th>Tgl Lhr</th>
    <th>Jenis Kelamin</th>
    <th>Alamat</th>
    <th>Agama</th>
    <th>Status</th>
    <th>Nonaktif</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rec_tampil_peg['p_id']; ?></td>
      <td><?php echo $row_rec_tampil_peg['p_nip']; ?></td>
      <td><?php echo $row_rec_tampil_peg['p_nama']; ?></td>
      <td><?php echo $row_rec_tampil_peg['p_tmp_lhr']; ?></td>
      <td><?php echo $row_rec_tampil_peg['p_tgl_lhr']; ?></td>
      <td><?php echo $row_rec_tampil_peg['p_jk']; ?></td>
      <td><?php echo $row_rec_tampil_peg['p_alamat']; ?></td>
      <td><?php echo $row_rec_tampil_peg['p_agama']; ?></td>
      <td><?php echo $row_rec_tampil_peg['p_status']; ?></td>
      <td><img src="Asset/images/<?php echo $row_rec_tampil_peg['nonaktif']; ?>.gif" border="0" /></td>
    </tr>
    <?php } while ($row_rec_tampil_peg = mysql_fetch_assoc($rec_tampil_peg)); ?>
</table>