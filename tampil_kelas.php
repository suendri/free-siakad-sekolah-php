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

$maxRows_rec_tampil_kelas = 10;
$pageNum_rec_tampil_kelas = 0;
if (isset($_GET['pageNum_rec_tampil_kelas'])) {
  $pageNum_rec_tampil_kelas = $_GET['pageNum_rec_tampil_kelas'];
}
$startRow_rec_tampil_kelas = $pageNum_rec_tampil_kelas * $maxRows_rec_tampil_kelas;

mysql_select_db($database_koneksi, $koneksi);
$query_rec_tampil_kelas = "SELECT * FROM kelas";
$query_limit_rec_tampil_kelas = sprintf("%s LIMIT %d, %d", $query_rec_tampil_kelas, $startRow_rec_tampil_kelas, $maxRows_rec_tampil_kelas);
$rec_tampil_kelas = mysql_query($query_limit_rec_tampil_kelas, $koneksi) or die(mysql_error());
$row_rec_tampil_kelas = mysql_fetch_assoc($rec_tampil_kelas);

if (isset($_GET['totalRows_rec_tampil_kelas'])) {
  $totalRows_rec_tampil_kelas = $_GET['totalRows_rec_tampil_kelas'];
} else {
  $all_rec_tampil_kelas = mysql_query($query_rec_tampil_kelas);
  $totalRows_rec_tampil_kelas = mysql_num_rows($all_rec_tampil_kelas);
}
$totalPages_rec_tampil_kelas = ceil($totalRows_rec_tampil_kelas/$maxRows_rec_tampil_kelas)-1;
?>
<div class="judul">
<h3><span class="glyphicon glyphicon-list-alt"></span> Daftar Kelas</h3>
</div>
<p><a class="btn btn-success" href="index.php?page=tambah_kelas">Tambah Kelas</a></p>
<table class="table table-bordered"> 
  <tr>
    <th>#</th>
    <th>Kode</th>
    <th>Nama Kelas</th>
    <th>Wali Kelas</th>
    <th>Nonaktif</th>
    <th>Aksi</th>
  </tr>
  <?php $no=0; do { $no++;?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $row_rec_tampil_kelas['k_kd']; ?></td>
      <td><?php echo $row_rec_tampil_kelas['k_nm']; ?></td>
      <td><?php echo $row_rec_tampil_kelas['k_wali']; ?></td>
      <td><img src="Asset/images/<?php echo $row_rec_tampil_kelas['k_nonaktif']; ?>.gif" border="0" /></td>
      <td><a href="index.php?page=edit_kelas&amp;k_id=<?php echo $row_rec_tampil_kelas['k_id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
    </tr>
    <?php } while ($row_rec_tampil_kelas = mysql_fetch_assoc($rec_tampil_kelas)); ?>
</table>