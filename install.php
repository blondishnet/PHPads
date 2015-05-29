<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PHPads - Install</title>
<style type="text/css">
body, td{font-family:verdana,helvetica,arial,sans-serif;font-size:12px;color:#000000;background-color:#ffffff;}
b{font-weight:bold;}
h1{font-size:2.5em;}
.smalltext{font-size:11px;}
.error{color:#ff0000;}
</style>
</head>

<body>
<div align="center"><h1>PHPads</h1><b>Install</b><br><br>
<table width="550" border="0" cellspacing="2" cellpadding="2">
<tr>
<td>
<?php
if (isset($_POST['path_dat']) && isset($_POST['path_inc'])) {
    $bannerAdsPath = stripslashes($_POST['path_dat']);
    $requirePath = stripslashes($_POST['path_inc']);
    if (file_exists($bannerAdsPath) && file_exists($requirePath)) {
        require $requirePath;
        // md5() password
        $bannerAds['pass'] = md5($bannerAds['pass']);
        writeads();
        echo '<b>Install Complete!</b> Please remove install.php from your ads directory right now.  You can now login to the control panel by clicking <a href="admin.php">here</a>.';
    } else {
        echo 'Cannot find ads.dat and/or ads.inc.php. Please go <a href="javascript:window.history.go(-1);">back</a> and edit the absolute path to ads.dat and/or ads.inc.php and try again.';
    }
} else {
?>
This script will attempt to convert the ads.dat file to be compatible with your installation of PHP.
<form method="post" action="install.php">
Absolute Path to ads.dat: <input type="text" name="path_dat" value="<?php echo dirname(__FILE__); ?>/ads.dat" size="35" /><br />
Absolute Path to ads.inc.php: <input type="text" name="path_inc" value="<?php echo dirname(__FILE__); ?>/ads.inc.php" size="35" />
<br><br>
<center><input type="submit" value="Install"></center>
</form>
<?php
}
?>
</td>
</tr>
</table>
<br><br>
<center><a href="http://www.blondish.net">PHPads</a></center></body>
</html>
