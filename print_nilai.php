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
 

if (isset($_GET['kuncitahun'])) {
  $_SESSION['kuncitahun'] = $_GET['kuncitahun'];
  $colname1_rec_tampil_nilai = $_SESSION['kuncitahun'];
}
else {
$colname1_rec_tampil_nilai = $_SESSION['kuncitahun'];
}

if (isset($_GET['kuncikelas'])) {
  $_SESSION['kuncikelas'] = $_GET['kuncikelas'];
  $colname2_rec_tampil_nilai = $_SESSION['kuncikelas'];
}
else {
$colname2_rec_tampil_nilai= $_SESSION['kuncikelas'];
}

if (isset($_GET['kuncisiswa'])) {
  $_SESSION['kuncisiswa'] = $_GET['kuncisiswa'];
  $colname3_rec_tampil_nilai = $_SESSION['kuncisiswa'];
}
else {
$colname3_rec_tampil_nilai = $_SESSION['kuncisiswa'];
}

$maxRows_rec_tampil_nilai = 10;
$pageNum_rec_tampil_nilai = 0;
if (isset($_GET['pageNum_rec_tampil_nilai'])) {
  $pageNum_rec_tampil_nilai = $_GET['pageNum_rec_tampil_nilai'];
}
$startRow_rec_tampil_nilai = $pageNum_rec_tampil_nilai * $maxRows_rec_tampil_nilai;

mysql_select_db($database_koneksi, $koneksi);
$query_rec_tampil_nilai = sprintf("SELECT nilai.n_id, nilai.n_nis, nilai.n_id_jadwal, nilai.n_harian, nilai.n_tugas, nilai.n_uts, nilai.n_uas, jadwal.j_id, jadwal.j_id_thn, jadwal.j_kd_kls, jadwal.j_kd_mapel, jadwal.j_id_guru, mapel.m_kode, mapel.m_nama, kelas.k_kd, kelas.k_nm, siswa.s_nis, siswa.u_nama as s_nama, tahun.t_id, tahun.t_nm, tahun.t_jn, guru.g_id, guru.u_nama as g_nama FROM nilai, jadwal, mapel, kelas, siswa, tahun, guru WHERE nilai.n_nis=siswa.s_nis AND nilai.n_id_jadwal=jadwal.j_id AND nilai.n_id_thn=tahun.t_id AND jadwal.j_kd_kls=kelas.k_kd AND jadwal.j_kd_mapel=mapel.m_kode AND jadwal.j_id_guru=guru.g_id AND nilai.n_id_thn=%s AND jadwal.j_kd_kls=%s AND nilai.n_nis=%s", 
	GetSQLValueString($colname1_rec_tampil_nilai, "text"),
	GetSQLValueString($colname2_rec_tampil_nilai, "text"),
	GetSQLValueString($colname3_rec_tampil_nilai, "text"));
$query_limit_rec_tampil_nilai = sprintf("%s LIMIT %d, %d", $query_rec_tampil_nilai, $startRow_rec_tampil_nilai, $maxRows_rec_tampil_nilai);
$rec_tampil_nilai = mysql_query($query_limit_rec_tampil_nilai, $koneksi) or die(mysql_error());
$row_rec_tampil_nilai = mysql_fetch_assoc($rec_tampil_nilai);

if (isset($_GET['totalRows_rec_tampil_nilai'])) {
  $totalRows_rec_tampil_nilai = $_GET['totalRows_rec_tampil_nilai'];
} else {
  $all_rec_tampil_nilai = mysql_query($query_rec_tampil_nilai);
  $totalRows_rec_tampil_nilai = mysql_num_rows($all_rec_tampil_nilai);
}
$totalPages_rec_tampil_nilai = ceil($totalRows_rec_tampil_nilai/$maxRows_rec_tampil_nilai)-1;

mysql_select_db($database_koneksi, $koneksi);
$query_rec_list_tahun = "SELECT * FROM tahun WHERE t_nonaktif='N'";
$rec_list_tahun = mysql_query($query_rec_list_tahun, $koneksi) or die(mysql_error());
$row_rec_list_tahun = mysql_fetch_assoc($rec_list_tahun);
$totalRows_rec_list_tahun = mysql_num_rows($rec_list_tahun);

mysql_select_db($database_koneksi, $koneksi);
$query_rec_list_kelas = "SELECT * FROM kelas WHERE k_nonaktif='N'";
$rec_list_kelas = mysql_query($query_rec_list_kelas, $koneksi) or die(mysql_error());
$row_rec_list_kelas = mysql_fetch_assoc($rec_list_kelas);
$totalRows_rec_list_kelas = mysql_num_rows($rec_list_kelas);

if ($_SESSION['Level'] == 'siswa' ) {
mysql_select_db($database_koneksi, $koneksi);
$query_rec_list_siswa = "SELECT * FROM siswa WHERE nonaktif='N' AND s_kd_kls='".$_SESSION['kuncikelas']."' AND u_nama='".$_SESSION['nama']."'";
$rec_list_siswa = mysql_query($query_rec_list_siswa, $koneksi) or die(mysql_error());
$row_rec_list_siswa = mysql_fetch_assoc($rec_list_siswa);
$totalRows_rec_list_siswa = mysql_num_rows($rec_list_siswa);
} 
else {
mysql_select_db($database_koneksi, $koneksi);
$query_rec_list_siswa = "SELECT * FROM siswa WHERE nonaktif='N' AND s_kd_kls='".$_SESSION['kuncikelas']."' ORDER BY u_nama";
$rec_list_siswa = mysql_query($query_rec_list_siswa, $koneksi) or die(mysql_error());
$row_rec_list_siswa = mysql_fetch_assoc($rec_list_siswa);
$totalRows_rec_list_siswa = mysql_num_rows($rec_list_siswa);
}
?>

<hr />
<h2> Laporan Nilai Siswa</h2>
<hr />
<table width="100%" border="0" class="gridtable">
  <tr>
    <th width="20">#</th>
    <th>Tahun</th>
    <th>Kelas</th>
    <th>NIS</th>
    <th>Nama Siswa</th>
	<th>Kode</th>
    <th>Mata Pelajaran</th>
    <th>Guru</th>
    <th>Nilai Harian</th>
    <th>Nilai Tugas</th>
    <th>Nilai UTS</th>
    <th>Nilai UAS</th>
  </tr>
  <?php do { ?>
    <tr>
      <th><?php echo $row_rec_tampil_nilai['n_id']; ?></th>
      <td><?php echo $row_rec_tampil_nilai['t_nm']; ?> - <?php echo $row_rec_tampil_nilai['t_jn']; ?></td>
      <td><?php echo $row_rec_tampil_nilai['k_nm']; ?></td>
      <td><?php echo $row_rec_tampil_nilai['s_nis']; ?></td>
      <td><?php echo $row_rec_tampil_nilai['s_nama']; ?></td>
      <td><?php echo $row_rec_tampil_nilai['m_kode']; ?></td>
      <td><?php echo $row_rec_tampil_nilai['m_nama']; ?></td>
      <td><?php echo $row_rec_tampil_nilai['g_nama']; ?></td>
      <td><?php echo $row_rec_tampil_nilai['n_harian']; ?></td>
      <td><?php echo $row_rec_tampil_nilai['n_tugas']; ?></td>
      <td><?php echo $row_rec_tampil_nilai['n_uts']; ?></td>
      <td><?php echo $row_rec_tampil_nilai['n_uas']; ?></td>
    </tr>
    <?php } while ($row_rec_tampil_nilai = mysql_fetch_assoc($rec_tampil_nilai)); ?>
</table>
