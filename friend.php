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

	public function PostFollow(){
		$user_id=$this->user->id;
		$Follower_id=$_SESSION['id'];
		$sql="INSERT INTO friends (Follower_id,following_id)VALUES('$follower_id','$user_id')";
		$query=mysqli_query($conn,$sql);

	}
		public function GETFollow(){
		$user_id=$this->user->id;
		$sql="SELECT * FROM friends WHERE following='$user->id'";

	}
	

}

?>