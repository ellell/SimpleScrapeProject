<?php
include_once("scrapeView.php");
include_once("../SimpleScrape/simpleScrape.php");
$sv = new ScrapeView();
echo $sv->createXHTMLStrictPage('SimpleScrape Example', 'did you miss me?');

// User simpleScrape to display latest articles from whedonesque
$myScrape = new SimpleScrape('www.whedonesque.com/rss.xml.php');
$elements = array("item/guid", "item/title");
$scrapes["href"] = $myScrape->getElements("guid", "item");
$scrapes["text"] = $myScrape->getElements("title", "item");
$content = array();
for($i = 0; $i < count($scrapes["href"]); $i++){
	$content[] = $sv->createLink($scrapes["href"][$i], $scrapes["text"][$i]);
}
echo $sv->createBox('whedonesque', $content);


// Use simpleScrape to display latest articles from autostraddles arts and entertainment category
$myScrape = new SimpleScrape('http://www.autostraddle.com/category/arts-and-entertainment/');
$scrapes["text"] = $myScrape->getElements("a", "h2");
$scrapes["href"] = $myScrape->getAttributes("href", "h2");
$content = array();
for($i = 0; $i < count($scrapes["text"]); $i++){
	$content[] = $sv->createLink($scrapes["href"][$i], $scrapes["text"][$i]);
}
echo $sv->createBox('autostraddle (entertainment)', $content);
