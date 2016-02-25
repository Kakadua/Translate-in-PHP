<?php
	class translate {
		var $keys;
		var $defaultLanguage;
		
		
		/**
		 *
		 * @param string $defaultLanguage The code for the language you want to have as default, if not passed it will default to english, OPTIONAL
		 *
		 * @version 1.0
		 */
		function __construct($defaultLanguage = "en"){
			$this->defaultLanguage = $defaultLanguage;
		}
		
		/**
		 *
		 * @param string $defaultLanguage The code for the language you want to have as default
		 *
		 * @version 1.0
		 */
		function setDefaultLanguage($defaultLanguage){
			$this->defaultLanguage = $defaultLanguage;
		}
		
		function getDefaultLanguage(){
			return $this->defaultLanguage;
		}
		
		
		
		
		/**
		 * Translate with Microsoft Translator
		 *
		 * OBS, before using this one make sure you have used setMicrosoftKey to set your API key or it won't work
		 * This can also be called as 
		 * $translate->microsoft($str); //Translates to english
		 * $translate->microsoft($str, $to);
		 * Get your key at https://datamarket.azure.com/dataset/bing/microsofttranslator
		 *
		 * @author Patrik "Popeen" Johansson <patrik@ptjwebben.se>
		 *
		 * @param string $str The text you want to translate
		 * @param string $from The language you want to translate from, OPTIONAL
		 * @param string $to The language you want to translate to, OPTIONAL
		 *
		 * @version 1.0
		 */
		function microsoft($str, $from = "notSet", $to = "notSet"){
			
			
			if($from == "notSet" && $to == "notSet"){ $to = $this->getDefaultLanguage(); $from = ""; } //Allows for $translate->microsoft($str);
			if($from != "notSet" && $to == "notSet"){ $to = $from; $from = ""; } //Allows for $translate->microsoft($str, $to);
			
			
			$str = urlencode($str);
			$cred = sprintf('Authorization: Basic %s', 
			base64_encode($this->getMicrosoftKey() . ":" . $this->getMicrosoftKey()) );
			$context = stream_context_create(array(
				'http' => array(
					'header'  => $cred
				)
			));
			$request = 'https://api.datamarket.azure.com/Bing/MicrosoftTranslator/v1/Translate?Text=%27'.$str.'%27&To=%27'.$to.'%27&$format=json';
			$response = file_get_contents($request, 0, $context);
			$json = json_decode($response, true);
			return $json['d']['results'][0]['Text'];
			
			
		}
		
		function setMicrosoftKey($key){
			$this->keys['microsoft'] = $key;
		}
		
		function getMicrosoftKey(){
			return $this->keys['microsoft'];
		}
		
		
		
		
		/**
		 * Translate with Yandex translate
		 *
		 * OBS, before using this one make sure you have used setYandexKey to set your API key or it won't work
		 * This can also be called as 
		 * $translate->yandex($str); //Translates to english
		 * $translate->yandex($str, $to);
		 * Get your key at https://tech.yandex.com/keys/get/?service=trnsl
		 *
		 * @author Patrik "Popeen" Johansson <patrik@ptjwebben.se>
		 *
		 * @param string $str The text you want to translate
		 * @param string $from The language you want to translate from, OPTIONAL
		 * @param string $to The language you want to translate to, OPTIONAL
		 *
		 * @version 1.0
		 */
		function yandex($str, $from = "notSet", $to = "notSet"){
			
			
			if($from == "notSet" && $to == "notSet"){ $to = $this->getDefaultLanguage(); $from = ""; } //Allows for $translate->yandex($str);
			if($from != "notSet" && $to == "notSet"){ $to = $from; $from = ""; } //Allows for $translate->yandex($str, $to);
			
			if($from != ""){ $from .= "-"; }
			
			$str = urlencode($str);
			$request = 'https://translate.yandex.net/api/v1.5/tr.json/translate?key='.$this->getYandexKey().'&text='.$str.'&lang='.$from.$to.'&format=plain';
			$response = file_get_contents($request);
			$json = json_decode($response, true);
			return $json['text'][0];
			
			
		}
		
		function setYandexKey($key){
			$this->keys['microsoft'] = $key;
		}
		
		function getYandexKey(){
			return $this->keys['microsoft'];
		}
		
		
		
		
	}
?>