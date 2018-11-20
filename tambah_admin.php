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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO `admin` (u_uname, u_pass, u_nama, u_tglLahir, u_jk, u_email, nonaktif) VALUES (%s, md5(%s), %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['u_uname'], "text"),
                       GetSQLValueString($_POST['u_pass'], "text"),
                       GetSQLValueString($_POST['u_nama'], "text"),
                       GetSQLValueString($_POST['u_tglLahir'], "text"),
                       GetSQLValueString($_POST['u_jk'], "text"),
                       GetSQLValueString($_POST['u_email'], "text"),
                       GetSQLValueString($_POST['u_level'], "text"),
                       GetSQLValueString($_POST['nonaktif'], "text"));

  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
}
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-user"></span> Tambah Admin</h3>
</div>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table cellpadding="4">
    <tr>
      <td>Username :</td>
      <td><span id="sprytextfield1">
              <input class="form-control" type="text" name="u_uname" value="" size="32" placeholder="Username"/>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>Password :</td>
      <td><span id="sprytextfield2">
              <input class="form-control" type="password" name="u_pass" value="" size="32" placeholder="Password"/>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td>Nama Lengkap :</td>
      <td><input class="form-control" type="text" name="u_nama" value="" size="32" placeholder="Nama Lengkap"/></td>
    </tr>
    <tr>
      <td>Tanggal Lahir :</td>
      <td><input class="form-control" type="text" name="u_tglLahir" value="" size="32" placeholder="Tanggal Lahir"/>
          <label class="title-abu">yyy-mm-dd</label></td>
    </tr>
    <tr>
      <td>Jenis Kelamin :</td>
              <td><select class="form-control" name="u_jk">
                      <option value="Laki-Laki">Laki-Laki</option>
                      <option value="Perempuan">Perempuan</option>
                  </select>
              </td>
    </tr>
    <tr>
      <td>Email :</td>
      <td><input class="form-control" type="text" name="u_nama" value="" size="32" placeholder="Email"/></td>
    </tr>
    <tr>
      <td>Level :</td>
              <td><select class="form-control" name="u_level">
                      <option value="1">Superuser</option>
                      <option value="2">Manager</option>
                  </select>
              </td>
    </tr>
    <tr>
      <td>Nonaktif:</td>
      <td><select class="form-control" name="nonaktif" id="nonaktif">
        <option value="Y">Y</option>
        <option value="N" selected="selected">N</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-info" name="Submit" type="submit" value="Tambah Admin" />
      <input class="btn btn-primary" type="button" name="button" id="button" value="Kembali" onClick="location='index.php?page=tampil_admin'"/></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["change"]});
//-->
</script>