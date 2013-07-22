<?php
/***********************************
* McMyAdmin PHP API class.
* Author: Alan Farquharson
* Version: 0.5 - (McMyAdmin V:2.4.3.4)
***********************************/

class McMyAdmin {

	protected $response;
	protected $config = array();
	protected $logged_in = false;
    protected $session_id = null;

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
	* Method getBukgetPluginInfo
	* PluginName	
	* String	
	*/
	public function getBukgetPluginInfo ($pluginname) {
	$this->ensureLoggedIn();

	if(!$pluginname) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'getbukgetplugininfo' , 'pluginname' => $pluginname));
	}

	/**
	* Method getTokenAuth
	* Username	
	* String	
	*/
	public function getTokenAuth ($username) {
	$this->ensureLoggedIn();

	if(!$username) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'gettokenauth' , 'username' => $username));
	}

	/**
	* Method searchBukgetByName
	* Name	
	* String	
	*/
	public function searchBukgetByName ($name) {
	$this->ensureLoggedIn();

	if(!$name) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'searchbukgetbyname' , 'name' => $name));
	}

	/**
	* Method uploadBackup
	* No Arguments	
	* 	
	*/
	public function uploadBackup () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'uploadbackup'));
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

			$request = $this->request(array('req'=>'login', 'Username'=>$user, 'Password'=>$pass));

            if (isset($request->MCMASESSIONID)) {
                $this->session_id = $request->MCMASESSIONID;
            }

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
		
        if(isset($request->userinfo)) {
	        foreach($request->userinfo as $user => $values) {
       	    	$playerlist[] = $user;
            }
        }
		
    	return $playerlist;
	}
        
    /**
	* Method downloadPluginFromURL
	* URL	
	* String	
	*/
	public function downloadPluginFromURL ($url) {
	$this->ensureLoggedIn();

	if(!$url) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'downloadpluginfromurl' , 'url' => $url));
	}

	/**
	* Method getBukgetCategories
	* No Arguments	
	* 	
	*/
	public function getBukgetCategories () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'getbukgetcategories'));
	}

	/**
	* Method getExtensions
	* No Arguments	
	* 	
	*/
	public function getExtensions () {
	$this->ensureLoggedIn();

	return $this->request(array('req' => 'getextensions'));
	}

	/**
	* Method renameGroup
	* Group	NewName	
	* String	String	
	*/
	public function renameGroup ($group, $newname) {
	$this->ensureLoggedIn();

	if(!$group || !$newname) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'renamegroup' , 'group' => $group, 'newname' => $newname));
	}
        
        	/**
	* Method downloadBukgetPlugin
	* PluginName	
	* String	
	*/
	public function downloadBukgetPlugin ($pluginname) {
	$this->ensureLoggedIn();

	if(!$pluginname) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'downloadbukgetplugin' , 'pluginname' => $pluginname));
	}

	/**
	* Method emcSetConfig
	* Key	Value	
	* String	String	
	*/
	public function emcSetConfig ($key, $value) {
	$this->ensureLoggedIn();

	if(!$key || !$value) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'emcsetconfig' , 'key' => $key, 'value' => $value));
	}

	/**
	* Method getBukgetPluginsInCategory
	* CategoryName	Start	
	* String	Int32	
	*/
	public function getBukgetPluginsInCategory ($categoryname, $start) {
	$this->ensureLoggedIn();

	if(!$categoryname || !$start) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'getbukgetpluginsincategory' , 'categoryname' => $categoryname, 'start' => $start));
	}
        
	/**
	* Method searchBukget
	* Query	
	* String	
	*/
	public function searchBukget ($query) {
	$this->ensureLoggedIn();

	if(!$query) {
		throw new Exception('Invalid arguments');
	}

	return $this->request(array('req' => 'searchbukget' , 'query' => $query));
	}

	/**
	* Method sleepServer
	* No Arguments	
	* 	
	*/
	public function sleepServer () {
	$this->ensureLoggedIn();

	    return $this->request(array('req' => 'sleepserver'));
	}

    /**
     * Method createGroup
     * Name
     * String
     */
    public function createGroup ($name) {
        $this->ensureLoggedIn();

        if(!$name) {
            throw new Exception('Invalid arguments');
        }

        return $this->request(array('req' => 'creategroup' , 'name' => $name));
    }

    /**
     * Method deleteGroup
     * Name
     * String
     */
    public function deleteGroup ($name) {
        $this->ensureLoggedIn();

        if(!$name) {
            throw new Exception('Invalid arguments');
        }

        return $this->request(array('req' => 'deletegroup' , 'name' => $name));
    }

    /**
     * Method deleteLegacyBackup
     * Index
     * Int32
     */
    public function deleteLegacyBackup ($index) {
        $this->ensureLoggedIn();

        if(!$index) {
            throw new Exception('Invalid arguments');
        }

        return $this->request(array('req' => 'deletelegacybackup' , 'index' => $index));
    }

    /**
     * Method getBackups
     * No Arguments
     *
     */
    public function getBackups () {
        $this->ensureLoggedIn();

        return $this->request(array('req' => 'getbackups'));
    }

    /**
     * Method getLegacyBackupList
     * No Arguments
     *
     */
    public function getLegacyBackupList () {
        $this->ensureLoggedIn();

        return $this->request(array('req' => 'getlegacybackuplist'));
    }

    /**
     * Method getLegacyRestoreStatus
     * No Arguments
     *
     */
    public function getLegacyRestoreStatus () {
        $this->ensureLoggedIn();

        return $this->request(array('req' => 'getlegacyrestorestatus'));
    }

    /**
     * Method getRAS
     * No Arguments
     *
     */
    public function getRAS () {
        $this->ensureLoggedIn();

        return $this->request(array('req' => 'getras'));
    }

    /**
     * Method getWorlds
     * No Arguments
     *
     */
    public function getWorlds () {
        $this->ensureLoggedIn();

        return $this->request(array('req' => 'getworlds'));
    }

    /**
     * Method restoreLegacyBackup
     * Index
     * Int32
     */
    public function restoreLegacyBackup ($index) {
        $this->ensureLoggedIn();

        if(!$index) {
            throw new Exception('Invalid arguments');
        }

        return $this->request(array('req' => 'restorelegacybackup' , 'index' => $index));
    }

    /**
     * Method scanWorlds
     * No Arguments
     *
     */
    public function scanWorlds () {
        $this->ensureLoggedIn();

        return $this->request(array('req' => 'scanworlds'));
    }

    /**
     * Method sendRASconfigChange
     * key	value
     * String	String
     */
    public function sendRASconfigChange ($key, $value) {
        $this->ensureLoggedIn();

        if(!$key || !$value) {
            throw new Exception('Invalid arguments');
        }

        return $this->request(array('req' => 'sendrasconfigchange' , 'key' => $key, 'value' => $value));
    }

    /**
     * Method sendRAScursor
     * x	y
     * Int32	Int32
     */
    public function sendRAScursor ($x, $y) {
        $this->ensureLoggedIn();

        if(!$x || !$y) {
            throw new Exception('Invalid arguments');
        }

        return $this->request(array('req' => 'sendrascursor' , 'x' => $x, 'y' => $y));
    }

    /**
     * Method sendRASviewChange
     * view
     * String
     */
    public function sendRASviewChange ($view) {
        $this->ensureLoggedIn();

        if(!$view) {
            throw new Exception('Invalid arguments');
        }

        return $this->request(array('req' => 'sendrasviewchange' , 'view' => $view));
    }

    /**
     * Method setWorldBackup
     * WorldID	Included
     * String	Boolean
     */
    public function setWorldBackup ($worldid, $included) {
        $this->ensureLoggedIn();

        if(!$worldid || !$included) {
            throw new Exception('Invalid arguments');
        }

        return $this->request(array('req' => 'setworldbackup' , 'worldid' => $worldid, 'included' => $included));
    }

    /**
     * Method takeBackup
     * Label	IncludePermissions	IncludePlugins	IncludeConfig	IncludeServer	IncludeWorlds
     * String	Boolean	Boolean	Boolean	Boolean	Boolean (Optional - default value is 'True')
     */
    public function takeBackup ($label, $includepermissions, $includeplugins, $includeconfig, $includeserver, $includeworlds) {
        $this->ensureLoggedIn();

        if(!$label || !$includepermissions || !$includeplugins || !$includeconfig || !$includeserver || !$includeworlds) {
            throw new Exception('Invalid arguments');
        }

        return $this->request(array('req' => 'takebackup' , 'label' => $label, 'includepermissions' => $includepermissions, 'includeplugins' => $includeplugins, 'includeconfig' => $includeconfig, 'includeserver' => $includeserver, 'includeworlds' => $includeworlds));
    }

    /**v
	* Method request
	* This allows a method to send a request to the McMyAdmin data source.
	*/
	private function request($args = array()) {
		if(empty($this->config['host']) || empty($this->config['port'])) {
			throw new Exception('No host or port has been given');
		}

        if (isset($this->session_id)) {
          $args['MCMASESSIONID'] = $this->session_id;
        } else {
           $args['Token'] = '';
        }

        $param = '';

		if(!empty($args)) {
			$param = http_build_query($args);
		}
		
		if(!file_exists('cookie.txt')) {
				if(!touch('cookie.txt')) { // You might have to do this yourself.
					throw new Exception('Please create a file named "cookie.txt" and chown it to the webserver and chmod it to 755 (Or alternatively 777 as a last case)');
				}
				chmod('cookie.txt','777');
		}
		
		$url = 'http://' . $this->config['host'] . ':' . $this->config['port'] . '/data.json?' . $param;
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
		
	return $data;
	}
}