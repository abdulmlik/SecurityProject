<?php
	session_start();
	$priv=3;
	if( isset($_SESSION['email']) ){
		header("Location: index.php");
	}

	$title = "PassWord";	//name page
	
	$email	  ="";
	$password ="";
	$err = true; //[Email,PassWord]

	if( $_SERVER['REQUEST_METHOD']=='POST' )
	{
		$email	  = $_POST['Email'];
		$password = $_POST['PassWord'];
		
		/* database login */
		require_once ("php pages/connect.php");
		
		//$sqllogin connect.php
		$stmt = $conn->prepare($sqllogin);
		$stmt->bindparam(':email',   $email);//bindparam($palceholders,$value,$datatype);
		$stmt->bindparam(':password',$password);
		$stmt->execute();
		
		if( $stmt->rowCount() == 1 )
		{
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			
			$_SESSION['email']    = $email;
			$_SESSION['password'] = $password;
			$_SESSION['no']       = $row['no'];
			$_SESSION['priv']     = $row['priv'];
			
			header("Location: index.php?massage=تم الدخول إلى الموقع بنجاح");
		} else {
			$err = false;// password or email is false
		}//end else rowcount
		
		/* end database login */
	}//end if post

	include("php pages/header.php");
	_header();
	
?>
<section class="section form_signin">
    <div class="container">
	    <div class="row">
		    <form class="col-sm-12" role="form" dir="rtl" 
			accept-charset="utf8" 
			method="post"
			action="<?= $_SERVER['PHP_SELF'] ?>" >
				<div class="row">
			 		<h1 class="text-right col-md-2 col-sm-4">تسجيل الدخول</h1><!-- head form -->
				    <div class="bott"><p class="text-right ss"> تشير إلى حقل مطلوب</p></div>
				</div>
				<div class="form-group ">
				   <div class="row">
				      <label for="inputEmail" class="col-md-2 control-label col-form-label-lg text-right">البريد الاكتروني<span class="_valid"> *</span></label>
					  <div class="col-md-10">
					      <input type="email" name="Email" class="form-control form-control-lg" id="inputEmail" placeholder="ادخل بريدك الاكتروني"
						value="<?= $email ?>"
					    required /><!-- pattern is A valid e-mail According to standards w3.org -->
					  </div>
				    </div>
				    <div class="row">
					    <div class="col-md-2"></div>
					    <div class="col-md-10"> 
								<?php 
									echo '<small id="idHelp" class="Help form-text ';
									if($err)
									{
										echo '_HelpValid">';
										echo "ادخل بريدك المسجل به";
									}else{
										echo '_HelpInvalid">';
										echo "الرجاء التأكد من بريد";
									}
				  					echo '</small>';
								?>
					    </div>
				    </div>
			    </div>
			    <div class="form-group">
				    <div class="row">
				        <label for="inputPassWord" class="col-md-2 control-label col-form-label-lg text-right">كلمة المرور<span class="_valid"> *</span></label>
				        <div class="col-md-10">
				            <input type="password" name="PassWord" class="form-control form-control-lg" id="inputPassWord" placeholder="ادخل كلمة المرور" value="<?= $password ?>"  required />
				        </div>
				    </div>
				    <div class="row">
				        <div class="col-md-2"></div>
						<div class="col-md-10">
				        <?php 
							echo '<small id="idHelp" class="Help form-text ';
							if($err)
							{
								echo '_HelpValid">';
								echo "ادخل كلمة المرور";
							}else{
								echo '_HelpInvalid">';
								echo "الرجاء التأكد من كلمة المرور";
							}
							echo '</small>';
						?>
						</div>
				    </div>
				 </div>
				<div class="form-group row">
					<div class="col-sm-2"></div>
					<div class="col-sm-4 col-md-3 col-lg-2">
					  <button type="submit" class="btn btn-info btn-lg btn-block">تسجيل الدخول</button>
					</div>
				</div>
		    </form>
			<?php 
				if(isset($_GET['u']))
				{
			?>
			<div class="col-12">
				<p class="bg-p lead text-right">اعد تسجيل الدخول</p>
			</div>
			<?php
				}
			?>
        </div>
    </div>
</section>
<?php
	include("php pages/footer.php");
	_footer();
?>