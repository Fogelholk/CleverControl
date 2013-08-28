<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
		<title>CleverControl</title>
		<link href="stylesheet.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
		<script>
			var auto_refresh = setInterval(
			function()
			{
			$('.wrapper').load('control.php');
			}, 6000);
		</script>
	</head>
	<body>
		<div class='wrapper'>
			<?php include_once("control.php"); ?>
		</div>
	</body>
</html>
