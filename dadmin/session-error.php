<?php
//session_start();

	if(isset($_SESSION['error']))
	{
		echo $_SESSION['error'];
		unset($_SESSION['error']);
		
	}
	
	if(isset($_SESSION['msg']))
	{
		echo $_SESSION['msg'];
		unset($_SESSION['msg']);
		
	}

?>
