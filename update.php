<?php 
		
	require 'core.inc.php';
	require 'connect.inc.php';
	
	$sender = $_POST['sender'];
	$receiver = $_POST['receiver'];
	
	$chat = "SELECT * FROM `chats` WHERE (`sender`='$sender' AND `receiver`='$receiver') OR (`sender`='$receiver' AND `receiver`='$sender')  ";
	$chat_run = mysql_query($chat);

	while($chat_rows = mysql_fetch_array($chat_run)) :
?>
<div id="chat_data" class="<?php if($sender==$chat_rows['sender']){ echo 's';} else{ echo 'r';}  ?>">
	<!-- <span style="color:green;"><?php echo $chat_rows['sender']; ?> : </span> -->
	<div>
	<div id="chatmsg"><?php echo $chat_rows['message']; ?></div>
	</div>	
	<!-- <span style="float:right;"><?php echo $chat_rows['receiver']; ?></span> -->
</div>
<?php endwhile; ?>