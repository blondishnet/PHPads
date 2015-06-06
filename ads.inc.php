<?php
$ads = array();
$bannerAds = array();
$bannerAdsTime = time();
$lines = file($bannerAdsPath) or die();

define( 'PHPADS_ADELEMENT_ID',		 0);
define( 'PHPADS_ADELEMENT_ENABLED',	 1);
define( 'PHPADS_ADELEMENT_WEIGHTING',	 2);
define( 'PHPADS_ADELEMENT_ENDDATE',	 3);
define( 'PHPADS_ADELEMENT_IMPRESSIONS',	 5);
define( 'PHPADS_ADELEMENT_REMAINING',	 4);
define( 'PHPADS_ADELEMENT_CLICKTHRUS',	 6);
define( 'PHPADS_ADELEMENT_WIDTH',	 7);
define( 'PHPADS_ADELEMENT_HEIGHT',	 8);
define( 'PHPADS_ADELEMENT_LINK_URI',	 9);
define( 'PHPADS_ADELEMENT_IMAGE_URI',	10);
define( 'PHPADS_ADELEMENT_NAME',	11);
define( 'PHPADS_ADELEMENT_STARTDATE',	12);
define( 'PHPADS_ADELEMENT_ADTYPE',	13);
define( 'PHPADS_ADELEMENT_OTHERCONTENT',99);

define( 'PHPADS_ADTYPE_IMAGE',           0);
define( 'PHPADS_ADTYPE_OTHER',           1);

foreach ($lines as $line) {
    $line = chop($line);
    if (($line != '') && (!ereg('^#', $line))) {
        if (ereg('^[A-Za-z0-9 ]+\|\|', $line)) {
            $ads[] = $line;
        } else {
            list ($key, $val) = explode('=', $line);
            $bannerAds[$key] = $val;
        }
    }
}
date_default_timezone_set($bannerAds['timezone']);
function writeads()
{
    global $bannerAdsPath, $ads, $bannerAds;
    $data = fopen($bannerAdsPath, 'w') or die();
    flock($data, 2) or die();
    fputs($data, @join("\n", $ads)."\n");
    while (list ($key, $val) = each ($bannerAds)) {
        if ($key != '') {
            fputs($data, $key.'='.$val."\n");
        }
    }
    flock($data, 3);
    fclose($data);
    reset($bannerAds);
}
?>
