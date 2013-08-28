<?php
	if(($_GET['action'] === "off" || $_GET['action'] === "on") && is_numeric($_GET['switch'])){
		exec("tdtool --".$_GET['action']." ".$_GET['switch']." && tdtool --list > tdtool-new.txt && mv tdtool-new.txt tdtool.txt");
	}
?>
