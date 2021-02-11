<?php
$url = "https://www.ouestfrance-auto.com/marques-motos/";

$pageContent = file_get_contents($url);
preg_match_all('`<a href="/marques-motos/[^>]+" class="btn btn-grey btn-block text-ellipsis">[^<]+</a>`', $pageContent, $brands);
$nbLink = count($brands[0]);

$listBrands = array();

for($i = 0; $i < $nbLink; $i++) {
    $linkContent = $brands[0][$i];
    preg_match('`<a href="[^>]+" title="[^>]+" class="btn btn-grey btn-block text-ellipsis">(.*?)<\/a>`', $linkContent, $match);
    array_push($listBrands, array($i + 1, $match[1]));
}

$fp = fopen('brands.csv', 'w');

foreach($listBrands as $brand) {
    fputcsv($fp, $brand);
}
  
fclose($fp); 