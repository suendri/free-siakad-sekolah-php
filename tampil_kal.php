<?php 

/* 
 * Sistem Informasi Sekolah
 * - Kalender Pendidikan
 * 
 * Ditambahkan pada Versi 2.1
 * 
 * Program ini adalah program Donasi http://phpbego.wordpress.com
 * Anda hanya saya minta sedikit donasi untuk program ini, tidak lebih.
 * Jika anda menghargai program saya, silakan anda hubungi saya
 * 
 * SMS : 085263616901 
 * Email : phpbego@yahoo.co.id, phpbego@gmail.com
 *
*/

mysql_select_db($database_koneksi, $koneksi);
$query_rec_tampil_kal = "SELECT kalender.k_id, kalender.k_t_id, kalender.k_mulai, kalender.k_selesai, kalender.k_ket, tahun.t_id, tahun.t_nm, tahun.t_jn FROM kalender, tahun WHERE kalender.k_t_id=tahun.t_id";
$rec_tampil_kal = mysql_query($query_rec_tampil_kal, $koneksi) or die(mysql_error());
$row_rec_tampil_kal = mysql_fetch_assoc($rec_tampil_kal);
$totalRows_rec_tampil_kal = mysql_num_rows($rec_tampil_kal);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-calendar"></span> Kalender Pendidikan</h3>
</div>
<p><a class="btn btn-success" href="index.php?page=tambah_kal">Tambah Kalender</a></p>
<table class="table table-bordered">
    <thead>
  <tr>
    <th>No</th>
    <th>Tahun Pelajaran</th>
    <th>Mulai</th>
    <th>Selesai</th>
    <th>Keterangan</th>
    <th>Edit</th>
    <th>Hapus</th>
  </tr>
    </thead>
    <tbody>
  <?php $no=0; do { $no++;?>
    <tr>
        <td><?php echo $no; ?></td>
      <td><?php echo $row_rec_tampil_kal['t_nm']; ?> - <?php echo $row_rec_tampil_kal['t_jn']; ?></td>
      <td><?php echo $row_rec_tampil_kal['k_mulai']; ?></td>
      <td><?php echo $row_rec_tampil_kal['k_selesai']; ?></td>
      <td><?php echo $row_rec_tampil_kal['k_ket']; ?></td>
      <td><a href="?page=edit_kal&k_id=<?php echo $row_rec_tampil_kal['k_id']; ?>"><span class="glyphicon glyphicon-cog"></span></a></td>
      <td><a href="?page=hapus_konfirm&f=kalender&id=<?php echo $row_rec_tampil_kal['k_id']; ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
    </tr>
    <?php } while ($row_rec_tampil_kal = mysql_fetch_assoc($rec_tampil_kal)); ?>
    </tbody>
</table>