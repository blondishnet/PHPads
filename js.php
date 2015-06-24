<?php
require './ads.php';
///////////////////////////////////////
// Don't Edit Anything Below This Line!
///////////////////////////////////////
if (!isset($_GET['id']) || !preg_match('/^[A-Za-z0-9 ]+$/', $_GET['id'])) {
    $_GET['id'] = null;
}
if (!isset($_GET['width']) || !preg_match('/^[0-9]+$/', $_GET['width'])) {
    $_GET['width'] = 0;
}
if (!isset($_GET['width']) || !isset($_GET['height']) || !preg_match('/^[0-9]+$/', $_GET['height'])) {
    $_GET['height'] = 0;
}
$buttons = new bannerAds($_GET['id'], 1, $_GET['width'], $_GET['height']);
header('Content-type: application/x-javascript');

if($buttons && strlen(trim($buttons->ad[0])) )
{
    echo "<!--\n";
    echo "document.write(\"" .addslashes($buttons->ad[0]). "\");\n";
    echo "//-->";
} else {
    echo "<!--\n";
    echo "document.write(\"".addslashes($bannerAds['default_display'])."\");\n";
    echo "//-->";
}
?>
