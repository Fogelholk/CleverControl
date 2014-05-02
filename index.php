<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
		<title>CleverControl</title>
		<link href="stylesheet.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="jquery-2.1.0.min.js"></script>
		<script>
		$.ajaxSetup({timeout:2000});
		var buttons;
		function loadButtons() {
			$.get("control.php", { type: "buttons" }, function(data) {
				$("#buttons").html(data);
			});
		}
		function loadSensors() {
			$.get("control.php", { type: "sensors" }, function(data) {
				$("#sensors").html(data);
			});
		}
		function loadAlert() {
			$('#alert').hide();
			$("#buttons").on('click', 'button', function() {
				$.get("action.php",{action: this.value, switch: this.name});
				$('#alert').slideDown('fast').html($(this).text() + " turned " + this.value).delay(1500).slideUp('slow');
			});
		}
		$(function() {
			loadButtons();
			loadSensors();
			setInterval(loadButtons,3000);
			setInterval(loadSensors,5000);
			loadAlert();
		});
		</script>
	</head>
	<body>
		<div class='wrapper'>
			<div id='buttons'></div>
			<div id='sensors'></div>
			<div id='alert'>Ponies!</div>
		</div>
	</body>
</html>
