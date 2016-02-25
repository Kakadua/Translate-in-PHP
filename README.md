Translate in PHP
================
This is a class that makes it quick and easy to use Translation APIs in PHP projects


Supported APIs
================
* Microsoft Translate
* Yandex Translator


Example:
================
	
	<?php
		
		include "translate.class.php";
		
		$str = "Tolk är en person som möjliggör kommunikation genom muntlig översättning mellan olika språk, för att göra det möjligt för personer som annars inte förstår varandras språk att kommunicera.";
		$translateTo = "en"; //English
		$translateFrom = "sv"; //Swedish
		
		$translate = new translate(); //This could also be called as new translate($translateTo); but since we want english and that is the default value we don't need to do that here
		
		
		$translate->setMicrosoftKey("YOUR MICROSOFT KEY"); //Get one here https://datamarket.azure.com/dataset/bing/microsofttranslator
		$microsoft = $translate->microsoft($str); //Could also be called as $translate->microsoft($str, $translateTo); or  $translate->microsoft($str, $translateFrom, $translateTo);
		
		$translate->setYandexKey("YOUR YANDEX KEY"); //Get one here https://tech.yandex.com/keys/get/?service=trnsl
		$yandex = $translate->yandex($str).'</p></div>'; //Could also be called as $translate->yandex($str, $translateTo); or  $translate->yandex($str, $translateFrom, $translateTo);
		
		
		echo "<div>
					<p>Original: {$str}</p>
					<p>Microsoft: {$microsoft}</p>
					<p>Yandex: {$yandex}</p>
				</div>";
	?>