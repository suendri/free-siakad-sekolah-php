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

$maxRows_rec_tampil_absensi = 10;
$pageNum_rec_tampil_absensi = 0;
if (isset($_GET['pageNum_rec_tampil_absensi'])) {
  $pageNum_rec_tampil_absensi = $_GET['pageNum_rec_tampil_absensi'];
}
$startRow_rec_tampil_absensi = $pageNum_rec_tampil_absensi * $maxRows_rec_tampil_absensi;

// pb add here
$colname1_rec_tampil_absensi = "-1";
$colname2_rec_tampil_absensi = "-1";
if (isset($_GET['kuncitahun']) AND isset($_GET['kuncikelas'])) {
  $_SESSION['kuncitahun'] = $_GET['kuncitahun'];
  $colname1_rec_tampil_absensi = $_SESSION['kuncitahun'];

  $_SESSION['kuncikelas'] = $_GET['kuncikelas'];
  $colname2_rec_tampil_absensi = $_SESSION['kuncikelas'];
}
else {
	if (isset($_SESSION['kuncitahun']) && isset($_SESSION['kuncikelas']))
	{ 
		$colname1_rec_tampil_absensi = $_SESSION['kuncitahun'];
		$colname2_rec_tampil_absensi = $_SESSION['kuncikelas'];
	}
	else {
		$colname1_rec_tampil_absensi = "";
		$colname2_rec_tampil_absensi = "";
	}
}
// pb until here

$query_rec_tampil_absensi = sprintf("SELECT absen.a_id, absen.a_id_siswa, absen.a_id_tahun, absen.a_sakit, absen.a_izin, absen.a_alpha, siswa.s_id, siswa.s_nis, siswa.u_nama, siswa.s_kd_kls, tahun.t_id, tahun.t_nm, tahun.t_jn, kelas.k_id, kelas.k_nm FROM absen, siswa, tahun, kelas WHERE siswa.nonaktif='N' AND absen.a_id_siswa = siswa.s_id AND absen.a_id_tahun = tahun.t_id AND siswa.s_kd_kls=kelas.k_kd AND absen.a_id_tahun=%s AND siswa.s_kd_kls=%s ORDER BY siswa.u_nama", GetSQLValueString($colname1_rec_tampil_absensi, "text"),GetSQLValueString($colname2_rec_tampil_absensi, "text"));
$query_limit_rec_tampil_absensi = sprintf("%s LIMIT %d, %d", $query_rec_tampil_absensi, $startRow_rec_tampil_absensi, $maxRows_rec_tampil_absensi);
$rec_tampil_absensi = mysql_query($query_limit_rec_tampil_absensi, $koneksi) or die(mysql_error());
$row_rec_tampil_absensi = mysql_fetch_assoc($rec_tampil_absensi);

if (isset($_GET['totalRows_rec_tampil_absensi'])) {
  $totalRows_rec_tampil_absensi = $_GET['totalRows_rec_tampil_absensi'];
} else {
  $all_rec_tampil_absensi = mysql_query($query_rec_tampil_absensi);
  $totalRows_rec_tampil_absensi = mysql_num_rows($all_rec_tampil_absensi);
}
$totalPages_rec_tampil_absensi = ceil($totalRows_rec_tampil_absensi/$maxRows_rec_tampil_absensi)-1;

$query_rec_list_tahun = "SELECT * FROM tahun WHERE t_nonaktif='N' ORDER BY t_nm ASC";
$rec_list_tahun = mysql_query($query_rec_list_tahun, $koneksi) or die(mysql_error());
$row_rec_list_tahun = mysql_fetch_assoc($rec_list_tahun);
$totalRows_rec_list_tahun = mysql_num_rows($rec_list_tahun);

