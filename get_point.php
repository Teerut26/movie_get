<?php 
function curl_load($url){
    curl_setopt($ch=curl_init(), CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

$url = "https://www.imdb.com/title/tt9021140/?ref_=rvi_tt";
$curl = curl_load($url);


$pattern = '/ratingValue">.../';
preg_match($pattern, $curl, $matches);
echo str_replace('ratingValue">','',$matches[0]);

?>