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
  $updateSQL = sprintf("UPDATE nilai SET n_harian=%s, n_tugas=%s, n_uts=%s, n_uas=%s WHERE n_id=%s",
                       GetSQLValueString($_POST['n_harian'], "int"),
                       GetSQLValueString($_POST['n_tugas'], "int"),
                       GetSQLValueString($_POST['n_uts'], "int"),
                       GetSQLValueString($_POST['n_uas'], "int"),
                       GetSQLValueString($_POST['n_id'], "int"));

  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_rec_edit_nilai = "-1";
if (isset($_GET['n_id'])) {
  $colname_rec_edit_nilai = $_GET['n_id'];
}

$query_rec_edit_nilai = sprintf("SELECT * FROM nilai WHERE n_id = %s", GetSQLValueString($colname_rec_edit_nilai, "int"));
$rec_edit_nilai = mysql_query($query_rec_edit_nilai, $koneksi) or die(mysql_error());
$row_rec_edit_nilai = mysql_fetch_assoc($rec_edit_nilai);
$totalRows_rec_edit_nilai = mysql_num_rows($rec_edit_nilai);

$query_rec_tampil_siswa = sprintf("SELECT nilai.n_nis, siswa.s_nis, siswa.u_nama FROM nilai, siswa WHERE nilai.n_nis = siswa.s_nis AND nilai.n_id = %s", GetSQLValueString($colname_rec_edit_nilai, "int"));
$rec_tampil_siswa = mysql_query($query_rec_tampil_siswa, $koneksi) or die(mysql_error());
$row_rec_tampil_siswa = mysql_fetch_assoc($rec_tampil_siswa);
$totalRows_rec_tampil_siswa = mysql_num_rows($rec_tampil_siswa);

$query_rec_tampil_tahun = sprintf("SELECT nilai.n_id_thn, tahun.t_id, tahun.t_nm, tahun.t_jn FROM nilai, tahun WHERE nilai.n_id_thn=tahun.t_id AND nilai.n_id = %s", GetSQLValueString($colname_rec_edit_nilai, "int"));
$rec_tampil_tahun = mysql_query($query_rec_tampil_tahun, $koneksi) or die(mysql_error());
$row_rec_tampil_tahun = mysql_fetch_assoc($rec_tampil_tahun);
$totalRows_rec_tampil_tahun = mysql_num_rows($rec_tampil_tahun);

$query_rec_tampil_jadwal = sprintf("SELECT nilai.n_id_jadwal, jadwal.j_id, jadwal.j_kd_mapel, mapel.m_kode, mapel.m_nama FROM nilai, jadwal, mapel WHERE nilai.n_id_jadwal=jadwal.j_id AND jadwal.j_kd_mapel=mapel.m_kode AND nilai.n_id = %s", GetSQLValueString($colname_rec_edit_nilai, "int"));
$rec_tampil_jadwal = mysql_query($query_rec_tampil_jadwal, $koneksi) or die(mysql_error());
$row_rec_tampil_jadwal = mysql_fetch_assoc($rec_tampil_jadwal);
$totalRows_rec_tampil_jadwal = mysql_num_rows($rec_tampil_jadwal);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-pencil"></span> Edit Nilai Siswa</h3>
</div>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table class="table-form">
    <tr>
      <td>NIS :</td>
      <td><strong><?php echo htmlentities($row_rec_tampil_siswa['s_nis'], ENT_COMPAT, 'utf-8'); ?> - <?php echo htmlentities($row_rec_tampil_siswa['u_nama'], ENT_COMPAT, 'utf-8'); ?></strong></td>
    </tr>
    <tr>
      <td>Tahun :</td>
      <td><strong><?php echo htmlentities($row_rec_tampil_tahun['t_nm'], ENT_COMPAT, 'utf-8'); ?> - <?php echo htmlentities($row_rec_tampil_tahun['t_jn'], ENT_COMPAT, 'utf-8'); ?></strong></td>
    </tr>
    <tr>
      <td>Mata Pelajaran :</td>
      <td><strong><?php echo htmlentities($row_rec_tampil_jadwal['m_nama'], ENT_COMPAT, 'utf-8'); ?></strong></td>
    </tr>
    <tr>
      <td>Nilai Harian :</td>
      <td><input class="form-control" type="text" name="n_harian" value="<?php echo htmlentities($row_rec_edit_nilai['n_harian'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
    </tr>
    <tr>
      <td>Nilai Tugas :</td>
      <td><input class="form-control" type="text" name="n_tugas" value="<?php echo htmlentities($row_rec_edit_nilai['n_tugas'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
    </tr>
    <tr>
      <td>Nilai UTS :</td>
      <td><input class="form-control" type="text" name="n_uts" value="<?php echo htmlentities($row_rec_edit_nilai['n_uts'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
    </tr>
    <tr>
      <td>Nilai UAS :</td>
      <td><input class="form-control" type="text" name="n_uas" value="<?php echo htmlentities($row_rec_edit_nilai['n_uas'], ENT_COMPAT, 'utf-8'); ?>" size="10" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-info" type="submit" value="Simpan Data" />
      <input class="btn btn-info" type="button" name="button" id="button" value="Kembali" onClick="location='index.php?page=tampil_nilai'" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="n_id" value="<?php echo $row_rec_edit_nilai['n_id']; ?>" />
</form>
