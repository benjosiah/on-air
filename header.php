<?php 
	session_start();
	// print_r($_SESSION);
?>

<!DOCTYPE html>
<html>

<head>
	<title>welcome</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	
		<nav>	
			<ul>
				<li><h1>ON AIR</h1></li>
				<a href="newsfeed.php"><li>Home</li></a>
				<li>About</li>
				<li>Contact</li>
				<?php if (!isset($_SESSION['id'])) {?>
					<a href="signin.php"><li>Sign in</li></a>
					<a href="index.php"><li>Sign up</li></a>
				<?php } else{
					echo '<li>'.$_SESSION['username'].'</li>';
					echo "<a href='logout.php'><li>"."Log Out"."</li></a>";
				} ?>
				
			</ul>

		</nav>
	