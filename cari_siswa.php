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

$maxRows_rec_cari_siswa = 10;
$pageNum_rec_cari_siswa = 0;
if (isset($_GET['pageNum_rec_cari_siswa'])) {
  $pageNum_rec_cari_siswa = $_GET['pageNum_rec_cari_siswa'];
}
$startRow_rec_cari_siswa = $pageNum_rec_cari_siswa * $maxRows_rec_cari_siswa;

$colname_rec_cari_siswa = "-1";
if (isset($_GET['katakunci'])) {
  $colname_rec_cari_siswa = $_GET['katakunci'];
}

$query_rec_cari_siswa = sprintf("SELECT s_id, s_nis, u_nama, s_nm_ortu, s_thn_masuk, s_kd_kls, nonaktif FROM siswa WHERE u_nama LIKE %s ORDER BY u_nama ASC", GetSQLValueString("%" . $colname_rec_cari_siswa . "%", "text"));
$query_limit_rec_cari_siswa = sprintf("%s LIMIT %d, %d", $query_rec_cari_siswa, $startRow_rec_cari_siswa, $maxRows_rec_cari_siswa);
$rec_cari_siswa = mysql_query($query_limit_rec_cari_siswa, $koneksi) or die(mysql_error());
$row_rec_cari_siswa = mysql_fetch_assoc($rec_cari_siswa);

if (isset($_GET['totalRows_rec_cari_siswa'])) {
  $totalRows_rec_cari_siswa = $_GET['totalRows_rec_cari_siswa'];
} else {
  $all_rec_cari_siswa = mysql_query($query_rec_cari_siswa);
  $totalRows_rec_cari_siswa = mysql_num_rows($all_rec_cari_siswa);
}
$totalPages_rec_cari_siswa = ceil($totalRows_rec_cari_siswa/$maxRows_rec_cari_siswa)-1;

$queryString_rec_cari_siswa = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rec_cari_siswa") == false && 
        stristr($param, "totalRows_rec_cari_siswa") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rec_cari_siswa = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rec_cari_siswa = sprintf("&totalRows_rec_cari_siswa=%d%s", $totalRows_rec_cari_siswa, $queryString_rec_cari_siswa);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-search"></span> Cari Siswa</h3>
</div>
<fieldset>
<legend>Pencarian Siswa</legend>
<form class="well" id="form1" name="form1" method="get" action="">
  <input type="hidden" name="page" value="cari_siswa" />
  <p>
      <input class="form-control" type="text" name="katakunci" id="katakunci" placeholder="Masukkan Nama Siswa"/>
  </p>
  <input class="btn btn-success" type="submit" name="cari" id="button" value="Cari Siswa" />
  <input class="btn btn-info" type="button" name="button2" id="button2" value="Kembali ke Daftar Siswa"  onClick="location='index.php?page=tampil_siswa'"/>
</form>
</fieldset>

<?php if ($totalRows_rec_cari_siswa > 0) { // Show if recordset not empty ?>
<table class="table table-bordered">
    <tr>
      <th>#</th>
      <th>NIS</th>
      <th>Nama</th>
      <th>Nama Orang Tua</th>
      <th>Tahun Masuk</th>
      <th>Kelas</th>
      <th>nonaktif</th>
      <th>Aksi</th>
    </tr>
    <?php $no=0; do { $no++; ?>
      <tr>
      	<td><?php echo $no; ?></td>
        <td><a href="index.php?page=tampil_siswa_detail&recordID=<?php echo $row_rec_cari_siswa['s_id']; ?>"> <?php echo $row_rec_cari_siswa['s_nis']; ?></a></td>
        <td><?php echo $row_rec_cari_siswa['u_nama']; ?></td>
        <td><?php echo $row_rec_cari_siswa['s_nm_ortu']; ?></td>
        <td><?php echo $row_rec_cari_siswa['s_thn_masuk']; ?></td>
        <td><?php echo $row_rec_cari_siswa['s_kd_kls']; ?></td>
        <td><?php echo $row_rec_cari_siswa['nonaktif']; ?></td>
        <td><a href="index.php?page=edit_siswa&amp;s_id=<?php echo $row_rec_cari_siswa['s_id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
      </tr>
      <?php } while ($row_rec_cari_siswa = mysql_fetch_assoc($rec_cari_siswa)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
  <table border="0">
    <tr>
      <td><?php if ($pageNum_rec_cari_siswa > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_rec_cari_siswa=%d%s", $currentPage, 0, $queryString_rec_cari_siswa); ?>">First</a>
            <?php } // Show if not first page ?>
      </td>
      <td><?php if ($pageNum_rec_cari_siswa > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_rec_cari_siswa=%d%s", $currentPage, max(0, $pageNum_rec_cari_siswa - 1), $queryString_rec_cari_siswa); ?>">Previous</a>
            <?php } // Show if not first page ?>
      </td>
      <td><?php if ($pageNum_rec_cari_siswa < $totalPages_rec_cari_siswa) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_rec_cari_siswa=%d%s", $currentPage, min($totalPages_rec_cari_siswa, $pageNum_rec_cari_siswa + 1), $queryString_rec_cari_siswa); ?>">Next</a>
            <?php } // Show if not last page ?>
      </td>
      <td><?php if ($pageNum_rec_cari_siswa < $totalPages_rec_cari_siswa) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_rec_cari_siswa=%d%s", $currentPage, $totalPages_rec_cari_siswa, $queryString_rec_cari_siswa); ?>">Last</a>
            <?php } // Show if not last page ?>
      </td>
    </tr>
  </table>
<?php if ($totalRows_rec_cari_siswa == 0) { // Show if recordset empty ?>
<div class="bs-callout bs-callout-info">Pastikan Data yang anda cari benar !</div>
    <?php } // Show if recordset empty ?>
