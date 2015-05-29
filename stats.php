<?php
$bannerAdsPath = '/home/yourdomain/public_html/ads/ads.dat';
require '/home/yourdomain/public_html/ads/ads.inc.php';
///////////////////////////////////////
// Don't Edit Anything Below This Line!
///////////////////////////////////////
foreach ($ads as $ad) {
    if(ereg('^' .$_GET['id']. '\|\|', $ad)) {
        $data = explode('||', $ad);
        break;
    }
}
if (!$data) {
    die();
}
$enabled = $data[1] ? 'Yes' : 'No';
if($data[3] == '99999999') {
    $expires = 'Never';
} else {
    $expires = date('m/d/y', $data[3]);
}
if ($data[4] == -1) {
    $remaining = 'Unlimited';
} else {
    $remaining = $data[4];
}
$ctratio = @number_format($data[6] / $data[5] * 100, 2);
$barOnWidth = round($ctratio);
$barOffWidth = 100 - $barOnWidth;
$tplf = fopen('template.htm', 'r') or die();
$tpl = fread($tplf, 4096);
fclose($tplf);
$tpl = str_replace('{id}', $_GET['id'], $tpl);
$tpl = str_replace('{enabled}', $enabled, $tpl);
$tpl = str_replace('{weight}', $data[2], $tpl);
$tpl = str_replace('{expires}', $expires, $tpl);
$tpl = str_replace('{remaining}', $remaining, $tpl);
$tpl = str_replace('{impressions}', $data[5], $tpl);
$tpl = str_replace('{ct}', $data[6], $tpl);
$tpl = str_replace('{width}', $data[7], $tpl);
$tpl = str_replace('{height}', $data[8], $tpl);
$tpl = str_replace('{linkURL}', $data[9], $tpl);
$tpl = str_replace('{adURL}', $data[10], $tpl);
$tpl = str_replace('{name}', $data[11], $tpl);
$tpl = str_replace('{ctratio}', $ctratio, $tpl);
$tpl = str_replace('{barOnWidth}', $barOnWidth, $tpl);
$tpl = str_replace('{barOffWidth}', $barOffWidth, $tpl);
echo $tpl;
?>
