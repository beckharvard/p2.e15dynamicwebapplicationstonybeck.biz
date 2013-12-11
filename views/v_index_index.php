<!-- check to see if ser is logged in-->
<?php if($user): ?>
<!-- display the welcome message -->
	<?php    	Router::redirect("/posts");  ?>
<?php else: ?>
	<!-- Send them back to the login page.-->
	<h2> Welcome to SpecSpec, please Login or Sign up above! </h2>
	
	<p>
		SpecSpec is a microblogging site. YOu can add posts, edit them and share them with other <br/>
		SpecSpec members!
	</p>
<?php endif; ?>


	      					  