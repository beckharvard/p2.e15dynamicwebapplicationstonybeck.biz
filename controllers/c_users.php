<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
     #   echo "users_controller construct called<br><br>";
             
        $client_files_head = Array(
    		'../css/style_php.css',
    		'../../css/style_php.css'
    		);
    	$this->template->client_files_head = Utils::load_client_files($client_files_head);
    	
    	$client_files_body = Array(
    		);
    	$this->template->client_files_body = Utils::load_client_files($client_files_body);
     
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
	
		$this->template->content = View::instance('v_users_profile');
    	$this->template->title = "Signed-up";

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
    	echo $this->template->content = View::instance('v_users_p_signup');
    	

	}


    public function login() {
        echo "This is the login page";
    }

    public function logout() {
        echo "This is the logout page";
    }

    public function profile($user_name = NULL) {
    
    	#Set up the view
    	$this->template->content = View::instance('v_users_profile');
    	$this->template->title = "Profile";
    	
    	#Pass the data to the View
    	$this->template->content->user_name = $user_name;
    	
    	#Display the view
    	echo $this->template;

	}
  

} # eoc