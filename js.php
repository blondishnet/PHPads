<?php
require './ads.php';
///////////////////////////////////////
// Don't Edit Anything Below This Line!
///////////////////////////////////////
if (!isset($_GET['id']) || !ereg('^[A-Za-z0-9]+$', $_GET['id'])) {
    $_GET['id'] = null;
}
if (!isset($_GET['width']) || !ereg('^[0-9]+$', $_GET['width'])) {
    $_GET['width'] = 0;
}
if (!isset($_GET['width']) || !isset($_GET['height']) || !ereg('^[0-9]+$', $_GET['height'])) {
    $_GET['height'] = 0;
}
$buttons = new bannerAds($_GET['id'], 1, $_GET['width'], $_GET['height']);
header('Content-type: application/x-javascript');
echo "<!--\n";
echo "document.write(\"" .addslashes($buttons->ad[0]). "\");\n";
echo "//-->";
?>
