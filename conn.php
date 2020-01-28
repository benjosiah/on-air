<?php
	$conn= mysqli_connect('localhost', 'root','','on_air');
	if (!$conn) {
		echo "". mysql_error();
	}
?>