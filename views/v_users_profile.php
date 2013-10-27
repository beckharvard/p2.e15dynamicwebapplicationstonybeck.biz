<?php if($user): ?>
	<h2>This is <?=$user->first_name?>'s  profile...</h2>
<?php else: ?>
<?php    	Router::redirect("/users/login");  ?>
<?php endif; ?>
<br/>
<?php if($user) echo 'First Name: '.$user->first_name;?>
<?php echo '<br/>'; ?>
<?php if($user) echo 'Last Name: '.$user->last_name; ?>
<?php echo '<br/>'; ?>
<?php if($user) echo 'email: '.$user->email; ?>
<?php echo '<br/>'; ?>
<?php if($user) 
	$convert_time = $user->created;
	echo 'Member since: ';
	echo date('M d Y', $convert_time); 
?>
<br/>
<hr/>
<br/>

<?php foreach($posts as $post): ?>
	
	<article>

    	<p><?=$post['content']?></p> 
		<h3>This post was created on:
    	<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
       		<?=Time::display($post['created'])?>
    	</time>
    	<a href='/posts/edit/<?=$post['post_id']; ?>' >Edit this post</a>
    	</h3>
	</article>
	<br/>
<?php endforeach; ?>
	<br/>
	<h2> Why not follow someone? <a href='/posts/users'>Other Posters</a></h2>

