<?php

$welcome = 'You\'ve been registered. <a href="index.php">Click to login</a>';

?>

<html>
<head>
<title>Quick Notes</title>

<meta charset="utf-8">
<link rel="stylesheet" href="project5.css">
<link rel="icon" href="favicon.png" type="image">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div id="container">
	<div id="header_bar">
	QUICK NOTES	
	</div>
	<div id="content1">
		<div id="box">
			<span id="error"><?php echo $welcome; ?></span>
		</div>	
	</div>
	<div style="background-image: url('desk1.png'); background-repeat: no-repeat; height: 550px; width: 100%;">
	</div>
	<div id="copyright">
	Made with <i class="material-icons" style="color: red;">favorite</i> and <i class="fa fa-code" aria-hidden="true"></i>
	by Neelanjan Akuli © 2017
	</div>
</div>
</body>
</html>