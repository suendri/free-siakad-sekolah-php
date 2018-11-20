<?php 
/* 
 * Sistem Informasi Sekolah
 * Perbaikan Ulang pada v3.0
 * 
 * Program ini adalah program Donasi http://phpbego.wordpress.com
 * Anda hanya saya minta sedikit donasi untuk program ini, tidak lebih.
 * Jika anda menghargai program saya, silakan anda hubungi saya
 * 
 * SMS : 085263616901 
 * Email : phpbego@yahoo.co.id, phpbego@gmail.com
 *
*/

$maxRows_rec_tampil_uguru = 10;
$pageNum_rec_tampil_uguru = 0;
if (isset($_GET['pageNum_rec_tampil_uguru'])) {
  $pageNum_rec_tampil_uguru = $_GET['pageNum_rec_tampil_uguru'];
}
$startRow_rec_tampil_uguru = $pageNum_rec_tampil_uguru * $maxRows_rec_tampil_uguru;

mysql_select_db($database_koneksi, $koneksi);
$query_rec_tampil_uguru = "SELECT g_id, g_nip, u_pass, u_nama, nonaktif FROM guru ORDER BY u_nama ASC";
$query_limit_rec_tampil_uguru = sprintf("%s LIMIT %d, %d", $query_rec_tampil_uguru, $startRow_rec_tampil_uguru, $maxRows_rec_tampil_uguru);
$rec_tampil_uguru = mysql_query($query_limit_rec_tampil_uguru, $koneksi) or die(mysql_error());
$row_rec_tampil_uguru = mysql_fetch_assoc($rec_tampil_uguru);

if (isset($_GET['totalRows_rec_tampil_uguru'])) {
  $totalRows_rec_tampil_uguru = $_GET['totalRows_rec_tampil_uguru'];
} else {
  $all_rec_tampil_uguru = mysql_query($query_rec_tampil_uguru);
  $totalRows_rec_tampil_uguru = mysql_num_rows($all_rec_tampil_uguru);
}
$totalPages_rec_tampil_uguru = ceil($totalRows_rec_tampil_uguru/$maxRows_rec_tampil_uguru)-1;
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-list-alt"></span> Daftar User Guru</h3>
</div>

<table class="table table-bordered">
  <tr>
    <th>#</th>
    <th>NIP</th>
    <th>Nama</th>
    <th>Nonaktif</th>
    <th>Aksi</th>
  </tr>
  <?php $no=0; do { $no++; ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $row_rec_tampil_uguru['g_nip']; ?></td>
      <td><?php echo $row_rec_tampil_uguru['u_nama']; ?></td>
      <td><img src="Asset/images/<?php echo $row_rec_tampil_uguru['nonaktif']; ?>.gif" border="0" /></td>
      <td><a href="index.php?page=edit_uguru&amp;g_id=<?php echo $row_rec_tampil_uguru['g_id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
    </tr>
    <?php } while ($row_rec_tampil_uguru = mysql_fetch_assoc($rec_tampil_uguru)); ?>
</table>

<div class="bs-callout bs-callout-info">Anda dapat menambahkan User Guru di Menu Modul - Guru</div>
