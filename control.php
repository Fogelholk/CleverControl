<?php
if(file_exists("tdtool.txt")){
	$file = file_get_contents("tdtool.txt"); //Created with "tdtool --list > tdtool.txt"
	$rows = array_filter(explode("\n",$file));
	array_shift($rows);
	foreach($rows as $row => $data){
		$new_data = explode("\t",$data);
		$roomdevice = explode(";",$new_data[1]); //I have my config set up like "Livingroom;Window", used here to split into Room and Device
		if(is_numeric($new_data[0])){
			$devices[$new_data[0]] = array("room" => $roomdevice[0], "device" => $roomdevice[1], "status" => $new_data[2], "id" => $new_data[0]); //Gets devices
		} elseif(strstr($new_data[0], 'fineoffset') && date("Y-m-d H:i:s",strtotime('-1 day')) < $new_data[7]){
			$sensors[trim($new_data[2])] = array("id" => $new_data[2], "temperature" => $new_data[3], "lastupdate" => $new_data[7]); //Gets sensors (fineoffset)
		}
		asort($devices); //Sort by Room
	}
	switch ($_GET['type']){
		case "buttons":
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
					case "DIMMED:255": //Device dimmed to max
						$action = "off";
						$color = "green";
					break;
					case "DIMMED:175": //Device dimmed to "half" (in my opinion)
						$action = "off";
						$color = "orange";
					break;
					default: //Device is unknown status;
						$action = "#";
						$color = "orange";
					break;
				}
				echo "<button name='".$thing[id]."' value='".$action."' class='control'><div class='circle".$color."' ></div> ".$thing[device]."</button>";
				$lastdevice = $thing[room];
			}
		break;
		case "sensors":
			$printsensors = array(); //Set sensors (fineoffset) to be included on the page ID => Location/Name (Example: 163 => "Outside")
			if(!empty($printsensors)){
				echo "<div class='title'>Sensors</div>";
				foreach($printsensors as $sensorid => $placement){
					if(is_numeric($sensorid)){
						echo "<span class='control sensors'>".$placement.": ".$sensors[$sensorid][temperature]." @ ".$sensors[$sensorid][lastupdate]."</span>";
					}
				}
			}
		break;
	}
} else {
	echo "tdtool.txt does not exist!";
}
?>
