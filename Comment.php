<?php
/**
 * 
 */
class Comment 
{
	private $data;
	function __construct($comment)
	{
		$this->data=$comment;
	}

	public function InsertComment(){
		require('conn.php');
		$comment=mysqli_real_escape_string($conn, $this->data['comment']);
		$post_id=mysqli_real_escape_string($conn,$this->data['post_id']);
		$user_id=mysqli_real_escape_string($conn,$_SESSION['id']);
		$sql="INSERT INTO `comments`(comment,post_id,user_id)VALUES('$comment','$post_id','$user_id')";
		$result=mysqli_query($conn, $sql);
		if(!$result) {
			$message="error ". mysqli_error($conn);
			return $message;
		}else{
			$message="successful";
			return $message;
			
		}
	}
	static function GetComments(){
		require('conn.php');
		$sql="SELECT * FROM `comments` ORDER BY created_at DESC";
		$result=mysqli_query($conn, $sql);
		$posts=mysqli_fetch_all($result, MYSQLI_ASSOC);
		return $posts;
	}
}