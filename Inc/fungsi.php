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

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

// ** Fungsi Tanggal Indonesia
function tanggal_format_indonesia($tgl){
	$tanggal  =  substr($tgl,8,2);
	$bulan	=  getBulan(substr($tgl,5,2));
	$tahun	=  substr($tgl,0,4);
return  $tanggal.' '.$bulan.' '.$tahun;
}

function getBulan($bln){
	switch ($bln)
	{
		case  1:
		return  "Januari";
		break;
		case  2:
		return  "Februari";
		break;
		case  3:
		return  "Maret";
		break;
		case  4:
		return  "Maret";
		break;
		case  5:
		return  "Mei";
		break;
		case  6:
		return  "Juni";
		break;
		case  7:
		return  "Juli";
		break;
		case  8:
		return  "Agustus";
		break;
		case  9:
		return  "September";
		break;
		case  10:
		return  "Oktober";
		break;
		case  11:
		return  "November";
		break;
		case  12:
		return  "Desember";
		break;
	}
}
