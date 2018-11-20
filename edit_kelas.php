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
  $updateSQL = sprintf("UPDATE kelas SET k_kd=%s, k_nm=%s, k_wali=%s, k_nonaktif=%s WHERE k_id=%s",
                       GetSQLValueString($_POST['k_kd'], "text"),
                       GetSQLValueString($_POST['k_nm'], "text"),
                       GetSQLValueString($_POST['k_wali'], "text"),
                       GetSQLValueString($_POST['k_nonaktif'], "text"),
                       GetSQLValueString($_POST['k_id'], "int"));

  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_rec_edit_kelas = "-1";
if (isset($_GET['k_id'])) {
  $colname_rec_edit_kelas = $_GET['k_id'];
}

$query_rec_edit_kelas = sprintf("SELECT * FROM kelas WHERE k_id = %s", GetSQLValueString($colname_rec_edit_kelas, "int"));
$rec_edit_kelas = mysql_query($query_rec_edit_kelas, $koneksi) or die(mysql_error());
$row_rec_edit_kelas = mysql_fetch_assoc($rec_edit_kelas);
$totalRows_rec_edit_kelas = mysql_num_rows($rec_edit_kelas);

$query_rec_list_wali = "SELECT * FROM guru ORDER BY u_nama ASC";
$rec_list_wali = mysql_query($query_rec_list_wali, $koneksi) or die(mysql_error());
$row_rec_list_wali = mysql_fetch_assoc($rec_list_wali);
$totalRows_rec_list_wali = mysql_num_rows($rec_list_wali);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-pencil"></span> Edit Kelas</h3>
</div>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table class="table-form">
    <tr>
      <td>Kode</td>
      <td><span id="sprytextfield1">
              <input class="form-control" type="text" name="k_kd" value="<?php echo htmlentities($row_rec_edit_kelas['k_kd'], ENT_COMPAT, 'utf-8'); ?>" size="20" placeholder="Kode Kelas"/>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>Nama Kelas</td>
      <td><span id="sprytextfield2">
              <input class="form-control" type="text" name="k_nm" value="<?php echo htmlentities($row_rec_edit_kelas['k_nm'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="Nama Kelas"/>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>Nama Wali</td>
      <td><select class="form-control" name="k_wali" id="k_wali">
        <?php
do {  
?>
        <option value="<?php echo $row_rec_list_wali['u_nama']?>"<?php if (!(strcmp($row_rec_list_wali['u_nama'], $row_rec_edit_kelas['k_wali']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rec_list_wali['u_nama']?></option>
        <?php
} while ($row_rec_list_wali = mysql_fetch_assoc($rec_list_wali));
  $rows = mysql_num_rows($rec_list_wali);
  if($rows > 0) {
      mysql_data_seek($rec_list_wali, 0);
	  $row_rec_list_wali = mysql_fetch_assoc($rec_list_wali);
  }
?>
      </select>
</td>
    </tr>
    <tr>
      <td>Nonaktif</td>
      <td><select class="form-control" name="k_nonaktif">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rec_edit_kelas['k_nonaktif'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Y</option>
        <option value="N" <?php if (!(strcmp("N", htmlentities($row_rec_edit_kelas['k_nonaktif'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>N</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-success" type="submit" value="Simpan Data" />
      <input class="btn btn-info" type="button" name="button" id="button" value="Kembali" onClick="location='index.php?page=tampil_kelas'"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="k_id" value="<?php echo $row_rec_edit_kelas['k_id']; ?>" />
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["change"]});
//-->
</script>

