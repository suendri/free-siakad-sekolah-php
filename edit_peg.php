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
  $updateSQL = sprintf("UPDATE pegawai SET p_nip=%s, p_nama=%s, p_tmp_lhr=%s, p_tgl_lhr=%s, p_jk=%s, p_alamat=%s, p_agama=%s, p_status=%s, nonaktif=%s WHERE p_id=%s",
                       GetSQLValueString($_POST['p_nip'], "text"),
                       GetSQLValueString($_POST['p_nama'], "text"),
                       GetSQLValueString($_POST['p_tmp_lhr'], "text"),
                       GetSQLValueString($_POST['p_tgl_lhr'], "date"),
                       GetSQLValueString($_POST['p_jk'], "text"),
                       GetSQLValueString($_POST['p_alamat'], "text"),
                       GetSQLValueString($_POST['p_agama'], "text"),
                       GetSQLValueString($_POST['p_status'], "text"),
                       GetSQLValueString($_POST['nonaktif'], "text"),
                       GetSQLValueString($_POST['p_id'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_rec_edit_peg = "-1";
if (isset($_GET['p_id'])) {
  $colname_rec_edit_peg = $_GET['p_id'];
}
mysql_select_db($database_koneksi, $koneksi);
$query_rec_edit_peg = sprintf("SELECT * FROM pegawai WHERE p_id = %s", GetSQLValueString($colname_rec_edit_peg, "int"));
$rec_edit_peg = mysql_query($query_rec_edit_peg, $koneksi) or die(mysql_error());
$row_rec_edit_peg = mysql_fetch_assoc($rec_edit_peg);
$totalRows_rec_edit_peg = mysql_num_rows($rec_edit_peg);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-pencil"></span> Edit Pegawai</h3>
</div>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table class="table-form">
    <tr>
      <td>NIP</td>
      <td><span id="sprytextfield1">
              <input class="form-control" type="text" name="p_nip" value="<?php echo htmlentities($row_rec_edit_peg['p_nip'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>Nama</td>
      <td><span id="sprytextfield2">
        <input class="form-control" type="text" name="p_nama" value="<?php echo htmlentities($row_rec_edit_peg['p_nama'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>Tempat Lhr</td>
      <td><input class="form-control" type="text" name="p_tmp_lhr" value="<?php echo htmlentities($row_rec_edit_peg['p_tmp_lhr'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr>
      <td>Tgl Lhr</td>
      <td><input class="form-control" type="text" name="p_tgl_lhr" value="<?php echo htmlentities($row_rec_edit_peg['p_tgl_lhr'], ENT_COMPAT, 'utf-8'); ?>" size="32" />&nbsp;<em> (yyyy-mm-dd)</em></td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td><select class="form-control" name="p_jk" id="p_jk">
        <option value="Laki-laki" <?php if (!(strcmp("Laki-laki", $row_rec_edit_peg['p_jk']))) {echo "selected=\"selected\"";} ?>>Laki-laki</option>
        <option value="Perempuan" <?php if (!(strcmp("Perempuan", $row_rec_edit_peg['p_jk']))) {echo "selected=\"selected\"";} ?>>Perempuan</option>
      </select>
</td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td><input class="form-control" type="text" name="p_alamat" value="<?php echo htmlentities($row_rec_edit_peg['p_alamat'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr>
      <td>Agama</td>
      <td><select class="form-control" name="p_agama" id="p_agama">
        <option value="Islam" <?php if (!(strcmp("Islam", $row_rec_edit_peg['p_agama']))) {echo "selected=\"selected\"";} ?>>Islam</option>
        <option value="Kristen" <?php if (!(strcmp("Kristen", $row_rec_edit_peg['p_agama']))) {echo "selected=\"selected\"";} ?>>Kristen</option>
        <option value="Hindu" <?php if (!(strcmp("Hindu", $row_rec_edit_peg['p_agama']))) {echo "selected=\"selected\"";} ?>>Hindu</option>
        <option value="Budha" <?php if (!(strcmp("Budha", $row_rec_edit_peg['p_agama']))) {echo "selected=\"selected\"";} ?>>Budha</option>
        <option value="Konghucu" <?php if (!(strcmp("Konghucu", $row_rec_edit_peg['p_agama']))) {echo "selected=\"selected\"";} ?>>Konghucu</option>
      </select>
</td>
    </tr>
    <tr>
      <td>Status</td>
      <td><input class="form-control" type="text" name="p_status" value="<?php echo htmlentities($row_rec_edit_peg['p_status'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr>
      <td>Nonaktif</td>
      <td><select class="form-control" name="nonaktif" id="nonaktif">
        <option value="Y" <?php if (!(strcmp("Y", $row_rec_edit_peg['nonaktif']))) {echo "selected=\"selected\"";} ?>>Y</option>
        <option value="N" <?php if (!(strcmp("N", $row_rec_edit_peg['nonaktif']))) {echo "selected=\"selected\"";} ?>>N</option>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-info" name="Submit" type="submit" value="Simpan Data" />
      <input class="btn btn-info" type="button" name="button" id="button" value="Kembali" onClick="location='index.php?page=tampil_peg'" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="p_id" value="<?php echo $row_rec_edit_peg['p_id']; ?>" />
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["change"]});
//-->
</script>
