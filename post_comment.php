<?php 
 include('header.php') ;
if (!isset($_SESSION['id'])) {
	header("location:signin.php");
}
 require('post.php');
 require('User.php');
 require('conn.php');
 require('Comment.php');
 require('postValidation.php');
 require('Like.php');
 $post_id=$_GET['id'];
 $post=Post::SelectPost();
 $users=User::GetUser();
 $comments=Comment::GetComments();
if (isset($_POST['com'])) {
 	$validate= new PoatValidaion($_POST);
 	$error=$validate->Commentvalidation();
 	if ($_POST['user_id']==$_SESSION['id']) {
 		if (empty(trim($error['comment']))) {
 			$postComment= new Comment($_POST);
 			$message=$postComment->InsertComment();

 		}
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
 	header('location:newsfeed.php');
 }
 if (isset($_POST['edit'])) {
 	
 }
 if (isset($_POST['reply'])) {
 	
 }
 $likes=Like::GetallLike();


?>
<div class="posts">
	<h3>Posts</h3>
	<?php foreach ($post as $post) { 
		?>
	<?php if($post['id']==$post_id){ 
		$file=$post['file'];
		$file_split=explode('.',$file);
		$fileext=end($file_split);
		?>
	<div class="post">
		<?php foreach ($users as $user) { ?>
		<?php if($post['user_id']==$user['id']){  ?>
		<div>
		<a href="user_page.php?id=<?php echo $user['id'];?>"><b><?php echo $user['username'];  ?></b></a>
		</div>
		
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
			<?php echo nl2br($post['post']);	 ?>
		</div>
	
		<div>
			<i><?php echo $post['created_at'];  ?></i>
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
			<button tyoe="submit" name="like">Like(<?php echo $like_num; ?>)</button>
			<?php }else{ ?>
			<button tyoe="submit" name="dislike">Dislike(<?php echo $like_num; ?>)</button>
			<?php } ?>
			<input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
		<?php if($user['id']==$_SESSION['id']){?>
			<button tyoe="submit" name="edit">Edit</button>
			<button tyoe="submit" name="delete">Delete</button>
			<?php }else { ?>
			<button tyoe="submit" name="">share</button>
			<?php } ?>
		</div>
	</div>
	<?php } ?>
	<?php } ?>

	<h2>Comments</h2>
	<?php foreach ($comments as $comment) { ?>
	<?php if($comment['post_id']==$post_id){  ?>
	<div class="post">
		<?php foreach ($users as $user) { ?>
		<?php if($comment['user_id']==$user['id']){  ?>
		<div>
			<b><?php echo $user['username'];  ?></b>
		</div>
		
		<div>
			<?php echo nl2br($comment['comment']);  ?>
		</div>
	
		<div>
			<i><?php echo $post['created_at'];  ?></i>
		</div>
		<div>
			<?php if($user['id']==$_SESSION['id']){  ?>
			<button>Like</button>
			<button>Reply</button>
			<button>Edit</button>
			<button>Delete</button>
			<?php }else { ?>
			<button>Like</button>
			<button>Reply</button>
			<?php } ?>
		</div>
		<?php } ?>
		<?php } ?>
	</div>
	<?php } ?>
	<?php } ?>
	<div>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<center>
			<div class="success"><?php echo $message??''; ?></div>
			<textarea class="text" id="comment"  name="comment" cols="60" rows="3" placeholder="Write your comment"></textarea>
			<div class="error"><?php echo $error['comment']??''; ?></div>
			<input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['id']) ?>">
			<input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post['id']) ?>">
			<button type="submit" name="com">comment</button>
			</center>
		</form>
	</div>
</div>
<?php } ?>
<?php } ?>
	
</body>
</html>