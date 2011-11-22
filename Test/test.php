<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once('../simpletest/autorun.php');
require_once('../SimpleScrape/simpleScrape.php');
class TestSimpleScrape extends UnitTestCase {
	/**
	* Change the testURL to run tests
	*/
	private $testURL = 'http://localhost:8888/php/seminarium/sem1/Test/test.xml';
	function testSetURL(){
		$testURL = '../Test/test.xml';
		$mySimpleScrape = new SimpleScrape($this->testURL);
		$this->assertEqual($mySimpleScrape->getURL(), $this->testURL);
	}
	function testGetDocument(){
		$mySimpleScrape = new SimpleScrape($this->testURL);
		$this->assertEqual($mySimpleScrape->getDocument(), 
			"<?xml version='1.0' encoding='ISO-8859-1' ?><sortiment><mejeriprodukter><grädde><produkt><produktnamn>Arla vispgrädde</produktnamn><pris valuta='sek'>9</pris></produkt><produkt><produktnamn>Kelda matlagningsgrädde</produktnamn><pris valuta='sek'>7.50</pris></produkt><produkt><produktnamn>Kelda vispgrädde</produktnamn><pris valuta='sek'>10</pris></produkt></grädde><mjölk><produkt><produktnamn>Arla Lättmjölk</produktnamn><pris valuta='sek'>9</pris></produkt><produkt><produktnamn>Arla Mellanmjölk</produktnamn><pris valuta='sek'>10</pris></produkt><produkt><produktnamn>Arla Mjölk</produktnamn><pris>11</pris></produkt></mjölk></mejeriprodukter></sortiment>"
			);
	}
	function testGetElement(){
		$mySimpleScrape = new SimpleScrape($this->testURL);
		$testResult = $mySimpleScrape->getElements("nonexistingelement");
		$this->assertFalse($testResult);
		$testResult = $mySimpleScrape->getElements("produktnamn");
		$this->assertIsA($testResult, 'array');
		$name = $testResult[0];
		$this->assertEqual($name, 'Arla vispgrädde');
	}
	function testGetAttribute(){
		$mySimpleScrape = new SimpleScrape($this->testURL);
		$testResult = $mySimpleScrape->getElements("nonexistingattribute");
		$this->assertFalse($testResult);
		$testResult = $mySimpleScrape->getAttributes("valuta");
		$this->assertIsA($testResult, 'array');
		$type = $testResult[0];
		$this->assertEqual($type, 'sek');
	}
}
?>