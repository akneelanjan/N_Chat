<?php 

require 'core.inc.php';
require 'connect.inc.php';

$error = $firstname = $surname = $email = $username = $password = $repassword =  "";


if (!loggedin()){
	if(isset($_POST['firstname'])&&isset($_POST['surname'])&&isset($_POST['email'])&&isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['repassword'])){
	$firstname = htmlentities($_POST['firstname']);
	$surname = htmlentities($_POST['surname']);
	$email = htmlentities($_POST['email']);
	$username = htmlentities($_POST['username']);
	$password = htmlentities($_POST['password']);
	$repassword = htmlentities($_POST['repassword']);
	
	if(!empty($firstname)&&!empty($surname)&&!empty($email)&&!empty($username)&&!empty($password)&&!empty($repassword)){
		if($password != $repassword){
			$error = "Passwords do not match.";
		}
		else{
			$query = "SELECT `username` FROM `users` WHERE `username` = '$username'";
			$query_run = mysql_query($query);
			if(mysql_num_rows($query_run)==1){
			 $error = "Username already exists.";
			}
			else{
				$query = "INSERT INTO `users` VALUES ('', '".mysql_real_escape_string($firstname)."', '".mysql_real_escape_string($surname)."', '".mysql_real_escape_string($email)."', '".mysql_real_escape_string($username)."', '".mysql_real_escape_string($password)."')";
				
				$create_table = "CREATE TABLE $username(id int AUTO_INCREMENT, notes VARCHAR(500), task VARCHAR(10) NOT NULL, PRIMARY KEY(id) )";
				
				
				if($query_run = mysql_query($query) && $create_table_run = mysql_query($create_table)){
					header("Location: welcome.php");
				}
			}
		}
		
	}
	else{
		$error =  "All fields are required.";
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
</head>
<body>
<div id="container">
	<div id="header_bar">
	QUICK NOTES	
	</div>
	<div id="content">
		<div id="box">
			<span id="error"><?php echo $error; ?></span>
			<div id="form_div">
			<form id="form" method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
				<div class="form_label">
				Firstname <input class="form_field" maxlength="30" type="text" name="firstname" value="<?php echo $firstname; ?>" required>
				</div>
				<div class="form_label">
				Surname <input class="form_field" maxlength="30" type="text" name="surname" value="<?php echo $surname; ?>" required>
				</div>
				<div class="form_label">
				E-mail <input  class="form_field" maxlength="30" type="email" name="email" value="<?php echo $email; ?>" required>
				</div>
				<div class="form_label">
				Username <input class="form_field" maxlength="30" type="text" name="username" value="<?php echo $username; ?>" required>
				</div>
				<div class="form_label">
				Password <input class="form_field" maxlength="30" type="password" name="password" required>
				</div>
				<div class="form_label">
				Re-enter Password <input class="form_field" maxlength="30" type="password" name="repassword" required>
				</div>
				<div class="form_label">
				<input id="button" type="submit" name="submit" value="Register">
				</div>
				<div><a href="index.php">Already have an account? Login now.</a></div>	
			</form>
			</div>
			<div id="img1">
			<div id="quote1">
				All you need<br>is an account<br>to get your <br>personalised <br>web diary.
			</div>
			</div>
		</div>
	</div>
	<div id="copyright">
	Made with <i class="material-icons" style="color: red;">favorite</i> and <i class="fa fa-code" aria-hidden="true"></i>
	by Neelanjan Akuli © 2017
	</div>
</div>
</body>
</html>

<?php
}
else if (loggedin()){
	echo "You are already registered.";
}
?>