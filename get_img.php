<?php
/* 
$name = urlencode("hello");
$url = "https://sg.media-imdb.com/suggests/a/".$name.".json";
$json = file_get_contents($url);
$json_decode = json_decode($json);
print_r($json_decode);
*/
function curl_load($url){
    curl_setopt($ch=curl_init(), CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

$url = "https://www.imdb.com/title/tt9426210/";
$curl = curl_load($url);


$pattern = '/http....m.+._V1_.jpg/';
preg_match($pattern, $curl, $matches);
echo '<img src="'.$matches[0].'" alt="">';

?>
