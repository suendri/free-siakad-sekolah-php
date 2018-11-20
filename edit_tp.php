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
  $updateSQL = sprintf("UPDATE tahun SET t_nm=%s, t_jn=%s, t_nonaktif=%s WHERE t_id=%s",
                       GetSQLValueString($_POST['t_nm'], "text"),
                       GetSQLValueString($_POST['t_jn'], "text"),
                       GetSQLValueString($_POST['t_nonaktif'], "text"),
                       GetSQLValueString($_POST['t_id'], "int"));

  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_rec_edit_tp = "-1";
if (isset($_GET['t_id'])) {
  $colname_rec_edit_tp = $_GET['t_id'];
}

$query_rec_edit_tp = sprintf("SELECT * FROM tahun WHERE t_id = %s", GetSQLValueString($colname_rec_edit_tp, "int"));
$rec_edit_tp = mysql_query($query_rec_edit_tp, $koneksi) or die(mysql_error());
$row_rec_edit_tp = mysql_fetch_assoc($rec_edit_tp);
$totalRows_rec_edit_tp = mysql_num_rows($rec_edit_tp);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-pencil"></span> Edit Tahun Pelajaran</h3>
</div>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table class="table-form">
    <tr>
      <td>Tahun Pelajaran</td>
      <td><span id="sprytextfield1">
              <input class="form-control" type="text" name="t_nm" value="<?php echo htmlentities($row_rec_edit_tp['t_nm'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="Tahun Pelajaran"/>
      <span class="textfieldRequiredMsg">Wajib Diisi.</span></span></td>
    </tr>
    <tr>
      <td>Semester</td>
      <td><select class="form-control" name="t_jn" id="t_jn">
        <option value="Genap" <?php if (!(strcmp("Genap", $row_rec_edit_tp['t_jn']))) {echo "selected=\"selected\"";} ?>>Genap</option><option value="Ganjil" <?php if (!(strcmp("Ganjil", $row_rec_edit_tp['t_jn']))) {echo "selected=\"selected\"";} ?>>Ganjil</option>
      </select></td>
    </tr>
    <tr>
      <td>Nonaktif:</td>
      <td><select class="form-control" name="t_nonaktif" id="t_nonaktif">
        <option value="Y" <?php if (!(strcmp("Y", $row_rec_edit_tp['t_nonaktif']))) {echo "selected=\"selected\"";} ?>>Y</option>
        <option value="N" <?php if (!(strcmp("N", $row_rec_edit_tp['t_nonaktif']))) {echo "selected=\"selected\"";} ?>>N</option>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-success" type="submit" value="Simpan" />
      <input class="btn btn-info" type="button" name="button" id="button" value="Kembali" onClick="location='index.php?page=tampil_tp'"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="t_id" value="<?php echo $row_rec_edit_tp['t_id']; ?>" />
</form>
<p>&nbsp;</p>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["change"]});
//-->
</script>
