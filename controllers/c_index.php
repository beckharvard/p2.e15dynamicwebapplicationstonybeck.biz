<?php

class index_controller extends base_controller {
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
	} 
		
	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/index/index/
	-------------------------------------------------------------------------------------------------*/
	public function index() {
		
		# Any method that loads a view will commonly start with this
		# First, set the content of the template with a view file
			$this->template->content = View::instance('v_index_index');
			
		# Now set the <title> tag
			$this->template->title = "SpecSpec";
			
		# Render the view
			echo $this->template;
	
		# CSS/JS includes
			/*
			$client_files_head = Array("");
	    	$this->template->client_files_head = Utils::load_client_files($client_files);
	    	
	    	$client_files_body = Array("");
	    	$this->template->client_files_body = Utils::load_client_files($client_files_body);   
	    	*/
	    	
	    	echo "<br/>";
		
		    $q = "SELECT last_name, first_name 
        			FROM users
        			ORDER BY last_name";
		
			# Get the list of users
 			if ($result = DB::instance(DB_NAME)->query($q)) {	
    		/* fetch object array */
    			while ($row = $result->fetch_row()) {
        			printf ("%s, %s\n", $row[0], $row[1]);
        			echo "<br/>";
    		}
    		$result->close();
		}	
	      					     		

			
			
			

	} # End of method
	
	
	
	/*-------------------------------------------------------------------------------------------------
	Add User?  needs a first name last name uname pw email image
	-------------------------------------------------------------------------------------------------*/
	
	
} # End of class
