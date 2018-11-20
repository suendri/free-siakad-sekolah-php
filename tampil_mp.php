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
$maxRows_rec_tampil_mp = 10;
$pageNum_rec_tampil_mp = 0;
if (isset($_GET['pageNum_rec_tampil_mp'])) {
  $pageNum_rec_tampil_mp = $_GET['pageNum_rec_tampil_mp'];
}
$startRow_rec_tampil_mp = $pageNum_rec_tampil_mp * $maxRows_rec_tampil_mp;

$query_rec_tampil_mp = "SELECT * FROM mapel ORDER BY m_nama ASC";
$query_limit_rec_tampil_mp = sprintf("%s LIMIT %d, %d", $query_rec_tampil_mp, $startRow_rec_tampil_mp, $maxRows_rec_tampil_mp);
$rec_tampil_mp = mysql_query($query_limit_rec_tampil_mp, $koneksi) or die(mysql_error());
$row_rec_tampil_mp = mysql_fetch_assoc($rec_tampil_mp);

if (isset($_GET['totalRows_rec_tampil_mp'])) {
  $totalRows_rec_tampil_mp = $_GET['totalRows_rec_tampil_mp'];
} else {
  $all_rec_tampil_mp = mysql_query($query_rec_tampil_mp);
  $totalRows_rec_tampil_mp = mysql_num_rows($all_rec_tampil_mp);
}
$totalPages_rec_tampil_mp = ceil($totalRows_rec_tampil_mp/$maxRows_rec_tampil_mp)-1;
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-list-alt"></span> Daftar Mata Pelajaran</h3>
</div>
<p><a class="btn btn-success" href="index.php?page=tambah_mp">Tambah Mata Pelajaran</a></p>
<table class="table table-bordered">
  <tr>
    <th>#</th>
    <th>Kode</th>
    <th>Mata Pelajaran</th>
    <th>Nonaktif</th>
    <th>Aksi</th>
  </tr>
  <?php $no=0; do { $no++;?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $row_rec_tampil_mp['m_kode']; ?></td>
      <td><?php echo $row_rec_tampil_mp['m_nama']; ?></td>
      <td><img src="Asset/images/<?php echo $row_rec_tampil_mp['m_nonaktif']; ?>.gif" border="0" /></td>
      <td><a href="index.php?page=edit_mp&amp;m_id=<?php echo $row_rec_tampil_mp['m_id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
  </tr>
    <?php } while ($row_rec_tampil_mp = mysql_fetch_assoc($rec_tampil_mp)); ?>
</table>
