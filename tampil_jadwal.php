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

$maxRows_rec_tampil_jadwal = 10;
$pageNum_rec_tampil_jadwal = 0;
if (isset($_GET['pageNum_rec_tampil_jadwal'])) {
  $pageNum_rec_tampil_jadwal = $_GET['pageNum_rec_tampil_jadwal'];
}
$startRow_rec_tampil_jadwal = $pageNum_rec_tampil_jadwal * $maxRows_rec_tampil_jadwal;
// pb add here
$colname1_rec_tampil_jadwal = "-1";
$colname2_rec_tampil_jadwal = "-1";

if (isset($_GET['kuncitahun']) AND isset($_GET['kuncikelas'])) {
  $_SESSION['kuncitahun'] = $_GET['kuncitahun'];
  $colname1_rec_tampil_jadwal = $_SESSION['kuncitahun'];

  $_SESSION['kuncikelas'] = $_GET['kuncikelas'];
  $colname2_rec_tampil_jadwal = $_SESSION['kuncikelas'];
}
else {
	if (isset($_SESSION['kuncitahun']) && isset($_SESSION['kuncikelas']))
	{ 
		$colname1_rec_tampil_jadwal = $_SESSION['kuncitahun'];
		$colname2_rec_tampil_jadwal = $_SESSION['kuncikelas'];
	}
	else {
	$colname1_rec_tampil_jadwal = "";
	$colname2_rec_tampil_jadwal = "";
	}
}
// pb until here

$query_rec_tampil_jadwal = sprintf("SELECT tahun.t_id, tahun.t_nm, tahun.t_jn, kelas.k_kd, kelas.k_nm, mapel.m_kode, mapel.m_nama, jadwal.j_id, jadwal.j_id_thn, jadwal.j_kd_kls, jadwal.j_kd_mapel, jadwal.j_id_guru, jadwal.j_hari, jadwal.j_jam, hari.h_id, hari.h_nama, guru.g_id, guru.u_nama FROM tahun, kelas, mapel, jadwal, hari, guru WHERE jadwal.j_id_thn=tahun.t_id AND jadwal.j_kd_kls=kelas.k_kd AND jadwal.j_kd_mapel=mapel.m_kode AND jadwal.j_hari=hari.h_id AND jadwal.j_id_guru=guru.g_id AND jadwal.j_id_thn=%s AND jadwal.j_kd_kls=%s ORDER BY jadwal.j_hari ASC", GetSQLValueString($colname1_rec_tampil_jadwal, "text"),GetSQLValueString($colname2_rec_tampil_jadwal, "text"));
$query_limit_rec_tampil_jadwal = sprintf("%s LIMIT %d, %d", $query_rec_tampil_jadwal, $startRow_rec_tampil_jadwal, $maxRows_rec_tampil_jadwal);
$rec_tampil_jadwal = mysql_query($query_limit_rec_tampil_jadwal, $koneksi) or die(mysql_error());
$row_rec_tampil_jadwal = mysql_fetch_assoc($rec_tampil_jadwal);

if (isset($_GET['totalRows_rec_tampil_jadwal'])) {
  $totalRows_rec_tampil_jadwal = $_GET['totalRows_rec_tampil_jadwal'];
} else {
  $all_rec_tampil_jadwal = mysql_query($query_rec_tampil_jadwal);
  $totalRows_rec_tampil_jadwal = mysql_num_rows($all_rec_tampil_jadwal);
}
$totalPages_rec_tampil_jadwal = ceil($totalRows_rec_tampil_jadwal/$maxRows_rec_tampil_jadwal)-1;

$query_rec_list_tahun = "SELECT * FROM tahun WHERE t_nonaktif='N' ORDER BY t_nm ASC";
$rec_list_tahun = mysql_query($query_rec_list_tahun, $koneksi) or die(mysql_error());
$row_rec_list_tahun = mysql_fetch_assoc($rec_list_tahun);
$totalRows_rec_list_tahun = mysql_num_rows($rec_list_tahun);

