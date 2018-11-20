<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="judul">
    <h3><span class="glyphicon glyphicon-list-alt"></span> Profil Setting</h3>
</div>
<form class="well" action="photo_proses.php" method="post" enctype="multipart/form-data" id="UploadForm">
    <div class="form-group">
        <label>Pilih Gambar :</label> 
        <input name="ImageFile" type="file" id="input_file"/>
    </div>
    <input type="submit" class="btn btn-info" name="Upload" value="Upload">
</form>
<div class="bs-callout bs-callout-info">
    <ul>
        <li>Gambar yang diizinkan hanya type .jpg dan .png</li>
        <li>Ukuran Maksimal 2 MB</li>
        <li>Direkomendasikan Tinggi 160px dan Lebar 160px.</li>
        <li>Maksimal Upload 10 Photo, silakan hapus di menu Gallery jika telah mencapai jumlah maksimal.</li>
    </ul>    
</div>
