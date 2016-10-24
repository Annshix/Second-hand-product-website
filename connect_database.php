
<?php
	$connection = mysqli_connect("localhost","root","000000");
	if($connection -> connect_error){
		die("connection failed: " . $connection->connect_error );
	}else{
	}
	$db_found = mysqli_select_db($connection, "dbpj");
?>