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
  $updateSQL = sprintf("UPDATE absen SET a_sakit=%s, a_izin=%s, a_alpha=%s WHERE a_id=%s",
                       GetSQLValueString($_POST['a_sakit'], "int"),
                       GetSQLValueString($_POST['a_izin'], "int"),
                       GetSQLValueString($_POST['a_alpha'], "int"),
                       GetSQLValueString($_POST['a_id'], "int"));

  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_rec_edit_absen = "-1";
if (isset($_GET['a_id'])) {
  $colname_rec_edit_absen = $_GET['a_id'];
}

$query_rec_edit_absen = sprintf("SELECT absen.a_id, absen.a_id_siswa, absen.a_id_tahun, absen.a_sakit, absen.a_izin, absen.a_alpha, siswa.s_id, siswa.u_nama FROM absen, siswa WHERE absen.a_id_siswa=siswa.s_id AND absen.a_id=%s", GetSQLValueString($colname_rec_edit_absen, "int"));
$rec_edit_absen = mysql_query($query_rec_edit_absen, $koneksi) or die(mysql_error());
$row_rec_edit_absen = mysql_fetch_assoc($rec_edit_absen);
$totalRows_rec_edit_absen = mysql_num_rows($rec_edit_absen);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-pencil"></span> Edit Absen</h3>
</div>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table class="table-form">
    <tr>
      <td>Sakit</td>
      <td><input class="form-control" type="text" name="a_sakit" value="<?php echo htmlentities($row_rec_edit_absen['a_sakit'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
    </tr>
    <tr>
      <td>Izin</td>
      <td><input class="form-control" type="text" name="a_izin" value="<?php echo htmlentities($row_rec_edit_absen['a_izin'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
    </tr>
    <tr>
      <td>Alpha</td>
      <td><input class="form-control" type="text" name="a_alpha" value="<?php echo htmlentities($row_rec_edit_absen['a_alpha'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-success" type="submit" value="Simpan Data" />
      <input class="btn btn-info" type="button" name="button" id="button" value="Kembali" onClick="location='index.php?page=tampil_absensi'" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="a_id" value="<?php echo $row_rec_edit_absen['a_id']; ?>" />
</form>
