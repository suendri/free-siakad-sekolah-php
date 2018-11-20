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

$maxRows_rec_tambah_admin = 10;
$pageNum_rec_tambah_admin = 0;
if (isset($_GET['pageNum_rec_tambah_admin'])) {
  $pageNum_rec_tambah_admin = $_GET['pageNum_rec_tambah_admin'];
}
$startRow_rec_tambah_admin = $pageNum_rec_tambah_admin * $maxRows_rec_tambah_admin;

mysql_select_db($database_koneksi, $koneksi);
$query_rec_tambah_admin = "SELECT * FROM `admin`";
$query_limit_rec_tambah_admin = sprintf("%s LIMIT %d, %d", $query_rec_tambah_admin, $startRow_rec_tambah_admin, $maxRows_rec_tambah_admin);
$rec_tambah_admin = mysql_query($query_limit_rec_tambah_admin, $koneksi) or die(mysql_error());
$row_rec_tambah_admin = mysql_fetch_assoc($rec_tambah_admin);

if (isset($_GET['totalRows_rec_tambah_admin'])) {
  $totalRows_rec_tambah_admin = $_GET['totalRows_rec_tambah_admin'];
} else {
  $all_rec_tambah_admin = mysql_query($query_rec_tambah_admin);
  $totalRows_rec_tambah_admin = mysql_num_rows($all_rec_tambah_admin);
}
$totalPages_rec_tambah_admin = ceil($totalRows_rec_tambah_admin/$maxRows_rec_tambah_admin)-1;
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-list-alt"></span> Daftar Admin</h3>
</div>
<p><a class="btn btn-success" href="index.php?page=tambah_admin"> Tambah Admin</a></p>
<table class="table table-bordered">
  <tr>
    <th>#</th>
    <th>Username</th>
    <th>Nama Lengkap</th>
    <th>Tanggal Lahir</th>
    <th>Jenis Kelamin</th>
    <th>Email</th>
    <th>Level</th>
    <th>Nonaktif</th>
    <th>Aksi</th>
  </tr>
  <?php $no=0; do { $no++; ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $row_rec_tambah_admin['u_uname']; ?></td>
      <td><?php echo $row_rec_tambah_admin['u_nama']; ?></td>
      <td><?php echo tanggal_format_indonesia($row_rec_tambah_admin['u_tglLahir']); ?></td>
      <td><?php echo $row_rec_tambah_admin['u_jk']; ?></td>
      <td><?php echo $row_rec_tambah_admin['u_email']; ?></td>
      <td>
          <?php 
          if ($row_rec_tambah_admin['u_level'] == 1){
          echo "Superuser"; 
          }
          else { echo "Manager"; }
          ?>
      </td>
      <td><img src="Asset/images/<?php echo $row_rec_tambah_admin['nonaktif']; ?>.gif" border="0" /></td>
      <td><a href="index.php?page=edit_admin&amp;u_id=<?php echo $row_rec_tambah_admin['u_id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
    </tr>
    <?php } while ($row_rec_tambah_admin = mysql_fetch_assoc($rec_tambah_admin)); ?>
</table>
