<?php
if(file_exists("tdtool.txt")){
	$file = file_get_contents("tdtool.txt"); //read from "tdtool --list > tdtool.txt"
	$rows = array_filter(explode("\n",$file));
	$printsensors = array(); //Set sensors (fineoffset) to be included on the page ID => Location/Name (Example: 163 => "Outside")
	array_shift($rows);
	foreach($rows as $row => $data){
		$new_data = explode("\t",$data);
		
		$roomdevice = explode(";",$new_data[1]); //I have my config set up like "Livingroom;Window", used here to split into Room and Device
		if(is_numeric($new_data[0])){
			$devices[$new_data[0]] = array("room" => $roomdevice[0], "device" => $roomdevice[1], "status" => $new_data[2], "id" => $new_data[0]); //Gets devices
		} elseif(strstr($new_data[0], 'fineoffset') && date("Y-m-d H:i:s",strtotime('-1 day')) < $new_data[5]){
			$sensors[trim($new_data[2])] = array("id" => $new_data[2], "temperature" => $new_data[3], "lastupdate" => $new_data[5]); //Gets sensors (fineoffset)
		}
	asort($devices); //Sort by Room
	}
	foreach($devices as $thing){
		if($thing[room] !== $lastdevice){
			echo "<div class='title'>".$thing[room]."</div>";
		}
		
		if($thing[status] === "ON"){ //Device is ON
			$action = "off";
			$color = "green";
		} elseif($thing[status] === "OFF"){ //Device is OFF
			$action = "on";
			$color = "red";
		} else { //Device is neither ON nor OFF
			$action = "#";
			$color = "orange";
		}
		echo "<button name='".$thing[id]."' value='".$action."' class='control'><div class='circle".$color."' ></div> ".$thing[device]."</button>";
		$lastdevice = $thing[room];
	}
	if(!empty($printsensors)){
		echo "<div class='title'>Sensors</div>";
		foreach($printsensors as $sensorid => $placement){
			if(is_numeric($sensorid)){
				echo "<span class='control'>".$placement.": ".$sensors[$sensorid][temperature]." @ ".$sensors[$sensorid][lastupdate]."</span>";
			}
		}
	}
	echo "<div id='alert'>Ponies!</div>"; //Preload the Div for actions with something otherwise is "lags", why not ponies?
?>
<script>
$('#alert').hide();
$( "button" ).click(function() {
	$.get("action.php",{action: this.value, switch: this.name});
//	clearInterval(auto_refresh); //to be fixed.. Stop auto_refresh while animation is going on and resume when animation is done
	$('#alert').slideDown('fast').html($(this).text() + " turned " + this.value).delay(1500).slideUp('slow');
});
</script>
<?php
} else {
	echo "tdtool.txt does not exist!";
}
?>
