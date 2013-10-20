<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<link href="../css/style_php.css" type="text/css" rel="stylesheet">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript">
</script>
<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js">
</script>
			
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
</head>

<body>	

	 <div id='menu'>

        <a href='/'>Home</a>

        <!-- Menu for users who are logged in -->
        <?php if($user): ?>

            <a href='/users/logout'>Logout</a>
            <a href='/users/profile'>Profile</a>

        <!-- Menu options for users who are not logged in -->
        <?php else: ?>
            <a href='/users/signup'>Sign up</a>
            <a href='/users/login'>Log in</a>
        <?php endif; ?>

    </div>

    <br>

    <?php if(isset($content)) echo $content; ?>

	<!--adding the javascript here, too because it performs better and it doesn't choke the DOM 
	javascript may need to be here as well as in the head. that's why we echo $client_files_body-->
	<?php if(isset($client_files_body)) echo $client_files_body; ?>
</body>
<footer>


</footer>
</html>