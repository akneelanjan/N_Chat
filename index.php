<?php 

require 'core.inc.php';
require 'connect.inc.php';

$message = $name = $text = "";




if(loggedin()){
	$message = '<a href="logout.php">Log Out</a>';
	$name =  getuserfield('firstname')." ".getuserfield('surname');
	$username = getuserfield('username');
	
	if(isset($_POST['text'])){
	$text = $_POST['text'];
		if(!empty($text)){
			$query = "INSERT INTO `$username` VALUES ('','".mysql_real_escape_string($text)."','')";
			$query_run = mysql_query($query);
		}
	}
	
	function delete_note($del, $name){
	$delete = "DELETE FROM `$name` where `id` = '".$del."' ";
	$delete_run = mysql_query($delete);
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
<script>
			var name = "<?php echo $username; ?>";

			$(document).ready(function(){
				$(".del_note").click(function(){
					var id = $(this).attr('id') ;
					$.ajax({
						url: 'test.php',
						type: "POST",
						data: "id=" + id + "&name=" + name,	
						success: function(data) {
							console.log(data);
							$("#"+id).hide(1000);
						}
					});
				});
			});		
			
			$(document).ready(function(){
				$('#chat_box').fadeIn(500);
				$('.submit').click(function(){
					var sender = name;
					var message = $('#message').val();
					if(message != '' && receiver != ''){
					$.ajax({
						url: 'chat.php',
						type: "POST",
						data: "sender=" + sender + "&message=" + message + "&receiver=" + receiver,	
						success: function(data) {
							$('#chat_box').fadeIn(500);
							$('#chat_box').html(data);
							$('#chat_box').scrollTop($('#chat_box').prop('scrollHeight'));
							$('#name').val("");
							$('#message').val("");
						}
					});
					}	
				});
			});
			
			function executeQuery() {
			  $.ajax({
				url: 'update.php',
				type: "POST",
				data: "sender=" + name + "&receiver=" + receiver,
				success: function(data) {
					$('#chat_box').html(data);
				}
			  });
			  setTimeout(executeQuery, 10000);
			}
				
			var receiver='';	

			$(document).ready(function() {
				$('.chatters').click(function(){
				$('.active').removeClass('active');	
				$(this).addClass('active');
				receiver = $(this).text();
				$('#chat_box').scrollTop($('#chat_box').prop('scrollHeight'));
				executeQuery();					
				});
			});
			
			
			/*function chatlistupdate() {
				$.ajax({
				url: 'chatlist.php',
				success: function(data) {
					$('#chat_list').html(data);
				}
				});
				setTimeout(chatlistupdate, 2000); 
			}*/

			$(document).ready(function() {
				//setTimeout(chatlistupdate, 2000);
				
				//default chat which comes on page loading
				
				$('#10').addClass('active');
				receiver = $('#10').html();
				executeQuery();
				setTimeout(executeQuery, 10000);
			});				
				
			
</script>


</head>
<body>
<div id="container">
	<div id="header_bar">
		QUICK NOTES
		<div id="logout"><?php echo $message; ?></div>
	</div>
	<div id="hello"><?php echo "Hello ".$name; ?></div>
	<div id="content">
		
		<div id="chat_space">
				<div id="chat_list">
				<?php 
				$chatters = "SELECT * FROM `users`";
				$chatters_run = mysql_query($chatters);
				
				while($chatters_row = mysql_fetch_array($chatters_run)){
					echo "<div class='chatters' id='".$chatters_row['id']."'>".$chatters_row['username']."</div>";
				}
				?>
				</div>
				<div id="ct">
					<div id="chat_box">
				
					</div>
					<div id="textsend">
						<textarea name="enter message" id="message" maxlength="200" placeholder="Enter Message(Max length 200)"></textarea>
						<button class="submit" type="submit" name="submit">click me</button>
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
else{
	include 'login.inc.php';
}
?>
