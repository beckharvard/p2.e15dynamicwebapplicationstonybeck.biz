<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
     #   echo "users_controller construct called<br><br>";
     
    } 

    public function index() {
        echo "This is the index page";
    }

  	public function signup() {

        # Setup view
            $this->template->content = View::instance('v_users_signup');
            $this->template->title   = "Sign Up";

        # Render template
            echo $this->template;

    }
	
	public function p_signup() {

    	# More data we want stored with the user
    	$_POST['created']  = Time::now();
    	$_POST['modified'] = Time::now();

    	# Encrypt the password  
    	$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);            

    	# Create an encrypted token via their email address and a random string
    	$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string()); 

    	# Insert this user into the database 
    	$user_id = DB::instance(DB_NAME)->insert("users", $_POST);

    	# For now, just confirm they've signed up - 
    	# You should eventually make a proper View for this
    	echo 'You\'re signed up';

	}


    public function login() {
        echo "This is the login page";
    }

    public function logout() {
        echo "This is the logout page";
    }

    public function profile($user_name = NULL) {
    
    
    	$view = View::instance('v_users_profile');
    	
    	$view->user_name = $user_name;
    	
    	echo $view;

	}
  

} # eoc