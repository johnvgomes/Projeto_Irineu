<?php 

session_start();

function loggedin(){
	
	if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
            
            return true;
	}else{
            return false;
	}
	
        
}

function getuser($id,$fild){
    
   $query = mysql_query("SELECT $fild FROM users Where id='$id'");
   $run = mysql_fetch_array($query);
   return $run[$fild];
    
}

        ?>