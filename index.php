 <?php
  include('header.php');
  require('UserValidator.php');
  require('User.php');
  require('conn.php');
  print_r($_SESSION);
  if (isset($_POST['reg'])) {
  	$validate= new Uservalidation($_POST);
  	$error= $validate->validateform(); 
  			
  		if(empty($error['username'])&&empty($error['email'])&&empty($error['password'])&&empty($error['confirm_password'])){
  			$user= new User($_POST);
			  $message=$user->PostUser();
			  header('location:signin.php');
  			
  		}
	}

?>


<div class="contaier">
	<h3>SIGN UP</h3>
	<div class="success">
		<?php echo $message??''; ?>
	</div>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" class="">
		<label>Name: </label><br>
		<input  type="text" name="username" id="username" value="<?php echo htmlspecialchars($_POST['username']?? ' ') ?>"><br>
		<div class="error">
			<?php echo $error['username']?? '';  ?>
		</div>
		<label>Email: </label><br>
		<input type="text" name="email" id="email" value="<?php echo htmlspecialchars($_POST['email']??'')?>"><br>
		<div class="error">
			<?php echo $error['email']?? '';  ?>
		</div>
		<label>Password: </label><br>
		<input type="text" name="password" id="password" value="<?php echo htmlspecialchars($_POST['password']?? '') ?>"><br>
		<div class="error">
			<?php echo $error['password']?? '';  ?>
		</div>
		<label>Confirm Password: </label><br>
		<input type="text" name="confirm_password" id="confirm_password" value="<?php echo htmlspecialchars($_POST['confirm_password']?? '') ?>"><br>
		<div class="error">
			<?php echo $error['confirm_password']?? '';  ?>
		</div><br>
		<input type="submit" name="reg"  id="reg" value="Submit">
	</form>
	<a href="signin.php">Signin</a>
	<p>&nbsp</p>
</div>
</body>
</html>