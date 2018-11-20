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
  $updateSQL = sprintf("UPDATE guru SET g_nip=%s, u_nama=%s, g_tmp_lhr=%s, g_tgl_lhr=%s, g_jk=%s, g_alamat=%s, g_agama=%s, g_status=%s, nonaktif=%s WHERE g_id=%s",
                       GetSQLValueString($_POST['g_nip'], "text"),
                       GetSQLValueString($_POST['u_nama'], "text"),
                       GetSQLValueString($_POST['g_tmp_lhr'], "text"),
                       GetSQLValueString($_POST['g_tgl_lhr'], "date"),
                       GetSQLValueString($_POST['g_jk'], "text"),
                       GetSQLValueString($_POST['g_alamat'], "text"),
                       GetSQLValueString($_POST['g_agama'], "text"),
                       GetSQLValueString($_POST['g_status'], "text"),
                       GetSQLValueString($_POST['nonaktif'], "text"),
                       GetSQLValueString($_POST['g_id'], "int"));

  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_rec_edit_guru = "-1";
if (isset($_GET['g_id'])) {
  $colname_rec_edit_guru = $_GET['g_id'];
}

$query_rec_edit_guru = sprintf("SELECT * FROM guru WHERE g_id = %s", GetSQLValueString($colname_rec_edit_guru, "int"));
$rec_edit_guru = mysql_query($query_rec_edit_guru, $koneksi) or die(mysql_error());
$row_rec_edit_guru = mysql_fetch_assoc($rec_edit_guru);
$totalRows_rec_edit_guru = mysql_num_rows($rec_edit_guru);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-pencil"></span> Edit Guru</h3>
</div>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table class="table-form">
    <tr>
      <td>NIP</td>
      <td><span id="sprytextfield1">
              <input class="form-control" type="text" name="g_nip" value="<?php echo htmlentities($row_rec_edit_guru['g_nip'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="NIP"/>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>Nama</td>
      <td><span id="sprytextfield2">
              <input class="form-control" type="text" name="u_nama" value="<?php echo htmlentities($row_rec_edit_guru['u_nama'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="Nama"/>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>Tempat Lahir</td>
      <td><input class="form-control" type="text" name="g_tmp_lhr" value="<?php echo htmlentities($row_rec_edit_guru['g_tmp_lhr'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="Tempat Lahir"/></td>
    </tr>
    <tr>
      <td>Tanggal Lahir</td>
      <td><span id="sprytextfield3">
              <input class="form-control" type="text" name="g_tgl_lhr" value="<?php echo htmlentities($row_rec_edit_guru['g_tgl_lhr'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="Tanggal Lahir"/>
      &nbsp;<em>(yyyy-mm-dd)</em> <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td><select class="form-control" name="g_jk" id="g_jk">
        <option value="Laki-laki" <?php if (!(strcmp("Laki-laki", $row_rec_edit_guru['g_jk']))) {echo "selected=\"selected\"";} ?>>Laki-laki</option>
        <option value="Perempuan" <?php if (!(strcmp("Perempuan", $row_rec_edit_guru['g_jk']))) {echo "selected=\"selected\"";} ?>>Perempuan</option>
      </select></td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td><input class="form-control" type="text" name="g_alamat" value="<?php echo htmlentities($row_rec_edit_guru['g_alamat'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="Alamat"/></td>
    </tr>
    <tr>
      <td>Agama</td>
      <td><select class="form-control" name="g_agama" id="g_agama">
        <option value="Islam" selected="selected" <?php if (!(strcmp("Islam", $row_rec_edit_guru['g_agama']))) {echo "selected=\"selected\"";} ?>>Islam</option>
        <option value="Kristen" <?php if (!(strcmp("Kristen", $row_rec_edit_guru['g_agama']))) {echo "selected=\"selected\"";} ?>>Kristen</option>
        <option value="Hindu" <?php if (!(strcmp("Hindu", $row_rec_edit_guru['g_agama']))) {echo "selected=\"selected\"";} ?>>Hindu</option>
        <option value="Budha" <?php if (!(strcmp("Budha", $row_rec_edit_guru['g_agama']))) {echo "selected=\"selected\"";} ?>>Budha</option>
        <option value="Konghucu" <?php if (!(strcmp("Konghucu", $row_rec_edit_guru['g_agama']))) {echo "selected=\"selected\"";} ?>>Konghucu</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>Status</td>
      <td><input class="form-control" type="text" name="g_status" value="<?php echo htmlentities($row_rec_edit_guru['g_status'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="Status"/></td>
    </tr>
    <tr>
      <td>Nonaktif</td>
      <td><select class="form-control" name="nonaktif" id="nonaktif">
        <option value="Y" <?php if (!(strcmp("Y", $row_rec_edit_guru['nonaktif']))) {echo "selected=\"selected\"";} ?>>Y</option>
        <option value="N" <?php if (!(strcmp("N", $row_rec_edit_guru['nonaktif']))) {echo "selected=\"selected\"";} ?>>N</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-success" type="submit" value="Simpan Data" />
      <input class="btn btn-info" type="button" name="button" id="button" value="Kembali"  onClick="location='index.php?page=tampil_guru'" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="g_id" value="<?php echo $row_rec_edit_guru['g_id']; ?>" />
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "date", {format:"yyyy-mm-dd", validateOn:["change"]});
//-->
</script>

