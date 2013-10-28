<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
             
        $client_files_head = Array(
        	'../js/validate.js',
        	'../../js/validate.js',
        	'../js/validate_posts.js',
        	'../../js/validate_posts.js',
    		'../css/style_php.css',
    		'../../css/style_php.css',
    		'../../../css/style_php.css'
    		);
    	$this->template->client_files_head = Utils::load_client_files($client_files_head);
    	
    	$client_files_body = Array(
    		'../js/validate.js',
        	'../../js/validate.js',
        	'../js/validate_posts.js',
        	'../../js/validate_posts.js',
    		'../css/style_php.css',
    		'../../css/style_php.css',
    		'../../../css/style_php.css'
    		);
    	$this->template->client_files_body = Utils::load_client_files($client_files_body); 
    	   
    } 

    public function index() {
    	 # Set up the View
    	
    }

  	public function signup($error = NULL) {

        # Setup view
        $this->template->content = View::instance('v_users_signup');
        $this->template->title   = "Sign Up";
            
        # Pass data to the view
		$this->template->content->error = $error;

        # Render template
        echo $this->template;          
    }
	
	public function p_signup() {
	
		# this is the  method I came up with....AND it works
		#------------------------------------------------------------------
		$this->template->content = View::instance('v_users_signup');
    	$this->template->title = "Signed-up";
    	
    	#setup for mail
    	$to = $_POST['email'];
    	$subject = "Welcome to SpecSpec!";
    	$message = "It's great to mmet you. Log in at p2.e15dynamicwebapplicationstonybeck.biz";
    	$from = 'beck@fas.harvard.edu';
    	$headers = "From:" . $from; 	

    	# More data we want stored with the user
    	$_POST['created']  = Time::now();
    	$_POST['modified'] = Time::now();

    	# Encrypt the password (with salt)
    	$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);            

    	# Create an encrypted token via their email address and a random string
    	$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string()); 

    	# Insert this user into the database 
    	$user_id = DB::instance(DB_NAME)->insert("users", $_POST);
    	
    	#Let's mail them out a welcome email 
    	if(!$this->user) {
    		mail($to, $subject, $message, $headers);
    	} 	
		# sent them to the login page
		Router::redirect('/users/login');	
	}

    public function login($error = NULL) {
        # Set up the view
    	$this->template->content = View::instance("v_users_login");
    	$this->template->title = "Log In";

    	# Pass data to the view
    	$this->template->content->error = $error;
    	
    	# Render the view
    	echo $this->template;
    	
    }
    
	public function p_login() {

    	# Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
    	$_POST = DB::instance(DB_NAME)->sanitize($_POST);

    	# Hash submitted password so we can compare it against one in the db
    	$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

    	# Search the db for this email and password
    	# Retrieve the token if it's available
    	$q = "SELECT token 
        	FROM users 
       	 	WHERE email = '".$_POST['email']."' 
        	AND password = '".$_POST['password']."'";

    	$token = DB::instance(DB_NAME)->select_field($q);

    	# If we didn't find a matching token in the database, it means login failed
    	if(!$token) {

        	# Send them back to the login page
        	Router::redirect("/users/login/error");

    	# But if we did, login succeeded! 
    	} else {

        	/* 
        	Store this token in a cookie using setcookie()
        	Important Note: *Nothing* else can echo to the page before setcookie is called
        	Not even one single white space.
        	param 1 = name of the cookie
        	param 2 = the value of the cookie
        	param 3 = when to expire
        	param 4 = the path of the cooke (a single forward slash sets it for the entire domain)
        	*/
        	setcookie("token", $token, strtotime('+1 year'), '/');

        	# Send them to the main page - or whever you want them to go
        	Router::redirect("/posts");
    	}
	}

    public function logout() {
        # Generate and save a new token for next login
    	$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

    	# Create the data array we'll use with the update method
    	# In this case, we're only updating one field, so our array only has one entry
    	$data = Array("token" => $new_token);

    	# Do the update
    	DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

    	# Delete their token cookie by setting it to a date in the past - effectively logging them out
    	setcookie("token", "", strtotime('-1 year'), '/');

    	# Send them back to the login page.
    	Router::redirect("/users/login");
    }
	#got rid of  public function profile($user_name = NULL) {
    public function profile() {
    
    	if(!$this->user) {
            die("Members only. <a href='/users/login'>Login</a>");
        }
    
    	#Set up the view
    	$this->template->content = View::instance('v_users_profile');
    	$this->template->title = "Profile";
    	
    	# Build the query
    	$q = 'SELECT
            posts.content,
            posts.created,
            posts.post_id
        FROM posts
        WHERE posts.user_id = '.$this->user->user_id.' 
            ORDER BY posts.created DESC' ;

    	# Run the query
    	$posts = DB::instance(DB_NAME)->select_rows($q);

    	# Pass data to the View
    	$this->template->content->posts = $posts;  	
    	
    	#Display the view
    	echo $this->template;
	}
	
	public function editProfile() {
	
		if(!$this->user) {
            die("Members only. <a href='/users/login'>Login</a>");
        }
	
		#Set up the view
    	$this->template->content = View::instance('v_users_editProfile');
    	$this->template->title = "Edit Profile";
    	
    	# Prepare the data array to be inserted
    	$data = Array(
    		"first_name" => $this->user->first_name,
    	    "last_name" => $this->user->last_name,
    	    "email" => $this->user->email,
    	    "password" => $this->user->password,
    	    "user_id" => $this->user->user_id
    	    );
    	
    	#Pass the data to the View
    	$this->template->content->user       = $data;
    	
    	#Display the view
    	echo $this->template;
	}
	
	public function p_editProfile($id) {
	
		if(!$this->user) {
            die("Members only. <a href='/users/login'>Login</a>");
        }
	
	    	# Set up the View
    	$this->template->content = View::instance('v_users_p_editProfile');
  		
  		# Set the modified time  
    	$_POST['modified'] = Time::now();
    	# be sure to Associate this post with this user
    	
    	# NOT SURE I NEED THIS...
        $_POST['user_id']  = $this->user->user_id;  
         
    	$where_condition = 'WHERE user_id = '.$id;    
     
 		$updated_post = DB::instance(DB_NAME)->update('users', $_POST, $where_condition);
 		
 		# Send them back to the login page.
    	Router::redirect("/users/profile");
	
	}
} # eoc