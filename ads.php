<?php
$bannerAdsPath = './ads.dat';
require './ads.inc.php';
///////////////////////////////////////
// Don't Edit Anything Below This Line!
///////////////////////////////////////
class bannerAds
{
    var $ad;
    function bannerAds($id = null, $max = 1, $width = 0, $height = 0)
    {
        global $ads, $bannerAds, $bannerAdsTime;
        if ($id != null) {
            for ($i = 0; $i < count($ads); $i++) {
                if(ereg("^$id\|\|", $ads[$i])) {
                    $data = explode('||', $ads[$i]);
		    // Only return if we've still got some impressions left and we're within time
		    if (($data[ PHPADS_ADELEMENT_REMAINING ] > 0 || $data[ PHPADS_ADELEMENT_REMAINING ] == -1) && ($data[ PHPADS_ADELEMENT_ENDDATE ] > $bannerAdsTime && $data[12] < $bannerAdsTime) && $data[ PHPADS_ADELEMENT_ENABLED ]) {
                        $this->ad[] = "<a href=\"" .$bannerAds['click_url']. "?id=".urlencode($data[ PHPADS_ADELEMENT_ID ])."\" target=\"" .$bannerAds['target']. "\"><img src=\"$data[10]\" alt=\"$data[11]\" width=\"" .$data[ PHPADS_ADELEMENT_WIDTH ]. "\" height=\"$data[8]\" border=\"" .$bannerAds['border']. "\" /></a>";
			if ($data[ PHPADS_ADELEMENT_REMAINING ] > 0) { // Don't turn 0 impressions left into infinite impressions
                            $data[ PHPADS_ADELEMENT_REMAINING ]--;
			}
			$data[ PHPADS_ADELEMENT_IMPRESSIONS ]++;
			$ads[$i] = join('||', $data);
                    }
                    break;
                }
            }
        } else {
            $eligible = array();
            $found = 0;
            for ($i = 0; $i < count($ads); $i++) {
                $data = explode('||', $ads[$i]);
                if ($data[ PHPADS_ADELEMENT_ENABLED ] != 1) {
                    continue;
                }
                if (($data[ PHPADS_ADELEMENT_ENDDATE ] != '99999999') && ($data[ PHPADS_ADELEMENT_ENDDATE ] < $bannerAdsTime)) {
                    continue;
                }
		if ($data[12] && $data[12] > $bannerAdsTime) {
		    continue;
		}
                if ($data[ PHPADS_ADELEMENT_REMAINING ] == 0) {
                    continue;
                }
                if (($width != 0) && ($data[ PHPADS_ADELEMENT_WIDTH ] != $width)) {
                    continue;
                }
                if (($height != 0) && ($data[8] != $height)) {
                    continue;
                }
                for ($j = 0; $j < $data[ PHPADS_ADELEMENT_WEIGHTING ]; $j++) {
                        $eligible[] = $i;
                }
                $found++;
            }
            if ($found < $max) {
                return;
            }
            srand((double) microtime() * 1000000);
            shuffle($eligible);
            $this->ad = array();
            for ($i = 0; $i < $max; $i++) {
                if (($i == $max - 1) && ($found == $max))  {
                    $theone = 0;
                } else {
                    mt_srand((double) microtime() * 1000000);
                    $theone = mt_rand(0, (count($eligible) - 1));
                }
                $theone = $eligible[$theone];
                $data = explode('||', $ads[$theone]);
                $this->ad[] .= "<a href=\"" .$bannerAds['click_url']. "?id=".urlencode($data[ PHPADS_ADELEMENT_ID ])."\" target=\"" .$bannerAds['target']. "\"><img src=\"$data[10]\" alt=\"$data[11]\" width=\"" .$data[ PHPADS_ADELEMENT_WIDTH ]. "\" height=\"$data[8]\" border=\"" .$bannerAds['border']. "\" /></a>";
                if ($data[ PHPADS_ADELEMENT_REMAINING ] > 0) { // Remaining impressions check already taken care of in previous for loop
                    $data[ PHPADS_ADELEMENT_REMAINING ]--;
		}
                $data[ PHPADS_ADELEMENT_IMPRESSIONS ]++;
                $ads[$theone] = join('||', $data);
		$neligible = array();
                for ($j = 0; $j < count($eligible); $j++) {
                    if ($eligible[$j] != $theone) {
                        $neligible[] = $eligible[$j];
                    }
                }
                unset($eligible);
                $eligible = $neligible;
                unset($neligible);
            }
        }
        writeads();
    }
}
?>
