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
	 echo "yo";
 }
 if (isset($_POST['delete'])) {
 	$delete= new Post($_POST['post_id']);
 	$massage=$delete->DeletePost();
 }
  $users=User::GetUser();
 $posts=Post::SelectPost();
 $likes=Like::GetallLike();
 
 	 	


 
 ?>
 <div class="head">
 	<h3>Post something</h3>
 	<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" >
 		<textarea cols="50" rows="10" name="post" id="post" placeholder="Write your post" ></textarea><br>
 		<div class="error"><?php echo $error['post']??''; ?></div>
 		<div class="success"><?php echo $submit??''; ?></div>
 		<input type="file" name="file" id="file" accept=".mp4, .webm , .png , .jpeg, .jpg"><br>
 		<input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">
 		<input type="submit" name="btn" value="Post">
 	</form>

 </div><br><br>
<cenrt>

	<div class="posts">
	<h3>Posts</h3>
	<div class="success"><?php echo $message??''; ?></div>
	<?php foreach ($posts as $post) {
		$file=$post['file'];
		$file_split=explode('.',$file);
		$fileext=end($file_split);
		?>
	
	<div class="post">
		<?php foreach ($users as $user) {?>
		<?php if ($user['id']==$post['user_id']) {?>
	<div>
		<h4><?php echo nl2br($user['username']); ?></h4>
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
		<?php if($user['id']==$_SESSION['id']){?>
			<button type="submit" name="edit">Edit</button>
			<button type="submit" name="delete">Delete</button>
			<?php }else { ?>
			<button type="submit" name="">share</button>
		<?php } ?>
		</form>
	</div>
	<?php }?>
	<?php }?>
	</div>
	<?php }?>
	</div>
	</cenrt>


</body>
</html>