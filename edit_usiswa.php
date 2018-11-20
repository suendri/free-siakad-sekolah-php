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
  $updateSQL = sprintf("UPDATE siswa SET u_pass=md5(%s), nonaktif=%s WHERE s_id=%s",
                       GetSQLValueString($_POST['u_pass'], "text"),
                       GetSQLValueString($_POST['nonaktif'], "text"),
                       GetSQLValueString($_POST['s_id'], "int"));

  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_rec_edit_usiswa = "-1";
if (isset($_GET['s_id'])) {
  $colname_rec_edit_usiswa = $_GET['s_id'];
}

$query_rec_edit_usiswa = sprintf("SELECT s_id, s_nis, u_pass, u_nama, nonaktif FROM siswa WHERE s_id = %s", GetSQLValueString($colname_rec_edit_usiswa, "int"));
$rec_edit_usiswa = mysql_query($query_rec_edit_usiswa, $koneksi) or die(mysql_error());
$row_rec_edit_usiswa = mysql_fetch_assoc($rec_edit_usiswa);
$totalRows_rec_edit_usiswa = mysql_num_rows($rec_edit_usiswa);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-pencil"></span> Edit User Siswa</h3>
</div>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table class="table-form">
    <tr>
      <td>NIS :</td>
      <td><strong><?php echo htmlentities($row_rec_edit_usiswa['s_nis'], ENT_COMPAT, 'utf-8'); ?> - <?php echo htmlentities($row_rec_edit_usiswa['u_nama'], ENT_COMPAT, 'utf-8'); ?></strong></td>
    </tr>
    <tr>
      <td>Password :</td>
      <td><span id="sprytextfield1">
              <input class="form-control" name="u_pass" type="password" size="32" maxlength="15" placeholder="Password"/>
      <span class="textfieldRequiredMsg">Wajib Diisi.</span></span></td>
    </tr>
    <tr>
      <td>Nonaktif :</td>
      <td><select class="form-control" name="nonaktif">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rec_edit_usiswa['nonaktif'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Y</option>
        <option value="N" <?php if (!(strcmp("N", htmlentities($row_rec_edit_usiswa['nonaktif'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>N</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="Submit" type="submit" class="btn btn-info" value="Simpan Data" />
      <input class="btn btn-info" type="button" name="Button" id="button" value="Kembali" onClick="location='index.php?page=tampil_usiswa'" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="s_id" value="<?php echo $row_rec_edit_usiswa['s_id']; ?>" />
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["change"]});
//-->
</script>
