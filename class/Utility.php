<?php

class Utility {

	/* Generations */
	public static function generateToken($length, $chars) {
		$clen = strlen($chars);
		$str = '';
		for ($i = 0; $i < $length; $i++) {
			$str .= $chars[rand(0, $clen - 1)];
		}
		return $str;
	}

	public static function generateSessionToken() {
		return Utility::generateToken(CONFIG['token_session_length'], CONFIG['token_session_chars']);
	}
	/* Generations */



	/* Escape */
	public static function escapeXSS($str) {
		return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
	}
	/* Escape */



	/* String Utility */
	public static function startsWith($str, $check) {
		return substr($str, 0, strlen($check)) === $check;
	}

	public static function endsWith($str, $check) {
		if ($check === '') return true;
		return substr($str, -strlen($check)) === $check;
	}

	public static function replaceFirst($from, $to, $content) {
	    $from = '/' . preg_quote($from, '/') . '/';
	    return preg_replace($from, $to, $content, 1);
	}
	/* String Utility */



	/* Access ID */
	private static $sessionID = null;

	public static function getSessionID() {
		if (self::$sessionID != null) return self::$sessionID;
		if (AuthManager::isLoggedIn()) {
			self::$sessionID = uniqid(AuthManager::getCurrentUser()->getID() . '-', true);
		} else {
			self::$sessionID = uniqid('guest-', true);
		}
		return self::$sessionID;
	}
	/* Access ID */



	/* Browser */
	private static $browser = null;
	public static function getBrowser() {
		if (self::$browser != null) return self::$browser;
	    $u_agent = $_SERVER['HTTP_USER_AGENT'];
	    $bname = 'Unknown';
	    $platform = 'Unknown';
	    $version= '';

	    //First get the platform?
	    if (preg_match('/linux/i', $u_agent)) {
	        $platform = 'Linux';
	    } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
	        $platform = 'Macintosh / Mac OS X';
	    } elseif (preg_match('/windows|win32/i', $u_agent)) {
	        $platform = 'Windows';
	    }

	    $matches = [];

	    // Next get the name of the useragent yes seperately and for good reason
	    if (preg_match('/MSIE/i' , $u_agent, $matches) && !preg_match('/Opera/i', $u_agent, $matches)) {
	        $bname = 'Internet Explorer';
	        $ub = 'MSIE';
	    } elseif (preg_match('/Firefox/i', $u_agent, $matches)) {
	        $bname = 'Mozilla Firefox';
	        $ub = 'Firefox';
	    } elseif (preg_match('/Chrome/i', $u_agent, $matches)) {
	        $bname = 'Google Chrome';
	        $ub = 'Chrome';
	    } elseif (preg_match('/Safari/i', $u_agent, $matches)) {
	        $bname = 'Apple Safari';
	        $ub = 'Safari';
	    } elseif (preg_match('/Opera/i', $u_agent, $matches)) {
	        $bname = 'Opera';
	        $ub = 'Opera';
	    } elseif (preg_match('/Netscape/i', $u_agent, $matches)) {
	        $bname = 'Netscape';
	        $ub = 'Netscape';
	    } else {
            $bname = 'Unknown';
            $ub = 'Unknown';
        }

	    // finally get the correct version number
	    $known = array('Version', $ub, 'other');
	    $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	    // if (!preg_match_all($pattern, $u_agent, $matches)) {
	    //     // we have no matching number just continue
	    // }

	    // see how many we have
	    $i = count($matches['browser']);
	    if ($i != 1) {
	        //we will have two since we are not using 'other' argument yet
	        //see if version is before or after the name
	        if (strripos($u_agent, 'Version') < strripos($u_agent, $ub)) {
	            $version = $matches['version'][0];
	        } else {
	            $version = $matches['version'][1];
	        }
	    } else {
	        $version = $matches['version'][0];
	    }

	    // check if we have a number
		if ($version == null || $version == '') $version = '?';

		$data = new stdClass();
		$data->UserAgent = $u_agent;
		$data->Name = $bname;
		$data->Version = $version;
		$data->Platform = $platform;
		$data->Pattern = $pattern;
		self::$browser = $data;
		return $data;
	}
	/* Browser */



	/* Show Status Page */
	public static function showStatus($code, $name='', $message='') {
		include_once(__DIR__ . '/../resources/data/StatusCodes.php');
		$type = 'custom';
		if (isset(STATUS_CODES[$code])) {
			if (!$name) $name = STATUS_CODES[$code]['name'];
			if (!$message) $message = STATUS_CODES[$code]['message'];
			$type = STATUS_CODES[$code]['type'];
		}

		switch ($type) {
			case 'informational':
				self::showInformationalStatus($code, $name, $message);
				break;

			case 'success':
				self::showSuccessStatus($code, $name, $message);
				break;

			case 'redirection':
				self::showRedirectionStatus($code, $name, $message);
				break;

			case 'client_error':
				self::showClientErrorStatus($code, $name, $message);
				break;

			case 'server_error':
				self::showServerErrorStatus($code, $name, $message);
				break;

			default:
				self::showCustomStatus($code, $name, $message);
				break;
		}
	}

	private static function formatStatusPage($code, $name, $message, $content) {
		$content = str_replace('{code}', $code, $content);
		$content = str_replace('{name}', $name, $content);
		$content = str_replace('{message}', $message, $content);
		return $content;
	}

	public static function showInformationalStatus($code, $name, $message) {
		$content = file_get_contents(__DIR__ . '/../resources/status/informational.html');
		echo self::formatStatusPage($code, $name, $message, $content);
	}

	public static function showSuccessStatus($code, $name, $message) {
		$content = file_get_contents(__DIR__ . '/../resources/status/success.html');
		echo self::formatStatusPage($code, $name, $message, $content);
	}

	public static function showRedirectionStatus($code, $name, $message) {
		$content = file_get_contents(__DIR__ . '/../resources/status/redirection.html');
		echo self::formatStatusPage($code, $name, $message, $content);
	}

	public static function showClientErrorStatus($code, $name, $message) {
		$content = file_get_contents(__DIR__ . '/../resources/status/client_error.html');
		echo self::formatStatusPage($code, $name, $message, $content);
	}

	public static function showServerErrorStatus($code, $name, $message) {
		$content = file_get_contents(__DIR__ . '/../resources/status/server_error.html');
		echo self::formatStatusPage($code, $name, $message, $content);
	}

	public static function showCustomStatus($code, $name, $message) {
		$content = file_get_contents(__DIR__ . '/../resources/status/custom.html');
		echo self::formatStatusPage($code, $name, $message, $content);
	}
	/* Show Status Page */

}
