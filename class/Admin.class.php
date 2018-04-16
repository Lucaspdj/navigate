<?php
class Admin {
	public $path = "/admin/";
	
	public function go($page){
		header("Location: ".$this->path."?admin=".$page);
	}
	
	public function setView($v = null) {
		$view = "login.php";
		if ($v) {
			$file_include = strtolower ( preg_replace ( '/[^a-zA-Z0-9-]/', '', $v ) );
			if (is_file ( stream_resolve_include_path ( "../_admin/views/" . $file_include . ".php" ) )) {
				if((isset($_SESSION['login_admin'])) && $_SESSION['login_admin'] == 'OK'){
					$view = $file_include . ".php";
				}
			}
		}
		
		return $view;
	}
	
	public function login($user, $pass){
		global $core;
		if($core->exist($user) && $core->exist($pass)){
			$user = strip_tags(addslashes($user));
			$pass = strip_tags(addslashes($pass));
			
			$getPassword = $core->Select("adm_user", array(
    				"user" => $user
				), "password", 1);
    		
			if($getPassword->num_rows > 0){
				$senha = $getPassword->fetch_assoc();
				if($senha['password'] === md5($pass)){
					return true;
				}
			}
		}
		return false;
	}
	
	public function updateSiteConfig($data){
		try{
			global $core;
			if(is_array($data)){
				unset($data["action"]);
				foreach($data as $config=>$value){
					$check = $core->Select("site_config", array(
						"name" => strip_tags($config)
					), "*", 1);
					
					if($check->num_rows > 0){
						$core->Update("site_config",
							array( // set
								"value" => strip_tags($value)
							),
							array( // where
								"name" => $config
						));
					}
					else{
						$core->Insert("site_config", array(
							"name" => strip_tags($config),
							"value" => strip_tags($value)
						));
					}
				}
				return true;
			}
			return false;
		}
		catch(Error $e){
			return false;
		}
	}
}
?>