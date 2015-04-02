<?php

$userInput = $_GET["userEnteredCity"];
$userInputArray = explode(" ", $userInput);

$correctedUserInput = "";
if (sizeof($userInputArray) > 1) {
	foreach ($userInputArray as $name) {
		$correctedUserInput = $correctedUserInput.$name;
	}
	$url = "http://www.weather-forecast.com/locations/".$correctedUserInput."/forecasts/latest";
	} else {
		if ($userInput) {
		$url = "http://www.weather-forecast.com/locations/".$userInput."/forecasts/latest";
	}
}
	
	if($url) {
		$pageContent = file_get_contents($url);
		$pattern = '/3 Day Weather Forecast Summary:<\/b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">(.*?)<\/span>/s';
		preg_match($pattern, $pageContent, $matches);
		echo $matches[1];
	}	
	
?>