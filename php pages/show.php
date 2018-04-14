<?php 

function _show()
{
	global $PATH,$id,$name,$nameB,$nameL,$date,$email,$socialSecurityNumber,$passWord;
?>
<section class="section show_input" dir="rtl">
  <div class="container">
	<div class="row">
	<div class="col-md-8">
		
	<div class="row">
	<div class="col-sm-12">
		<p class="bg-p lead text-right">تم فتح الحساب بنجاح</p>
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
		  <td><?= $id ?></td>
		</tr>
		<tr>
		  <th scope="row">الاسم</th>
		  <td><?= $name ?></td>
		</tr>
		<tr>
		  <th scope="row">الاب</th>
		  <td><?= $nameB ?></td>
		</tr>
		<tr>
		  <th scope="row">اسم العائلة</th>
		  <td><?= $nameL ?></td>
		</tr>
		<tr>
		  <th scope="row">تاريخ الميلاد</th>
		  <td><?= $date->format('Y-m-d') ?></td>
		</tr>
		<tr>
		  <th scope="row">البريد الاكتروني</th>
		  <td><?= $email ?></td>
		</tr>
		<tr>
		  <th scope="row">الرقم الوطني</th>
		  <td><?= $socialSecurityNumber ?></td>
		</tr>
		<tr>
		  <th scope="row">كلمة المرور</th>
		  <td><?= $passWord ?></td>
		</tr>
	  </tbody>
	</table>
	</div>
	<div class="col-md-4">
		<div class="row">
		<div class="col-sm-12">
			<p class="bg-p lead text-right">ملاحظة : يجب حفظ كلمة المرور لتسجيل الدخول</p>
		</div>
		<div class="col-sm-12">
			<p class="lead text-right">لتغير كلمة المرور من <a href="<?= $PATH ?>change_password.php">هنا</a></p>
		</div>
		</div>
	</div>
   </div>
  </div>
</section>
<?php 

}

?>