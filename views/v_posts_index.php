<?php foreach($posts as $post): ?>
	<article>
	<hr/>
    	<h2><?=$post['first_name']?> <?=$post['last_name']?> posted:</h2>

    	<p><?=$post['content']?></p>
    	
		<h3>This post was created on:
		
    		<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
       			<?=Time::display($post['created'])?>
    		</time>
		</h3>
		<br/>
	</article>	
	
<?php endforeach; ?>
	<h2> Why not follow someone? <a href='/posts/users'>Other Posters</a></h2>
	
