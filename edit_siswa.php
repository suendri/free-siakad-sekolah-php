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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE siswa SET s_nis=%s, u_nama=%s, s_tmp_lahir=%s, s_tgl_lhr=%s, s_jk=%s, s_nm_ortu=%s, s_pek_ortu=%s, s_alamat=%s, s_agama=%s, s_gdarah=%s, s_thn_masuk=%s, s_kd_kls=%s, nonaktif=%s WHERE s_id=%s",
                       GetSQLValueString($_POST['s_nis'], "text"),
                       GetSQLValueString($_POST['u_nama'], "text"),
                       GetSQLValueString($_POST['s_tmp_lahir'], "text"),
                       GetSQLValueString($_POST['s_tgl_lhr'], "date"),
                       GetSQLValueString($_POST['s_jk'], "text"),
                       GetSQLValueString($_POST['s_nm_ortu'], "text"),
                       GetSQLValueString($_POST['s_pek_ortu'], "text"),
                       GetSQLValueString($_POST['s_alamat'], "text"),
                       GetSQLValueString($_POST['s_agama'], "text"),
                       GetSQLValueString($_POST['s_gdarah'], "text"),
                       GetSQLValueString($_POST['s_thn_masuk'], "int"),
                       GetSQLValueString($_POST['s_kd_kls'], "text"),
                       GetSQLValueString($_POST['nonaktif'], "text"),
                       GetSQLValueString($_POST['s_id'], "int"));

  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_rec_edit_siswa = "-1";
if (isset($_GET['s_id'])) {
  $colname_rec_edit_siswa = $_GET['s_id'];
}

$query_rec_edit_siswa = sprintf("SELECT * FROM siswa WHERE s_id = %s", GetSQLValueString($colname_rec_edit_siswa, "int"));
$rec_edit_siswa = mysql_query($query_rec_edit_siswa, $koneksi) or die(mysql_error());
$row_rec_edit_siswa = mysql_fetch_assoc($rec_edit_siswa);
$totalRows_rec_edit_siswa = mysql_num_rows($rec_edit_siswa);

