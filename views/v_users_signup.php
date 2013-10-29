<h2> Sign Up </h2>
<br/>
<form id="myForm" method='POST' action='/users/p_signup'>

    <label for="first_name">First Name</label><br>
    <input type='text' name='first_name' required autofocus/>
    <br><br>

    <label for="last_name">Last Name</label><br>
    <input type='text' name='last_name' required/>
    <br><br>

    <label for="email">Email</label><br>
    <input type='text' name='email' />
    <br><br>

    <label for="password">Password</label><br>
    <input id="password" type='password' name='password' />
    <br><br>
    
    <label for="confirm_password">Confirm password</label><br>
	<input id="confirm_password" name="confirm_password" type="password" />
	
    <br><br>
    	<?php if(isset($error)): ?>
        	<div class='error'>
            	Sign Up failed. Do you already have an account?
        	</div>
        	<br>
    	<?php endif; ?>

    <input class="buttons" type='submit' value='Sign Up'>

</form>