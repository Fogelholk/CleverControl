<?php
if($_GET['type'] === "devices" && file_exists("tdtool-devices.txt")){
	$file = file_get_contents("tdtool-devices.txt"); //Created with "tdtool --list-devices > tdtool-devices.txt"
	$rows = array_filter(explode("\n",$file));
	foreach($rows as $row => $data){
		$new_data = explode("\t",$data);
		$roomdevice = explode(";",$new_data[2]); //I have my config set up like "Livingroom;Window;Dimmable", used here to split into Room;Device;Dimmable
		$did = str_replace("id=","",$new_data[1]);
		if(is_numeric($did)){
			$droom = str_replace("name=","",$roomdevice[0]);
			$ddevice = $roomdevice[1];
			$dstatus = str_replace("lastsentcommand=","",$new_data[3]);
			if($dstatus === "DIMMED"){
				$dlevel = str_replace("dimlevel=","",$new_data[4]);
			} else {
				$dlevel = 0;
			}
			if($roomdevice[2] === "Dimmable"){
				$ddimmable = 1;
			} else {
				$ddimmable = 0;
			}
			$devices[$did] = array("room" => $droom, "device" => $ddevice, "status" => $dstatus, "id" => $did, "dimlevel" => $dlevel, "dimmable" => $ddimmable); //Gets devices
		}
	}
	asort($devices); //Sort by Room
	foreach($devices as $thing){
		if($thing[room] !== $lastdevice){
			echo "<div class='title'>".$thing[room]."</div>";
		}
		switch($thing[status]){
			case "ON": //Device is ON
				$action = "off";
				$color = "green";
			break;
			case "OFF": //Device is OFF
				$action = "on";
				$color = "red";
			break;
			case "DIMMED": //Device is DIMMED)
				$action = "off";
				$color = "orange";
			break;
			default: //Device is unknown status;
				$action = "#";
				$color = "orange";
			break;
		}
		echo "<button name='".$thing[id]."' value='".$action."' class='control'><div class='circle".$color."' ></div> ".$thing[device]."</button>";
		if($thing[dimmable] == 1){
			echo "<input type='range' name='".$thing[id]."' min='0' max='255' value='".$thing[dimlevel]."' class='dimrange' data-name='".$thing[device]."' />";
		}
		$lastdevice = $thing[room];
	}
} elseif($_GET['type'] === "devices" && !file_exists("tdtool-devices.txt")) {
	echo "tdtool-devices.txt does not exist!";
}
if ($_GET['type'] === "sensors" && file_exists("tdtool-sensors.txt")){
	$printsensors = array(); //Set sensors to be included on the page ID => Location/Name (Example: 163 => "Outside")
	if(!empty($printsensors)){
		echo "<div class='title'>Sensors</div>";
		$file = file_get_contents("tdtool-sensors.txt"); //Created with "tdtool --list-sensors > tdtool-sensors.txt"
		$rows = array_filter(explode("\n",$file));
		foreach($rows as $row => $data){
			$new_data = explode("\t",$data);
			$sid = str_replace("id=","",$new_data[3]);
			$stemp = str_replace("temperature=","",$new_data[4]);
			$supdate = str_replace("time=","",$new_data[5]);
			$sensors[$sid] = array("id" => $sid, "temperature" => $stemp."&deg;C", "lastupdate" => $supdate);
		}
		foreach($printsensors as $sensorid => $placement){
			if(is_numeric($sensorid)){
				echo "<span class='control sensors'>".$placement.": ".$sensors[$sensorid][temperature]." @ ".$sensors[$sensorid][lastupdate]."</span>";
			}
		}
	}
} elseif($_GET['type'] === "sensors" && !file_exists("tdtool-sensors.txt")) {
	echo "tdtool-sensors.txt does not exist!";
}
?>
