<?php include 'header.php';?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-5">
							<h4 class="page-title">Attendance</h4>
						</div>
						<div class="col-xs-7 text-right m-b-30">
							<a href="add-attendance.php" class="btn btn-primary pull-right rounded" ><i class="fa fa-plus"></i> Add Attendance</a>
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
											<th style="width:10%;" id="ifd">Id</th>
											<th style="width:25%;" id="ifd">Date</th>
											<th style="width:15%;" id="ifd">In Time</th>
											<th style="width:15%;" id="ifd">Out Time</th>
											<th style="width:15%;" id="ifd">Working Hours</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									$i = '1';
									$mysqli->where('user_id', $userGetID);
									$getEmp = $mysqli->get(ATTN);
									foreach ($getEmp as $empVal) {
										extract($empVal);
										$user = base64_encode($id);
										$hours = strtotime($out_time) - strtotime($in_time);
                                        $total = $hours/60;
                                        // $working = sprintf("%02d:%02d", floor($total/60), $total%60);
                                        $time1 = new DateTime($in_time);
					//	echo date('H:i:s', strtotime($userAtt['out_time']));
$time2 = new DateTime($out_time);
$timediff = $time1->diff($time2);
$working = $timediff->format('%h : %i : %s');
                                        if (!empty($out_time)) {
                                        	$out = date('H:i:s', strtotime($out_time));
                                        	$tet = (empty($in_time))?'0': $working;
                                        }
                                        else{
                                        	$out = '';
                                        	$tet = '';
                                        }
									?>

										<tr>
											<td><?=$i++?></td>
											<td><?=date('d M Y', strtotime($date))?></td>
											<td><?=date('H:i:s', strtotime($in_time))?></td>
											<td><?=$out?></td>
											<td><?=$tet?></td>
										</tr>
									<?php }?>

									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="row" id="mobile_view">
					
						<div class="table-responsive">
								<table class="table table-striped custom-table" id="example1">
									<thead>
										<tr>
											<th style="width:10%;" id="ifd">Id</th>
											<th style="width:25%;" id="ifd">Date</th>
											<th style="width:15%;" id="ifd">In Time</th>
											<th style="width:15%;" id="ifd">Out Time</th>
											<th style="width:15%;" id="ifd">Working Hours</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									$i = '1';
									$mysqli->where('user_id', $userGetID);
									$mysqli->orderBy('id', 'desc');
									$getEmp = $mysqli->get(ATTN);
									foreach ($getEmp as $empVal) {
										extract($empVal);
										$user = base64_encode($id);
										$hours = strtotime($out_time) - strtotime($in_time);
                                        $total = $hours/60;
                                        $working = sprintf("%02d:%02d", floor($total/60), $total%60);
                                        if (!empty($out_time)) {
                                        	$out = date('h:i:s', strtotime($out_time));
                                        	$tet = (empty($in_time))?'0': $working;
                                        }
                                        else{
                                        	$out = '';
                                        	$tet = '';
                                        }
									?>

										<tr>
											<td><?=$i++?></td>
											<td><?=date('d M Y', strtotime($date))?></td>
											<td><?=date('h:i:s', strtotime($in_time))?></td>
											<td><?=$out?></td>
											<td><?=$tet?></td>
										</tr>
									<?php }?>

									</tbody>
								</table>
							</div>
						
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