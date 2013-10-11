<?php
class posts_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        echo "posts_controller construct called<br><br>";
    } 
     public function user_posts() {
        echo "These are the posts by this user";
    }
    
}    
?>    