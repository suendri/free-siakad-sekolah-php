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

require ("Inc/config.php");
require ("Inc/fungsi.php");

// *** Validate request to login to this site.

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername = mysql_real_escape_string($_POST['username']);
  $password = mysql_real_escape_string($_POST['password']);
  //$level = $_POST['level']; Update v4.0
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_koneksi, $koneksi);
  
  $LoginRS__query=sprintf("SELECT u_uname, u_pass, level, u_nama FROM view_users WHERE u_uname=%s AND u_pass=md5(%s)",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $koneksi) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  
  if ($loginFoundUser) {
     $loginStrGroup = "";
	 
	 $level = mysql_result($LoginRS, 0, 'level');
	 $nama = mysql_result($LoginRS, 0, 'u_nama');
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	  
	$_SESSION['Level'] = $level;
	$_SESSION['nama'] = $nama;	    

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    sleep(3);
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>

<!DOCTYPE>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Login Sistem :: Sistem Informasi SMA N X Kisaran</title>
<meta name="description" content="Sistem Informasi Sekolah">
<meta name="author" content="PHPBeGO Foundation">
<link rel="shortcut icon" href="Asset/images/favicon.ico" />
<link href="Asset/css/bootstrap.css" rel="stylesheet" type="text/css" />

<style type="text/css">
body {padding-top: 50px;padding-bottom: 20px;background-color:#e7ebf2;font-size: 12px;}
.login-avatar {float: left;padding: 3px;position: absolute;margin-top: 40px;margin-left: 10px;width: 200px;cursor: pointer;}
.login-title {color: #ffffff;margin-left: 220px;text-shadow: 0 1px 2px rgba(0, 0, 0, 0.6);}
.jumbotron {background-color: #026fa6;background-image: url(Asset/images/hero.png);background-repeat: repeat;border-bottom: 10px solid #CCC;}
.space { height: 120px;}
</style>
</head>

<body>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">SISFO SEKOLAH</a>
        </div>
        <div class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" ACTION="<?php echo $loginFormAction; ?>" METHOD="POST" name="formlogin">
              <div class="form-group">
                <input type="text" name="username" placeholder="Username" class="form-control" required="">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" class="form-control" required="">
            </div>
            <button type="submit" class="btn btn-success" name="blogin" id="blogin">Login</button>
          </form>
        </div>
      </div>
    </div>
    <div class="jumbotron">
      <div class="container">
        <div class="login-avatar"><img src="Asset/images/login.png" /></div>
        <div class="space"></div>
        <div class="login-title">
        <h2>SISTEM INFORMASI SEKOLAH SMA N X KISARAN</h2>
        <h4>Alamat : Jln. St Ali Syahbana 11b Kisaran. No Telp : (0623) 4562221. Email : cs@gosoftware.web.id</h4>
        </div>
      </div>
    </div>
    <div class="container">
    <footer>
        Copyright &copy; 2014. Sistem Informasi Sekolah v3.1 - <a href="http://phpbego.wordpress.com" target="_blank">PHPBeGO Foundation</a>
    </footer>
    </div>
<script src="Asset/js/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="Asset/js/bootstrap.js" type="text/javascript"></script>
<script src="Asset/js/application.js" type="text/javascript"></script>
</body>
</html>
