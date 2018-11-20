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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO absen (a_id_siswa, a_id_tahun, a_sakit, a_izin, a_alpha) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['a_id_siswa'], "int"),
                       GetSQLValueString($_POST['a_id_tahun'], "int"),
                       GetSQLValueString($_POST['a_sakit'], "int"),
                       GetSQLValueString($_POST['a_izin'], "int"),
                       GetSQLValueString($_POST['a_alpha'], "int"));

  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
}

/*-----------------------------------------------------------------------
 * Bug Fixed @v1.4
 *
 * $_SESSION['kuncitahun'] and $_SESSION['kuncikelas']
 *-----------------------------------------------------------------------
 */
 
if (isset($_GET['kuncitahun'])) {
  $_SESSION['kuncitahun'] = $_GET['kuncitahun'];
  $colname1_rec_list_jadwal = $_SESSION['kuncitahun'];
}
else {
	if (isset($_SESSION['kuncitahun'])) {
	$colname1_rec_list_jadwal = $_SESSION['kuncitahun'];
	}
	else {
	$colname1_rec_list_jadwal = "";
	}	
}

if (isset($_GET['kuncikelas'])) {
  $_SESSION['kuncikelas'] = $_GET['kuncikelas'];
  $colname2_rec_list_siswa = $_SESSION['kuncikelas'];
}
else {
	if (isset($_SESSION['kuncikelas'])) {
	$colname2_rec_list_siswa = $_SESSION['kuncikelas'];
	}
	else {
	$colname2_rec_list_siswa = "";
	}	
}

$query_rec_list_siswa = sprintf("SELECT siswa.s_id, siswa.u_nama, siswa.s_kd_kls, kelas.k_kd FROM siswa, kelas WHERE siswa.s_kd_kls=kelas.k_kd AND siswa.s_kd_kls=%s AND siswa.nonaktif='N'", GetSQLValueString($colname2_rec_list_siswa, "text"));
$rec_list_siswa = mysql_query($query_rec_list_siswa, $koneksi) or die(mysql_error());
$row_rec_list_siswa = mysql_fetch_assoc($rec_list_siswa);
$totalRows_rec_list_siswa = mysql_num_rows($rec_list_siswa);

$query_rec_list_thn = "SELECT * FROM tahun WHERE t_nonaktif='N' ORDER BY t_nm ASC";
$rec_list_thn = mysql_query($query_rec_list_thn, $koneksi) or die(mysql_error());
$row_rec_list_thn = mysql_fetch_assoc($rec_list_thn);
$totalRows_rec_list_thn = mysql_num_rows($rec_list_thn);

$query_rec_list_kls = "SELECT * FROM kelas WHERE k_nonaktif='N' ORDER BY k_kd ASC";
$rec_list_kls = mysql_query($query_rec_list_kls, $koneksi) or die(mysql_error());
$row_rec_list_kls = mysql_fetch_assoc($rec_list_kls);
$totalRows_rec_list_kls = mysql_num_rows($rec_list_kls);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-plus-sign"></span> Tambah Absensi</h3>
</div>
<form class="well" id="form1" name="form1" method="get" action="">
<input type="hidden" name="page" value="tambah_absensi" />
<table class="table-form">
    <tr>
      <td width="146">Tahun Pelajaran</td>
      <td width="196"><select class="form-control" name="kuncitahun" id="kuncitahun">
        <?php
do {  
?>
        <option value="<?php echo $row_rec_list_thn['t_id']?>"<?php if (!(strcmp($row_rec_list_thn['t_id'], $colname1_rec_list_jadwal))) {echo "selected=\"selected\"";} ?>><?php echo $row_rec_list_thn['t_nm']?> - <?php echo $row_rec_list_thn['t_jn']?></option>
<?php
} while ($row_rec_list_thn = mysql_fetch_assoc($rec_list_thn));
  $rows = mysql_num_rows($rec_list_thn);
  if($rows > 0) {
      mysql_data_seek($rec_list_thn, 0);
	  $row_rec_list_thn = mysql_fetch_assoc($rec_list_thn);
  }
?>
      </select>
      </td>
    </tr>
    <tr>
      <td>Kelas</td>
      <td><select class="form-control" name="kuncikelas" id="kuncikelas">
        <?php
do {  
?><option value="<?php echo $row_rec_list_kls['k_kd']?>"<?php if (!(strcmp($row_rec_list_kls['k_kd'], $colname2_rec_list_siswa))) {echo "selected=\"selected\"";} ?>><?php echo $row_rec_list_kls['k_nm']?></option>
        <?php
} while ($row_rec_list_kls = mysql_fetch_assoc($rec_list_kls));
  $rows = mysql_num_rows($rec_list_kls);
  if($rows > 0) {
      mysql_data_seek($rec_list_kls, 0);
	  $row_rec_list_kls = mysql_fetch_assoc($rec_list_kls);
  }
?>
      </select>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-info" type="submit" name="Submit" id="button" value="Cari Data" /></td>
    </tr>
  </table>
</form>


<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
<input type="hidden" name="a_id_tahun" value="<?php echo $_SESSION['kuncitahun']; ?>" />
<table class="table-form">
    <tr>
      <td>Nama Siswa</td>
      <td><label>
        <select class="form-control" name="a_id_siswa" id="a_id_siswa">
          <?php
do {  
?>
          <option value="<?php echo $row_rec_list_siswa['s_id']?>"><?php echo $row_rec_list_siswa['u_nama']?></option>
          <?php
} while ($row_rec_list_siswa = mysql_fetch_assoc($rec_list_siswa));
  $rows = mysql_num_rows($rec_list_siswa);
  if($rows > 0) {
      mysql_data_seek($rec_list_siswa, 0);
	  $row_rec_list_siswa = mysql_fetch_assoc($rec_list_siswa);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td>Sakit</td>
      <td><span id="sprytextfield1">
      <input class="form-control" type="text" name="a_sakit" size="15" value="0" />
      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
    </tr>
    <tr>
      <td>Izin</td>
      <td><span id="sprytextfield2">
      <input class="form-control" type="text" name="a_izin" value="0" size="15" />
      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
    </tr>
    <tr>
      <td>Alpha</td>
      <td><span id="sprytextfield3">
      <input class="form-control" type="text" name="a_alpha" value="0" size="15" />
      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-success" name="Submit" type="submit" value="Simpan" />
      <input class="btn btn-info" type="button" name="button2" id="button2" value="Kembali" onClick="location='index.php?page=tampil_absensi'"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form2" />
</form>
<p>&nbsp;</p>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {minChars:1, maxChars:2, validateOn:["change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {validateOn:["change"], minChars:1, maxChars:2});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {validateOn:["change"], minChars:1, maxChars:2});
//-->
</script>
