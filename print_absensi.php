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
 
$maxRows_rec_tampil_absensi = 10;
$pageNum_rec_tampil_absensi = 0;
if (isset($_GET['pageNum_rec_tampil_absensi'])) {
  $pageNum_rec_tampil_absensi = $_GET['pageNum_rec_tampil_absensi'];
}
$startRow_rec_tampil_absensi = $pageNum_rec_tampil_absensi * $maxRows_rec_tampil_absensi;


$colname1_rec_tampil_absensi = $_SESSION['kuncitahun'];
$colname2_rec_tampil_absensi = $_SESSION['kuncikelas'];

mysql_select_db($database_koneksi, $koneksi);
if ($_SESSION['Level'] == 'siswa' ) {
$query_rec_tampil_absensi = sprintf("SELECT absen.a_id, absen.a_id_siswa, absen.a_id_tahun, absen.a_sakit, absen.a_izin, absen.a_alpha, siswa.s_id, siswa.s_nis, siswa.u_nama, siswa.s_kd_kls, tahun.t_id, tahun.t_nm, tahun.t_jn, kelas.k_id, kelas.k_nm FROM absen, siswa, tahun, kelas WHERE siswa.nonaktif='N' AND absen.a_id_siswa = siswa.s_id AND absen.a_id_tahun = tahun.t_id AND siswa.s_kd_kls=kelas.k_kd AND siswa.u_nama='".$_SESSION['nama']."' AND absen.a_id_tahun=%s AND siswa.s_kd_kls=%s ORDER BY siswa.u_nama", GetSQLValueString($colname1_rec_tampil_absensi, "text"),GetSQLValueString($colname2_rec_tampil_absensi, "text"));
}
else {
$query_rec_tampil_absensi = sprintf("SELECT absen.a_id, absen.a_id_siswa, absen.a_id_tahun, absen.a_sakit, absen.a_izin, absen.a_alpha, siswa.s_id, siswa.s_nis, siswa.u_nama, siswa.s_kd_kls, tahun.t_id, tahun.t_nm, tahun.t_jn, kelas.k_id, kelas.k_nm FROM absen, siswa, tahun, kelas WHERE siswa.nonaktif='N' AND absen.a_id_siswa = siswa.s_id AND absen.a_id_tahun = tahun.t_id AND siswa.s_kd_kls=kelas.k_kd AND absen.a_id_tahun=%s AND siswa.s_kd_kls=%s ORDER BY siswa.u_nama", GetSQLValueString($colname1_rec_tampil_absensi, "text"),GetSQLValueString($colname2_rec_tampil_absensi, "text"));
}
$query_limit_rec_tampil_absensi = sprintf("%s LIMIT %d, %d", $query_rec_tampil_absensi, $startRow_rec_tampil_absensi, $maxRows_rec_tampil_absensi);
$rec_tampil_absensi = mysql_query($query_limit_rec_tampil_absensi, $koneksi) or die(mysql_error());
$row_rec_tampil_absensi = mysql_fetch_assoc($rec_tampil_absensi);

if (isset($_GET['totalRows_rec_tampil_absensi'])) {
  $totalRows_rec_tampil_absensi = $_GET['totalRows_rec_tampil_absensi'];
} else {
  $all_rec_tampil_absensi = mysql_query($query_rec_tampil_absensi);
  $totalRows_rec_tampil_absensi = mysql_num_rows($all_rec_tampil_absensi);
}
$totalPages_rec_tampil_absensi = ceil($totalRows_rec_tampil_absensi/$maxRows_rec_tampil_absensi)-1;

mysql_select_db($database_koneksi, $koneksi);
$query_rec_list_tahun = "SELECT * FROM tahun WHERE t_nonaktif='N' ORDER BY t_nm ASC";
$rec_list_tahun = mysql_query($query_rec_list_tahun, $koneksi) or die(mysql_error());
$row_rec_list_tahun = mysql_fetch_assoc($rec_list_tahun);
$totalRows_rec_list_tahun = mysql_num_rows($rec_list_tahun);

mysql_select_db($database_koneksi, $koneksi);
$query_rec_list_kelas = "SELECT * FROM kelas WHERE k_nonaktif='N' ORDER BY k_nm ASC";
$rec_list_kelas = mysql_query($query_rec_list_kelas, $koneksi) or die(mysql_error());
$row_rec_list_kelas = mysql_fetch_assoc($rec_list_kelas);
$totalRows_rec_list_kelas = mysql_num_rows($rec_list_kelas);
?>

<hr />
<h2> Laporan Absensi Siswa</h2>
<hr />

<?php if ($totalRows_rec_tampil_absensi > 0) { // Show if recordset not empty ?>
  <table border="0" class="gridtable">
    <tr>
      <th width="17">#</th>
      <th width="164">Tahun</th>
      <th width="179">Kelas</th>
      <th width="164">NIS</th>
      <th width="181">Nama</th>
      <th width="177">Sakit</th>
      <th width="168">Izin</th>
      <th width="181">Alpha</th>
    </tr>
    <?php $no=0; do { $no++;?>
      <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $row_rec_tampil_absensi['t_nm']; ?> - <?php echo $row_rec_tampil_absensi['t_jn']; ?></td>
        <td><?php echo $row_rec_tampil_absensi['k_nm']; ?></td>
        <td><?php echo $row_rec_tampil_absensi['s_nis']; ?></td>
        <td><?php echo $row_rec_tampil_absensi['u_nama']; ?></td>
        <td><?php echo $row_rec_tampil_absensi['a_sakit']; ?></td>
        <td><?php echo $row_rec_tampil_absensi['a_izin']; ?></td>
        <td><?php echo $row_rec_tampil_absensi['a_alpha']; ?></td>
       </tr>
      <?php } while ($row_rec_tampil_absensi = mysql_fetch_assoc($rec_tampil_absensi)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_rec_tampil_absensi == 0) { // Show if recordset empty ?>
    <p>Silakan Cari Tahun Pelajaran dan Kelas.</p>
    <?php } // Show if recordset empty ?>
