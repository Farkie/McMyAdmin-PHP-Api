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
	* __construct - Optional Params. If chosen, script will login.
	* User		Pass 	Host	Port
	* String	String	String	String
	*/
	public function __construct($user = 'admin',$pass = '',$host = 'localhost',$port = '8080') {
		if(!empty($user) && !empty($pass) && !empty($host) && !empty($port)) {
			$this->login($user,$pass,$host,$port);
		}
	}

	/**
	* Method addGroupValue
	* Group	Type	Value	
	* String	String	String	
	*/
	public function addGroupValue ($group, $type, $value) {
	$this->ensureLoggedIn();

	if(!$group || !$type || !$value) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'addgroupvalue' , 'group' => $group, 'type' => $type, 'value' => $value));
	}


	/**
	* Method addLicence
	* NewKey	
	* String	
	*/
	public function addLicence ($newkey) {
	$this->ensureLoggedIn();

	if(!$newkey) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'addlicence' , 'newkey' => $newkey));
	}


	/**
	* Method addScheduleItem
	* Hours	Mins	Type	Param	
	* Int32	Int32	EventType [Enum:Int32]	String	
	*/
	public function addScheduleItem ($hours, $mins, $type, $param) {
	$this->ensureLoggedIn();

	if(!$hours || !$mins || !$type || !$param) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'addscheduleitem' , 'hours' => $hours, 'mins' => $mins, 'type' => $type, 'param' => $param));
	}


	/**
	* Method backupWorld
	* Label	
	* String	
	*/
	public function backupWorld ($label) {
	$this->ensureLoggedIn();

	if(!$label) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'backupworld' , 'label' => $label));
	}


	/**
	* Method changePassword
	* OldPassword	NewPassword	
	* String	String	
	*/
	public function changePassword ($oldpassword, $newpassword) {
	$this->ensureLoggedIn();

	if(!$oldpassword || !$newpassword) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'changepassword' , 'oldpassword' => $oldpassword, 'newpassword' => $newpassword));
	}


	/**
	* Method changeUserPassword
	* Username	NewPassword	
	* String	String	
	*/
	public function changeUserPassword ($username, $newpassword) {
	$this->ensureLoggedIn();

	if(!$username || !$newpassword) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'changeuserpassword' , 'username' => $username, 'newpassword' => $newpassword));
	}


	/**
	* Method createUser
	* NewUsername	
	* String	
	*/
	public function createUser ($newusername) {
	$this->ensureLoggedIn();

	if(!$newusername) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'createuser' , 'newusername' => $newusername));
	}


	/**
	* Method deleteBackup
	* Index	
	* Int32	
	*/
	public function deleteBackup ($index) {
	$this->ensureLoggedIn();

	if(!$index) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'deletebackup' , 'index' => $index));
	}


	/**
	* Method deleteUser
	* Username	
	* String	
	*/
	public function deleteUser ($username) {
	$this->ensureLoggedIn();

	if(!$username) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'deleteuser' , 'username' => $username));
	}


	/**
	* Method deleteWorld
	* No Arguments	
	* 	
	*/
	public function deleteWorld () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'deleteworld'));
	}


	/**
	* Method delScheduleItem
	* Index	
	* Int32	
	*/
	public function delScheduleItem ($index) {
	$this->ensureLoggedIn();

	if(!$index) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'delscheduleitem' , 'index' => $index));
	}


	/**
	* Method doDiagnostics
	* No Arguments	
	* 	
	*/
	public function doDiagnostics () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'dodiagnostics'));
	}


	/**
	* Method getAllGroupInfo
	* No Arguments	
	* 	
	*/
	public function getAllGroupInfo () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'getallgroupinfo'));
	}


	/**
	* Method getBackupList
	* No Arguments	
	* 	
	*/
	public function getBackupList () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'getbackuplist'));
	}


	/**
	* Method getBackupStatus
	* No Arguments	
	* 	
	*/
	public function getBackupStatus () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'getbackupstatus'));
	}


	/**
	* Method getChat
	* Since	
	* Int64	
	*/
	public function getChat ($since) {
	$this->ensureLoggedIn();

	if(!$since) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'getchat' , 'since' => $since));
	}


	/**
	* Method getConfig
	* Key	
	* String	
	*/
	public function getConfig ($key) {
	$this->ensureLoggedIn();

	if(!$key) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'getconfig' , 'key' => $key));
	}


	/**
	* Method getDeleteStatus
	* No Arguments	
	* 	
	*/
	public function getDeleteStatus () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'getdeletestatus'));
	}


	/**
	* Method getFullConfig
	* No Arguments	
	* 	
	*/
	public function getFullConfig () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'getfullconfig'));
	}


	/**
	* Method getGroupInfo
	* Group	
	* String	
	*/
	public function getGroupInfo ($group) {
	$this->ensureLoggedIn();

	if(!$group) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'getgroupinfo' , 'group' => $group));
	}


	/**
	* Method getGroupList
	* No Arguments	
	* 	
	*/
	public function getGroupList () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'getgrouplist'));
	}


	/**
	* Method getMCMAUsers
	* No Arguments	
	* 	
	*/
	public function getMCMAUsers () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'getmcmausers'));
	}


	/**
	* Method getPluginCategories
	* No Arguments	
	* 	
	*/
	public function getPluginCategories () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'getplugincategories'));
	}


	/**
	* Method getPlugins
	* No Arguments	
	* 	
	*/
	public function getPlugins () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'getplugins'));
	}


	/**
	* Method getProviderInfo
	* No Arguments	
	* 	
	*/
	public function getProviderInfo () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'getproviderinfo'));
	}


	/**
	* Method getRestoreStatus
	* No Arguments	
	* 	
	*/
	public function getRestoreStatus () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'getrestorestatus'));
	}


	/**
	* Method getSchedule
	* No Arguments	
	* 	
	*/
	public function getSchedule () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'getschedule'));
	}


	/**
	* Method getServerInfo
	* No Arguments	
	* 	
	*/
	public function getServerInfo () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'getserverinfo'));
	}


	/**
	* Method getStatus
	* No Arguments	
	* 	
	*/
	public function getStatus () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'getstatus'));
	}


	/**
	* Method getTip
	* No Arguments	
	* 	
	*/
	public function getTip () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'gettip'));
	}


	/**
	* Method getUpdateStatus
	* No Arguments	
	* 	
	*/
	public function getUpdateStatus () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'getupdatestatus'));
	}


	/**
	* Method getVersions
	* No Arguments	
	* 	
	*/
	public function getVersions () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'getversions'));
	}


	/**
	* Method killServer
	* No Arguments	
	* 	
	*/
	public function killServer () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'killserver'));
	}


	/**
	* Method logout
	* No Arguments	
	* 	
	*/
	public function logout () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'logout'));
	}


	/**
	* Method reload
	* No Arguments	
	* 	
	*/
	public function reload () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'reload'));
	}


	/**
	* Method removeGroupValue
	* Group	Type	Value	
	* String	String	String	
	*/
	public function removeGroupValue ($group, $type, $value) {
	$this->ensureLoggedIn();

	if(!$group || !$type || !$value) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'removegroupvalue' , 'group' => $group, 'type' => $type, 'value' => $value));
	}


	/**
	* Method restartServer
	* No Arguments	
	* 	
	*/
	public function restartServer () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'restartserver'));
	}


	/**
	* Method restoreBackup
	* Index	
	* Int32	
	*/
	public function restoreBackup ($index) {
	$this->ensureLoggedIn();

	if(!$index) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'restorebackup' , 'index' => $index));
	}


	/**
	* Method runScheduleItem
	* Index	
	* Int32	
	*/
	public function runScheduleItem ($index) {
	$this->ensureLoggedIn();

	if(!$index) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'runscheduleitem' , 'index' => $index));
	}


	/**
	* Method scanPlugins
	* No Arguments	
	* 	
	*/
	public function scanPlugins () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'scanplugins'));
	}


	/**
	* Method sendChat
	* Message	
	* String	
	*/
	public function sendChat ($message) {
	$this->ensureLoggedIn();

	if(!$message) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'sendchat' , 'message' => $message));
	}


	/**
	* Method setConfig
	* Key	Value	
	* String	String	
	*/
	public function setConfig ($key, $value) {
	$this->ensureLoggedIn();

	if(!$key || !$value) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'setconfig' , 'key' => $key, 'value' => $value));
	}


	/**
	* Method setGroupDefaults
	* No Arguments	
	* 	
	*/
	public function setGroupDefaults () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'setgroupdefaults'));
	}


	/**
	* Method setMCMAUserAuthMask
	* User	Mask	
	* String	UInt64	
	*/
	public function setMCMAUserAuthMask ($user, $mask) {
	$this->ensureLoggedIn();

	if(!$user || !$mask) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'setmcmauserauthmask' , 'user' => $user, 'mask' => $mask));
	}


	/**
	* Method setMCMAUserSettingMask
	* User	Mask	
	* String	UInt32	
	*/
	public function setMCMAUserSettingMask ($user, $mask) {
	$this->ensureLoggedIn();

	if(!$user || !$mask) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'setmcmausersettingmask' , 'user' => $user, 'mask' => $mask));
	}


	/**
	* Method setPluginState
	* Plugin	State	
	* String	Boolean	
	*/
	public function setPluginState ($plugin, $state) {
	$this->ensureLoggedIn();

	if(!$plugin || !$state) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'setpluginstate' , 'plugin' => $plugin, 'state' => $state));
	}


	/**
	* Method setScheduleDefaults
	* No Arguments	
	* 	
	*/
	public function setScheduleDefaults () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'setscheduledefaults'));
	}


	/**
	* Method startServer
	* No Arguments	
	* 	
	*/
	public function startServer () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'startserver'));
	}


	/**
	* Method stopServer
	* No Arguments	
	* 	
	*/
	public function stopServer () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'stopserver'));
	}


	/**
	* Method unsetMCMAUserAuthMask
	* User	Mask	
	* String	UInt64	
	*/
	public function unsetMCMAUserAuthMask ($user, $mask) {
	$this->ensureLoggedIn();

	if(!$user || !$mask) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'unsetmcmauserauthmask' , 'user' => $user, 'mask' => $mask));
	}


	/**
	* Method unsetMCMAUserSettingMask
	* User	Mask	
	* String	UInt32	
	*/
	public function unsetMCMAUserSettingMask ($user, $mask) {
	$this->ensureLoggedIn();

	if(!$user || !$mask) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'unsetmcmausersettingmask' , 'user' => $user, 'mask' => $mask));
	}


	/**
	* Method updateMC
	* No Arguments	
	* 	
	*/
	public function updateMC () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'updatemc'));
	}


	/**
	* Method updateMCMA
	* No Arguments	
	* 	
	*/
	public function updateMCMA () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'updatemcma'));
	}

	/**
	* Method Login - Used to login to the McMyAdmin server with the supplied details.
	* User		Pass 	Host	Port
	* String	String	String	String
	*/
	public function login($user = 'admin',$pass = '',$host = 'localhost',$port = '8080') {

		if(!empty($user) && !empty($pass) && !empty($host) && !empty($port)) {
			$this->config['user'] = $user;
			$this->config['pass'] = $pass;
			$this->config['host'] = $host;
			$this->config['port'] = $port;

			$request = $this->request(array('req'=>'login', 'username'=>$user, 'password'=>$pass));
			
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
	* Method getLoggedIn
	* This allows a method to see if user is logged in or not.
	*/
	private function ensureLoggedIn() {
		if($this->logged_in == false) {
			throw new Exception('Not logged into McMyAdmin');
		}
	}
	
	/**
	* Method getPlayers()
	* returns PlayerList
	*/
    public function getPlayers() {
    $this->ensureLoggedIn();
		$request = $this->getStatus();
        $playerlist = array();

        if($request->userinfo) {
	        foreach($request->userinfo as $user => $values) {
       	    	$playerlist[] = $user;
            }
        }
		
    	return $playerlist;
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
		
		$data = json_decode($data);
		
		if(isset($data->status)) {
			if($data->status == '200')
				unset($data->status);
		}
		
		if(count((array)$data) == 1){ // If there is only 1 key, return it rather than use the $mcmyadmin->method()->key
				return current((array)$data);
		}
		
	return $data;
	}
}