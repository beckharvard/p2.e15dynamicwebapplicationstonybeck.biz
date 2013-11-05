<h2> Sign Up </h2>
<br/>
<form id="myForm" method='POST' action='/users/p_signup'>

    <label>First Name</label><br>
    <input type='text' name='first_name' required autofocus/>
    <br><br>

    <label>Last Name</label><br>
    <input type='text' name='last_name' required/>
    <br><br>

    <label>Email</label><br>
    <input type='text' name='email' />
    <br><br>

    <label>Password</label><br>
    <input id="password" type='password' name='password' />
    <br><br>
    
    <label>Confirm password</label><br>
	<input id="confirm_password" name="confirm_password" type="password" />
	
    <br><br>
    	<?php if(isset($error)): ?>
        	<div class='error'>
        		<?php echo $error; ?> 
        		<br>            	
            	<?php if(isset($error2)): ?>    
            				
        			<?php echo $error2; ?>
        			
    			<?php endif; ?>
            	 
        	</div>
        	<br>
    	<?php endif; ?>

    <input class="buttons" type='submit' value='Sign Up'>

</form>