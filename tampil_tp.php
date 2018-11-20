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

$maxRows_rec_tampil_tp = 10;
$pageNum_rec_tampil_tp = 0;
if (isset($_GET['pageNum_rec_tampil_tp'])) {
  $pageNum_rec_tampil_tp = $_GET['pageNum_rec_tampil_tp'];
}
$startRow_rec_tampil_tp = $pageNum_rec_tampil_tp * $maxRows_rec_tampil_tp;

$query_rec_tampil_tp = "SELECT * FROM tahun ORDER BY t_nm ASC";
$query_limit_rec_tampil_tp = sprintf("%s LIMIT %d, %d", $query_rec_tampil_tp, $startRow_rec_tampil_tp, $maxRows_rec_tampil_tp);
$rec_tampil_tp = mysql_query($query_limit_rec_tampil_tp, $koneksi) or die(mysql_error());
$row_rec_tampil_tp = mysql_fetch_assoc($rec_tampil_tp);

if (isset($_GET['totalRows_rec_tampil_tp'])) {
  $totalRows_rec_tampil_tp = $_GET['totalRows_rec_tampil_tp'];
} else {
  $all_rec_tampil_tp = mysql_query($query_rec_tampil_tp);
  $totalRows_rec_tampil_tp = mysql_num_rows($all_rec_tampil_tp);
}
$totalPages_rec_tampil_tp = ceil($totalRows_rec_tampil_tp/$maxRows_rec_tampil_tp)-1;
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-list-alt"></span> Tahun Pelajaran</h3>
</div>
<p><a class="btn btn-success" href="index.php?page=tambah_tp">Tambah Tahun</a></p>
<table class="table table-bordered">
    <thead>
  <tr>
    <th>#</th>
    <th>Tahun</th>
    <th>Semester</th>
    <th>Nonaktif</th>
    <th>Aksi</th>
  </tr>
    </thead>
    <tbody>
  <?php $no=0; do { $no++;?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $row_rec_tampil_tp['t_nm']; ?></td>
      <td><?php echo $row_rec_tampil_tp['t_jn']; ?></td>
      <td><img src="Asset/images/<?php echo $row_rec_tampil_tp['t_nonaktif']; ?>.gif" border="0" /></td>
      <td><a href="index.php?page=edit_tp&amp;t_id=<?php echo $row_rec_tampil_tp['t_id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
    </tr>
    <?php } while ($row_rec_tampil_tp = mysql_fetch_assoc($rec_tampil_tp)); ?>
    </tbody>
</table>
