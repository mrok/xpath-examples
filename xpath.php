<?php

$xml = simplexml_load_file(getcwd() . '/xpath.xml');

//normal usage of Simple Xml Element
$subtitles = $xml->video->subtitles->subtitle;
foreach ($subtitles as $subtitle) {
	echo $subtitle .PHP_EOL;
}	
echo '================================ 1' .PHP_EOL;
//access to subtitle
$subtitles = $xml->xpath('/import/video/subtitles/subtitle');
foreach ($subtitles as $subtitle) {
	echo $subtitle .PHP_EOL;
}
echo '================================ 2' .PHP_EOL;

//how get Spanish subtitles
$spanishSubtitles = reset($xml->xpath('/import/video/subtitles/subtitle[contains(., "es.")]'));
echo $spanishSubtitles .PHP_EOL;
