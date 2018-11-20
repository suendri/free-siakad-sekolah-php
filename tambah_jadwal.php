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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO jadwal (j_id_thn, j_kd_kls, j_kd_mapel, j_id_guru, j_hari, j_jam) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['j_id_thn'], "int"),
                       GetSQLValueString($_POST['j_kd_kls'], "text"),
                       GetSQLValueString($_POST['j_kd_mapel'], "text"),
					   GetSQLValueString($_POST['j_id_guru'], "text"),
                       GetSQLValueString($_POST['j_hari'], "text"),
                       GetSQLValueString($_POST['j_jam'], "text"));

  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
}

$query_rec_list_tahun = "SELECT * FROM tahun WHERE t_nonaktif='N' ORDER BY t_nm ASC";
$rec_list_tahun = mysql_query($query_rec_list_tahun, $koneksi) or die(mysql_error());
$row_rec_list_tahun = mysql_fetch_assoc($rec_list_tahun);
$totalRows_rec_list_tahun = mysql_num_rows($rec_list_tahun);

$query_rec_list_kelas = "SELECT * FROM kelas WHERE k_nonaktif='N' ORDER BY k_nm ASC";
$rec_list_kelas = mysql_query($query_rec_list_kelas, $koneksi) or die(mysql_error());
$row_rec_list_kelas = mysql_fetch_assoc($rec_list_kelas);
$totalRows_rec_list_kelas = mysql_num_rows($rec_list_kelas);

$query_rec_list_mp = "SELECT * FROM mapel WHERE m_nonaktif='N' ORDER BY m_nama ASC";
$rec_list_mp = mysql_query($query_rec_list_mp, $koneksi) or die(mysql_error());
$row_rec_list_mp = mysql_fetch_assoc($rec_list_mp);
$totalRows_rec_list_mp = mysql_num_rows($rec_list_mp);

$query_rec_list_hari = "SELECT * FROM hari ORDER BY h_id ASC";
$rec_list_hari = mysql_query($query_rec_list_hari, $koneksi) or die(mysql_error());
$row_rec_list_hari = mysql_fetch_assoc($rec_list_hari);
$totalRows_rec_list_hari = mysql_num_rows($rec_list_hari);

$query_rec_list_guru = "SELECT g_id, g_nip, u_nama, nonaktif FROM guru WHERE nonaktif = 'N' ORDER BY u_nama ASC";
$rec_list_guru = mysql_query($query_rec_list_guru, $koneksi) or die(mysql_error());
$row_rec_list_guru = mysql_fetch_assoc($rec_list_guru);
$totalRows_rec_list_guru = mysql_num_rows($rec_list_guru);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-plus-sign"></span> Tambah Jadwal</h3>
</div>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table cellpadding="2">
    <tr>
      <td>Tahun</td>
      <td><select class="form-control" name="j_id_thn" id="j_id_thn">
        <?php
do {  
?>
        <option value="<?php echo $row_rec_list_tahun['t_id']?>"><?php echo $row_rec_list_tahun['t_nm']?> - <?php echo $row_rec_list_tahun['t_jn']?></option>
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
?><option value="<?php echo $row_rec_list_kelas['k_kd']?>"><?php echo $row_rec_list_kelas['k_nm']?></option>
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
      <td>Mata Pelajaran</td>
      <td><label>
        <select class="form-control" name="j_kd_mapel" id="j_kd_mapel">
          <?php
do {  
?>
          <option value="<?php echo $row_rec_list_mp['m_kode']?>"><?php echo $row_rec_list_mp['m_nama']?></option>
          <?php
} while ($row_rec_list_mp = mysql_fetch_assoc($rec_list_mp));
  $rows = mysql_num_rows($rec_list_mp);
  if($rows > 0) {
      mysql_data_seek($rec_list_mp, 0);
	  $row_rec_list_mp = mysql_fetch_assoc($rec_list_mp);
  }
?>
        </select>
      </label></td>
    </tr>
        <tr>
      <td>Guru</td>
      <td><label>
        <select class="form-control" name="j_id_guru" id="j_id_guru">
          <?php
do {  
?>
          <option value="<?php echo $row_rec_list_guru['g_id']?>"><?php echo $row_rec_list_guru['u_nama']?></option>
          <?php
} while ($row_rec_list_guru = mysql_fetch_assoc($rec_list_guru));
  $rows = mysql_num_rows($rec_list_guru);
  if($rows > 0) {
      mysql_data_seek($rec_list_guru, 0);
	  $row_rec_list_guru = mysql_fetch_assoc($rec_list_guru);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td>Hari</td>
      <td><select class="form-control" name="j_hari" id="j_hari">
        <?php
do {  
?>
        <option value="<?php echo $row_rec_list_hari['h_id']?>"><?php echo $row_rec_list_hari['h_nama']?></option>
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
      <td><input class="form-control" type="text" name="j_jam" value="" size="32" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-success" type="submit" value="Simpan Jadwal" />
      <input class="btn btn-info" type="button" name="button" id="button" value="Kembali" onClick="location='index.php?page=tampil_jadwal'"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
