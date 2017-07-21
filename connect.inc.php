<?php

if(!@mysql_connect('localhost', 'root', '') || !@mysql_select_db('database')){
	die(mysql_error());
}
	
?> 