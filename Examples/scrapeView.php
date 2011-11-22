<?php
class ScrapeView{
	public function createLink($href, $text){
		$link = "<a href='$href'>$text</a>";
		return $link;
	}
}