<?php if(isset($user)): ?>
	<h2>This is <?=$user->first_name?>'s  profile...</h2>
<?php else: ?>
	<h2> No user has been specified</h2>
<?php endif; ?>

<?php if($user) echo 'First Name: '.$user->first_name;?>
<?php echo '<br/>'; ?>
<?php if($user) echo 'Last Name: '.$user->last_name; ?>
<?php echo '<br/>'; ?>
<?php if($user) echo 'email: '.$user->email; ?>
<?php echo '<br/>'; ?>
<?php if($user) 

$convert_time = $user->created;
echo 'Member since: ';
echo date('M d Y', $convert_time); 

?>