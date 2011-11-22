<?php
class ScrapeView{
	public function createXHTMLStrictPage($title, $headline){
		$pageStart = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' /><html>
			<head>
				<title>$title</title>
			</head>
			<body>
			<h1>$headline</h1>";
		return $pageStart;
	}
	public function createLink($href, $text){
		$link = "<a href='$href'>$text</a>";
		return $link;
	}
	public function createBox($headline, $content){
		$box = "<div class='box'><h2>$headline</h2>";
		if($content == null){
			$box .= "<p>Nothing to display</p>";
		}
		else{
			foreach ($content as $item){
				$box .= "<p>" . $item . "</p>";
			}
		}
		$box .= "</div>";
		return $box;
	}
}