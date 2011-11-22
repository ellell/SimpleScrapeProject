SimpleScrape, 2011
Lisa Övermyr <lisaovermyr@gmail.com>
You are free to use this component as you like. 

What is this? This is a tool for scraping xml or xhtml documents 

Requirements
PHP 5.2 or later

Instructions:

Create a SimpleScrape object, the constructor takes one string parameter; the url of the document you want to scrape. Then call method getElements() or getAttributes() to extract the data you need. These methods have one required string parameter, $element for getElements(), and $attribute for getAttributes(), set those to the name of the element or attribute you want to fetch.

There's also three optional parameters for filtering your query; $parent, $filterAttr and $filterAttrValue. The first one, $parent, is for when you only want to fetch elements or attributes that are children of another element, you set that parameter to the name of the parent element. The last two are for filtering with attributes, you set the $filterAttr to the name of the attribute and the $filterAttrValue to the value of the attribute you want to use for filtering. 

The result will be returned as an array.

Examples: 
	// Extract all the title elements from within the item element and display the result
	$myScrape = new SimpleScrape($url);
	$titles = $myScrape->getElements("title", "item");
	foreach ($titles as $title){ echo $title; }
	
	// Extract text from element "a" and attribute "href" within h2-element and use scrapeview
	$myScrape = new SimpleScrape($url);
	$scrapes["text"] = $myScrape->getElements("a", "h2");
	$scrapes["href"] = $myScrape->getAttributes("href", "h2");
	for($i = 0; $i < count($scrapes["text"]); $i++){
		echo = $myScrapeView->createLink($scrapes["href"][$i], $scrapes["text"][$i]);
	}
