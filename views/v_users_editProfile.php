<?php if($user): ?>
	<h2>Edit <?=$user["first_name"]?>'s  profile...</h2>
<?php else: ?>
<?php    	Router::redirect("/users/login");  ?>
<?php endif; ?>
<form id="myForm" method='POST' action='/users/p_editProfile/<?=$user["user_id"]?>'>

    First Name<br>
    <input type='text' name='first_name' value='<?=$user["first_name"];?>' required>
    <br><br>

    Last Name<br>
    <input type='text' name='last_name' value='<?=$user["last_name"];?>' required>
    <br><br>

    Email<br>
    <input type='text' name='email' value='<?=$user["email"]; ?>' required>
    <br><br>

    Re-enter or update your Password<br>
    <!-- we don't pre-fill the password because we want them to enter one and we force them to do so-->
    <input type='password' name='password'>
    <br><br>
    
    	<?php if(isset($error)): ?>
        	<div class='error'>
            	Update failed. 
        	</div>
        	<br>
    	<?php endif; ?>

    <input type='submit' value='Update Profile'>

</form>
