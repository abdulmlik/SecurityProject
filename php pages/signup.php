<?php 

function _signup()
{
	global $PATH,$id,$na1,$naB1,$naL1,$Bdate,$Bmonth,$Byear,$flag_date,$email,$flag_SSN,$socialSecurityNumber;
?>
<section class="section form_input">
  <div class="container">
	<div class="row">
	<div class="col-sm-1"></div>
	  <form class="col-sm-12" role="form" dir="rtl" 
			accept-charset="utf8" 
			method="post"
			action="<?= $_SERVER['PHP_SELF'] ?>" 
			>
		  <div class="row">
			  <h1 class="text-right col-md-2 col-sm-4">تسجيل</h1><!-- head form -->
			  <div class="bott"><p class="text-right ss"> تشير إلى حقل مطلوب</p></div>
		  </div>
		  <div class="form-group">
			  <div class="row">
			  <div class="col-md-8">
			  <div class="row">
				<label for="inputId" class="col-sm-3 col-lg-2 control-label col-form-label-lg text-right text-line">رقم القيد :<span class="_valid"> *</span></label>
				<div class="col-sm-9 col-lg-10">
					<input type="text" name="inputId" class="form-control form-control-lg" id="inputId" placeholder="ادخل رقم قيدك" pattern="^\s*([0-9]{4,9})\s*$"
					value="<?= $id ?>"
					onchange="InvalidMsg(this)"
					oninvalid="InvalidMsg(this)"
					required />
				</div>
			   </div>
			  </div>
			  <div class="col-md-4">
				<div class="row">
				<div class="col-sm-3 col-md-1"></div>
				<div class="col-sm-9 col-md-11">
					<small id="idHelp" class="Help form-text _HelpValid">رقم القيد يتكون من اربعة إلى تسعة ارقام.</small>
				</div>
			  </div>
			  </div>
			  </div>
		  </div>

		  <div class="form-group">
			  <div class="row">
			  <div class="col-md-8">
			  <div class="row">
			  <label for="inputName" class="col-sm-3 col-lg-2 control-label col-form-label-lg text-right text-line">الاسم : <span class="_valid">*</span></label>
			  <div class="col-sm-9 col-lg-10">
				  <div class="container-fluid">
				  <div class="row">
					<input type="text" name="inputName[]" class="col form-control form-control-lg" id="inputName" placeholder="ادخل اسمك" pattern="^\s*([\u0621-\u064A]{2,10})\s*$"
					value="<?= $na1[0] ?>" 
					onchange="Invalid_name(this)"
					oninvalid="Invalid_name(this)"
					required />
					<?php 
						if( !empty($na1[1]) ) {

							echo "<input type=\"text\" name=\"inputName[]\" class=\"col form-control form-control-lg\" id=\"inputName2\" pattern=\"^\\s*([\\u0621-\\u064A]{2,10})\\s*$\" value=\"$na1[1]\" placeholder=\"بقية الاسم المركب\" onchange=\"Invalid_name(this)\" oninvalid=\"Invalid_name(this)\" required />";
							echo "<span class=\"input-group-btn\">
						<button class=\"btn btn-danger\" type=\"button\" onclick=\"delInput(this)\">-</button>
					</span>";

						} else {
					  ?>
					<span class="input-group-btn">
						<button class="btn btn-info" type="button" onclick="addInput(this)">+</button>
					</span>
					 <?php } ?>
				  </div>
				  </div>
			  </div>
			  </div>
			  </div>
			  <div class="col-md-4">
			  <div class="row">
				<div class="col-sm-3 col-md-1"></div>
				<div class="col-sm-9 col-md-11">
					<small id="nameHelp" class="Help form-text _HelpValid">الاسم بالعربية وطوله من حرفين إلى عشرة حروف ,اسم مركب اضغط على الرمز (+).</small>
				</div>
			  </div>
			  </div>
			  </div>
		  </div>
		  <div class="form-group">
			  <div class="row">
			  <div class="col-md-8">
				<div class="row">
					<label for="inputParentName" class="col-sm-3 col-lg-2 text-line control-label col-form-label-lg text-right">اسم الاب : <span class="_valid">*</span></label>
					<div class="col-sm-9 col-lg-10">
					  <div class="container-fluid">
					  <div class="row">
						<input type="text" name="inputNameB[]" class="col form-control form-control-lg" id="inputParentName" placeholder="ادخل اسم الوالد" pattern="^\s*([\u0621-\u064A]){2,10}\s*$"
						value="<?= $naB1[0] ?>"
						onchange="Invalid_name(this)"
						oninvalid="Invalid_name(this)"
						required />
						<?php 
						if( !empty($naB1[1]) ) {

							echo "<input type=\"text\" name=\"inputNameB[]\" class=\"col form-control form-control-lg\" id=\"inputParentName2\" pattern=\"^\\s*([\\u0621-\\u064A]{2,10})\\s*$\" value=\"$naB1[1]\" placeholder=\"بقية الاسم المركب\" onchange=\"Invalid_name(this)\" oninvalid=\"Invalid_name(this)\" required />";
							echo "<span class=\"input-group-btn\">
						<button class=\"btn btn-danger\" type=\"button\" onclick=\"delInput(this)\">-</button>
					</span>";

						} else {
					  ?>
					<span class="input-group-btn">
						<button class="btn btn-info" type="button" onclick="addInput(this)">+</button>
					</span>
					 <?php } ?> 
					  </div>
					  </div>
					</div>
				  </div>
				  </div>
				  <div class="col-md-4">
  					<div class="row">
						<div class="col-sm-3 col-md-1"></div>
						<div class="col-sm-9 col-md-11">
						<small id="nameHelp" class="Help form-text _HelpValid">الاسم بالعربية وطوله من حرفين إلى عشرة حروف ,اسم مركب اضغط على الرمز (+).</small>
					   </div>
				  </div>
				  </div>
			  </div>
		      </div>
			  <div class="form-group">
				  <div class="row">
			  	  <div class="col-md-8">
				  <div class="row">
					<label for="inputLastName" class="col-sm-3 col-lg-2 text-line control-label col-form-label-lg text-right">اللقب : <span class="_valid">*</span></label>
					<div class="col-sm-9 col-lg-10">
					   <div class="container-fluid">
					   <div class="row">
						<input type="text" name="inputNameL[]" class="col form-control form-control-lg" id="inputLastName" placeholder="ادخل اسم العائلة" pattern="^\s*([\u0621-\u064A]){2,10}\s*$"
						value="<?= $naL1[0] ?>"
						onchange="Invalid_name(this)"
						oninvalid="Invalid_name(this)"
						required />
						<?php 
						if( !empty($naL1[1]) ) {

							echo "<input type=\"text\" name=\"inputNameL[]\" class=\"col form-control form-control-lg\" id=\"inputLastName2\" pattern=\"^\\s*([\\u0621-\\u064A]{2,10})\\s*$\" value=\"$naL1[1]\" placeholder=\"بقية الاسم المركب\" onchange=\"Invalid_name(this)\" oninvalid=\"Invalid_name(this)\" required />";
							echo "<span class=\"input-group-btn\">
						<button class=\"btn btn-danger\" type=\"button\" onclick=\"delInput(this)\">-</button>
					</span>";

						} else {
					  ?>
					<span class="input-group-btn">
						<button class="btn btn-info" type="button" onclick="addInput(this)">+</button>
					</span>
					 <?php } ?> 
					  </div>
					  </div>
					</div>
				 </div>
				 </div>
				 <div class="col-md-4">
					 <div class="row">
						 <div class="col-sm-3 col-md-1"></div>
						 <div class="col-sm-9 col-md-11">
							<small id="nameHelp" class="Help form-text _HelpValid">الاسم بالعربية وطوله من حرفين إلى عشرة حروف ,اسم مركب اضغط على الرمز (+).</small>
						 </div>
				     </div>
			     </div>
			</div>
		  </div>
		  <script>
			  var selectedDay  = <?= $Bdate ?>;
			  var selectedMon  = <?= $Bmonth ?>;
			  var selectedYear = <?= $Byear ?>;
		  </script>

		  <div class="form-group">
			  <div class="row">
			  <div class="col-md-8">
			  <div class="row">
			  <label for="inputDate" class="col-sm-3 col-lg-2 text-line control-label col-form-label-lg text-right">تاريخ الميلاد : <span class="<?php 
												if(!$flag_date) echo "_invalid";
												else echo "_valid";
											?>">*</span></label>
			  <div class="col-sm-8">
				  <div class="container-fluid">
				  <div class="row">
					<SELECT class="col combine form-control form-control-lg" id ="year" name = "yyyy" onchange="change_year(this)">
					</SELECT>
					<SELECT class="col combine form-control form-control-lg" id ="month" name = "mm" onchange="change_month(this)">
					</SELECT>
					<SELECT class="col combine form-control form-control-lg" id ="day" name = "dd" >
					</SELECT>
				  </div>
				  </div>
			  </div>
			  </div>
			  </div>
			  </div>
		  </div>
		  <div class="form-group ">
			  <div class="row">
			  <div class="col-md-8">
			  <div class="row">
				<label for="inputEmail" class="col-sm-3 col-lg-2 text-line control-label col-form-label-lg text-right">البريد الاكتروني :<span class="_valid">*</span></label>
				<div class="col-sm-9 col-lg-10">
					<input type="email" name="inputEmail" class="form-control form-control-lg _rtl" id="inputEmail" placeholder="ادخل بريدك الاكتروني"
					value="<?= $email ?>"
					onchange="InvalidMsg(this)"
					oninvalid="InvalidMsg(this)"
				    onblur="Dirrtl(this)"
				    onfocus="Dirltr(this)"
					required /><!-- pattern is A valid e-mail According to standards w3.org -->
				</div>
			  </div>
			  </div>
			  <div class="col-md-4">
     			<div class="row">
					<div class="col-sm-3 col-md-1"></div>
					<div class="col-sm-9 col-md-11">
					  <small id="idHelp" class="Help form-text _HelpValid">البريد الاكتروني يكون بهذا النمط (xxxx@xxx.xxx).</small>
				    </div>
			    </div>
			   </div>
			  </div>
		  </div>
		  <div class="form-group">
			 <div class="row"><div class="col-md-8">
			 <div class="row">
			  <label for="inputN12" class="col-sm-3 col-lg-2 text-line control-label col-form-label-lg text-right">الرقم الوطني : <span class="<?php 
												if(!$flag_SSN) echo "_invalid";
												else echo "_valid";
											?>">*</span></label>
			  <div class="col-sm-9 col-lg-10">
					<input type="text" name="inputN" class="form-control form-control-lg" id="inputN12" placeholder="ادخل رقمك الوطني" pattern="[12]{2}[0-9]{10}"
					value="<?= $socialSecurityNumber ?>"
					onchange="InvalidMsg(this)"
					oninvalid="InvalidMsg(this)"
					required />
			  </div>
			 </div>
			</div>
			  <div class="col-md-4">
  				<div class="row">
					<div class="col-sm-3 col-md-1"></div>
					<div class="col-sm-9 col-md-11">
					  <small id="idHelp" class="Help form-text <?php 
												if(!$flag_SSN) echo "_HelpInvalid";
												else echo "_HelpValid";
											?>">الرقم الوطني يتكون من اثنى عشر خانة الخانة الاولى يجب ان تكون 1 او 2 والخانة الثانية إلى الخامسة تمثل سنة ميلادك.</small>
				    </div>
			    </div>
		       </div>
		     </div>
		  </div>
		  <div class="form-group row">
			 <div class="col-md-8">
			<div class="row">
			<div class="col-sm-3 col-lg-2"></div>
			<div class="col-sm-5 col-md-4 col-lg-3">
			  <button type="submit" class="btn btn-info btn-lg btn-block">التالي</button>
			</div>
		   </div>
		  </div>
		</div>
	  </form>
	<div class="col-sm-1"></div>
	</div>
  </div>
</section>
<?php 
	
}

?>