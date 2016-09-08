<?php

/**
 * Scrapes links from web page and provides list of link
 * name/url in format: Name [/url]
 */

include_once('simplehtmldom_1_5/simple_html_dom.php');

class LinkRetriever
{
	public function __construct($url)
	{
		$this->url = $url;
	}

	public function printLinks()
	{
		foreach ($this->getLinks() as $name => $url)
			echo $name . ' [' . $url . ']' . PHP_EOL;
	}

	public function getLinks()
	{
		$links = [];
		foreach ($this->getATags() as $a) {
			$linkText = $this->cleanLink($a->plaintext);
			if (!in_array($linkText, $links))
				if (!empty($a->href))
					$links[$linkText] = $a->href;
		}

		return $links;
	}

	private function cleanLink($link)
	{
		return trim(preg_replace('/\s\s+/', ' ', $link));
	}

	private function getATags()
	{
		try {
			return file_get_html($this->url)->find('a');
		} catch (Exception $e) {
			echo $e->message;
			die();
		}
	}
}

$url = $argv[1];

if (!filter_var($url, FILTER_VALIDATE_URL))
	die('The provided url is not valid');

$retriever = new LinkRetriever($argv[1]);
$retriever->printLinks();

