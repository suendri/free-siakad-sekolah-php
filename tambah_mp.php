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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO mapel (m_kode, m_nama, m_nonaktif) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['m_kode'], "text"),
                       GetSQLValueString($_POST['m_nama'], "text"),
                       GetSQLValueString($_POST['m_nonaktif'], "text"));

  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
}
?>
<div class="judul">
<h3><span class="glyphicon glyphicon-plus-sign"></span> Tambah Matapelajaran</h3>
</div>

<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table class="table-form">
    <tr>
      <td>Kode :</td>
      <td><span id="sprytextfield1">
              <input class="form-control" type="text" name="m_kode" value="" size="32" placeholder="Kode Matapelajaran"/>
      <span class="textfieldRequiredMsg">Wajib Diisi</span></span></td>
    </tr>
    <tr>
      <td>Mata Pelajaran :</td>
      <td><span id="sprytextfield2">
              <input class="form-control" type="text" name="m_nama" value="" size="40" placeholder="Nama Matapelajaran"/>
      <span class="textfieldRequiredMsg">Wajib Diisi</span></span></td>
    </tr>
    <tr>
      <td>Nonaktif :</td>
      <td><select class="form-control" name="m_nonaktif">
        <option value="Y" <?php if (!(strcmp("Y", ""))) {echo "SELECTED";} ?>>Y</option>
        <option value="N" <?php if (!(strcmp("N", ""))) {echo "SELECTED";} ?> selected="selected">N</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-success" type="submit" value="Simpan Data" />
      <input class="btn btn-info" type="button" name="button" id="button" value="Kembali" onClick="location='index.php?page=tampil_mp'"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>

<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["change"]});
//-->
</script>
