<?php
$level = $_SESSION['Level'];
$uname = $_SESSION['MM_Username'];
$SQL = mysql_query("SELECT * FROM $level WHERE u_uname='$uname' LIMIT 1");
$detailAccount = mysql_fetch_assoc($SQL);

?>
<div class="judul">
<h3><span class="glyphicon glyphicon-list-alt"></span> General Profil</h3>
</div>

<table class="table">
    <tr>
        <td style="width: 200px;">Username</td> 
        <td><?php echo $_SESSION['MM_Username']; ?></td> 
    </tr>
    <tr>
        <td>Nama Lengkap</td> 
        <td><?php echo $detailAccount['u_nama']; ?></td> 
    </tr>
    <tr>
        <td>Password</td> 
        <td><div class="title-abu">Password tidak ditampilkan</div></td> 
    </tr>
    <tr>
        <td>Email</td> 
        <td><?php echo $detailAccount['u_email']; ?></td> 
    </tr>
    <tr>
        <td>Level</td> 
        <td><?php echo $_SESSION['Level']; ?></td> 
    </tr>
    <tr>
        <td>&nbsp;</td> 
        <td><a class="btn btn-info" href="?page=edit_ugeneral&uname=<?php echo $_SESSION['MM_Username']; ?>">Edit</a></td> 
    </tr>
</table>

