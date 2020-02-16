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
					echo '<a href="freinds_list.php">
					
					<img src="chat_icon.png" alt="profile.png" class="dp">
					<li>
					Message
					</li>
					</a>';
					
					echo '<a href="user_page.php?id='.$_SESSION['id'].'">
					<img src="'. $_SESSION['image'].'" alt="profile.png" class="dp">
					<li>'
					.$_SESSION['username'].
					'</li>
					</a>';
					echo "<a href='logout.php'><li>"."Log Out"."</li></a>";
				} ?>
				
			</ul>

		</nav>
	