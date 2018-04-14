<?php
	$title = "Sign Up";	//name page

	session_start();
	$priv=3;
	if( isset($_SESSION['email']) ){
		header("Location: index.php");
	}
	
	$flag  = false;		//singup.php OR show.php

	$id		= "";		//رقم القيد

	$name 	= "";		//الاسم
	$na1	= ["",""];	//خاصة بحفظ القيمة

	$nameB	= "";		//اسم الاب
	$naB1	= ["",""];	//خاصة بحفظ القيمة

	$nameL	= "";		//اسم العائلة
	$naL1	= ["",""];	//خاصة بحفظ القيمة

	$Bdate	= 1;		//اليوم
	$Bmonth	= 1;		//الشهر
	$Byear	= date('Y');//السنة

	$email	= "";		//البريد

	$socialSecurityNumber	= ""; //الرقم الوطني

	$flag_date = true; //VALIDATETION DATE
	$flag_SSN  = true; //VALIDATETION social Security Number

	if( $_SERVER['REQUEST_METHOD']=='POST' )
	{
		$id		= $_POST['inputId'];
		//$name
		$na1	= $_POST['inputName'];
		foreach($_POST['inputName'] as $val)
		{
			$name .= " ". $val;
		}
		//$nameB
		$naB1	= $_POST['inputNameB'];
		foreach($_POST['inputNameB'] as $val)
		{
			$nameB .= " ". $val;
		}
		//$nameL
		$naL1	= $_POST['inputNameL'];
		foreach($_POST['inputNameL'] as $val)
		{
			$nameL .= " ". $val;
		}
		$Bdate	= $_POST["dd"];
		$Bmonth	= $_POST["mm"];
		$Byear	= $_POST["yyyy"];
		$date   = new DateTime();
		$date->setDate($Byear, $Bmonth, $Bdate);
		
		$email	= $_POST['inputEmail'];
		$socialSecurityNumber	= $_POST['inputN'];
		
		$args_op= array(
			'inputId'		=> array(
								"options" => array("regexp"=>"/^\s*([0-9]{4,9})\s*$/")
								)
			,
			'inputName'		=> array(
								"options" => array("regexp"=>"/\s*([\u0621-\u064A]{2,10}(\s+[\u0621-\u064A]{2,10})?)\s*/")
								)
			,
			'inputNameB'    => array(
								"options" => array("regexp"=>"/\s*([\u0621-\u064A]{2,10}(\s+[\u0621-\u064A]{2,10})?)\s*/")
								)
			,
			'inputNameL' 	=> array(
								"options" => array("regexp"=>"/\s*([\u0621-\u064A]{2,10}(\s+[\u0621-\u064A]{2,10})?)\s*/")
								)
			,
			'inputEmail'   	=> FILTER_VALIDATE_EMAIL,
			'inputN'   	 	=> array(
								"options" => array("regexp"=>"/[12]{2}[0-9]{10}/")
								)
		);
		$flag_date = true;
		$flag_SSN  = true;
		if( $date > new DateTime('-1 day')  ){
			$flag_date = false;
		}
		if( $date->format('Y') != substr($socialSecurityNumber , 1 , 4) ){
			$flag_SSN = false;
		}
		
		if( filter_input_array(INPUT_POST,$args_op) && $flag_date && $flag_SSN )
		{
			$patt = "/\s{2,}/";
			
			$id	   	= trim($id);
			
			$name  	= preg_replace($patt, " ", $name);
			$name   = trim($name);
			
			$nameB  = preg_replace($patt, " ", $nameB);
			$nameB  = trim($nameB);
			
			$nameL  = preg_replace($patt, " ", $nameL);
			$nameL  = trim($nameL);
			
			$passWord 	= rand(100000,999999);
			
			$salt  = uniqid(mt_rand(), true);
			/* save database */
			require_once ("php pages/connect.php");
			//$sqlSaveData => connect.php
			$stmt = $conn->prepare($sqlSaveData);
			$stmt2 = $conn->prepare($sqlSaveData2);
			
			
			$de = $date->format('Y-m-d');
			/* user_info */
			$stmt->bindparam(':name', $name, PDO::PARAM_STR);
			//bindparam($palceholders,$value,$datatype);
			$stmt->bindparam(':namep', $nameB, PDO::PARAM_STR);
			$stmt->bindparam(':namel', $nameL, PDO::PARAM_STR);
			$stmt->bindparam(':email', $email, PDO::PARAM_STR);
			$stmt->bindparam(':date', $de, PDO::PARAM_STR);
			$stmt->bindparam(':id', $id,PDO::PARAM_INT);
			$stmt->bindparam(':SSN', $socialSecurityNumber,PDO::PARAM_INT);
			$stmt->bindparam(':password', $passWord, PDO::PARAM_STR);
			
			/* password_info */
			$salt_password = "" . $salt . $passWord;
			//$user_no = "";
			//$stmt->bindparam(':user_no', $user_no, PDO::PARAM_INT);
			$stmt2->bindparam(':salt_pass', $salt_password, PDO::PARAM_STR);
			$stmt2->bindparam(':_salt', $salt, PDO::PARAM_STR);
			$stmt2->bindparam(':password', $passWord, PDO::PARAM_STR);
			
			try{
				$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$conn->beginTransaction();
				
				$stmt->execute();
				$user_no = $conn->lastInsertId();
				$stmt2->execute();
				
				$conn->commit();
				
				$_SESSION['email'] = $email;
				$_SESSION['password'] =$passWord;
				$_SESSION['no'] = $user_no;
				$_SESSION['priv'] = 2;
				
			}
			catch(Exception $e) {
				$conn->rollback();
				echo "Error :: ".$e->getMessage();
			}
			finally{
				$conn = null;
			}
							 
			$title = "Show Data";//name page
			$flag  = true;
		}// end if filter
	}// end if post

	include ("php pages/header.php");
	_header();
    if($flag)
	{
		include ("php pages/show.php");
		_show();
	}// end if 
    else {
		include ("php pages/signup.php");//
		_signup();
    }//end else

	include ("php pages/footer.php");
	_footer();
?>