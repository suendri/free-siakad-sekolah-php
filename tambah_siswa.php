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
  $insertSQL = sprintf("INSERT INTO siswa (s_nis, u_uname, u_nama, s_tmp_lahir, s_tgl_lhr, s_jk, s_nm_ortu, s_pek_ortu, s_alamat, s_agama, s_gdarah, s_thn_masuk, s_kd_kls, nonaktif) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['s_nis'], "text"),
					   GetSQLValueString($_POST['s_nis'], "text"),
                       GetSQLValueString($_POST['u_nama'], "text"),
                       GetSQLValueString($_POST['s_tmp_lahir'], "text"),
                       GetSQLValueString($_POST['s_tgl_lhr'], "date"),
                       GetSQLValueString($_POST['s_jk'], "text"),
                       GetSQLValueString($_POST['s_nm_ortu'], "text"),
                       GetSQLValueString($_POST['s_pek_ortu'], "text"),
                       GetSQLValueString($_POST['s_alamat'], "text"),
                       GetSQLValueString($_POST['s_agama'], "text"),
                       GetSQLValueString($_POST['s_gdarah'], "text"),
                       GetSQLValueString($_POST['s_thn_masuk'], "int"),
                       GetSQLValueString($_POST['s_kd_kls'], "text"),
                       GetSQLValueString($_POST['nonaktif'], "text"));

  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
}

$query_rec_list_kelas = "SELECT * FROM kelas WHERE k_nonaktif='N' ORDER BY k_kd ASC";
$rec_list_kelas = mysql_query($query_rec_list_kelas, $koneksi) or die(mysql_error());
$row_rec_list_kelas = mysql_fetch_assoc($rec_list_kelas);
$totalRows_rec_list_kelas = mysql_num_rows($rec_list_kelas);
?>

<div class="judul">
<h3><span class="glyphicon glyphicon-plus-sign"></span> Tambah Siswa</h3>
</div>
<form class="well" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table class="table-form">
    <tr>
      <td>NIS</td>
      <td><span id="sprytextfield1">
              <input class="form-control" type="text" name="s_nis" value="" size="25" placeholder="NIS"/>
      <span class="textfieldRequiredMsg">Wajib Diisi</span></span></td>
    </tr>
    <tr>
      <td>Nama</td>
      <td><span id="sprytextfield2">
              <input class="form-control" type="text" name="u_nama" value="" size="50" placeholder="Nama Lengkap"/>
      <span class="textfieldRequiredMsg">Wajib Diisi</span></span></td>
    </tr>
    <tr>
      <td>Tempat Lahir</td>
      <td><input class="form-control" type="text" name="s_tmp_lahir" value="" size="50" placeholder="Tempat Lahir"/></td>
    </tr>
    <tr>
      <td>Tanggal Lahir</td>
      <td><span id="sprytextfield3">
              <input class="form-control" type="text" name="s_tgl_lhr" value="" size="25" placeholder="Tanggal Lahir"/>
      <span class="textfieldRequiredMsg">Wajib Diisi</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td><select class="form-control" name="s_jk" id="s_jk">
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>Nama Orang Tua</td>
      <td><input class="form-control" type="text" name="s_nm_ortu" value="" size="50" placeholder="Nama Orang Tua"/></td>
    </tr>
    <tr>
      <td>Pekerjaan Orang Tua</td>
      <td><input class="form-control" type="text" name="s_pek_ortu" value="" size="50" placeholder="Pekerjaan Orang Tua"/></td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td><input class="form-control" type="text" name="s_alamat" value="" size="50" placeholder="Alamat"/></td>
    </tr>
    <tr>
      <td>Agama</td>
      <td><select class="form-control" name="s_agama" id="s_agama">
        <option value="Islam">Islam</option>
        <option value="Kristen">Kristen</option>
        <option value="Hindu">Hindu</option>
        <option value="Budha">Budha</option>
        <option value="Konghucu">Konghucu</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>Gologan Darah</td>
      <td><select class="form-control" name="s_gdarah" id="s_gdarah">
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="AB">AB</option>
        <option value="O">O</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>Tahun Masuk</td>
      <td><span id="sprytextfield4">
              <input class="form-control" type="text" name="s_thn_masuk" value="" size="10" placeholder="Tahun Masuk"/>
      <span class="textfieldRequiredMsg">Wajib Diisi</span><span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
    </tr>
    <tr>
      <td>Kelas</td>
      <td><select class="form-control" name="s_kd_kls" id="s_kd_kls">
        <?php
do {  
?>
        <option value="<?php echo $row_rec_list_kelas['k_kd']?>"><?php echo $row_rec_list_kelas['k_nm']?></option>
        <?php
} while ($row_rec_list_kelas = mysql_fetch_assoc($rec_list_kelas));
  $rows = mysql_num_rows($rec_list_kelas);
  if($rows > 0) {
      mysql_data_seek($rec_list_kelas, 0);
	  $row_rec_list_kelas = mysql_fetch_assoc($rec_list_kelas);
  }
?>
      </select>
</td>
    </tr>
    <tr>
      <td>Nonaktif</td>
      <td><select class="form-control" name="nonaktif" id="nonaktif">
        <option value="Y">Y</option>
        <option value="N" selected="selected">N</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input class="btn btn-success" name="Submit" type="submit" value="Simpan Data" />
      <input class="btn btn-info" type="button" name="Button" id="button" value="Kembali"  onClick="location='index.php?page=tampil_siswa'" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "date", {format:"yyyy-mm-dd", validateOn:["change"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "integer", {validateOn:["change"], minChars:4, maxChars:4});
//-->
</script>
