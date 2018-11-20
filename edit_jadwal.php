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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE jadwal SET j_id_thn=%s, j_kd_kls=%s, j_kd_mapel=%s, j_id_guru=%s, j_hari=%s, j_jam=%s WHERE j_id=%s",
                       GetSQLValueString($_POST['j_id_thn'], "int"),
                       GetSQLValueString($_POST['j_kd_kls'], "text"),
                       GetSQLValueString($_POST['j_kd_mapel'], "text"),
                       GetSQLValueString($_POST['j_id_guru'], "text"),
                       GetSQLValueString($_POST['j_hari'], "text"),
                       GetSQLValueString($_POST['j_jam'], "text"),
                       GetSQLValueString($_POST['j_id'], "int"));

  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_rec_edit_jadwal = "-1";
if (isset($_GET['j_id'])) {
  $colname_rec_edit_jadwal = $_GET['j_id'];
}

$query_rec_edit_jadwal = sprintf("SELECT * FROM jadwal WHERE j_id = %s", GetSQLValueString($colname_rec_edit_jadwal, "int"));
$rec_edit_jadwal = mysql_query($query_rec_edit_jadwal, $koneksi) or die(mysql_error());
$row_rec_edit_jadwal = mysql_fetch_assoc($rec_edit_jadwal);
$totalRows_rec_edit_jadwal = mysql_num_rows($rec_edit_jadwal);

$query_rec_list_tahun = "SELECT * FROM tahun";
$rec_list_tahun = mysql_query($query_rec_list_tahun, $koneksi) or die(mysql_error());
$row_rec_list_tahun = mysql_fetch_assoc($rec_list_tahun);
$totalRows_rec_list_tahun = mysql_num_rows($rec_list_tahun);

$query_rec_list_kls = "SELECT * FROM kelas";
$rec_list_kls = mysql_query($query_rec_list_kls, $koneksi) or die(mysql_error());
$row_rec_list_kls = mysql_fetch_assoc($rec_list_kls);
$totalRows_rec_list_kls = mysql_num_rows($rec_list_kls);

$query_rec_list_mapel = "SELECT * FROM mapel";
$rec_list_mapel = mysql_query($query_rec_list_mapel, $koneksi) or die(mysql_error());
$row_rec_list_mapel = mysql_fetch_assoc($rec_list_mapel);
$totalRows_rec_list_mapel = mysql_num_rows($rec_list_mapel);

$query_rec_list_guru = "SELECT * FROM guru";
$rec_list_guru = mysql_query($query_rec_list_guru, $koneksi) or die(mysql_error());
$row_rec_list_guru = mysql_fetch_assoc($rec_list_guru);
$totalRows_rec_list_guru = mysql_num_rows($rec_list_guru);

$query_rec_list_hari = "SELECT * FROM hari";
$rec_list_hari = mysql_query($query_rec_list_hari, $koneksi) or die(mysql_error());
$row_rec_list_hari = mysql_fetch_assoc($rec_list_hari);
$totalRows_rec_list_hari = mysql_num_rows($rec_list_hari);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-pencil"></span> Edit Absen</h3>
</div>
<form class="well" method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table class="table-form">
    <tr>
      <td>ID</td>
      <td><?php echo $row_rec_edit_jadwal['j_id']; ?></td>
    </tr>
    <tr>
      <td>Tahun</td>
      <td><select class="form-control" name="j_id_thn" id="j_id_thn">
        <?php
do {  
?>
        <option value="<?php echo $row_rec_list_tahun['t_id']?>"<?php if (!(strcmp($row_rec_list_tahun['t_id'], $row_rec_edit_jadwal['j_id_thn']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rec_list_tahun['t_nm']?> - <?php echo $row_rec_list_tahun['t_jn']?></option>
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
      <td><select class="form-control" name="j_kd_kls" id="j_kd_kls">
        <?php
do {  
?>
        <option value="<?php echo $row_rec_list_kls['k_kd']?>"<?php if (!(strcmp($row_rec_list_kls['k_kd'], $row_rec_edit_jadwal['j_kd_kls']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rec_list_kls['k_nm']?></option>
        <?php
} while ($row_rec_list_kls = mysql_fetch_assoc($rec_list_kls));
  $rows = mysql_num_rows($rec_list_kls);
  if($rows > 0) {
      mysql_data_seek($rec_list_kls, 0);
	  $row_rec_list_kls = mysql_fetch_assoc($rec_list_kls);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td>Matapelajaran</td>
      <td><select class="form-control" name="j_kd_mapel" id="j_kd_mapel">
        <?php
do {  
?>
        <option value="<?php echo $row_rec_list_mapel['m_kode']?>"<?php if (!(strcmp($row_rec_list_mapel['m_kode'], $row_rec_edit_jadwal['j_kd_mapel']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rec_list_mapel['m_nama']?></option>
        <?php
} while ($row_rec_list_mapel = mysql_fetch_assoc($rec_list_mapel));
  $rows = mysql_num_rows($rec_list_mapel);
  if($rows > 0) {
      mysql_data_seek($rec_list_mapel, 0);
	  $row_rec_list_mapel = mysql_fetch_assoc($rec_list_mapel);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td>Guru</td>
      <td><select class="form-control" name="j_id_guru" id="j_id_guru">
        <?php
do {  
?>
        <option value="<?php echo $row_rec_list_guru['g_id']?>"<?php if (!(strcmp($row_rec_list_guru['g_id'], $row_rec_edit_jadwal['j_id_guru']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rec_list_guru['u_nama']?></option>
        <?php
} while ($row_rec_list_guru = mysql_fetch_assoc($rec_list_guru));
  $rows = mysql_num_rows($rec_list_guru);
  if($rows > 0) {
      mysql_data_seek($rec_list_guru, 0);
	  $row_rec_list_guru = mysql_fetch_assoc($rec_list_guru);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td>Hari</td>
      <td><select class="form-control" name="j_hari" id="j_hari">
        <?php
do {  
?>
        <option value="<?php echo $row_rec_list_hari['h_id']?>"<?php if (!(strcmp($row_rec_list_hari['h_id'], $row_rec_edit_jadwal['j_hari']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rec_list_hari['h_nama']?></option>
        <?php
} while ($row_rec_list_hari = mysql_fetch_assoc($rec_list_hari));
  $rows = mysql_num_rows($rec_list_hari);
  if($rows > 0) {
      mysql_data_seek($rec_list_hari, 0);
	  $row_rec_list_hari = mysql_fetch_assoc($rec_list_hari);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td>Jam</td>
      <td><input class="form-control" type="text" name="j_jam" value="<?php echo htmlentities($row_rec_edit_jadwal['j_jam'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-info" type="submit" value="Simpan">
      <input class="btn btn-info" type="button" name="button" id="button" value="Kembali" onClick="location='?page=tampil_jadwal'" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="j_id" value="<?php echo $row_rec_edit_jadwal['j_id']; ?>">
</form>