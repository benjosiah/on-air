<?php
include('header.php') ;
if (!isset($_SESSION['id'])) {
	header("location:signin.php");
}
 require('postValidation.php');
 require('post.php');
 require('User.php');
 require('conn.php');
 require('Like.php');
 require('friend.php');
 $user_id=$_GET['id'];
 if (isset($_POST['btn'])) {
	$index=substr(str_shuffle("qwertyuioplkjhgfdsazxcvmQWERTYUIOPLKJHGFDSAZXCVM1234567890"),0,5);
	$files=$_FILES['file'];
	$filename=$files['name'];
	$fileerror=$files['error'];
	$fileTemp=$files['tmp_name'];
	$filesx=explode('.',$filename);
	$fileExt=end($filesx);
	$filenamenew="POP".uniqid('',true).$index.'.'.$fileExt;
 	$validation= new PoatValidaion($_POST);
 	$error=$validation->validation();
 	if(empty($error['post']) || $fileerror===0) {
		$filedest="postsfiles/".$filenamenew;
		move_uploaded_file($fileTemp,$filedest);
 		if ($_POST['user_id']==$_SESSION['id']) {
 			$post= new Post($_POST);
			$submit=$post->InsertPost($filedest);
			echo $submit;
 		}
	}else{
	}
 }
 if (isset($_POST['like'])) {
 	$like= new Like($_POST);
 	$getlikes=$like->GetLike();
 	if (empty($getlikes)) {
 		$postlike= new Like($_POST['post_id']);
 		$postlike->postlike();
 	}
 	
 }
 if (isset($_POST['dislike'])) {
	 $dislike= new Like($_POST['post_id']);
	 $dislike->DeleteLike();
	
 }
 if (isset($_POST['delete'])) {
 	$delete= new Post($_POST['post_id']);
 	$massage=$delete->DeletePost();
 }
 if (isset($_POST['upload'])) {
	 $files=$_FILES['image'];
	 $file= new User($files);
	 $message=$file->Getfile();
	 echo $message;
 }

 $users=User::GetUser();
 $posts=Post::SelectPost();
 $likes=Like::GetallLike();
 $follow = new Friend($user_id);
 $followers=$follow->GETFollower();
 $following=$follow->GETFollowing();
 $followers_id=[];
 foreach($followers as $follower){
	 $Follower_id=$follower['Follower_id'];
	 array_push($followers_id,$Follower_id );
 }
 foreach($users as $user){
	 if ($user['id']==$user_id) {
		 $name=$user['username'];
		 if (!empty($user['image'])) {
			 $propic=$user['image'];
		 }
	 }
 }
 ?>
<div class="head">

<center>

    <div> 
	
        <img src="<?php echo $propic ??'profile.png';?>" alt="profile.png" class="profile">
		<h4><?php echo $name;  ?></h4>

		<div>
 				<span>
				 <ul>
 					<li>
					 Followers (<?php echo count($followers); ?>)
					 </li>
					 <li>
					 Following (<?php echo count($following); ?>)
					 </li>

				 </ul>
				 </span>
		</div>
		<?php if($user_id==$_SESSION['id']){ ?>
        <form action="" method="post" enctype="multipart/form-data">
        	<button type="submit" name="profile_edit">Edit user profile</button>
			<button type="submit" name="pro_pics">Upload profile photo</button>
			<?php
				if (isset($_POST['profile_edit'])) {
					 echo '
					 <br/>
					 <br/>
					 <br/>
					 <input type="file" name="image" id=""><br/>
					 <button type="submit" name="upload">Upload</button>
					 ' ;
 				}
 			?>
        </form>
		<?php }else{?>
			
			<form action="" method="post" enctype="multipart/form-data">
			<?php if(!in_array($_SESSION['id'],$followers_id)){ ?>
				<button type="submit" name="follow">Follow</button>
				<?php
					if (isset($_POST['follow'])) {
						$follow = new Friend($user_id);
						$postfollow= $follow->postfollow();
					}
				?>
			<?php }else{ ?>
				<button type="submit" name="unfollow">Following</button>
			<?php } ?>
        </form>
		<?php } ?>
		
    </div>
 	<h3>Post something</h3>
 	<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" >
 		<textarea cols="50" rows="10" name="post" id="post" placeholder="Write your post" ></textarea><br>
 		<div class="error"><?php echo $error['post']??''; ?></div>
 		<div class="success"><?php echo $submit??''; ?></div>
 		<input type="file" name="file" id="file" accept=".mp4, .webm , .png , .jpeg, .jpg"><br>
 		<input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">
 		<input type="submit" name="btn" value="Post">
     </form>
	
</center>


 </div><br><br>
	<div class="posts">
	<h3>Posts</h3>
	<div class="success"><?php echo $message??''; ?></div>
	<?php foreach ($posts as $post) {
		$file=$post['file'];
		$file_split=explode('.',$file);
		$fileext=end($file_split);
		
		?>
	<?php if($post['user_id']==$user_id) {?>
	<div class="post">
	<?php foreach ($users as $user) {?>
		<?php if($user['id']==$post['user_id']) {?>
	<div>
		<a href="user_page.php"><h4><?php echo nl2br($user['username']); ?></h4></a>
	</div>
	<a href="post_comment.php?id=<?php echo $post['id'];?>">
		<div>
			<?php if(!empty($post['file'])){?>
				<center>
				<div>
				<?php if($fileext!="mp4"){?>
				<img src="<?php echo $post['file'] ; ?>" alt="" height="400px" width="50%">
				<?php }else{ ?>
					<video controls height="300px" width="50%" >
						<source src="<?php echo $post['file'];?>" type="video/mp4">
					</video>
				<?php } ?>
				</div>
				</center>
			<?php } ?>
			<?php
			if (!empty($post['post'])) {
				if (strlen($post['post'])<=50) {
					echo nl2br($post['post']). "<br>";
					echo strlen($post['post']);
				}else{
					echo nl2br(substr($post['post'],0,50))."... <br>";
					echo strlen($post['post']);
				}
			}
			  ?>
		</div>
	</a>
	<div>
		<i><?php echo $post['created_at']; ?></i>
	</div>
	<div>
		
		<form action="" method="post">
		<?php 
		$like_user_id=[];
		$lik=[];
		foreach($likes as $like){
			 if($like['post_id']==$post['id']){
				array_push($lik,$like);	
				$user_like=$like['user_id'];
				array_push($like_user_id,$user_like);
				
				if ($like['user_id']==$_SESSION['id']) {
					
				}
			}
			

		}
			$like_num=count($lik);
			if (in_array($_SESSION['id'],$like_user_id)) {
				$like_user=true;
			}else{
				$like_user=false;
			}
		?>
		<?php if($like_user!=true){ ?>
			<button type="submit" name="like">Like(<?php echo $like_num; ?>)</button>
		<?php }else{ ?>
			<button type="submit" name="dislike">Dislike(<?php echo $like_num; ?>)</button>
		<?php } ?>
			<input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
            <button type="submit" name="comment">Comment</button>
			<button type="submit" name="edit">Edit</button>
			<button type="submit" name="delete">Delete</button>
			<button type="submit" name="">share</button>
		</form>
	</div>
	</div>
    <?php }?>
    <?php }?>
	<?php }?>
	<?php }?>
	</div>
</body>
</html>