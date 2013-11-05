<?php if($user): ?>
<!-- display the welcome message -->
<h2>Welcome to <?=APP_NAME?><?php if($user) echo ', '.$user->first_name; ?></h2>
<?php else: ?>
	<?php foreach($posts as $post): ?>
		<article>
			<?=$post['content'] = trim($post['content'], " \x00\t\n\r" ) ?>
    		<p><?=nl2br($post['content'])?></p>
    		<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
        		<?=Time::display($post['created'])?>
    		</time>
		</article>
	<br/>
	<?php endforeach; ?>

<!-- Send them back to the login page.-->
<?php    	Router::redirect("/users/login");  ?>
<?php endif; ?>
