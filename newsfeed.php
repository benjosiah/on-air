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
 	$validation= new PoatValidaion($_POST);
 	$error=$validation->validation();
 	echo $_POST['post'];
 	if(empty($error['post'])) {
 		if ($_POST['user_id']==$_SESSION['id']) {
 			$post= new Post($_POST);
			print_r($_POST);
			$submit=$post->InsertPost();
			echo $submit;
 		}
	}
 }
 if (isset($_POST['like'])) {
 	$like= new Like($_POST);
 	$likes=$like->GetLike();
 	if (empty($likes)) {
 		$postlike= new Like($_POST['post_id']);
 		$postlike->postlike();
 		$likes=$like->GetLike();
 	}
 	
 }
 if (isset($_POST['comment'])) {
 	
 }
 if (isset($_POST['delete'])) {
 	$delete= new Post($_POST['post_id']);
 	$massage=$delete->DeletePost();
 }
  $users=User::GetUser();
 $posts=Post::SelectPost();
 
 	 


 
 ?>
 <div class="head">
 	<h3>Post something</h3>
 	<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
 		<textarea cols="50" rows="10" name="post" id="post" placeholder="Write your post" ></textarea><br>
 		<div class="error"><?php echo $error['post']??''; ?></div>
 		<div class="success"><?php echo $submit??''; ?></div>
 		<input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">
 		<input type="submit" name="btn" value="Post">
 	</form>

 </div><br><br>
<cenrt>

	<div class="posts">
	<h3>Posts</h3>
	<div class="success"><?php echo $message??''; ?></div>
	<?php foreach ($posts as $post) {?>
	<div class="post">
		<?php foreach ($users as $user) {?>
		<?php if ($user['id']==$post['user_id']) {?>
	<div>
		<h4><?php echo nl2br($user['username']); ?></h4>
	</div>
	<a href="post_comment.php?id=<?php echo $post['id'];?>">
		<div>
			<?php echo nl2br($post['post']); ?>
		</div>
	</a>
	<div>
		<i><?php echo $post['created_at']; ?></i>
	</div>
	<div>
		
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
			<button type="submit" name="like">Like</button>
			<button type="submit" name="dislike">Dislike</button>
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