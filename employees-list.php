<?php include 'header.php';?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-2">
							<h4 class="page-title">Employee</h4>
						</div>
						<div class="col-xs-10 text-right m-b-30">
						    <a href="employeesHide-list.php" class="btn btn-primary pull-right rounded" style="margin-left:10px"><i class="fa fa-eye-slash"></i> Hide</a>
							<a href="add-employees.php" class="btn btn-primary pull-right rounded" ><i class="fa fa-plus"></i> Add Employee</a>
						</div>
						<!--<div class="col-sm-1">-->
						<!--	<button class="btn btn-primary rounded pull-right" onclick="myFunction()"><i class="fa fa-plus"></i> Filters</button>-->
						<!--</div>-->
					</div>
					<!--<div id="filter" >-->
     <!--               	<form action="" method="post">-->
     <!--           			<table class="table table-striped">-->
     <!--           				<tr >-->
     <!--               				<td colspan="" width="20%">-->
     <!--                 					<select class="form-control" name="search_from" id="search_from" >-->
     <!--                   					<option value="Search for">Search for</option>-->
     <!--                   					<option value="id">Employee Id</option>-->
     <!--                   					<option value="name">Employee Name</option>-->
     <!--                   					<option value="email">Email</option>-->
     <!--                   					<option value="mobile">Mobile</option>-->
     <!--                   					<option value="department">Department</option>-->
     <!--                   					<option value="Joining_date">Joining Date</option>-->
     <!--                   					<option value="status">Status</option>-->
     <!--                 					</select>-->
     <!--               				</td>-->
     <!--               				<td colspan="2" width="15%">-->
     <!--                 					<select class="form-control" name="search_type" id="type" style="display: block;">-->
     <!--                   					<option>Select Search Type</option>-->
     <!--                   					<option value="LIKE">Start with</option>-->
     <!--                   					<option value="LIKE">End with</option>-->
     <!--                   					<option value=">=">Min</option>-->
     <!--                   					<option value="<=">Max</option>-->
     <!--                   					<option value="=">Equal</option>-->
     <!--                 					</select>-->
     <!--                 					<p id="msg"></p>-->
     <!--               				</td>-->
     <!--               				<td width="30%">-->
     <!--               					<div id="canId">-->
     <!--               						<input class="form-control" type="text" name="search_value">-->
     <!--               					</div>-->
     <!--               				</td>-->
     <!--               				<td width="10%" style="border: none; text-align: center;" >-->
     <!--               					<div>                   						-->
     <!--               					<input type="submit" class="btn btn-success btn-block" name="rangetwo" value="SEARCH">-->
     <!--               					</div>-->
     <!--               				</td>-->
     <!--               			</tr>-->
     <!--               			<tr>-->
     <!--               			</tr>-->
     <!--               		</table>-->
     <!--               	</form>-->
					<!--</div>-->
					<div class="row" id="desktop_view">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table" id="example">
									<thead>
										<tr>
											<th style="width:10%;" id="ifd">Employee ID</th>
											<th style="width:25%;" id="ifd">Name</th>
											<th style="width:15%;" id="ifd">Email</th>
											<th style="width:15%;" id="ifd">Mobile</th>
											<th style="width:25%;" id="ifd">Department</th>
											<th style="width:25%;" id="ifd">Designation</th>
											<th style="width:15%;" id="ifd">Join Date</th>
											<th style>Attn</th>
											<th style="width:5%;" class="text-right"></th>
										</tr>
									</thead>
									<tbody>
									<?php 
									$mysqli->orderBy('id', 'desc');
									$getEmp = $mysqli->get(UADMIN);
									foreach ($getEmp as $empVal) {
										extract($empVal);
										$user = base64_encode($id);
										$primary_id = str_pad($id, 3, '0', STR_PAD_LEFT);
										$text = ($status == '1')? 'Active' : 'Inactive';
											$bg = ($status == '1')? 'success' : 'danger';
											$val = ($status == '1')? '0' : '1';
											if($hide != '1'):
												$loc = 'employees-list.php';
												$tabName = UADMIN;
												// if($profile_type == 'Admin'):
									?>

										<tr>
											<td>EMP-<?=$primary_id ?></td>
											<td>
												
												<h2><a href="profile-user.php?user=<?=$user?>"><?=$fname?> <?=$lname?> </a></h2>
											</td>
											<td><?=$email?></td>
											<td><?=$mobile_no?></td>
											<td><?=$profile_type?></td>
											<td><?=$designation?></td>
											<td><?=$created_date?></td>
											<td><a href="emp-attn.php?emp=<?=$user?>" target="_blank"><i class="fa fa-calendar"></i></a></td>
											<td class="text-right">
												<div class="dropdown">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="edit-employees.php?id=<?=$user?>"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
														<li><a href="#" data-toggle="modal" data-target="#delete_employee" class="delete" data-id="<?=$id?>" ><i class="fa fa-trash-o m-r-5 "  ></i> Delete</a></li>
													</ul>
												</div>
											</td>
										</tr>
									<?php 
								// 	endif; 
									
									endif; }?>

									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="row staff-grid-row" id="mobile_view">
						<?php 
							$mysqli->orderBy('id', 'desc');
							$getEmp = $mysqli->get(UADMIN);
							foreach ($getEmp as $empVal) {
								extract($empVal);
								$user = base64_encode($id);
								$primary_id = str_pad($id, 3, '0', STR_PAD_LEFT);
								$text = ($status == '1')? 'Active' : 'Inactive';
								$bg = ($status == '1')? 'success' : 'danger';
								$val = ($status == '1')? '0' : '1';
								if($hide != '1'):
									$loc = 'employees-list.php';
									$tabName = UADMIN;
								// 	if($profile_type == 'Admin'):
						?>
						<div class="col-md-4 col-sm-4 col-xs-6 col-lg-3">
							<div class="profile-widget">
								<div class="profile-img">
									<a href="javascript:">
										<img alt="" class="avatar" src="assets/img/user.jpg">
									</a>
								</div>
								<div class="dropdown profile-action">
									<a aria-expanded="false" class="action-icon dropdown-toggle" data-toggle="dropdown" href="javascript:">
										<i class="fa fa-ellipsis-v"></i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li><a href="add-employees.php?id=<?=$user?>"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
										<li><a href="#" data-toggle="modal" data-target="#delete_employee" class="delete" data-id="<?=$id?>" ><i class="fa fa-trash-o m-r-5 "  ></i> Delete</a></li>
									</ul>
								</div>
								<h4 class="user-name m-t-10 m-b-0 text-ellipsis">
									<a class="small" href="profile-user.php?user=<?=$user?>">EMP-<?=$primary_id ?></a><br>
									<a href="profile-user.php?user=<?=$user?>"><?=$fname?> <?=$lname?></a>
								</h4>
								<!-- <div class="small text-muted"><?=$designation?></div> -->
								<h4 class="user-name m-t-10 m-b-0 text-ellipsis">
									<a class="small" href="https://api.whatsapp.com/send?abid=<?=$whats_app?> &text=Hello <?=$fname?> <?=$lname?>%2C%0A%20&source=&data=" data-action="share/whatsapp/share" target="_blank" class="font-size-18">
										<i class="fa fa-whatsapp" style="background: #0b8902;padding: 10px;border-radius: 11%;color: #fff;"></i>
									</a>
									<a class="small" href="tel:<?=$mobile_no?>">
										<i class="fa fa-phone" style="background: #0b8902;padding: 10px;border-radius: 11%;color: #fff;"></i>
									</a>
									<a class="small" href="mailto:<?=$email?>">
										<i class="fa fa-envelope" style="background: #0b8902;padding: 10px;border-radius: 11%;color: #fff;"></i>
									</a>
									<a class="small" href="emp-attn.php?emp=<?=$user?>">
										<i class="fa fa-calendar" style="background: #0b8902;padding: 10px;border-radius: 11%;color: #fff;"></i>
									</a>
								</h4>
								<div class="text-muted"><a href=""></a></div>
							</div>
						</div>
						<?php
						  //  endif;
						
						endif; }?>
					</div>
                </div>
            </div>
			<div id="delete_employee" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Delete Employee</h4>
						</div>
						<form method="post" action="ajax.php?action=delete">
								<input type="hidden" name="id" value="" id="del_id" >
								<input type="hidden" name="tab_name" value="<?=UADMIN?>" >
								<input type="hidden" name="col_nam" value="id" >
								<input type="hidden" name="loc" value="employees-list.php" >
								<div class="modal-body card-box">
									<p>Are you sure want to delete this?</p>
									<div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
										<button type="submit" class="btn btn-danger">Delete</button>
									</div>
								</div>
						</form>
					</div>
				</div>
			</div>
        </div>
		<?php include 'footer.php';?>
		<script type="text/javascript">
			$('.delete').click(function(){
				var id = $(this).attr('data-id');
				$('#del_id').val(id);
		//	alert(id);
			})
		</script>
		<script type="text/javascript">
   /*$('#genderType').hide();
    $('#dateView').hide();
  $('#product_typeType').hide();
  $('#stageID').hide();
  $('#brandType').hide();
  $('#priorityType').hide();*/
  $("#search_from").change(function(){
  var selectVal = $(this).val();
  //alert(selectVal);


if(selectVal == 'id' || selectVal == 'name' || selectVal == 'email' || selectVal == 'pincode' || selectVal == 'status' || selectVal == 'mobile' || selectVal == 'department'){
  $('#type').html("<select class='form-control' name='search_type'><option value='='>Equal</option></select>");
}
else if( selectVal == 'Joining_date' ){
   $('#type').html("<select class='form-control' name='search_type'><option value='>='>Min </option><option value='<='>Max</option></select>");
}
if(selectVal == 'id' || selectVal == 'name' || selectVal == 'mobile' || selectVal == 'email'){
  $('#canId').html('<input class="form-control" type="text" name="search_value">');
}
else if(selectVal == 'department' ){
    $('#canId').html('<select class="form-control" name="search_value" ><option>Select Department</option><option value="Accountant">Accountant</option><option value="HR">HR</option><option value="Sales">Sales</option><option value="Web Designer">Web Designer</option></select>')
}
else if(selectVal == 'Joining_date'){
    $('#canId').html('<input class="form-control datetimepicker" type="date"  name="search_value" >');
}
else if(selectVal == 'status'){
    $('#canId').html("<select class='form-control' name='search_value' ><option>Select Status</option><option value='Active'>Active</option><option value='Inactive'>Inactive</option></select>");
}

  });
</script>