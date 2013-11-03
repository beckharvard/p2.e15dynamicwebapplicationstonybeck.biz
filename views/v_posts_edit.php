<form method ='POST' action ='/posts/p_edit/<?=$post['post_id']; ?>'>

Edit your post
	<br>
	<!-- the next line has to have the PHP right after the "require>" or I get spaces at left in edit post --->
	<textarea id='myPost' cols="72" rows="25" type='text' name='content' required><?=$post['content'] = trim($post['content'], " \t\n\r" )?>
	</textarea>
    <br>
    <input class="buttons" type='submit' value='Update Post'>
</form>

