<?php

$xml = simplexml_load_file(getcwd() . '/xpath.xml');
/**
 * Return callback function which check if fileURL contains proper language version 
 */
$fFindSubtitlesByLang = function ($lang) {
			$lang .= '.'; //to be sure that no part of 'example' word is searching
			return function ($fileUrl) use ($lang) {
						return strpos($fileUrl, $lang);
					};
		};
$spanishSubtitles = '';
$startTime = microtime(true);

//normal usage of Simple Xml Element
for ($i = 0; $i < 10000; $i++) {
	$subtitles = (array) $xml->video->subtitles;
	$spanishSubtitles = reset(array_filter($subtitles['subtitle'], $fFindSubtitlesByLang('es')));
}
echo $spanishSubtitles . PHP_EOL;
echo '1: ' . (microtime(true) - $startTime);
echo '================================ ' . PHP_EOL;

$spanishSubtitles = '';
$startTime = microtime(true);

//access to subtitle
for ($i = 0; $i < 10000; $i++) {
	$subtitles = $xml->xpath('/import/video/subtitles/subtitle');
	$spanishSubtitles = reset(array_filter($subtitles, $fFindSubtitlesByLang('es')));
}
echo $spanishSubtitles . PHP_EOL;
echo '2: ' . (microtime(true) - $startTime);
echo '================================ 2' . PHP_EOL;

$spanishSubtitles = '';
$startTime = microtime(true);

//how get Spanish subtitles
for ($i = 0; $i < 10000; $i++) {
	$spanishSubtitles = reset($xml->xpath('/import/video/subtitles/subtitle[contains(., "es.")]'));
}
echo $spanishSubtitles . PHP_EOL;
echo '3: ' . (microtime(true) - $startTime);