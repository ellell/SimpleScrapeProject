<?php
/** 
* A tool for web scraping. 
* 
* @author Lisa Övermyr <lisaovermyr@gmail.com>
* @version 1.0 
* 
*/
class SimpleScrape{
	private $scrapeURL;	
	public function __construct($url) {
        $this->scrapeURL = $url;
    }
	public function getDocument(){
		// Initiate new curl session
		$html = '';
    	$ch = curl_init();
		// Set options - the URL to fetch, to return transfer as string
    	curl_setopt($ch, CURLOPT_URL, $this->scrapeURL);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		try {
			// Execute session
		    $html = curl_exec($ch);
			if(!$html){
				// If execution returns false, throw new exception
				throw new Exception("cURL error number: " .curl_errno($ch) . " cURL error: " . curl_error($ch));
			}
		}
		catch (Exception $e)
		{
		    echo "Exception caught: ",  $e->getMessage(), "\n";
			echo "In file: " . $e->getFile() . "<br />";
			echo "On line: " . $e->getLine();
		}
		return $html;
	} 
	private function queryDocument($query){
		// Get document as domdocument and create new DOMXpath object
		$doc = $this->getDocument();
		$html = new DOMDocument();
		@$html->loadHtml($doc);
		$xpath = new DOMXpath($html);
		// Execute xpath query
		$result = $xpath->query($query);
		$i = 0;
		$items = '';
		// Save result in an array
		foreach($result as $item){
			$items[] = ($item->nodeValue);
		}
		if($items == null){
			// If there's no result, return false
			return false;
		}
		// Return results
		return $items;
	}
	public function getElements($element, $parent = null, $filterAttr = null, $filterAttrValue = null){
		// If container parameter is set, add doubleslashes so it fits in expression
		if($parent != null){
			$parent = $parent . "//";
		}
		// If filterattribute or filterattributevalue parameters are not set, set query without filter
		if($filterAttr == null || $filterAttrValue == null){
			$query = "//$parent$element";
		}
		// If filterattribute or filterattributevalue parameters are set, set query with filter
		else{
			$query = "//$parent$element" . '[@' . $filterAttr . "='$filterAttrValue']";
		}
		// Execute query and return results
		$elements = $this->queryDocument($query);
		return $elements;
	}
	public function getAttributes($attribute, $parent = null, $filterAttr = null, $filterAttrValue = null){
		// If container parameter is set, add doubleslashes so it fits in expression
		if($parent != null){
			$parent = $parent . "//";
		}
		// If filterattribute or filterattributevalue parameters are not set, set query without filter
		if($filterAttr == null || $filterAttrValue == null){
			$query = "//$parent@$attribute";
		}
		// If filterattribute or filterattributevalue parameters are set, set query with filter
		else{
			$query = "//$parent@$attribute" . '[@' . $filterAttr . "='$filterAttrValue']";
		}
		// Execute query and return results
		$elements = $this->queryDocument($query);
		return $elements;
	}
	public function getURL(){
		return $this->scrapeURL;
	}
}