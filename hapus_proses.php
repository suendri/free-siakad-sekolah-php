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
 * File ini digunakan untuk menghapus data
 * Anda bisa gunakan dari table manapun.
 * 
 * data sumber dari hapus_konfirm.php
 * 
 */

require ("Inc/config.php");
require ("Inc/fungsi.php");

if ((isset($_POST['f'])) && ($_POST['f'] == "jadwal") && (isset($_POST['id']))) {
  $deleteSQL = sprintf("DELETE FROM jadwal WHERE j_id=%s",
                       GetSQLValueString($_POST['id'], "int"));

  $Result1 = mysql_query($deleteSQL, $koneksi) or die(mysql_error());
  header('location: index.php?page=tampil_jadwal');
}

if ((isset($_POST['f'])) && ($_POST['f'] == "absensi") && (isset($_POST['id']))) {
  $deleteSQL = sprintf("DELETE FROM absen WHERE a_id=%s",
                       GetSQLValueString($_POST['id'], "int"));

  $Result1 = mysql_query($deleteSQL, $koneksi) or die(mysql_error());
  header('location: index.php?page=tampil_absensi');
}

if ((isset($_POST['f'])) && ($_POST['f'] == "kalender") && (isset($_POST['id']))) {
  $deleteSQL = sprintf("DELETE FROM kalender WHERE k_id=%s",
                       GetSQLValueString($_POST['id'], "int"));

  $Result1 = mysql_query($deleteSQL, $koneksi) or die(mysql_error());
  header('location: index.php?page=tampil_kal');
}