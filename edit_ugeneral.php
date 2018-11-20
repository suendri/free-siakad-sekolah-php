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

$level = $_SESSION['Level'];
$uname = filter_input(INPUT_GET, 'uname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
   $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $upass = filter_input(INPUT_POST, 'upass', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $uemail = filter_input(INPUT_POST, 'uemail', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   
   $setPass = (!empty($upass) ? "u_pass=md5('$upass')," : "");
   
   $SQLUpdate = mysql_query("UPDATE $level SET $setPass u_nama='$nama', u_email='$uemail' WHERE u_uname='$uname'" ) or die(mysql_error());
}

if (isset($uname)) {
    $SQL = mysql_query("SELECT * FROM $level WHERE u_uname='$uname' LIMIT 1");
    $detailAccount = mysql_fetch_assoc($SQL);
}


?>
<div class="judul">
<h3><span class="glyphicon glyphicon-pencil"></span> Edit General Profil</h3>
</div>

<form method="POST" action="<?php $editFormAction; ?>">
<input type="hidden" name="MM_update" value="form1" />
<table class="table">
    <tr>
        <td style="width: 200px;">Username</td> 
        <td><?php echo $_SESSION['MM_Username']; ?></td> 
    </tr>
    <tr>
        <td>Nama Lengkap</td> 
        <td><span id="sprytextfield1">
                <input type="text" class="form-control" name="nama" value="<?php echo $detailAccount['u_nama']; ?>" placeholder="Nama lengkap">
            <span class="textfieldRequiredMsg">Wajib Diisi.</span></span></td> 
    </tr>
    <tr>
        <td>Password</td> 
        <td><input type="password" class="form-control" name="upass" placeholder="Password">
            <label class="title-abu">Biarkan kosong jika tidak merobah password</label></td> 
    </tr>
    <tr>
        <td>Email</td> 
        <td><input type="text" class="form-control" name="uemail" value="<?php echo $detailAccount['u_email']; ?>" placeholder="Email"></td> 
    </tr>
    <tr>
        <td>Level</td> 
        <td><?php echo $_SESSION['Level']; ?></td> 
    </tr>
     <tr>
         <td>&nbsp;</td> 
         <td><input type="submit" class="btn btn-success" name="Simpan" value="Simpan">
             <input type="button" class="btn btn-info" value="Kembali" onclick="location='?page=tampil_ugeneral'"</td> 
    </tr>
</table>
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["change"]});
//-->
</script>