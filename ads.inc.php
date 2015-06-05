<?php
$ads = array();
$adelements = array(
	'id'=>0, 
	'enabled'=>1, 
	'weighting'=>2, 
	'expires'=>3, 
	'remaining'=>4, 
	'remaining'=>5, 
	'clickthrough'=>6, 
	'width'=>7, 
	'height'=>8, 
	'link'=>9, 
	'image'=>10, 
	'name'=>11, 
	'startdate'=>12 
);
$bannerAds = array();
$bannerAdsTime = time();
$lines = file($bannerAdsPath) or die();

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
