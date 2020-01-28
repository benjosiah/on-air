 <?php 
 include('header.php') ;
 require('UserValidator.php');
 require('User.php');
  if (isset($_POST['reg'])) {
  	$validate= new Uservalidation($_POST);
  	$error= $validate->validateform(); 
  	if(empty($error['email']&&$error['password'])){
  			$user= new User($_POST);
  			$user->PostSignin();
  			

  			
  			
  		}
  
	}

 ?>


<div class="contaier">
	<h3>SIGN IN</h3>
	<form method="post" action="" class="">
		<label>Email: </label><br>
		<input type="text" name="email"><br>
		<div class="error">
			<?php echo $error['email']?? '';  ?>
		</div>
		<label>Password: </label><br>
		<input type="text" name="password"><br>
		<div class="error">
			<?php echo $error['password']?? '';  ?>
		</div>
		<input type="submit" name="reg" value="Submit">
	</form>
	<p>&nbsp</p>
</div>
</body>
</html>
