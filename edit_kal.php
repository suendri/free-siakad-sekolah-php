<?php 
/* 
 * Sistem Informasi Sekolah
 * Ditambahkan pada versi 3.0
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
  $updateSQL = sprintf("UPDATE kalender SET k_mulai=%s, k_selesai=%s, k_ket=%s WHERE k_id=%s",
                       GetSQLValueString($_POST['k_mulai'], "date"),
                       GetSQLValueString($_POST['k_selesai'], "date"),
                       GetSQLValueString($_POST['k_ket'], "text"),
                       GetSQLValueString($_POST['k_id'], "int"));

  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_rec_edit_kal = "-1";
if (isset($_GET['k_id'])) {
  $colname_rec_edit_kal = $_GET['k_id'];
}

$query_rec_edit_kal = sprintf("SELECT * FROM kalender WHERE k_id = %s", GetSQLValueString($colname_rec_edit_kal, "int"));
$rec_edit_kal = mysql_query($query_rec_edit_kal, $koneksi) or die(mysql_error());
$row_rec_edit_kal = mysql_fetch_assoc($rec_edit_kal);
$totalRows_rec_edit_kal = mysql_num_rows($rec_edit_kal);

$query_rec_list_tahun = "SELECT * FROM tahun";
$rec_list_tahun = mysql_query($query_rec_list_tahun, $koneksi) or die(mysql_error());
$row_rec_list_tahun = mysql_fetch_assoc($rec_list_tahun);
$totalRows_rec_list_tahun = mysql_num_rows($rec_list_tahun);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-pencil"></span> Edit Kalender</h3>
</div>
<form class="well" method="post" name="form1" action="<?php echo $editFormAction; ?>">
    <table class="table-form">
    <tr>
      <td>Tahun Pelajaran</td>
      <td><select class="form-control" name="k_t_id" id="k_t_id">
        <?php
do {  
?>
        <option value="<?php echo $row_rec_list_tahun['t_id']?>"<?php if (!(strcmp($row_rec_list_tahun['t_id'], $row_rec_edit_kal['k_t_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rec_list_tahun['t_nm']?> - <?php echo $row_rec_list_tahun['t_jn']?></option>
        <?php
} while ($row_rec_list_tahun = mysql_fetch_assoc($rec_list_tahun));
  $rows = mysql_num_rows($rec_list_tahun);
  if($rows > 0) {
      mysql_data_seek($rec_list_tahun, 0);
	  $row_rec_list_tahun = mysql_fetch_assoc($rec_list_tahun);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td>Mulai</td>
      <td><input class="form-control" type="text" name="k_mulai" value="<?php echo htmlentities($row_rec_edit_kal['k_mulai'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="Tanggal Mulai"></td>
    </tr>
    <tr>
      <td>Selesai</td>
      <td><input class="form-control" type="text" name="k_selesai" value="<?php echo htmlentities($row_rec_edit_kal['k_selesai'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="Tanggal Selesai"></td>
    </tr>
    <tr>
      <td>Keterangan</td>
      <td><textarea class="form-control" name="k_ket" cols="32"><?php echo htmlentities($row_rec_edit_kal['k_ket'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-success" type="submit" value="Simpan">
      <input class="btn btn-info" type="button" name="button" id="button" value="Kembali" onClick="location='?page=tampil_kal'"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="k_id" value="<?php echo $row_rec_edit_kal['k_id']; ?>">
</form>
