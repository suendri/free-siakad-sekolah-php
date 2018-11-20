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
$maxRows_DetailRS1 = 10;
$pageNum_DetailRS1 = 0;
if (isset($_GET['pageNum_DetailRS1'])) {
  $pageNum_DetailRS1 = $_GET['pageNum_DetailRS1'];
}
$startRow_DetailRS1 = $pageNum_DetailRS1 * $maxRows_DetailRS1;

$colname_DetailRS1 = "-1";
if (isset($_GET['recordID'])) {
  $colname_DetailRS1 = $_GET['recordID'];
}

$query_DetailRS1 = sprintf("SELECT * FROM siswa WHERE s_id = %s ORDER BY s_nis ASC", GetSQLValueString($colname_DetailRS1, "int"));
$query_limit_DetailRS1 = sprintf("%s LIMIT %d, %d", $query_DetailRS1, $startRow_DetailRS1, $maxRows_DetailRS1);
$DetailRS1 = mysql_query($query_limit_DetailRS1, $koneksi) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);

if (isset($_GET['totalRows_DetailRS1'])) {
  $totalRows_DetailRS1 = $_GET['totalRows_DetailRS1'];
} else {
  $all_DetailRS1 = mysql_query($query_DetailRS1);
  $totalRows_DetailRS1 = mysql_num_rows($all_DetailRS1);
}
$totalPages_DetailRS1 = ceil($totalRows_DetailRS1/$maxRows_DetailRS1)-1;
?>
<div class="judul">
<h3><span class="glyphicon glyphicon-list-alt"></span> Detail - <?php echo $row_DetailRS1['u_nama']; ?> </h3>
</div>
<table class="table table-bordered">
  <tr>
    <th width="138">NIS</th>
    <td width="340"><?php echo $row_DetailRS1['s_nis']; ?> </td>
  </tr>
  <tr>
    <th>Nama</th>
    <td><?php echo $row_DetailRS1['u_nama']; ?> </td>
  </tr>
  <tr>
    <th>Tempat Lahir</th>
    <td><?php echo $row_DetailRS1['s_tmp_lahir']; ?> </td>
  </tr>
  <tr>
    <th>Tanggal Lahir</th>
    <td><?php echo $row_DetailRS1['s_tgl_lhr']; ?> </td>
  </tr>
  <tr>
    <th>Jenis Kelamin</th>
    <td><?php echo $row_DetailRS1['s_jk']; ?> </td>
  </tr>
  <tr>
    <th>Nama Orang Tua</th>
    <td><?php echo $row_DetailRS1['s_nm_ortu']; ?> </td>
  </tr>
  <tr>
    <th>Pekerjaan Orang Tua</th>
    <td><?php echo $row_DetailRS1['s_pek_ortu']; ?> </td>
  </tr>
  <tr>
    <th>Alamat</th>
    <td><?php echo $row_DetailRS1['s_alamat']; ?> </td>
  </tr>
  <tr>
    <th>Agama</th>
    <td><?php echo $row_DetailRS1['s_agama']; ?> </td>
  </tr>
  <tr>
    <th>Gol Darah</th>
    <td><?php echo $row_DetailRS1['s_gdarah']; ?> </td>
  </tr>
  <tr>
    <th>Tahun Masuk</th>
    <td><?php echo $row_DetailRS1['s_thn_masuk']; ?> </td>
  </tr>
  <tr>
    <th>Kelas</th>
    <td><?php echo $row_DetailRS1['s_kd_kls']; ?> </td>
  </tr>
  <tr>
    <th>Nonaktif</th>
    <td><?php echo $row_DetailRS1['nonaktif']; ?> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input class="btn btn-info" type="button" name="button" id="button" value="Kembali" onClick="location='index.php?page=tampil_siswa'"/></td>
  </tr>
</table>
