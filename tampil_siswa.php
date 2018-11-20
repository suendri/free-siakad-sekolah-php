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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rec_tampil_siswa = 10;
$pageNum_rec_tampil_siswa = 0;
if (isset($_GET['pageNum_rec_tampil_siswa'])) {
  $pageNum_rec_tampil_siswa = $_GET['pageNum_rec_tampil_siswa'];
}
$startRow_rec_tampil_siswa = $pageNum_rec_tampil_siswa * $maxRows_rec_tampil_siswa;

mysql_select_db($database_koneksi, $koneksi);
$query_rec_tampil_siswa = "SELECT * FROM siswa ORDER BY s_nis ASC";
$query_limit_rec_tampil_siswa = sprintf("%s LIMIT %d, %d", $query_rec_tampil_siswa, $startRow_rec_tampil_siswa, $maxRows_rec_tampil_siswa);
$rec_tampil_siswa = mysql_query($query_limit_rec_tampil_siswa, $koneksi) or die(mysql_error());
$row_rec_tampil_siswa = mysql_fetch_assoc($rec_tampil_siswa);

if (isset($_GET['totalRows_rec_tampil_siswa'])) {
  $totalRows_rec_tampil_siswa = $_GET['totalRows_rec_tampil_siswa'];
} else {
  $all_rec_tampil_siswa = mysql_query($query_rec_tampil_siswa);
  $totalRows_rec_tampil_siswa = mysql_num_rows($all_rec_tampil_siswa);
}
$totalPages_rec_tampil_siswa = ceil($totalRows_rec_tampil_siswa/$maxRows_rec_tampil_siswa)-1;

$queryString_rec_tampil_siswa = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rec_tampil_siswa") == false && 
        stristr($param, "totalRows_rec_tampil_siswa") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rec_tampil_siswa = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rec_tampil_siswa = sprintf("&totalRows_rec_tampil_siswa=%d%s", $totalRows_rec_tampil_siswa, $queryString_rec_tampil_siswa);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-list-alt"></span> Daftar Siswa</h3>
</div>
<p><a class="btn btn-success" href="index.php?page=tambah_siswa">Tambah Siswa</a>
   <a class="btn btn-success" href="index.php?page=cari_siswa">Cari Siswa</a></p>
<table class="table table-bordered">
  <tr>
    <th>#</th>
    <th>NIS</th>
    <th>Nama</th>
    <th>Nama Orang Tua</th>
    <th>Tahun Masuk</th>
    <th>Kelas</th>
    <th>Nonaktif</th>
    <th>Aksi</th>
  </tr>
  <?php $no=0; do { $no++;?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><a href="index.php?page=tampil_siswa_detail&recordID=<?php echo $row_rec_tampil_siswa['s_id']; ?>"> <?php echo $row_rec_tampil_siswa['s_nis']; ?></a> </td>
      <td><?php echo $row_rec_tampil_siswa['u_nama']; ?></td>
      <td><?php echo $row_rec_tampil_siswa['s_nm_ortu']; ?></td>
      <td><?php echo $row_rec_tampil_siswa['s_thn_masuk']; ?></td>
      <td><?php echo $row_rec_tampil_siswa['s_kd_kls']; ?></td>
      <td><img src="Asset/images/<?php echo $row_rec_tampil_siswa['nonaktif']; ?>.gif" border="0" /></td>
      <td><a href="index.php?page=edit_siswa&amp;s_id=<?php echo $row_rec_tampil_siswa['s_id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
    </tr>
    <?php } while ($row_rec_tampil_siswa = mysql_fetch_assoc($rec_tampil_siswa)); ?>
</table>

<p>&nbsp;</p>
Records <?php echo ($startRow_rec_tampil_siswa + 1) ?> to <?php echo min($startRow_rec_tampil_siswa + $maxRows_rec_tampil_siswa, $totalRows_rec_tampil_siswa) ?> of <?php echo $totalRows_rec_tampil_siswa ?>

<table border="0">
  <tr>
    <td><?php if ($pageNum_rec_tampil_siswa > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rec_tampil_siswa=%d%s", $currentPage, 0, $queryString_rec_tampil_siswa); ?>"><< First | </a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rec_tampil_siswa > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rec_tampil_siswa=%d%s", $currentPage, max(0, $pageNum_rec_tampil_siswa - 1), $queryString_rec_tampil_siswa); ?>"> < Previous </a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rec_tampil_siswa < $totalPages_rec_tampil_siswa) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rec_tampil_siswa=%d%s", $currentPage, min($totalPages_rec_tampil_siswa, $pageNum_rec_tampil_siswa + 1), $queryString_rec_tampil_siswa); ?>">| Next ></a>
          <?php } // Show if not last page ?>
    </td>
    <td><?php if ($pageNum_rec_tampil_siswa < $totalPages_rec_tampil_siswa) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rec_tampil_siswa=%d%s", $currentPage, $totalPages_rec_tampil_siswa, $queryString_rec_tampil_siswa); ?>"> | Last >></a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
