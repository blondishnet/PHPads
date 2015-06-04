<?php
$ads = array();
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
