<?php
	$title = "Home";	//name page
	session_start();
	
	$priv=3;
	if( isset($_SESSION['email']) ){
		require_once ("php pages/connect.php");
		require_once ("php pages/session.php");
	}

	include("php pages/header.php");
	_header();
	
?>
<section class="section home">
    <div class="container">
		<?php if( !isset($_SESSION['email'])) { ?>
	    <div class="row">
            <div class="col-sm-12 alert alert-light">
		        <p class="lead text-right">للتسجيل في الموقع من <a href="<?= $PATH ?>data.php">هنا</a></p>
		        <p class="lead text-right">لتسجيل الدخول من <a href="<?= $PATH ?>login.php">هنا</a></p>
	        </div>
        </div>
		<?php } else { ?>
		<div class="row">
            <div class="col-sm-12 alert alert-light">
		        <p class="lead text-right">لتسجيل الخروج الموقع من <a href="<?= $PATH ?>php pages/logout.php">هنا</a></p>
				<p class="lead text-right">لتغير كلمة المرور من <a href="<?= $PATH ?>change_password.php">هنا</a></p>
		        <p class="lead text-right">لعرض البيانات من <a href="<?= $PATH ?>display.php">هنا</a></p>
	        </div>
        </div>
		<?php }
			  if(isset($_GET['massage']))
			  {
			?>
			<div class="row">
			<div class="col-sm-12">
				<p class="bg-p lead text-right"><?= $_GET['massage'] ?></p>
			</div>
		    </div>
			<?php
			  }
			?>
    </div>
</section>

<?php
	include ("php pages/footer.php");
	_footer();
?>