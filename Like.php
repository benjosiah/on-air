<?php

/**
 * 
 */
class Like
{
	private $data;
	
	function __construct($post)
	{
		$this->data= $post;
	}
	public function postlike(){
		require('conn.php');
		$post_id=$this->data;
		$user_id=$_SESSION['id'];
		$sql="INSERT INTO likes (user_id, post_id)VALUES('$user_id','$post_id')";
		$query=mysqli_query($conn, $sql);
		if ($query) {
			
		}else{
			echo "error ".mysqli_error($conn);
		}
	}
	public function GetLike(){
		require('conn.php');
		$post_id=$this->data['post_id'];
		$user_id= $_SESSION['id'];
		$sql="SELECT * FROM `likes` WHERE user_id='$user_id'AND post_id='$post_id' ";
		$result=mysqli_query($conn, $sql);
		$likes=mysqli_fetch_all($result, MYSQLI_ASSOC);
		return $likes;
	}
	static function GetallLike(){
		require('conn.php');
		$sql="SELECT * FROM `likes` ";
		$result=mysqli_query($conn, $sql);
		$likes=mysqli_fetch_all($result, MYSQLI_ASSOC);
		return $likes;
	}
	public function DeleteLike(){
		require('conn.php');
		$post_id=$this->data;
		$user_id=$_SESSION['id'];
		$sql="DELETE FROM `likes` WHERE post_id='$post_id' and user_id='$user_id'";
		$query=mysqli_query($conn,$sql);
		if ($query) {
			$message="successfully deleted";
			return $message;
		}else{
			return mysqli_error($conn);
		}
	}
}
