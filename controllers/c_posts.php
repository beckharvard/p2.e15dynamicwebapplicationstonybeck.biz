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
    	$q = "SELECT 
            	posts .* , 
            	users.first_name, 
            	users.last_name
        	FROM posts
        	INNER JOIN users 
        	    ON posts.user_id = users.user_id";

    	# Run the query
    	$posts = DB::instance(DB_NAME)->select_rows($q);

    	# Pass data to the View
    	$this->template->content->posts = $posts;

    	# Render the View
    	echo $this->template;

	}
    
    public function users()  {
    	# Set up the View
    	$this->template->content = View::instance('v_posts_users');
    	  	    	 
    	# Render template
        echo $this->template;
    	
    	# Get the list of users
    	if ($this->user) {
			
			echo "<br/>";
			
			echo "<h2>Here are the other users:</h2>";
			
			echo "<br/>";
		
		    $q = "SELECT last_name, first_name 
        			FROM users
        			ORDER BY last_name";
		
			# Get the list of users
 			if ($result = DB::instance(DB_NAME)->query($q)) {	
    		/* fetch object array */
    			while ($row = $result->fetch_row()) {
        			printf ("%s, %s\n", $row[0], $row[1]);
        			echo "<pre>";
        			echo "<a href= >Subscribe</a>"; 
        			echo "<br/>";
        			echo "<br/>";
    		}
    		echo "</pre>";
    		$result->close();
    		
    		}
		}	

    }
    
    # odd function names are less guessable
	public function add()  {
	 	# Set up the View
    	$this->template->content = View::instance('v_posts_add');
    	# echo "This is something about adding a post";
    	
    	# Render template
        echo $this->template;
    }
    
    # odd function names are less guessable
    public function p_add()  {
    	# Set up the View
    	$this->template->content = View::instance('v_posts_p_add');
    	
    	# STILL NEED TO CHECK THAT WE HAVE A USER_ID!
    	#   !!!!! VERY IMPORTANT !!!!!
    	
    	# sanitize the post data
    	#$_POST = DB::instance(DB_NAME)-sanitize($_POST);
    	
    	# More data we want stored with the user
    	$_POST['created']  = Time::now();
    	$_POST['modified'] = Time::now();
    	# Associate this post with this user
        $_POST['user_id']  = $this->user->user_id;

    	$author_user_id = DB::instance(DB_NAME)->insert("posts", $_POST);
    	
    	
    	# Render template
        #echo $this->template;
    }
    
    public function edit()  {
    	 # Set up the View
    
    	$this->template->content = View::instance('v_posts_edit');
    	 echo "This is something about editing a post";
    	 
    	 $_POST['modified'] = Time::now();
    	# Associate this post with this user
        $_POST['user_id']  = $this->user->user_id;

    	$author_user_id = DB::instance(DB_NAME)->update("posts", $_POST);
    }
    
    public function deletepost()  {
     	# Set up the View
     
    	#$this->template->content = View::instance('v_posts_deletepost');
    	 echo "This is something about deleting a post";
    }
    
}    
?>    