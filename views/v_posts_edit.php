<form method ='POST' action ='/posts/p_edit/<?=$post['post_id']; ?>'>

Edit your post<br>
	<textarea id='myPost' cols="72" rows="25" type='text' name='content'><?=$post['content']?></textarea>
    <br>
    <input type='submit' value='Update Post'>

</form>

