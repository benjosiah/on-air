<?php
/**
 * 
 */
class Post
{
	private $data;
	static $posts;
	
	function __construct($post_data)
	{
		$this->data=$post_data;
	}

	public function InsertPost($file){
		require('conn.php');
		$post=mysqli_real_escape_string($conn, $this->data['post']);
		$user_id=mysqli_real_escape_string($conn,$_SESSION['id']);
		$sql="INSERT INTO `posts`(post,user_id,file)VALUES('$post','$user_id','$file')";
		$result=mysqli_query($conn, $sql);
		if(!$result) {
			$message= "error". mysqli_error($conn);
			return $message;
		}else{
			$message="successful";
			return $message;
			
		}
	}

	static function SelectPost(){
		require('conn.php');
		$sql="SELECT * FROM `posts` ORDER BY created_at DESC";
		$result=mysqli_query($conn, $sql);
		$posts=mysqli_fetch_all($result, MYSQLI_ASSOC);
		return $posts;
	}
	public function DeletePost(){
		require('conn.php');
		$post_id=$this->data;
		$user_id=$_SESSION['id'];
		$sql="DELETE FROM `posts` WHERE id='$post_id'";
		$query=mysqli_query($conn,$sql);
		if ($query) {
			$message="successfully deleted";
			return $message;
		}else{
			return mysqli_error($conn);
		}
	}

}

?>