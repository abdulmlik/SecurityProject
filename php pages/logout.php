<?php
	session_start();
	
	if( !isset($_SESSION['email']) ){
		header("Location: index.php");
	}
	
	session_unset();
	session_destroy();
	header("Location: ../index.php?massage=تم الخروج من الموقع بنجاح");
?>