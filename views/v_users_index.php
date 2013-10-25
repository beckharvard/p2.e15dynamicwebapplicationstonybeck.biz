<!-- check to see if ser is logged in
<?php if($user): ?>
<!-- display the welcome message -->
<h2>Welcome to <?=APP_NAME?><?php if($user) echo ', '.$user->first_name; ?></h2>
<?php else: ?>
<!-- Send them back to the login page.-->
<?php    	Router::redirect("/users/login");  ?>
 <?php endif; ?>



I DON'T KNOW IF THIS IS EVER BEING LOADED....
-->