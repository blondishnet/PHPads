<?php
$bannerAdsPath = './ads.dat';
require './ads.inc.php';
///////////////////////////////////////
// Don't Edit Anything Below This Line!
///////////////////////////////////////
for ($i = 0; $i < count($ads); $i++) {
    if(preg_match('/^' .$_GET['id']. '\|\|/', $ads[$i])) {
        $data = explode('||', $ads[$i]);
	if ($_SERVER['REMOTE_ADDR'] != $bannerAds['blockip']) {
            $data[ PHPADS_ADELEMENT_CLICKTHRUS ]++;
	}
        $ads[$i] = join('||', $data);
        break;
    }
}
if (!$data[PHPADS_ADELEMENT_LINK_URI]) {
    die();
}
writeads();
Header("Location: ". $data[PHPADS_ADELEMENT_LINK_URI]);
exit;
?>
