<?php

/**
 * 
 */
class Uservalidation
{
	private $data=['username'=>' ','email'=>'','password'=>'','confirm_password'=>''];
	private $errors=['username'=>'','email'=>'','password'=>'','confirm_password'=>''];
	private static $fields=['username','email','password','confirm_password'];

	public function __construct($user_data)
	{
		$this->data['username']=$user_data['username']??'';
		$this->data['email']=$user_data['email']??'';
		$this->data['password']=$user_data['password']??'';
		$this->data['confirm_password']=$user_data['confirm_password']??'';
	}
	public function validateform() {
		$this->validateusername();
		$this->validateemail();
		$this->validatepassword();
		$this->validateconfirm_password();
		return $this->errors;
	}

	private function validateusername(){
		$val=trim($this->data['username']);
		if (empty($val)) {
			$error='username field should not be empty!!';
			$this->errors['username']=$error;
		}else{
			if (!preg_match('/^[a-zA-Z0-9]{6,12}$/', $val)) {
				$error='username is not valid!!';
				$this->errors['username']=$error;
			}

		}

	}
	private function validateemail(){
		$val=trim($this->data['email']);
		if (empty($val)) {
			$error='email field should not be empty!!';
			$this->errors['email']=$error;
		}else{
			if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
				$error='email should be a valid email adderess!!';
				$this->errors['email']=$error;
			}
		}

	}
	private function validatepassword(){
		$val=trim($this->data['password']);
		if (empty($val)) {
			$error='password field should not be empty!!';
			$this->errors['password']=$error;
		}
	}
	private function validateconfirm_password(){
		$val=trim($this->data['confirm_password']);
		$val2=trim($this->data['password']);
		if (empty($val)) {
			$error='confirm password field should not be empty!!';
			$this->errors['confirm_password']=$error;
		}else{
			if ($val!= $val2) {
				$error='confirm password value must be the same as password value!!';
				$this->errors['confirm_password']=$error;
			}
		}

	}
	
}