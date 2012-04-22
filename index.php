<?php

include_once('mcmyadmin.class.php');
$mcconfig = parse_ini_file('config.ini'); // Must be readable by the webserver. (644)

$mcmyadmin = new McMyAdmin($mcconfig['username'],$mcconfig['password'],$mcconfig['host'],$mcconfig['port']);

$players = $mcmyadmin->getPlayers();
echo "Current players: " . implode(" - ",$players) . '<br />';

$mcmyadmin->sendMessage('This is a message sent from php-API');

echo "Edition: " . $mcmyadmin->sendCommand('getServerInfo')->edition . '<br />';
echo "Random Tip: " . $mcmyadmin->sendCommand('getTip')->tip . '<br />';

echo print_list($mcmyadmin->getServerInfo());

if(isset($_GET['killserver'])) {
	$mcmyadmin->sendCommand('killServer');
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