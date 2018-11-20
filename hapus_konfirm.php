<?php
/* 
 * Sistem Informasi Sekolah
 * Ditambahkan pada v2.0
 * 
 * Program ini adalah program Donasi http://phpbego.wordpress.com
 * Anda hanya saya minta sedikit donasi untuk program ini, tidak lebih.
 * Jika anda menghargai program saya, silakan anda hubungi saya
 * 
 * SMS : 085263616901 
 * Email : phpbego@yahoo.co.id, phpbego@gmail.com
 *
*/

/*
 * File ini digunakan untuk konfirmasi penghapusan data
 * Anda dapat menggunakannya dari file manapun
 * 
 * Kami belum memikirkan tentang keamanan cara ini
 * Namun efektif dan dengan kode yang lebih sederhana
 */

$f = mysql_real_escape_string($_GET['f']);
$id = mysql_real_escape_string($_GET['id']);

function alert_proses($f, $id, $kembali)
{
  echo "<form method='POST' action='hapus_proses.php'>
      <input type='hidden' name='f' value='".$f."'>
      <input type='hidden' name='id' value='".$id."'>
    <div class='bs-callout bs-callout-info'>
    <h4>Apakah anda ingin menghapus data ini?</h4>
    <p><input class='btn btn-danger' type='submit' value='Lanjutkan'> <a class='btn btn-success' href=".$kembali.">Batal</a></p>
    </div></form>";        
}

switch ($f)
{
    case "jadwal":
        alert_proses($f, $id, '?page=tampil_jadwal'); 
        break;
    case "absensi":
        alert_proses($f, $id, '?page=tampil_jadwal'); 
        break;
    case "kalender":
        alert_proses($f, $id, '?page=tampil_kal'); 
        break;
    default :
        echo "<h3>Proses tidak diketahui</h3>";
        break;
}
