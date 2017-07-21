<?php
$invalid_login = "";
if (isset($_POST['username']) && isset($_POST['password'])){
	$username = $_POST['username'];
	$password = ($_POST['password']);
	
	
	if(!empty($username) && !empty($password)){
		$query = "SELECT `id` FROM `users` WHERE `username` = '".mysql_real_escape_string($username)."' AND `password` = '".mysql_real_escape_string($password)."'";
		
		if($query_run = mysql_query($query)){
			$query_num_rows = mysql_num_rows($query_run);
			if($query_num_rows == 0){
				$invalid_login = "Your Login Name or Password is invalid";
			}	
			else if($query_num_rows == 1){
				echo $user_id = mysql_result($query_run, 0, 'id');
				$_SESSION['user_id'] = $user_id;	
				header("Location: index.php");
			}
		}		
	}
}

?>

<html>
<head>
<title>Quick Notes</title>

<meta charset="utf-8">
<link rel="stylesheet" href="project5.css">
<link rel="icon" href="favicon.png" type="image">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
	
</script>
</head>
<body>
<div id="container">
	<div id="header_bar">
	QUICK NOTES	
	</div>
	<div id="content">
	<div id="box">
		<span id="error"><?php echo $invalid_login; ?></span>
		 <div id="img">
			<div id="quote">
				Give words<br>to your thoughts<br>with "Quick Notes".
			</div>
		 </div>
		 <div id="form_div">
			<form id = "form" action = "<?php echo $current_file; ?>" method = "post">
                  UserName <input class="form_field" type = "text" name = "username" required>
				  <br><br><br>
                  Password <input class="form_field" type = "password" name = "password" required>
				  <br><br><br>
                  <input id="button" type = "submit" value = " Submit "/><br><br>
			<div><a href="register.php">Don't have an account? Register now.</a></div>
		 </form>
		</div>
	</div>
	</div>
	<div id="copyright1">
	Made with <i class="material-icons" style="color: red;">favorite</i> and <i class="fa fa-code" aria-hidden="true"></i>
	by Neelanjan Akuli © 2017
	</div>
</div>


</body>
</html>
