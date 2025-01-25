<?php
//MYSQLi or PDO(php data object)
	//connect to db
	$conn= mysqli_connect('localhost','shaun','taki2004','ninja_pizza');//return type boolean, = true connection succed, =false echec de connection

	//check connection
	if(!$conn){//si =false 
		echo 'Connection error: '.mysql_connect_error();
	}
?>