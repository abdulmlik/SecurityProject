<?php
	$title = "Sign Up";	//name page

	session_start();
	$priv=3;
	if( !isset($_SESSION['email']) ){
		header("Location: index.php");
	}

	require_once ("php pages/connect.php");
	require_once ("php pages/session.php");

	$stmt = $conn->prepare($sqlDisplay);
	//
	$stmt->bindValue(":no", $_SESSION['no'], PDO::PARAM_INT);
	$stmt->bindValue(":password", $_SESSION['password'], PDO::PARAM_STR);
	$stmt->execute();

	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	$conn = null;
	include ("php pages/header.php");
	_header();
?>
<section class="section display_data" dir="rtl">
  <div class="container">
	<div class="row">
		
	<div class="col-md-6">
	<div class="row">
	<div class="col-sm-12">
		<p class="bg-p lead text-right">البيانات غير مشفرة</p>
	</div>
	</div>
	<table class="table table-bordered" dir="rtl">
	  <thead class="table-info">
		<tr>
		  <th scope="col" class="w-25">#</th>
		  <th scope="col">البيانات</th>
		</tr>
	  </thead>
	  <tbody>
		<tr>
		  <th scope="row">رقم القيد</th>
		  <td><?= $row['_id'] ?></td>
		</tr>
		<tr>
		  <th scope="row">الاسم</th>
		  <td><?= $row['_first_name'] ?></td>
		</tr>
		<tr>
		  <th scope="row">الاب</th>
		  <td><?= $row['_parent_name'] ?></td>
		</tr>
		<tr>
		  <th scope="row">اسم العائلة</th>
		  <td><?= $row['_last_name'] ?></td>
		</tr>
		<tr>
		  <th scope="row">تاريخ الميلاد</th>
		  <td><?= $row['_birthday'] ?></td>
		</tr>
		<tr>
		  <th scope="row">البريد الاكتروني</th>
		  <td><?= $row['_email'] ?></td>
		</tr>
		<tr>
		  <th scope="row">الرقم الوطني</th>
		  <td><?= $row['_SSN'] ?></td>
		</tr>
		<tr>
		  <th scope="row">Salt</th>
		  <td><?= $row['_salt'] ?></td>
		</tr>
		<tr>
		  <th scope="row">كلمة المرور</th>
		  <td class="_invalid" ><?= "غير قابلة لفك التشفير" ?></td>
		</tr>
	  </tbody>
	</table>
	</div>
	<div class="col-md-6">
	<div class="row">
	<div class="col-sm-12">
		<p class="bg-p lead text-right">البيانات مشفرة</p>
	</div>
	</div>
	<table class="table table-bordered" dir="rtl">
	  <thead class="table-info">
		<tr>
		  <th scope="col" class="w-25">#</th>
		  <th scope="col">البيانات</th>
		</tr>
	  </thead>
	  <tbody>
		<tr>
		  <th scope="row">رقم القيد</th>
			<td><?= bin2hex($row['id']) ?></td>
		</tr>
		<tr>
		  <th scope="row">الاسم</th>
			<td><?= bin2hex($row['first_name']) ?></td>
		</tr>
		<tr>
		  <th scope="row">الاب</th>
			<td><?= bin2hex($row['parent_name']) ?></td>
		</tr>
		<tr>
		  <th scope="row">اسم العائلة</th>
			<td><?= bin2hex($row['last_name']) ?></td>
		</tr>
		<tr>
		  <th scope="row">تاريخ الميلاد</th>
			<td><?= bin2hex($row['birthday']) ?></td>
		</tr>
		<tr>
		  <th scope="row">البريد الاكتروني</th>
			<td><?= bin2hex($row['email']) ?></td>
		</tr>
		<tr>
		  <th scope="row">الرقم الوطني</th>
			<td><?= bin2hex($row['SSN']) ?></td>
		</tr>
		<tr>
		  <th scope="row">Salt</th>
			<td><?= bin2hex($row['salt']) ?></td>
		</tr>
		<tr>
		  <th scope="row">كلمة المرور</th>
			<td><?= $row['pass'] ?></td>
		</tr>
	  </tbody>
	</table>
	</div>
		
   </div>
  </div>
</section>
<?php
	include ("php pages/footer.php");
	_footer();
?>