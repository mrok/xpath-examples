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

//normal usage of Simple Xml Element
$subtitles = (array) $xml->video->subtitles;
$spanishSubtitles = reset(array_filter($subtitles['subtitle'], $fFindSubtitlesByLang('es')));
echo $spanishSubtitles .PHP_EOL;
echo '================================ 1' .PHP_EOL;

//access to subtitle
$subtitles = $xml->xpath('/import/video/subtitles/subtitle');
$spanishSubtitles = reset(array_filter($subtitles, $fFindSubtitlesByLang('es')));
echo $spanishSubtitles .PHP_EOL;
echo '================================ 2' .PHP_EOL;

//how get Spanish subtitles
$spanishSubtitles = reset($xml->xpath('/import/video/subtitles/subtitle[contains(., "es.")]'));
echo $spanishSubtitles .PHP_EOL;
