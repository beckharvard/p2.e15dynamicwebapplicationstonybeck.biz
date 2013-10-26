<?php if($user): ?>
	<h2>These are <?=$user->first_name?>'s  posts...</h2>
<?php else: ?>
<?php Router::redirect("/users/login");  ?>
<?php endif; ?>