<?php include 'header.php';?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-4">
							<h4 class="page-title">Add Employee</h4>
						</div>
						<div class="col-xs-8 text-right m-b-30">
							<a href="employees-list.php" class="btn btn-primary pull-right rounded" ><i class="fa fa-list" aria-hidden="true"></i> Employee List</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
						<!-- <?php 
							if(isset($_GET['id'])):
								$id = base64_decode($_GET['id']);
								$mysqli->where('id', $id);
								$getEmp = $mysqli->getOne(UADMIN);
								$type = 'update'; 
								$fname = $getEmp['fname'];
								$lname = $getEmp['lname'];
								$designation = $getEmp['designation'];
								$emails = $getEmp['email'];
								$mobile_no = $getEmp['mobile_no'];
								$whats_app = $getEmp['whats_app'];
								$empid = str_pad($getEmp['id'], 3, '0', STR_PAD_LEFT);
								$emp_no = '#AL-'.$empid;
								$date = strtotime($getEmp['created_date']);
								$create = date('Y-m-d',$date);
								$password = $getEmp['password'];
								$designation = $getEmp['profile_type'];
								$department = $getEmp['designation'];
								$doj = $getEmp['doj'];
							else:
								$mysqli->orderBy('id', 'desc');
								$getEmp = $mysqli->getOne(UADMIN);
								$type = 'new';
								$fname = '';
								$lname = '';
								$designation = '';
								$emails = '';
								$mobile_no = '';
								$enpNo = str_pad($getEmp['id'], 3, '0', STR_PAD_LEFT);
								$empId = $enpNo + 1;
								$emp_no = '#AL-'.$enpNo;
								$whats_app ='';
								$create = '';
								$password = '';
								$designation = '';
								$department = '';
								$doj = '';

							endif;

						?> -->
						<div id="msg" style="color:red"></div>
						<form class="m-b-30" method="post" autocomplete="off" action="ajax.php?action=employee&type=<?=$type?>">
								<div class="row">
									<div class="col-sm-2">  
										<div class="form-group">
										 <?php if(isset($_GET['id'])): ?>
												<input type="hidden" name="id" value="<?=$_GET['id']?>">
								 			<?php endif;?> 
											<label class="control-label">Employee ID <span class="text-danger">*</span></label>
											<input type="text" class="form-control" disabled="" value="<?=$emp_no?>">
										</div>
									</div>
									<div class="col-sm-5">
										<div class="form-group">
											<label class="control-label">First Name <span class="text-danger">*</span></label>
											<input class="form-control" type="text" name="fname" value="<?=$fname?>" id="fname" required>
										</div>
									</div>
									<div class="col-sm-5">
										<div class="form-group">
											<label class="control-label">Last Name</label>
											<input class="form-control" type="text" name="lname" value="<?=$lname?>" id="lname">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label">Phone <span class="text-danger">*</span><br/> <span id="emailError1" class="text-danger"></span></label>
											<input class="form-control" type="text" name="mobile_no" value="<?=$mobile_no?>" id="mobile_no" required>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label">Whatsapp No </label>
											<input class="form-control" type="text" name="whats_app" value="<?=$whats_app?>" id="whats_app">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label">Email <span class="text-danger">*</span> <span id="emailError" class="text-danger"></span></label>
											<input class="form-control" type="email" name="email" value="<?=$emails?>" id="email" required>
											
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label">Designation <span class="text-danger">*</span></label>
											<select class="select" name="designation" id="designation" required>
												
												<?php 
												if(empty($designation)): ?>
													<option value="">Select Designation</option>
													<?php $mysqli->orderBy('name', 'asc');
													$mysqli->where('status', '1');
													$getDesig = $mysqli->get(DESIGNATION);
													foreach ($getDesig as $val): ?>
													<option value="<?=$val['name']?>"><?=$val['name']?></option>
													<?php endforeach; 
												else: 
													$mysqli->where('name', $designation);
													$selDesg = $mysqli->getOne(DESIGNATION); ?>
													<option value="<?=$selDesg['name']?>"><?=$selDesg['name']?></option>
													<?php	$mysqli->orderBy('name', 'asc');
														$mysqli->where('status', '1');
													$getDesig = $mysqli->get(DESIGNATION);
													foreach ($getDesig as $val):
													if($selDesg['name'] != $val['name']):?>
													<option value="<?=$val['name']?>"><?=$val['name']?></option>
													<?php endif; endforeach;
												endif; ?>
											</select>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label">Department <span class="text-danger">*</span></label>
											<select class="select" name="department" id="department" required>
													<?php 
												if(empty($department)): ?>
													<option value="">Select Department</option>
													<?php $mysqli->orderBy('name', 'asc');
													$getDesig = $mysqli->get(DEPARTMENT);
													foreach ($getDesig as $val): ?>
													<option value="<?=$val['name']?>"><?=$val['name']?></option>
													<?php endforeach; 
												else: 
													$mysqli->where('name', $department);
													$selDesg = $mysqli->getOne(DEPARTMENT); ?>
													<option value="<?=$selDesg['name']?>"><?=$selDesg['name']?></option>
													<?php	$mysqli->orderBy('name', 'asc');
													$getDesig = $mysqli->get(DEPARTMENT);
													foreach ($getDesig as $val):
													if($selDesg['name'] != $val['name']):?>
													<option value="<?=$val['name']?>"><?=$val['name']?></option>
													<?php endif; endforeach;
												endif; ?>
											</select>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label">Password <span class="text-danger">*</span></label>
											<input class="form-control" type="password" id="new_password" name="password" value="<?=$password?>" required>
											<span toggle="#new_password" class="fa fa-fw fa-eye field-icon new_password"></span>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label class="control-label">Confirm Password <span class="text-danger">*</span></label>
											<input class="form-control" type="password" id="confirm_password" name="password" value="<?=$password?>" required>
											<span toggle="#confirm_password" class="fa fa-fw fa-eye field-icon confirm_password"></span>
											<p id="confirmEror" class="text-danger"></p>
										</div>
									</div>
									

									<div class="col-sm-4">  
										<div class="form-group">
											<label class="control-label">Joining Date <span class="text-danger">*</span></label>
											<div class="cal-icon"><input class="form-control datetimepicker" type="text" name="doj" id="doj" value="<?=$doj?>" required></div>
										</div>
									</div>
								

								</div>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary submitBtn" type="submit" id="emailSubmit" value="emailSubmit">SUBMIT</button>
								</div>
							</form>
							
						
						</div>
					</div>
                </div>
				<?php include 'messages.php';?>
            </div>
        </div>
        
		<?php include 'footer.php';?>
		<script>
		$(".new_password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
  //var input = $($(this).attr("toggle"));
  var input =  $('#new_password');
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
     
        </script>
        
        	<script>
        		$(".confirm_password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
  //var input = $($(this).attr("toggle"));
  var input =  $('#confirm_password');
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
     $("#confirm_password").blur(function(){
         var new_pass = $("#new_password").val();
         var confirm_pass = $(this).val();
         if(new_pass != confirm_pass){
             $("#confirmEror").html('Password not match.');
         }else{
             $("#confirmEror").html('');
         }
     })
        </script>
	
		<script>
			$("#emailSubmit1").click(function(){
				var fname = $("#fname").val();
				var lname = $("#lname").val();
				var mobile_no = $("#mobile_no").val();
				var email = $("#email").val();
				var designation = $("#designation").val();
				var department = $("#department").val();
				var password = $("#new_password").val();
				var doj = $("#doj").val();

				$.ajax({
					url:"ajax.php?action=employee&type=new",
					type:"POST",
					data:{
						fname:fname,
						lname:lname,
						mobile_no:mobile_no,
						email:email,
						designation:designation,
						department:department,
						password:password,
						doj:doj
					},
					success:function(result){
						$("#msg").html(result);
						alert(result);
					}
				});
			});
		</script>