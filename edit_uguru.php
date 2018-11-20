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
  $updateSQL = sprintf("UPDATE guru SET u_pass=md5(%s), nonaktif=%s WHERE g_id=%s",
                       GetSQLValueString($_POST['u_pass'], "text"),
                       GetSQLValueString($_POST['nonaktif'], "text"),
                       GetSQLValueString($_POST['g_id'], "int"));

  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_rec_edit_uguru = "-1";
if (isset($_GET['g_id'])) {
  $colname_rec_edit_uguru = $_GET['g_id'];
}

$query_rec_edit_uguru = sprintf("SELECT g_id, g_nip, u_pass, u_nama, nonaktif FROM guru WHERE g_id = %s", GetSQLValueString($colname_rec_edit_uguru, "int"));
$rec_edit_uguru = mysql_query($query_rec_edit_uguru, $koneksi) or die(mysql_error());
$row_rec_edit_uguru = mysql_fetch_assoc($rec_edit_uguru);
$totalRows_rec_edit_uguru = mysql_num_rows($rec_edit_uguru);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-pencil"></span> Edit User Guru</h3>
</div>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table class="table-form">
    <tr>
      <td>NIP</td>
      <td><strong><?php echo htmlentities($row_rec_edit_uguru['g_nip'], ENT_COMPAT, 'utf-8'); ?> - <?php echo htmlentities($row_rec_edit_uguru['u_nama'], ENT_COMPAT, 'utf-8'); ?></strong></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><span id="sprytextfield1">
              <input class="form-control" name="u_pass" type="password" size="32" maxlength="15" placeholder="Password"/>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>Nonaktif</td>
      <td><select class="form-control" name="nonaktif">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rec_edit_uguru['nonaktif'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Y</option>
        <option value="N" <?php if (!(strcmp("N", htmlentities($row_rec_edit_uguru['nonaktif'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>N</option>
      </select>      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-info" name="Submit" type="submit" value="Simpan Data" />
      <input class="btn btn-info" type="button" name="Button" id="button" value="Kembali" onClick="location='index.php?page=tampil_uguru'" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="g_id" value="<?php echo $row_rec_edit_uguru['g_id']; ?>" />
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["change"]});
//-->
</script>
