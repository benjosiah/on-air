<?php 
 require('post.php');
 require('User.php');
 require('conn.php');
 $users=User::GetUser();
 $posts=Post::SelectPost();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="frame.css">
</head>
<body>
	<h3>latest</h3>
	<?php foreach ($posts as $post) {?>
	<div>
		<?php foreach ($users as $user) {?>
	<div>
		<?php if ($user['id']==$post['user_id']) {?>
		<h4><?php echo $user['username']; ?></h4>
		<?php }?>
	</div>
		<?php }?>
	<a href="post_comment.php?id=<?php echo $post['id'];?>"><div>
		<?php echo $post['post']; ?>
	</div></a>
	<div>
		<i><?php echo $post['created_at']; ?></i>
	</div>
	<div>
		<button>Like</button>
		<button>Comment</button>
		<button>Share</button>
	</div>
	</div>
	<?php }?>
</body>
</html>