$query_rec_list_kelas = "SELECT * FROM kelas WHERE k_nonaktif='N' ORDER BY k_kd ASC";
$rec_list_kelas = mysql_query($query_rec_list_kelas, $koneksi) or die(mysql_error());
$row_rec_list_kelas = mysql_fetch_assoc($rec_list_kelas);
$totalRows_rec_list_kelas = mysql_num_rows($rec_list_kelas);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-list-alt"></span> Daftar Jadwal</h3>
</div>
<form class="well" id="form1" name="form1" method="get" action="">
<input type="hidden" name="page" value="tampil_jadwal" />
  <table width="307" border="0">
    <tr>
      <td width="125">Tahun Pelajaran</td>
      <td width="166"><select name="kuncitahun" class="form-control" id="kuncitahun">
        <option value="" <?php if (!(strcmp("", $row_rec_tampil_jadwal['j_id_thn']))) {echo "selected=\"selected\"";} ?>>-- Pilih Tahun --</option>
        <?php
do {  
?>
        <option value="<?php echo $row_rec_list_tahun['t_id']?>"<?php if (!(strcmp($row_rec_list_tahun['t_id'], $row_rec_tampil_jadwal['j_id_thn']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rec_list_tahun['t_nm']?> - <?php echo $row_rec_list_tahun['t_jn']?></option>
<?php
} while ($row_rec_list_tahun = mysql_fetch_assoc($rec_list_tahun));
  $rows = mysql_num_rows($rec_list_tahun);
  if($rows > 0) {
      mysql_data_seek($rec_list_tahun, 0);
	  $row_rec_list_tahun = mysql_fetch_assoc($rec_list_tahun);
  }
?>
      </select>
      </td>
    </tr>
    <tr>
      <td>Kelas</td>
      <td><select name="kuncikelas" class="form-control" id="kuncikelas">
        <option value="" <?php if (!(strcmp("", $row_rec_tampil_jadwal['j_kd_kls']))) {echo "selected=\"selected\"";} ?>>-- Pilih Kelas --</option>
        <?php
do {  
?><option value="<?php echo $row_rec_list_kelas['k_kd']?>"<?php if (!(strcmp($row_rec_list_kelas['k_kd'], $row_rec_tampil_jadwal['j_kd_kls']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rec_list_kelas['k_nm']?></option>
        <?php
} while ($row_rec_list_kelas = mysql_fetch_assoc($rec_list_kelas));
  $rows = mysql_num_rows($rec_list_kelas);
  if($rows > 0) {
      mysql_data_seek($rec_list_kelas, 0);
	  $row_rec_list_kelas = mysql_fetch_assoc($rec_list_kelas);
  }
?>
      </select>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-info" type="submit" name="button" id="button" value="Cari Jadwal" /></td>
    </tr>
  </table>
</form>

<p><a class="btn btn-success" href="index.php?page=tambah_jadwal">Tambah Jadwal</a></p>

<?php if ($totalRows_rec_tampil_jadwal > 0) { // Show if recordset not empty ?>
<table class="table table-bordered">
    <thead>
    <tr>
      <th>#</th>
      <th>Tahun</th>
      <th>Kelas</th>
      <th>Mata Pelajaran</th>
      <th>Guru</th>
      <th>Hari</th>
      <th>Jam</th>
      <th>Edit</th>
      <th>Hapus</th>
    </tr>
    </thead>
    <tbody>
    <?php $no=0; do { $no++; ?>
      <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $row_rec_tampil_jadwal['t_nm']; ?> - <?php echo $row_rec_tampil_jadwal['t_jn']; ?></td>
        <td><?php echo $row_rec_tampil_jadwal['k_nm']; ?></td>
        <td><?php echo $row_rec_tampil_jadwal['m_nama']; ?></td>
        <td><?php echo $row_rec_tampil_jadwal['u_nama']; ?></td>
        <td><?php echo $row_rec_tampil_jadwal['h_nama']; ?></td>
        <td><?php echo $row_rec_tampil_jadwal['j_jam']; ?></td>
        <td><a href="?page=edit_jadwal&j_id=<?php echo $row_rec_tampil_jadwal['j_id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
        <td><a href="?page=hapus_konfirm&f=jadwal&id=<?php echo $row_rec_tampil_jadwal['j_id']; ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
      </tr>
      <?php } while ($row_rec_tampil_jadwal = mysql_fetch_assoc($rec_tampil_jadwal)); ?>
    </tbody>    
</table>
  <?php } // Show if recordset not empty ?>
  <br />
  <?php if ($totalRows_rec_tampil_jadwal == 0) { // Show if recordset empty ?>
  <div class="bs-callout bs-callout-info">
  Silakan Cari Jadwal atau Tambahkan Jadwal baru.
  </div>
      <?php } // Show if recordset empty ?>
