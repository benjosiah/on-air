<?php
require('header.php');
require('User.php');
require('friend.php');
$id=$_SESSION['id'];
$users=User::GetUser();
$follow = new Friend($id);
$followers=$follow->GETFollower();
$following=$follow->GETFollowing();
$folling_id=[];
$friends=[];
foreach($following as $following){
    array_push($folling_id,$following['following_id']);
}
foreach($users as $user){
    if (in_array($user['id'], $folling_id)) {
        array_push($friends,$user);
    }
}
?>
<div>
<div class="contact">
    <?php foreach($friends as $friend){
            $profile= $friend['image'];?>
        <a href='message_page?id=<?php echo $friend['id']?>'>
        <div>
            <div>
                <?php if(!empty($profile)){?>
                    <img src="<?php echo $profile;?>" alt="" class="profile"> 
                <?php } else{?>
                    <img src="profile.png" alt="" class="profile">
                <?php }?>
                <h4><?php echo $friend['username'] ?></h4>
            </div>
    
            <div class="list">

            </div>
        </div>

    <?php } ?>
</div>

</div>