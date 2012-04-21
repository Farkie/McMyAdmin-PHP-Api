<?php

include_once('mcmyadmin.class.php');
$config = parse_ini_file('config.ini');

$mcmyadmin = new McMyAdmin($config['username'],$config['password'],$config['host'],$config['port']);

$players = $mcmyadmin->getPlayers();
echo implode(" - ",$players);

$mcmyadmin->sendMessage('This is a message');

echo $mcmyadmin->sendCommand('getServerInfo')->edition;

if(isset($_GET['killserver'])) {
	$mcmyadmin->killServer();
}