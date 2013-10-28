<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<link href="../css/style_php.css" type="text/css" rel="stylesheet">
	<link href="../../css/style_php.css" type="text/css" rel="stylesheet">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript">
</script>
<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js">
</script>
			
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
</head>

<body>	

	 <div id='menu'>

        <!-- Menu for users who are logged in -->
        <?php if($user): ?>
			<a href='/users/logout'>Logout</a>
            <a href='/users/profile'>Profile</a>
			<a href='/posts/add'>Add Post</a>
			<a href='/posts/'>View Posts</a>
			<a href='/posts/users'>Follow users</a>


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
<hr/>
<div style="float:left;">
<h2>SpecSpec's +1 features</h2>
<ul>
	<li>Ability to edit own posts from Profile</li>
	<li>Ability to edit own Profile</li>
</ul>
</div>
<div style="padding-left: 90%;">

<ul>
<li>Anthony Beck</li>
<li>DWA Project 2</li>
<li>beck@fas.harvard.edu</li>

</ul>
</div>

</footer>
</html>