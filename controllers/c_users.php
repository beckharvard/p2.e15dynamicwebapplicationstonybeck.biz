<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
     #   echo "users_controller construct called<br><br>";
             
        $client_files_head = Array(
        	'../js/validate.js',
        	'../../js/validate.js',
    		'../css/style_php.css',
    		'../../css/style_php.css'
    		);
    	$this->template->client_files_head = Utils::load_client_files($client_files_head);
    	
    	$client_files_body = Array(
    		);
    	$this->template->client_files_body = Utils::load_client_files($client_files_body);
     
    } 

    public function index() {
    
        $this->template->content = View::instance('v_users_index');
        $this->template->title   = "THE INDEX";
    

    	
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

    	# More data we want stored with the user
    	$_POST['created']  = Time::now();
    	$_POST['modified'] = Time::now();

    	# Encrypt the password (with salt)
    	$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);            

    	# Create an encrypted token via their email address and a random string
    	$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string()); 

    	# Insert this user into the database 
    	$user_id = DB::instance(DB_NAME)->insert("users", $_POST);

 		# connect to the db and add to the table the user data from post 
		#DB::instance(DB_NAME)->insert_row('users', $_POST);
		# commented the above because it seems to be the cause of redundant records
	
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
        	setcookie("token", $token, strtotime('+2 weeks'), '/');

        	# Send them to the main page - or whever you want them to go
        	Router::redirect("/index");

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

	# original text here was     public function profile($user_name = NULL) {
    public function profile() {
    

    	#Set up the view
    	$this->template->content = View::instance('v_users_profile');
    	$this->template->title = "Profile";
    	
    	#Pass the data to the View
    	#$this->template->content->user_name = $user_name;
    	
    	#Display the view
    	echo $this->template;

	}
  

} # eoc