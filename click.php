<?php
$bannerAdsPath = './ads.dat';
require './ads.inc.php';
///////////////////////////////////////
// Don't Edit Anything Below This Line!
///////////////////////////////////////
for ($i = 0; $i < count($ads); $i++) {
    if(ereg('^' .$_GET['id']. '\|\|', $ads[$i])) {
        $data = explode('||', $ads[$i]);
        $data[6]++;
        $ads[$i] = join('||', $data);
        break;
    }
}
if (!$data[9]) {
    die();
}
writeads();
Header("Location: $data[9]");
exit;
?>