$query_rec_list_kelas = "SELECT * FROM kelas WHERE k_nonaktif='N' ORDER BY k_nm ASC";
$rec_list_kelas = mysql_query($query_rec_list_kelas, $koneksi) or die(mysql_error());
$row_rec_list_kelas = mysql_fetch_assoc($rec_list_kelas);
$totalRows_rec_list_kelas = mysql_num_rows($rec_list_kelas);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-list-alt"></span> Absensi Siswa</h3>
</div>
<form class="well" id="form1" name="form1" method="get" action="">
<input type="hidden" name="page" value="tampil_absensi" />
  <table width="329" border="0">
    <tr>
      <td width="144">Tahun Pelajaran</td>
      <td width="169"><select class="form-control" name="kuncitahun" id="kuncitahun">
      <option value="">-- Pilih Tahun --</option>
        <?php
do {  
?>
        <option value="<?php echo $row_rec_list_tahun['t_id']?>"<?php if (!(strcmp($row_rec_list_tahun['t_id'], $row_rec_tampil_absensi['a_id_tahun']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rec_list_tahun['t_nm']?> - <?php echo $row_rec_list_tahun['t_jn']?></option>
        <?php
} while ($row_rec_list_tahun = mysql_fetch_assoc($rec_list_tahun));
  $rows = mysql_num_rows($rec_list_tahun);
  if($rows > 0) {
      mysql_data_seek($rec_list_tahun, 0);
	  $row_rec_list_tahun = mysql_fetch_assoc($rec_list_tahun);
  }
?>
            </select></td>
    </tr>
    <tr>
      <td>Kelas</td>
      <td><select class="form-control" name="kuncikelas" id="kuncikelas">
      <option value="">-- Pilih Kelas --</option>
        <?php
do {  
?>
        <option value="<?php echo $row_rec_list_kelas['k_kd']?>"<?php if (!(strcmp($row_rec_list_kelas['k_nm'], $row_rec_tampil_absensi['k_nm']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rec_list_kelas['k_nm']?></option>
        <?php
} while ($row_rec_list_kelas = mysql_fetch_assoc($rec_list_kelas));
  $rows = mysql_num_rows($rec_list_kelas);
  if($rows > 0) {
      mysql_data_seek($rec_list_kelas, 0);
	  $row_rec_list_kelas = mysql_fetch_assoc($rec_list_kelas);
  }
?>
                  </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-info" type="submit" name="cari" id="cari" value="Cari Kelas" /></td>
    </tr>
  </table>
</form>
<p><a class="btn btn-success" href="index.php?page=tambah_absensi">Tambah Absensi</a></p>
<?php if ($totalRows_rec_tampil_absensi > 0) { // Show if recordset not empty ?>
<table class="table table-bordered">
    <tr>
      <th width="17">#</th>
      <th width="164">Tahun</th>
      <th width="179">Kelas</th>
      <th width="164">NIS</th>
      <th width="181">Nama</th>
      <th width="177">Sakit</th>
      <th width="168">Izin</th>
      <th width="181">Alpha</th>
      <th width="57">Absensi</th>
      <th width="57">Hapus</th>
    </tr>
    <?php $no=0; do { $no++;?>
      <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $row_rec_tampil_absensi['t_nm']; ?> - <?php echo $row_rec_tampil_absensi['t_jn']; ?></td>
        <td><?php echo $row_rec_tampil_absensi['k_nm']; ?></td>
        <td><?php echo $row_rec_tampil_absensi['s_nis']; ?></td>
        <td><?php echo $row_rec_tampil_absensi['u_nama']; ?></td>
        <td><?php echo $row_rec_tampil_absensi['a_sakit']; ?></td>
        <td><?php echo $row_rec_tampil_absensi['a_izin']; ?></td>
        <td><?php echo $row_rec_tampil_absensi['a_alpha']; ?></td>
        <td><a href="index.php?page=edit_absensi&amp;a_id=<?php echo $row_rec_tampil_absensi['a_id']; ?>"><span class="glyphicon glyphicon-cog"></span></a></td>
        <td><a href="index.php?page=hapus_konfirm&f=absensi&id=<?php echo $row_rec_tampil_absensi['a_id']; ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
      </tr>
      <?php } while ($row_rec_tampil_absensi = mysql_fetch_assoc($rec_tampil_absensi)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_rec_tampil_absensi == 0) { // Show if recordset empty ?>
    <p>Silakan Cari Tahun Pelajaran dan Kelas.</p>
    <?php } // Show if recordset empty ?>
