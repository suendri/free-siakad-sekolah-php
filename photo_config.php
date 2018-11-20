<?php

/*
 * @Package Sistem Informasi Sekolah
 * Ditambahkan pada v3.0
 * 
 * Program ini adalah program Donasi http://phpbego.wordpress.com
 * Anda hanya saya minta sedikit donasi untuk program ini, tidak lebih.
 * Jika anda menghargai program saya, silakan anda hubungi saya
 * 
 * SMS : 085263616901 
 * Email : phpbego@yahoo.co.id, phpbego@gmail.com
 *
 * http://phpbego.wordpress.com
 *
 */

function resizeImage($CurWidth,$CurHeight,$MaxWidth,$MaxHeight,$DestFolder,$SrcImage)
{
	$ImageScale      	= min($MaxWidth/$CurWidth, $MaxHeight/$CurHeight);
	$NewWidth  		= ceil($ImageScale*$CurWidth);
	$NewHeight 		= ceil($ImageScale*$CurHeight);
	$NewCanves 		= imagecreatetruecolor($NewWidth, $NewHeight);
	// Resize Image
	if(imagecopyresampled($NewCanves, $SrcImage,0, 0, 0, 0, $NewWidth, $NewHeight, $CurWidth, $CurHeight))
	{
		// copy file
		if(imagejpeg($NewCanves,$DestFolder,100))
		{
			imagedestroy($NewCanves);
			return true;
		}
	}
}

?>
