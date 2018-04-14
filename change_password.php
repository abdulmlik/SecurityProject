<?php
	$title = "PassWord";	//name page
	
	session_start();
	$priv=3;
	if( !isset($_SESSION['email']) ){
		header("Location: index.php");
	}

	require_once ("php pages/connect.php");
	require_once ("php pages/session.php");

	$password ="";

	if( $_SERVER['REQUEST_METHOD']=='POST' )
	{
		$flag = true;
		$password = $_POST['PassWord'];
		
		if( $password !== $_POST['PassWord2'] || $password == "" )
		{
			$flag = false;
		}
		elseif( preg_match("/[^a-zA-Z0-9_\\.,`\';@?:#\\$%&!\\+-]/",$password) 
			   || strlen($password) < 6 || strlen($password) > 16 )
		{
			$flag = false;
		}
		elseif( !preg_match("/[a-z]/",$password) || !preg_match("/[A-Z]/",$password) 
			   || !preg_match("/\\d/",$password) || !preg_match("/[_\\.,`\';@?:#\\$%&!\\+-]/",$password) )
		{
			$flag = false;
		}
		else
		{
			for( $i = 0 ; $i < strlen($password) ; $i++)
			{
				if( preg_match( "/[". substr($password,$i,1) ."]/i" , substr($password,$i+1) ) )
				{
					$flag = false;
					break;
				}
			}
		}
		
		if( $flag )
		{
			/*save database*/
			//////$sqlSaveBynewPassword insed database
			$stmt1 = $conn->prepare($sqlSaveBynewPassword);
			$stmt2 = $conn->prepare($sqlNewPassword);
			$no = $_SESSION['no'];
			$old_password = $_SESSION['password'];
			
			//
			$stmt1->bindValue(":no", $no, PDO::PARAM_INT);
			$stmt1->bindValue(":old_password", $old_password, PDO::PARAM_STR);
			$stmt1->bindValue(":newpassword", $password, PDO::PARAM_STR);

			
			//
			$stmt2->bindValue(":no", $no, PDO::PARAM_INT);
			$stmt2->bindValue(":old_password", $old_password, PDO::PARAM_STR);
			$stmt2->bindValue(":newpassword", $password, PDO::PARAM_STR);

			try{
				$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$conn->beginTransaction();
				$stmt1->execute();
				$stmt2->execute();
				$conn->commit();
				$_SESSION['password'] = $password;
				header("Location: index.php?massage=تم تغير كلمة المرور بنجاح");
			}
			catch(Exception $e) {
				$conn->rollback();
				echo "Error :: ".$e->getMessage();
			}
			finally {
				$conn = null;
			}
			
		}
		
	}//end post

	include("php pages/header.php");
	_header();
	
?>
<section class="section form_password">
    <div class="container">
	    <div class="row">
		    <form class="col-sm-12" role="form" dir="rtl"
				  id="form_pass"
				  accept-charset="utf8" 
			      method="post"
			      action="<?= $_SERVER['PHP_SELF'] ?>" 
			>
				
			  		<h1 class="text-right">تغيير كلمة المرور</h1><!-- head form -->
				    <div class="bott"><p class="text-right ss"> تشير إلى حقل مطلوب</p></div>
				
			    <div class="form-group">
				    <div class="row">
				        <label for="inputPassWord" class="col-md-2 control-label col-form-label-lg text-right">كلمة المرور الجديدة<span class="_valid"> *</span></label>
				        <div class="col-md-10">
				            <input type="password" name="PassWord" class="form-control form-control-lg" id="inputPassWord" placeholder="ادخل كلمة المرور" value="<?= $password ?>" onpause="function(e){e.preventDefault();}" onchange="Invalid_password(this)" oninvalid="Invalid_password(this)" required />
				        </div>
				    </div>
				    <div class="row">
				        <div class="col-sm-2"></div>
				        <div class="col-sm-10">
				            <small id="passHelp" class="Help form-text _HelpValid">كلمة المرور تتبع النمط التالي فيها حرف كبتل وحرف سمول ورمز من هذه الرموز (, . ` - _ @ &amp; # $ % ) وتكون بطول من ستة إلى 16 الخانة وكل خانة لا تتكرر.</small>
				        </div>
				    </div>
				 </div>
				 <div class="form-group">
				    <div class="row">
				        <label for="inputPassWord2" class="col-md-2 control-label col-form-label-lg text-right">التأكد من كلمة المرور<span class="_valid"> *</span></label>
				        <div class="col-md-10">
				            <input type="password" name="PassWord2" class="form-control form-control-lg" id="inputPassWord2" placeholder="اعد ادخال كلمة المرور" onpause="function(e){e.preventDefault();}" onchange="Invalid_password2(this)" oninvalid="Invalid_password2(this)" required />
				        </div>
				    </div>
					<div class="row">
					    <div class="col-sm-2"></div>
					    <div class="col-sm-10">
						   <small id="idHelp" class="Help form-text _HelpValid">اعد ادخال كلمة المرور.</small>
					    </div>
			    </div>
				</div>
				<div class="form-group row">
					<div class="col-sm-2"></div>
					<div class="col-sm-4 col-md-3 col-lg-2">
					  <button type="submit" class="btn btn-info btn-lg btn-block">حفظ</button>
					</div>
				</div>
		    </form>
        </div>
    </div>
</section>
<?php
	include("php pages/footer.php");
	_footer();
?>