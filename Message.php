<?php
require('conn.php');

class Message{
    
    private $data;
    
    
    public function __construct($mess) {
        $this->data = $mess;
    }
    private function sendmessage($user_id){
        require('conn.php');
        $sender_id=$_SESSION['id'];
        $receiver_id=$user_id;
        $message=mysqli_real_escape_string($conn,$this->data);
        $sql="INSERT INTO `messages` (sender_id , reciever_id , message )VALUES('$sender_id', '$receiver_id', '$message')";
        $query=mysqli_query($conn, $sql);
        if ($query) {
            $response=true;
        }else {
            $response= false;
        }

        return $response;

    }

    public function messageValidation($user_id){
        $message=trim($this->data);
        if (!empty($message)) {
            $sendmessage=$this->sendmessage($user_id);
            header("location:message_page.php?id=$user_id");
        }

    }
    static function getsentmessage($user_id){
        require('conn.php');
        $sender_id=$_SESSION['id'];
        $receiver_id=$user_id;
        $sql="SELECT * FROM `messages` WHERE sender_id='$sender_id'  AND reciever_id='$receiver_id' ORDER BY time ";
        $query=mysqli_query($conn,$sql);
        $result=mysqli_fetch_all($query,MYSQLI_ASSOC);
        return $result;
    }
    static function getreceivedmessage($user_id){
        require('conn.php');
        $receiver_id=$_SESSION['id'];
        $sender_id=$user_id;
        $sql="SELECT * FROM `messages` WHERE sender_id='$sender_id'  AND reciever_id='$receiver_id' ";
        $query=mysqli_query($conn,$sql);
        $result=mysqli_fetch_all($query,MYSQLI_ASSOC);
        return $result;
    }
}