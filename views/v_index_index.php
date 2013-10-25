<!-- check to see if ser is logged in-->
<?php if($user): ?>
<!-- display the welcome message -->
	<h2> Hello <?=$user->first_name; ?></h2>
<?php else: ?>
<!-- Send them back to the login page.-->
<h2> Welcome to my app, please Login or Sign up above! </h2>
 <?php endif; ?>


	      					  