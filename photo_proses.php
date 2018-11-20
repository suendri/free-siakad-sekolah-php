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
require ("Inc/config.php");
require ("Inc/fungsi.php");
require ("photo_config.php");

$p_uid = $_SESSION['MM_Username'];

// Hitung jumlah Photo yang sedang Login
$SQLphotoMax = mysql_query("SELECT * FROM photo WHERE p_uname='$p_uid'") or die (mysql_error());
$CountMax = mysql_num_rows($SQLphotoMax);

if (isset($_POST['Upload'])) {
    //Settings
    $x35MaxWidth = 35; //35x35 width
    $x35MaxHeight = 35; //35x35 Height
    $x100MaxWidth = 160; //100x100 Image width to
    $x100MaxHeight = 160; //100x100 Image height to

    $x35Prefix = "35x35_" . $p_uid . "_"; //x35 Prefix
    $x100Prefix = "100x100_" . $p_uid . "_"; //x100 Prefix

    $OriginalPrefix = $p_uid . "_"; // Prefix for original image
    $x35DestinationDirectory = 'Photo/35/'; //Upload Directory
    $x100DestinationDirectory = 'Photo/100/'; //Upload Directory
    $DestinationDirectory = 'Photo/'; //Upload Directory
    $jpg_quality = 90;


    $RandomNumber = rand(0, 9999999999); // We need same random name for both files.
    $MaxSize = "1000000"; // Ukuran Maksimum Gambar 2MB.
    //Information about image that we need later.
    $ImageName = strtolower($_FILES['ImageFile']['name']);
    $ImageSize = $_FILES['ImageFile']['size'];
    $TempSrc = $_FILES['ImageFile']['tmp_name'];
    $ImageType = $_FILES['ImageFile']['type'];
    $process = true;

    //Validate file + create image from uploaded file.
    switch (strtolower($ImageType)) {
        case 'image/png':
            $CreatedImage = imagecreatefrompng($_FILES['ImageFile']['tmp_name']);
            break;
        case 'image/jpeg':
            $CreatedImage = imagecreatefromjpeg($_FILES['ImageFile']['tmp_name']);
            break;
        default:
            die('Type Gambar Tidak Diizinkan!'); //output error
    }
    
    // check if file upload went ok
    if (!isset($_FILES['ImageFile']) || !is_uploaded_file($_FILES['ImageFile']['tmp_name'])) {
        die('Something went wrong with Upload'); //output error
    }
    elseif ($ImageSize > $MaxSize)
    { 
        die('Ukuran Gambar Terlalu Besar');     
    }
    elseif ($CountMax >= 10) {
        die('Jumlah photo yang diizinkan Maksimal 10, silakan hapus sebagian photo anda.');
    }
    else {

        //get Image Size
        list($CurWidth, $CurHeight) = getimagesize($TempSrc);

        //get file extension, this will be added after random name
        $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
        $ImageExt = str_replace('.', '', $ImageExt);

        //Set the Destination Image path with Random Name
        $x35_DestRandImageName = $x35DestinationDirectory . $x35Prefix . $RandomNumber . '.' . $ImageExt; //x35 name
        $x100_DestRandImageName = $x100DestinationDirectory . $x100Prefix . $RandomNumber . '.' . $ImageExt; //x100 name
        $original_DestRandImageName = $DestinationDirectory . $OriginalPrefix . $RandomNumber . '.' . $ImageExt; //Name for Original Image
        //Resize image to our Specified Size by calling our resizeImage function.
        //Create thumnail for the Image
        resizeImage($CurWidth, $CurHeight, $x35MaxWidth, $x35MaxHeight, $x35_DestRandImageName, $CreatedImage);
        resizeImage($CurWidth, $CurHeight, $x100MaxWidth, $x100MaxHeight, $x100_DestRandImageName, $CreatedImage);
        resizeImage($CurWidth, $CurHeight, $CurWidth, $CurWidth, $original_DestRandImageName, $CreatedImage);

        // Insert info into table 
        mysql_query("INSERT INTO photo (p_uname,p_image_small,p_image_middle,p_image_default) 
		VALUES ('$p_uid',
				'$x35Prefix$RandomNumber.$ImageExt',
				'$x100Prefix$RandomNumber.$ImageExt',
				'$OriginalPrefix$RandomNumber.$ImageExt')") or die(mysql_error());
    }
    header('location:index.php?page=tampil_uprofil');
}
?>
