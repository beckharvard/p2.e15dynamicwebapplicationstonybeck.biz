<hr/>
<br/>
<?php foreach($users as $user): ?>

    <!-- If there exists a connection with this user, show a unfollow link -->
    <?php if(isset($connections[$user['user_id']])): ?>
        <a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>
		<!-- Print this user's name -->
    	 <?=$user['first_name']?> <?=$user['last_name']?>

    <!-- Otherwise, show the follow link -->
    <?php else: ?>
        <a href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
		<!-- Print this user's name -->
    	 <?=$user['first_name']?> <?=$user['last_name']?>
    <?php endif; ?>

    <br><br>

<?php endforeach; ?>
