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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rec_tampil_usiswa = 10;
$pageNum_rec_tampil_usiswa = 0;
if (isset($_GET['pageNum_rec_tampil_usiswa'])) {
  $pageNum_rec_tampil_usiswa = $_GET['pageNum_rec_tampil_usiswa'];
}
$startRow_rec_tampil_usiswa = $pageNum_rec_tampil_usiswa * $maxRows_rec_tampil_usiswa;

mysql_select_db($database_koneksi, $koneksi);
$query_rec_tampil_usiswa = "SELECT s_id, s_nis, u_pass, u_nama, nonaktif FROM siswa ORDER BY u_nama ASC";
$query_limit_rec_tampil_usiswa = sprintf("%s LIMIT %d, %d", $query_rec_tampil_usiswa, $startRow_rec_tampil_usiswa, $maxRows_rec_tampil_usiswa);
$rec_tampil_usiswa = mysql_query($query_limit_rec_tampil_usiswa, $koneksi) or die(mysql_error());
$row_rec_tampil_usiswa = mysql_fetch_assoc($rec_tampil_usiswa);

if (isset($_GET['totalRows_rec_tampil_usiswa'])) {
  $totalRows_rec_tampil_usiswa = $_GET['totalRows_rec_tampil_usiswa'];
} else {
  $all_rec_tampil_usiswa = mysql_query($query_rec_tampil_usiswa);
  $totalRows_rec_tampil_usiswa = mysql_num_rows($all_rec_tampil_usiswa);
}
$totalPages_rec_tampil_usiswa = ceil($totalRows_rec_tampil_usiswa/$maxRows_rec_tampil_usiswa)-1;

$queryString_rec_tampil_usiswa = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rec_tampil_usiswa") == false && 
        stristr($param, "totalRows_rec_tampil_usiswa") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rec_tampil_usiswa = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rec_tampil_usiswa = sprintf("&totalRows_rec_tampil_usiswa=%d%s", $totalRows_rec_tampil_usiswa, $queryString_rec_tampil_usiswa);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-list-alt"></span> Daftar User Siswa</h2>
</div>

<table class="table table-bordered">
  <tr>
    <th>#</th>
    <th>NIS</th>
    <th>Nama</th>
    <th>Nonaktif</th>
    <th>Aksi</th>
  </tr>
  <?php $no=0; do { $no++; ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $row_rec_tampil_usiswa['s_nis']; ?></td>
      <td><?php echo $row_rec_tampil_usiswa['u_nama']; ?></td>
      <td><img src="Asset/images/<?php echo $row_rec_tampil_usiswa['nonaktif']; ?>.gif" border="0" /></td>
      <td><a href="index.php?page=edit_usiswa&amp;s_id=<?php echo $row_rec_tampil_usiswa['s_id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
    </tr>
    <?php } while ($row_rec_tampil_usiswa = mysql_fetch_assoc($rec_tampil_usiswa)); ?>
</table>
<table border="0">
  <tr>
    <td><?php if ($pageNum_rec_tampil_usiswa > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rec_tampil_usiswa=%d%s", $currentPage, 0, $queryString_rec_tampil_usiswa); ?>"><< First |</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rec_tampil_usiswa > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rec_tampil_usiswa=%d%s", $currentPage, max(0, $pageNum_rec_tampil_usiswa - 1), $queryString_rec_tampil_usiswa); ?>"> < Previous </a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rec_tampil_usiswa < $totalPages_rec_tampil_usiswa) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rec_tampil_usiswa=%d%s", $currentPage, min($totalPages_rec_tampil_usiswa, $pageNum_rec_tampil_usiswa + 1), $queryString_rec_tampil_usiswa); ?>"> | Next ></a>
          <?php } // Show if not last page ?>
    </td>
    <td><?php if ($pageNum_rec_tampil_usiswa < $totalPages_rec_tampil_usiswa) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rec_tampil_usiswa=%d%s", $currentPage, $totalPages_rec_tampil_usiswa, $queryString_rec_tampil_usiswa); ?>"> | Last >></a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>

<div class="bs-callout bs-callout-info">Anda dapat menambahkan User Siswa di Menu Modul - Siswa</div>