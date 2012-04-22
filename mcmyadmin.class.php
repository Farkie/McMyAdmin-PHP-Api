<?php
/***********************************
* McMyAdmin PHP API class.
* Author: Alan Farquharson
* Version: 0.1
***********************************/

class McMyAdmin {

	protected $response;
	protected $config = array();
	protected $logged_in = false;

	/**
	* __construct - Optional. If chosen, script will login.
	* user, pass, host, port = string
	*/
	public function __construct($user = 'admin',$pass = '',$host = 'localhost',$port = '8080') {
		if(!empty($user) && !empty($pass) && !empty($host) && !empty($port)) {
			$this->login($user,$pass,$host,$port);
		}
	}

	/**
	* Method Login - Used to login to the McMyAdmin server with the supplied details.
	* user String
	* pass String
	* host String
	* port String
	*/
	public function login($user = 'admin',$pass = '',$host = 'localhost',$port = '8080') {

		if(!empty($user) && !empty($pass) && !empty($host) && !empty($port)) {
			$this->config['user'] = $user;
			$this->config['pass'] = $pass;
			$this->config['host'] = $host;
			$this->config['port'] = $port;

			$request = $this->request(array(
											'req'=>'login',
											'username'=>$user,
											'password'=>$pass
											)
									);
			if($request->success == 1){
				$this->logged_in = true;
			} else {
				throw new Exception('Incorrect config details');
			}
		} else {
			throw new Exception('Not enough Paramters');
		}

	}

	/**
	* Method getPlayers()
	* returns PlayerList
	*/
	public function getPlayers() {
		$this->getLoggedIn();

		$request = $this->sendCommand('getStatus');
		$playerlist = array();

		if($request->userinfo) {
			foreach($request->userinfo as $user => $values) {
				$playerlist[] = $user;
			}
		}
		return $playerlist;
	}

	/**
	* Method sendCommand
	* This allows additonal commands to be send and returned from the McMyAdmin server.
	*/

	public function sendCommand($command) {
		$this->getLoggedIn();

		if(!$command) {
			throw Exception('No command given');
		}

		return $this->request(array('req' => $command));
	}


	/**
	* Method sendMessage
	* This allows messages to be sent to the Minecraft Server.
	*/
	public function sendMessage($message) {
		$this->getLoggedIn();

		if(!isset($message)) {
			throw new Exception('No message given');
		}

		return $this->request(array('req' => 'sendchat','message'=>$message));
	}

	/**
	* Method remGroupMember
	* This allows a group member to be removed from a group.
	*/
	public function remGroupMember($group,$username,$type = 'groupmembers') {
		$this->getLoggedIn();

		if(!$group || $username) {
			throw new Exception('Invalid arguments');
		}

		return $this->request(array('req'=>'removegroupvalue','type'=>$type,'group'=>$group,'value'=>$username));
	}

	/**
	* Method addGroupMember
	* This allows a group member to be added to a group.
	*/
	public function addGroupMember($group,$username,$type = 'groupmembers') {
		$this->getLoggedIn();

		if(!$group || $username) {
			throw new Exception('Invalid arguments');
		}

		return $this->request(array('req'=>'addgroupvalue','type'=>$type,'group'=>$group,'value'=>$username));
	}

	/**
	* Method getServerInfo
	* This returns the current server info
	*/
	public function getServerInfo() {
		$this->getLoggedIn();

		return $this->request(array('req'=>'getServerInfo'));
	}

	/**
	* Method getLoggedIn
	* This allows a method to see if user is logged in or not.
	*/
	private function getLoggedIn() {
		if($this->logged_in == false) {
			throw new Exception('Not logged into McMyAdmin');
		}
	}

	/**
	* Method request
	* This allows a method to send a request to the McMyAdmin data source.
	*/
	private function request($args = array()) {
		if(empty($this->config['host']) || empty($this->config['port'])) {
			throw new Exception('No host or port has been given');
		}

		if(!empty($args)) {
			$param = http_build_query($args);
		}

		if(!file_exists('cookie.txt')) {
				if(!touch('cookie.txt')) { // You might have to do this yourself.
					throw new Exception('Please create a file named "cookie.txt" and chown it to the webserver and chmod it to 755 (Or alternatively 777 as a last case)');
				}
				chmod('cookie.txt','777');
		}

		$url = 'http://'.$this->config['host'].':'.$this->config['port'].'/data.json?'.$param;
		$ch = curl_init($url);

			 curl_setopt($ch, CURLOPT_HTTPHEADER , array('Content-type: application/json','Accept: application/json'));
			 curl_setopt($ch, CURLOPT_FOLLOWLOCATION , 1);
		     curl_setopt($ch, CURLOPT_USERAGENT, 'Firefox/mozilla McMyAdminClass');
			 curl_setopt($ch, CURLOPT_HEADER , 0);
			 curl_setopt($ch, CURLOPT_COOKIEJAR , 'cookie.txt');
			 curl_setopt($ch, CURLOPT_COOKIEFILE , 'cookie.txt');
			 curl_setopt($ch, CURLINFO_HEADER_OUT, true);
			 curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
				 $data = curl_exec($ch);

		if(empty($data)) {
			throw new Exception('No content was received back from McMyAdmin.');
		}
			curl_close($ch);

		return json_decode($data);
	}
}