$query_rec_list_kelas = "SELECT * FROM kelas WHERE k_nonaktif='N' ORDER BY k_nm ASC";
$rec_list_kelas = mysql_query($query_rec_list_kelas, $koneksi) or die(mysql_error());
$row_rec_list_kelas = mysql_fetch_assoc($rec_list_kelas);
$totalRows_rec_list_kelas = mysql_num_rows($rec_list_kelas);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-pencil"></span> Edit Siswa</h3>
</div>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table class="table-form">
    <tr>
      <td>NIS</td>
      <td><span id="sprytextfield1">
              <input class="form-control" type="text" name="s_nis" value="<?php echo htmlentities($row_rec_edit_siswa['s_nis'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="NIS"/>
      <span class="textfieldRequiredMsg">Wajib Diisi</span></span></td>
    </tr>
    <tr>
      <td>Nama</td>
      <td><span id="sprytextfield2">
              <input class="form-control" type="text" name="u_nama" value="<?php echo htmlentities($row_rec_edit_siswa['u_nama'], ENT_COMPAT, 'utf-8'); ?>" size="50" placeholder="Nama Lengkap"/>
      <span class="textfieldRequiredMsg">Wajib Diisi</span></span></td>
    </tr>
    <tr>
      <td>Tempat Lahir</td>
      <td><input class="form-control" type="text" name="s_tmp_lahir" value="<?php echo htmlentities($row_rec_edit_siswa['s_tmp_lahir'], ENT_COMPAT, 'utf-8'); ?>" size="50" placeholder="Tempat Lahir"/></td>
    </tr>
    <tr>
      <td>Tanggal Lahir</td>
      <td><span id="sprytextfield3">
              <input class="form-control" type="text" name="s_tgl_lhr" value="<?php echo htmlentities($row_rec_edit_siswa['s_tgl_lhr'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="Tanggal Lahir"/>
      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td><select class="form-control" name="s_jk" id="s_jk">
        <option value="Laki-laki" <?php if (!(strcmp("Laki-laki", $row_rec_edit_siswa['s_jk']))) {echo "selected=\"selected\"";} ?>>Laki-laki</option>
        <option value="Perempuan" <?php if (!(strcmp("Perempuan", $row_rec_edit_siswa['s_jk']))) {echo "selected=\"selected\"";} ?>>Perempuan</option>
      </select></td>
    </tr>
    <tr>
      <td>Nama Orang Tua</td>
      <td><input class="form-control" type="text" name="s_nm_ortu" value="<?php echo htmlentities($row_rec_edit_siswa['s_nm_ortu'], ENT_COMPAT, 'utf-8'); ?>" size="50" placeholder="Nama Orang Tua"/></td>
    </tr>
    <tr>
      <td>Pekerjaan</td>
      <td><input class="form-control" type="text" name="s_pek_ortu" value="<?php echo htmlentities($row_rec_edit_siswa['s_pek_ortu'], ENT_COMPAT, 'utf-8'); ?>" size="50" placeholder="Pekerjaa Orang Tua"/></td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td><input class="form-control" type="text" name="s_alamat" value="<?php echo htmlentities($row_rec_edit_siswa['s_alamat'], ENT_COMPAT, 'utf-8'); ?>" size="50" placeholder="Alamat"/></td>
    </tr>
    <tr>
      <td>Agama</td>
      <td><select class="form-control" name="s_agama" id="s_agama">
        <option value="Islam" <?php if (!(strcmp("Islam", $row_rec_edit_siswa['s_agama']))) {echo "selected=\"selected\"";} ?>>Islam</option>
        <option value="Kristen" <?php if (!(strcmp("Kristen", $row_rec_edit_siswa['s_agama']))) {echo "selected=\"selected\"";} ?>>Kristen</option>
        <option value="Hindu" <?php if (!(strcmp("Hindu", $row_rec_edit_siswa['s_agama']))) {echo "selected=\"selected\"";} ?>>Hindu</option>
        <option value="Budha" <?php if (!(strcmp("Budha", $row_rec_edit_siswa['s_agama']))) {echo "selected=\"selected\"";} ?>>Budha</option>
        <option value="Konghucu" <?php if (!(strcmp("Konghucu", $row_rec_edit_siswa['s_agama']))) {echo "selected=\"selected\"";} ?>>Konghucu</option>
      </select></td>
    </tr>
    <tr>
      <td>Gol Darah</td>
      <td><input class="form-control" type="text" name="s_gdarah" value="<?php echo htmlentities($row_rec_edit_siswa['s_gdarah'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
    </tr>
    <tr>
      <td>Tahun Masuk</td>
      <td><span id="sprytextfield4">
              <input class="form-control" type="text" name="s_thn_masuk" value="<?php echo htmlentities($row_rec_edit_siswa['s_thn_masuk'], ENT_COMPAT, 'utf-8'); ?>" size="10" placeholder="Tahun Masuk"/>
      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
    </tr>
    <tr>
      <td>Kelas</td>
      <td><select class="form-control" name="s_kd_kls" id="s_kd_kls">
        <?php
do {  
?>
        <option value="<?php echo $row_rec_list_kelas['k_kd']?>"<?php if (!(strcmp($row_rec_list_kelas['k_kd'], $row_rec_edit_siswa['s_kd_kls']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rec_list_kelas['k_nm']?></option>
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
      <td>Nonaktif</td>
      <td><select class="form-control" name="nonaktif" id="nonaktif">
        <option value="Y" <?php if (!(strcmp("Y", $row_rec_edit_siswa['nonaktif']))) {echo "selected=\"selected\"";} ?>>Y</option>
        <option value="N" <?php if (!(strcmp("N", $row_rec_edit_siswa['nonaktif']))) {echo "selected=\"selected\"";} ?>>N</option>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-success" name="Submit" type="submit" value="Simpan Data" />
      <input class="btn btn-info" type="button" name="Button" id="button" value="Kembali" onClick="location='index.php?page=tampil_siswa'"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="s_id" value="<?php echo $row_rec_edit_siswa['s_id']; ?>" />
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "date", {format:"yyyy-mm-dd", validateOn:["change"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "integer", {validateOn:["change"], minChars:4, maxChars:4});
//-->
</script>
