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
$maxRows_rec_tampil_guru = 10;
$pageNum_rec_tampil_guru = 0;
if (isset($_GET['pageNum_rec_tampil_guru'])) {
  $pageNum_rec_tampil_guru = $_GET['pageNum_rec_tampil_guru'];
}
$startRow_rec_tampil_guru = $pageNum_rec_tampil_guru * $maxRows_rec_tampil_guru;

$query_rec_tampil_guru = "SELECT * FROM guru ORDER BY u_nama ASC";
$query_limit_rec_tampil_guru = sprintf("%s LIMIT %d, %d", $query_rec_tampil_guru, $startRow_rec_tampil_guru, $maxRows_rec_tampil_guru);
$rec_tampil_guru = mysql_query($query_limit_rec_tampil_guru, $koneksi) or die(mysql_error());
$row_rec_tampil_guru = mysql_fetch_assoc($rec_tampil_guru);

if (isset($_GET['totalRows_rec_tampil_guru'])) {
  $totalRows_rec_tampil_guru = $_GET['totalRows_rec_tampil_guru'];
} else {
  $all_rec_tampil_guru = mysql_query($query_rec_tampil_guru);
  $totalRows_rec_tampil_guru = mysql_num_rows($all_rec_tampil_guru);
}
$totalPages_rec_tampil_guru = ceil($totalRows_rec_tampil_guru/$maxRows_rec_tampil_guru)-1;
?>
<div class="judul">
<h3><span class="glyphicon glyphicon-list-alt"></span> Daftar Guru</h3>
</div>
<p><a class="btn btn-success" href="index.php?page=tambah_guru">Tambah Guru</a></p>
<table class="table table-bordered">
    <thead>
  <tr>
    <th>#</th>
    <th>NIP</th>
    <th>Nama</th>
    <th>Tempat Lahir</th>
    <th>Tgl Lahir</th>
    <th>Jenis Kelamin</th>
    <th>Alamat</th>
    <th>Agama</th>
    <th>Status</th>
    <th>Nonaktif</th>
    <th>Aksi</th>
  </tr>
    </thead>
    <tbody>
  <?php $no=0; do { $no++;?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $row_rec_tampil_guru['g_nip']; ?></td>
      <td><?php echo $row_rec_tampil_guru['u_nama']; ?></td>
      <td><?php echo $row_rec_tampil_guru['g_tmp_lhr']; ?></td>
      <td><?php echo $row_rec_tampil_guru['g_tgl_lhr']; ?></td>
      <td><?php echo $row_rec_tampil_guru['g_jk']; ?></td>
      <td><?php echo $row_rec_tampil_guru['g_alamat']; ?></td>
      <td><?php echo $row_rec_tampil_guru['g_agama']; ?></td>
      <td><?php echo $row_rec_tampil_guru['g_status']; ?></td>
      <td><img src="Asset/images/<?php echo $row_rec_tampil_guru['nonaktif']; ?>.gif" border="0" /></td>
      <td><a href="index.php?page=edit_guru&amp;g_id=<?php echo $row_rec_tampil_guru['g_id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
    </tr>
    <?php } while ($row_rec_tampil_guru = mysql_fetch_assoc($rec_tampil_guru)); ?>
    </tbody>
</table>
