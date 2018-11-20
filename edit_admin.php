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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $upass = filter_input(INPUT_POST, 'u_pass', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $setPass = (!empty($upass) ? "u_pass=md5('$upass')," : "");
  $updateSQL = sprintf("UPDATE `admin` SET $setPass u_nama=%s, u_tglLahir=%s, u_jk=%s, u_email=%s, u_level=%s, nonaktif=%s WHERE u_id=%s",
                       GetSQLValueString($_POST['u_nama'], "text"),
                       GetSQLValueString($_POST['u_tglLahir'], "text"),
                       GetSQLValueString($_POST['u_jk'], "text"),
                       GetSQLValueString($_POST['u_email'], "text"),
                       GetSQLValueString($_POST['u_level'], "text"),
                       GetSQLValueString($_POST['nonaktif'], "text"),
                       GetSQLValueString($_POST['u_id'], "int"));

  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());
}

$colname_rec_edit_admin = "-1";
if (isset($_GET['u_id'])) {
  $colname_rec_edit_admin = $_GET['u_id'];
}

$query_rec_edit_admin = sprintf("SELECT * FROM `admin` WHERE u_id = %s", GetSQLValueString($colname_rec_edit_admin, "int"));
$rec_edit_admin = mysql_query($query_rec_edit_admin, $koneksi) or die(mysql_error());
$row_rec_edit_admin = mysql_fetch_assoc($rec_edit_admin);
$totalRows_rec_edit_admin = mysql_num_rows($rec_edit_admin);
?>
<div class="judul">
<h3><span class="glyphicon glyphicon-pencil"></span> Edit Admin</h3>
</div>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table class="table">
    <tr>
      <td>Username</td>
      <td><?php echo htmlentities($row_rec_edit_admin['u_uname'], ENT_COMPAT, 'utf-8'); ?></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><input class="form-control" name="u_pass" type="password" size="32" maxlength="15" placeholder="Password"/>
          <label class="title-abu">Biarkan kosong jika tidak merobah password</label></td>
    </tr>
    <tr>
      <td>Nama Lengkap</td>
      <td><input class="form-control" type="text" name="u_nama" value="<?php echo htmlentities($row_rec_edit_admin['u_nama'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="Nama Lengkap"/></td>
    </tr>
    <tr>
      <td>Tanggl Lahir</td>
      <td><input class="form-control" type="text" name="u_tglLahir" value="<?php echo htmlentities($row_rec_edit_admin['u_tglLahir'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="Tanggal Lahir"/></td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td>
          <select class="form-control" name="u_jk">
        <option value="Laki-Laki" <?php if (!(strcmp("Laki-Laki", htmlentities($row_rec_edit_admin['u_jk'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>>Laki-Laki</option>
        <option value="Perempuan" <?php if (!(strcmp("Perempuan", htmlentities($row_rec_edit_admin['u_jk'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>>Perempuan</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>Email</td>
      <td><input class="form-control" type="text" name="u_email" value="<?php echo htmlentities($row_rec_edit_admin['u_email'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="Email"/></td>
    </tr>
    <tr>
      <td>Level</td>
      <td>
          <select class="form-control" name="u_level">
        <option value="1" <?php if (!(strcmp("1", htmlentities($row_rec_edit_admin['u_level'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>>Superuser</option>
        <option value="2" <?php if (!(strcmp("2", htmlentities($row_rec_edit_admin['u_level'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>>Manager</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>Nonaktif</td>
      <td><select class="form-control" name="nonaktif">
        <option value="Y" <?php if (!(strcmp("Y", htmlentities($row_rec_edit_admin['nonaktif'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>>Y</option>
        <option value="N" <?php if (!(strcmp("N", htmlentities($row_rec_edit_admin['nonaktif'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>>N</option>
      </select>
      </td>
    </tr>
    <tr> </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-info" name="Submit" type="submit" value="Simpan Data" />
      <input class="btn btn-info" type="button" name="button" id="button" value="Kembali" onClick="location='index.php?page=tampil_admin'"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="u_id" value="<?php echo $row_rec_edit_admin['u_id']; ?>" />
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["change"]});
//-->
</script>
