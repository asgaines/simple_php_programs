<?php

/**
 * Scrapes links from web page and provides list of link
 * name/url in format: Name [/url]
 */

include_once('simplehtmldom_1_5/simple_html_dom.php');

$webPageUrl = $argv[1];

try {
	$html = file_get_html($webPageUrl);
} catch (Exception $e) {
	echo $e->message;
	die();
}

$links = [];

foreach($html->find('a') as $a) {
	// Remove whitespace and linebreaks
	$linkName = trim(preg_replace('/\s\s+/', ' ', $a->plaintext));
	if (!in_array($linkName, $links)) // No duplicate urls
		if (!empty($a->href)) // Only links
			$links[$linkName] = $a->href;
}

foreach ($links as $name => $url)
	echo $name . ' [' . $url . ']' . PHP_EOL;

?>
