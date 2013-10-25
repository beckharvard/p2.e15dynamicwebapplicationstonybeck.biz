<?php

	class practice_controller extends base_controller {
	
		public function test_db() {
	
		#$q = 'INSERT INTO users
		#	SET first_name = "Albert",
		#	last_name = "Einstein"';
		#	
		#	
		#	DB:instance(DB_NAME)->query($q);
		}
		
		$_POST['first_name'] = '2';
		
		$_POST = DB::instance(DB_NAME)-sanitize($_POST);
		
		$q = 'SELECT email 
			FROM users 
			WHERE first_name = "'.$_POST['first_name'].'"';
			
			echo DB::instance(DB_NAME)->select_field($q);
	
	}
?>

#YEAH. htis needs to be fixed.