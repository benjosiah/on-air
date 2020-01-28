<?php 
/**
 * 
 */
class PoatValidaion
{
	private $data;
	public $errors=['post'=>'','id'=>'', 'comment'=>''];
	
	function __construct($post_data)
	{
		$this->data=$post_data;
	}

	public function validation(){
		$post=trim($this->data['post']);
		$id=trim($this->data['user_id']);
		if (empty($post)) {
			$error="No post";
			$this->errors['post']=$error;
		}

		return $this->errors;

		
	}
	public function Commentvalidation(){
		$post=trim($this->data['comment']);
		$id=trim($this->data['user_id']);
		if (empty($post)) {
			$error="comment empty";
			$this->errors['comment']=$error;
		}

		return $this->errors;

		
	}
}

 ?>