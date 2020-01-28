<?php

/**
 * 
 */
class User
{
	private $data;

	
	function __construct($post_data)
	{
		$this->data=$post_data;
	}

	public function PostUser(){
		require('conn.php');
		$username=htmlspecialchars($this->data['username']);
		$email=htmlspecialchars($this->data['email']);
		$password=htmlspecialchars($this->data['password']);

		$sql= "INSERT INTO users (username,email,password)VALUES('$username','$email','$password')";
		$query=mysqli_query($conn, $sql);
		if (!$query) {
			echo "error ". mysqli_error($conn) ;
		}else{
			$message='Signup Successful';
			echo $message;
		}

	}
	public function PostSignin(){
		require('conn.php');
		$email=htmlspecialchars($this->data['email']);
		$password=htmlspecialchars($this->data['password']);
		$sql="SELECT*FROM`users`WHERE email='$email' AND password='$password'";
		$query=mysqli_query($conn, $sql);
		if (mysqli_num_rows($query)>0) {
			$details=mysqli_fetch_assoc($query);
			$_SESSION['id']=$details['id'];
			$_SESSION['email']=$details['email'];
			$_SESSION['username']=$details['username'];
			$_SESSION=$details;
			header("location:newsfeed.php");

		}else{
		echo "error". mysqli_error($conn);
		}
	}
	public function Logout(){
		session_start();
		session_destroy();
	}
	static function GetUser(){
		require('conn.php');
		$sql="SELECT * FROM `users`";
		$result=mysqli_query($conn, $sql);
		$users=mysqli_fetch_all($result, MYSQLI_ASSOC);
		return $users;
	}
 	
}

?>