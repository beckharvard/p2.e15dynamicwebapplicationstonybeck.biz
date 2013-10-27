<!-- check to see if ser is logged in-->
<?php if($user): ?>
<!-- display the welcome message -->
	<?php    	Router::redirect("/posts");  ?>
<?php else: ?>
	<!-- Send them back to the login page.-->
	<h2> Welcome to SpecSpec, please Login or Sign up above! </h2>
<?php endif; ?>


	      					  