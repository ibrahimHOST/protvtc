<?php
    
    include('config.php');
    session_start();
	
			if(!empty($_SESSION['login_user'])){
			$user_check = $_SESSION['login_user'];
			$s_sql = mysqli_query($conn,"select id from user 
			where id = '$user_check'");
					$row = mysqli_fetch_array($s_sql,MYSQLI_ASSOC);
					$login_session = $row['id'];
			}
		    

	if (!isset($_SESSION['login_user'])){
		header("location:login.php");
		die();
	}
	
	
	

?>