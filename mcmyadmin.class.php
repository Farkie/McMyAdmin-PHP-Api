<?php

class McMyAdmin {

	protected $response;
	protected $config = array();
	protected $logged_in = false;
	
	public function __construct($user = '',$pass = '',$host = 'localhost',$port = '8080') {
		if(!empty($user) && !empty($pass) && !empty($host) && !empty($port)) {
			$this->login($user,$pass,$host,$port);
		}
	}
	
	public function login($user = '',$pass = '',$host = 'localhost',$port = '8080') {
	
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
	
	public function getPlayers() {
		if($this->getLoggedIn() == false) {
			throw new Exception('Not logged into McMyAdmin');	
		}
		
		$request = $this->request(array('req' => 'getStatus'));
		
		foreach($request->userinfo as $user => $values) {
			$playerlist[] = $user;
		}
		return $playerlist;
	}
	
	public function sendMessage($message) {
		if($this->getLoggedIn() == false) {
			throw new Exception('Not logged into McMyAdmin');	
		}
		
		if(!isset($message)) {
			throw new Exception('No message given');	
		}
		
		$request = $this->request(array('req' => 'sendchat','message'=>$message));
		
		return $request;
	}
	
	public function getLoggedIn() {
		return $this->logged_in;	
	}
	
	private function request($args = array()) {
		if(empty($this->config['host']) || empty($this->config['port'])) {
			throw new Exception('No host or port has been given');	
		}
				
		if(!empty($args)) {
			$param = http_build_query($args);
		}
		
		$url = 'http://'.$this->config['host'].':'.$this->config['port'].'/data.json?'.$param;
		$ch = curl_init($url);		
		
			 curl_setopt($ch, CURLOPT_HTTPHEADER , array('Content-type: application/json','Accept: application/json'));
			 curl_setopt($ch, CURLOPT_FOLLOWLOCATION , 1);
		     curl_setopt( $ch, CURLOPT_USERAGENT, 'Firefox/mozilla McMyAdminClass');
			 curl_setopt($ch, CURLOPT_HEADER , 0);
			 curl_setopt($ch, CURLOPT_COOKIEJAR , 'cookie.txt');
			 curl_setopt($ch, CURLOPT_COOKIEFILE , 'cookie.txt');
			 curl_setopt($ch, CURLINFO_HEADER_OUT, true);
			 curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
				 $data = curl_exec($ch);

		if(empty($data)) {
			throw new Exception('No content was received back. Was this the correct url?: '.var_dump(curl_getinfo($ch,CURLINFO_HEADER_OUT)));
		}
			curl_close($ch);

		return json_decode($data);
	}
}