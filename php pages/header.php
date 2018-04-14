<?php 

	$name_page = str_replace(array(dirname($_SERVER['SCRIPT_NAME']), ".php"), "", $_SERVER['SCRIPT_NAME']);
	$name_page = trim($name_page , '\/');

    if( empty($title) )// true if title is empty
	{
		$title = $name_page ;
	}

	$PATH = "http://localhost/SecurityProject cs340/";
	

	function _header()
	{
		global $PATH,$title;
?>
<!doctype html>
<html lang="en">
  <head>
    <title><?= $title ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Security Websites">
	<meta name="author" content="Abdulmalik Ben Ali">
	  
    <link rel="icon" type="image/x-icon" href="<?= $PATH ?>/img/icons8_Protect.ico" />
	<!-- <link rel="shortcut icon" type="image/x-icon" href="<?= $PATH ?>/img/icons8_Protect.ico" /> -->
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="<?= $PATH ?>css/bootstrap.min.css">
	<!-- 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	-->
	<!-- My CSS -->
	<link rel="stylesheet" href="<?= $PATH ?>css/style.css">
	 
  </head>
  <body>
	  <nav class="navbar navbar-expand-sm navbar-fixed-top bg-info navbar-dark">
		  <div class="container-fluid">
			  <a class="navbar-brand text-capitalize" href="<?= $PATH ?>index.php">security project CS340</a>
		  </div>
	  </nav>

<?php
	
	}

?>