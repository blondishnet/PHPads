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

if($buttons && strlen(trim($buttons->ad[0])) )
{
    echo "<html><body style=\"margin:0; padding:0\">" .$buttons->ad[0]. "</body></html>";
} else {
    echo "<html><body style=\"margin:0; padding:0\">" .$bannerAds['default_display']."</body></html>";
}
?>

