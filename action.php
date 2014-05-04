<?php
	if(is_numeric($_GET['switch'])){
		$switch = escapeshellcmd($_GET['switch']);
		
		switch ($_GET['action']) {
			case "off":
			$action = "f";
			break;
			
			case "on":
			$action = "n";
			break;
			
			case "dim":
			if(is_numeric($_GET['dimlevel'])){
				$dimlevel = escapeshellcmd($_GET['dimlevel']);
			}
			$action = "v ".$dimlevel." -d";
			break;
		}
		exec("tdtool -".$action." ".$switch." && tdtool --list-devices > tdtool-devices-new.txt && mv tdtool-devices-new.txt tdtool-devices.txt");
	}
?>
