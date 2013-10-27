<?php
class posts_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        
        if(!$this->user) {
            die("Members only. <a href='/users/login'>Login</a>");
        }
    } 
    
   public function index() {

    	# Set up the View
    	$this->template->content = View::instance('v_posts_index');

    	
    	$this->template->title   = "Posts";

    	# Build the query
    	$q = 'SELECT 
            posts.content,
            posts.created,
            posts.user_id AS post_user_id,
            users_users.user_id AS follower_id,
            users.first_name,
            users.last_name
        FROM posts
        INNER JOIN users_users 
            ON posts.user_id = users_users.user_id_followed
        INNER JOIN users 
            ON posts.user_id = users.user_id
        WHERE users_users.user_id = '.$this->user->user_id;

    	# Run the query
    	$posts = DB::instance(DB_NAME)->select_rows($q);

    	# Pass data to the View
    	$this->template->content->posts = $posts;

    	# Render the View
    	echo $this->template;

	}
    
	public function users() {

    	# Set up the View
    	$this->template->content = View::instance("v_posts_users");
    	$this->template->title   = "Users";

    	# Build the query to get all the users
    	$q = "SELECT *
    	    FROM users";

    	# Execute the query to get all the users. 
    	# Store the result array in the variable $users
    	$users = DB::instance(DB_NAME)->select_rows($q);

    	# Build the query to figure out what connections does this user already have? 
    	# I.e. who are they following
    	$q = "SELECT * 
    	    FROM users_users
        	WHERE user_id = ".$this->user->user_id;

    	# Execute this query with the select_array method
    	# select_array will return our results in an array and use the "users_id_followed" field as the index.
    	# This will come in handy when we get to the view
    	# Store our results (an array) in the variable $connections
    	$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');

    	# Pass data (users and connections) to the view
    	$this->template->content->users       = $users;
    	$this->template->content->connections = $connections;

    	# Render the view
    	echo $this->template;
	}
    
    public function follow($user_id_followed) {

    	# Prepare the data array to be inserted
    	$data = Array(
    	    "created" => Time::now(),
    	    "user_id" => $this->user->user_id,
    	    "user_id_followed" => $user_id_followed
    	    );

    	# Do the insert
    	DB::instance(DB_NAME)->insert('users_users', $data);

    	# Send them back
    	Router::redirect("/posts/users");

	}

	public function unfollow($user_id_followed) {

    	# Delete this connection
    	$where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
    	DB::instance(DB_NAME)->delete('users_users', $where_condition);

    	# Send them back
    	Router::redirect("/posts/users");

	}
    
    public function add()  {
	 	# Set up the View
    	$this->template->content = View::instance('v_posts_add');
    	# echo "This is something about adding a post";
    	
    	# Render template
        echo $this->template;
    }
    
    public function p_add()  {
    	# Set up the View
    	$this->template->content = View::instance('v_posts_p_add');
    	
    	# More data we want stored with the user
    	$_POST['created']  = Time::now();
    	$_POST['modified'] = Time::now();
    	# Associate this post with this user
        $_POST['user_id']  = $this->user->user_id;

    	$author_user_id = DB::instance(DB_NAME)->insert("posts", $_POST);
    	
    	echo "Your post has been added. <a href='/posts/add'>Add another</a>";
    }
    
    public function edit($edited)  {
    	# Set up the View
    	$this->template->content = View::instance('v_posts_edit');
    		
    	# Build the query to get the post
    	$q = "SELECT content
    	    FROM posts 
    	    WHERE post_id = ".$edited;

    	# Execute the query to get all the users. 
    	# Store the result array in the variable $post
    	$editable = DB::instance(DB_NAME)->select_row($q);
    	
    	# Pass data to the view
    	$this->template->content = $editable['content'];
    	
    	# Render template
        echo $this->template;
    	 

    }
    
    public function p_edit()  {
    	# Set up the View
    	$this->template->content = View::instance('v_posts_p_edit');
    
    	$data = Array(
    	 	"post_id" => $toBe_edited,
    	 	"content" => $toBe_edited,
    	    "created" => posts.created,
    	    "modified" => Time::now(),
    	    "user_id" => $this->user->user_id
    	    );
    	    
		$updated_post = DB::instance(DB_NAME)->update('posts', $data);
    	# Associate this post with this user
        $_POST['user_id']  = $this->user->user_id;

 
        
    }
    
    public function deletepost()  {
     	# Set up the View
     
    	#$this->template->content = View::instance('v_posts_deletepost');
    	# echo "This is something about deleting a post";
    }
}?>    