<?php

include_once('mcmyadmin.class.php');
$mcconfig = parse_ini_file('config.ini'); // Must be readable by the webserver. (644)

	$mcmyadmin = new McMyAdmin($mcconfig['username'],$mcconfig['password'],$mcconfig['host'],$mcconfig['port']);


		/**
		* Want to get a list of players? use $mcmyadmin->getPlayers();
		*/
		$players = $mcmyadmin->getPlayers();
		echo "Current players: " . implode(" - ",$players) . '<br />';

		/**
		* Send a message to the server using: $mcmyadmin->sendChat($message);
		*/
		$mcmyadmin->sendChat('This is a message sent from php-API');

		/**
		* To get the current version of McMyAdmin, use $mcmyadmin->getServerInfo()->edition
		* If you use methods that return one object key, there is no need to ask for the key. Such as $mcmyadmin->getTip();
		*/
		echo "Edition: " . $mcmyadmin->getServerInfo()->edition . '<br />';
		echo "Random Tip: " . $mcmyadmin->getTip() . '<br />';

		/**
		* The $mcmyadmin->getServerInfo() returns an array inside the object, (Provider). The function below is a simple recursive call to display every option.
		*/
		echo print_list($mcmyadmin->getServerInfo());

		/**
		* You can also kill the server using $mcmyadmin->killServer()
		*/
		if(isset($_GET['killserver'])) {
			$mcmyadmin->killServer();
		}

function print_list($array) { 
$str = '<ul>';
	foreach($array as $key => $value) { 
		$str .= '<li> ' . $key .': ';
			if(is_object($value) || is_array($value)) {
				$str .= print_list($value);	
			} else {
				$str .= $value;	
			}
		$str .= '</li>';
	}
$str .= '</ul>';
return $str;
}