<?php
class Core extends Conn {
	public function setView($v = null) {
		$view = "home.php";
		if ($v) {
			$url = explode ( "/", $v );
			$file_include = strtolower ( preg_replace ( '/[^a-zA-Z0-9-]/', '', $url [1] ) );
			
			if (is_file ( stream_resolve_include_path ( "./views/" . $file_include . ".php" ) )) {
				$view = $file_include . ".php";
			}
		}
		
		return $view;
	}
	public function getOS() {
		$user_agent = $_SERVER ['HTTP_USER_AGENT'];
		$os_platform = "Unknown OS Platform";
		$os_array = array (
				'/windows nt 10/i' => 'Windows 10',
				'/windows nt 6.3/i' => 'Windows 8.1',
				'/windows nt 6.2/i' => 'Windows 8',
				'/windows nt 6.1/i' => 'Windows 7',
				'/windows nt 6.0/i' => 'Windows Vista',
				'/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
				'/windows nt 5.1/i' => 'Windows XP',
				'/windows xp/i' => 'Windows XP',
				'/windows nt 5.0/i' => 'Windows 2000',
				'/windows me/i' => 'Windows ME',
				'/win98/i' => 'Windows 98',
				'/win95/i' => 'Windows 95',
				'/win16/i' => 'Windows 3.11',
				'/macintosh|mac os x/i' => 'Mac OS X',
				'/mac_powerpc/i' => 'Mac OS 9',
				'/linux/i' => 'Linux',
				'/ubuntu/i' => 'Ubuntu',
				'/iphone/i' => 'iPhone',
				'/ipod/i' => 'iPod',
				'/ipad/i' => 'iPad',
				'/android/i' => 'Android',
				'/blackberry/i' => 'BlackBerry',
				'/webos/i' => 'Mobile' 
		);
		
		foreach ( $os_array as $regex => $value )
			if (preg_match ( $regex, $user_agent ))
				$os_platform = $value;
		
		return $os_platform;
	}
	public function getBrowser() {
		$user_agent = $_SERVER ['HTTP_USER_AGENT'];
		$browser = "Unknown Browser";
		$browser_array = array (
				'/msie/i' => 'Internet Explorer',
				'/firefox/i' => 'Firefox',
				'/safari/i' => 'Safari',
				'/chrome/i' => 'Chrome',
				'/edge/i' => 'Edge',
				'/opera/i' => 'Opera',
				'/netscape/i' => 'Netscape',
				'/maxthon/i' => 'Maxthon',
				'/konqueror/i' => 'Konqueror',
				'/mobile/i' => 'Handheld Browser' 
		);
		
		foreach ( $browser_array as $regex => $value )
			if (preg_match ( $regex, $user_agent ))
				$browser = $value;
		
		return $browser;
	}
	public function getClientLanguage() {
		$language = explode ( ";", $_SERVER ['HTTP_ACCEPT_LANGUAGE'] );
		return $language [0];
	}
	public function exist($c) {
		try {
			if (isset ( $c ) && empty ( $c ) == false && strlen ( $c ) > 0) {
				return true;
			} else {
				return false;
			}
		} catch ( Error $e ) {
			return false;
		}
	}
	public function limpa($v) {
		if (strlen ( $v ) > 0) {
			$v = preg_replace ( "/[^A-Za-z0-9 @.-_+]/", '', $v );
			return trim ( $v );
		} else
			return "";
	}
	public function redirectTo($url){
		if($url){
			echo '<script type="text/javascript">window.location="'.strip_tags($url).'";</script>';
		}
		return null;
	}
	// http://br.php.net/manual/pt_BR/function.preg-replace.php#90316
	public function CleanFileName( $Raw ){
		$Raw	=	trim($Raw);
		$RemoveChars	=	array( "([\40])" , "([^a-zA-Z0-9-])", "(-{2,})" );
		$ReplaceWith	=	array("");
		return preg_replace($RemoveChars, $ReplaceWith, $Raw);
	}
	public function normalizaUrl($palavra) {
        $retorno  = str_replace('"','',$palavra);
        $retorno  = str_replace('/','',$retorno);
		$retorno	=	trim(preg_replace("[^a-zA-Z0-9_-]", "", strtr($retorno, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC-")));
        $retorno = $this->CleanFileName($retorno);
		//return utf8_encode($retorno);
		return strtolower(urlencode($retorno));
	}
	
}
?>