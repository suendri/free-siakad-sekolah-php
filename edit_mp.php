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
  $updateSQL = sprintf("UPDATE mapel SET m_kode=%s, m_nama=%s, m_nonaktif=%s WHERE m_id=%s",
                       GetSQLValueString($_POST['m_kode'], "text"),
                       GetSQLValueString($_POST['m_nama'], "text"),
                       GetSQLValueString($_POST['m_nonaktif'], "text"),
                       GetSQLValueString($_POST['m_id'], "int"));

  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_rec_edit_mp = "-1";
if (isset($_GET['m_id'])) {
  $colname_rec_edit_mp = $_GET['m_id'];
}

$query_rec_edit_mp = sprintf("SELECT * FROM mapel WHERE m_id = %s", GetSQLValueString($colname_rec_edit_mp, "int"));
$rec_edit_mp = mysql_query($query_rec_edit_mp, $koneksi) or die(mysql_error());
$row_rec_edit_mp = mysql_fetch_assoc($rec_edit_mp);
$totalRows_rec_edit_mp = mysql_num_rows($rec_edit_mp);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-pencil"></span> Edit Mata Pelajaran</h3>
</div>

<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table class="table-form">
    <tr>
      <td>Kode</td>
      <td><span id="sprytextfield1">
              <input class="form-control" type="text" name="m_kode" value="<?php echo htmlentities($row_rec_edit_mp['m_kode'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="Kode Matapelajaran"/>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>Mata Pelajaran</td>
      <td><span id="sprytextfield2">
              <input class="form-control" type="text" name="m_nama" value="<?php echo htmlentities($row_rec_edit_mp['m_nama'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="Nama Matapelajaran"/>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>Nonaktif</td>
      <td><select class="form-control" name="m_nonaktif">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rec_edit_mp['m_nonaktif'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Y</option>
        <option value="N" <?php if (!(strcmp("N", htmlentities($row_rec_edit_mp['m_nonaktif'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>N</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-success" type="submit" value="Simpan Data" />
      <input class="btn btn-info" type="button" name="button" id="button" value="Kembali"  onClick="location='index.php?page=tampil_mp'"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="m_id" value="<?php echo $row_rec_edit_mp['m_id']; ?>" />
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["change"]});
//-->
</script>
