<?php 
/**
 * 
 */
class Friend
{
	private $user_id;
	
	function __construct($user_id)
	{
		$this->user_id=$user_id;

	}

	private function Follow(){
		require('conn.php');
		$user_id=$this->user_id;
		$follower_id=$_SESSION['id'];
		$sql="INSERT INTO friends (Follower_id,following_id)VALUES('$follower_id','$user_id')";
		$query=mysqli_query($conn,$sql);
		
	}
	
	private function checkfollowing(){
		require('conn.php');
		$id=$_SESSION['id'];
		$user_id=$this->user_id;
		$sql="SELECT * FROM friends WHERE follower_id=$id AND following_id='$user_id'";
		$query= mysqli_query($conn, $sql);
		$foll=mysqli_fetch_all($query, MYSQLI_ASSOC);
		return $foll;
		
		

	}
	public function postfollow(){
		$user_id=$this->user_id;
		$check=$this->checkfollowing();
		if (empty($check)) {
			$follow=$this->Follow();
		}

	}
	public function GETFollower(){
		require('conn.php');
		$user_id=$this->user_id;
		$sql="SELECT * FROM friends WHERE following_id='$user_id'";
		$query= mysqli_query($conn, $sql);
		$followers=mysqli_fetch_all($query, MYSQLI_ASSOC);
		return $followers;

	}
	public function GETFollowing(){
		require('conn.php');
		$user_id=$this->user_id;
		$sql="SELECT * FROM friends WHERE follower_id='$user_id'";
		$query= mysqli_query($conn, $sql);
		$following=mysqli_fetch_all($query, MYSQLI_ASSOC);
		return $following;

	}
	

}

?>