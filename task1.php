<?php include 'header.php'?>
            <div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="row filter-row">
						<div class="col-sm-2 col-xs-6">  
							<div class="form-group form-focus">
								<label class="control-label">Select Month</label>
								
							</div>
						</div>
						<div class="col-sm-4 col-xs-6">  
							<div class="form-group form-focus">
								<label class="control-label">Start Date</label>
								<input type="text" class="form-control floating">
							</div>
						</div>
						<div class="col-sm-4 col-xs-6"> 
							<div class="form-group form-focus">
								<label class="control-label">End Date</label>
								<input type="text" class="form-control floating">
							</div>
						</div>
						<div class="col-sm-2 col-xs-6">  
							<a href="#" class="btn btn-success btn-block"> Search </a>  
						</div>     
                    </div>
					<div class="row">
						<div class="col-sm-4">
							<h4 class="page-title">Tasks</h4>
						</div>
						<?php if($getAdmin['profile_type'] == 'Admin'): ?>
						<div class="col-sm-6 text-right m-b-20">
							<a href="add-task.php" class="btn btn-primary rounded pull-right"><i class="fa fa-plus"></i> Create Task</a>
						</div>
					<?php endif; ?>
						<div class="col-sm-1">
							<button class="btn btn-primary rounded pull-right" onclick="myFunction()"><i class="fa fa-list"></i> Filters</button>
						</div>
						<div class="col-sm-1">
							<a href="export_to_xl.php" class="btn btn-primary rounded pull-right"><i class="fa fa-plus"></i> Export</a>
						</div>
					</div>
					<div id="filter">
                    	<form action="" method="post">
                			<table class="table table-striped">
                				<tr >
                    				<td colspan="" width="20%">
                      					<select class="form-control" name="search_from" id="search_from" >
                        					<option value="Search for">Search for</option>
                        					<option value="id">Task Id</option>
                        					<option value="name">Task Name</option>
                        					<option value="leader">Leader</option>
                        					<option value="team">Team</option>
                        					<option value="deadline">Deadline</option>
                        					<option value="priority">Priority</option>
                        					<option value="status">Status</option>
                      					</select>
                    				</td>
                    				<td colspan="2" width="15%">
                      					<select class="form-control" name="search_type" id="type" style="display: block;">
                        					<option>Select Search Type</option>
                        					<option value="LIKE">Start with</option>
                        					<option value="LIKE">End with</option>
                        					<option value=">=">Min</option>
                        					<option value="<=">Max</option>
                        					<option value="=">Equal</option>
                      					</select>
                      					<p id="msg"></p>
                    				</td>
                    				<td width="30%">
                    					<div id="canId">
                    						<input class="form-control" type="text" name="search_value">
                    					</div>
                    				</td>
                    				<td width="10%" style="border: none; text-align: center;" >
                    					<div>                   						
                    					<input type="submit" class="btn btn-success btn-block" name="rangetwo" value="SEARCH">
                    					</div>
                    				</td>
                    			</tr>
                    			<tr>
                    			</tr>
                    		</table>
                    	</form>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table" id="example">
									<thead>
										<tr>
											<th id="ifd" width="7%">Task Id</th>
											<th id="ifd">Task Date</th>
											<th id="ifd" width="20%">Task</th>
											<th id="ifd">Company</th>
											<th id="ifd">Assign Team</th>
											<th id="ifd">Start Date</th>
											<th id="ifd">End Date</th>
											<th id="ifd">Created</th>
											
											<th id="ifd">Priority</th>
											<th id="ifd">Status</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										if($getAdmin['profile_type'] != 'Admin'):
										$mysqli->where('employee_list', $getAdmin['id']);
										endif;
										$mysqli->groupBy('task_id' );
										$mysqli->orderBy('id', 'desc');
										$getTask = $mysqli->get(TASK);
										foreach ($getTask as $taskVal) {
											extract($taskVal);
											$mysqli->where('id', $client);
											$getClient = $mysqli->getOne(USER);
										$primary_id = str_pad($task_id, 3, '0', STR_PAD_LEFT);
										$tasks = base64_encode($task_id);
										$clientid = base64_encode($client);
										$endDate = strtotime($end_date);
										$text = ($status == '1')? 'Active' : 'Inactive';
											$bg = ($status == '1')? 'success' : 'danger';
											$val = ($status == '1')? '0' : '1';
											$loc = 'tasks.php';
												$tabName = TASK;

												 $date1 = strtotime($created_date);  
											 $date2 = time();
											 $diff = abs($date2 - $date1);  
											 $years = floor($diff / (365*60*60*24));  
											 $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
											 $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24)); 
											 $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60)); 
											 $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24  
                          - $hours*60*60)/ 60);  
											 $seconds = floor(($diff - $years * 365*60*60*24  - $months*30*60*60*24 - $days*60*60*24 
                - $hours*60*60 - $minutes*60));  

											 if($days != '0'):
											 	$create = $days.' Days ago';
											 else:
											 	if($hours != '0'):
											 		$create = $hours.' hrs ago';
											 	else:
											 		$create = $minutes.' min ago';
											 	endif;
											 endif;
											 if($taskVal['complete_task'] == '0'):
												$workStatus = 'Overdue';
												$label_bg = 'danger';
											elseif($taskVal['complete_task'] == '1'):
												$workStatus = 'Pending';
													$label_bg = 'primary';
											elseif($taskVal['complete_task'] == '2'):
												$workStatus = 'Completed';
													$label_bg = 'success';
											endif;
											if(!empty($priority)):
													if($priority == 'High'):
														$circle = 'danger';
														$textPr = 'High';
													elseif($priority == 'Medium'):
														$circle = 'warning';
														$textPr = 'Medium';
													elseif($priority == 'Low'):
														$circle = 'success';
														$textPr = 'Low';
													endif;
												else:
														$circle = 'success';
														$textPr = 'Low';
												endif;
											
											 if($taskVal['complete_task'] == '0'):

										?>
										<tr>
											<td style="background: #ffbcbc">TSK-<?=$primary_id?></td>
											<td style="background: #ffbcbc"><?=date('d-M-Y', strtotime($created_date))?></td>
											<td style="background: #ffbcbc">
												<h2><a href="viewtask.php?task=<?=$tasks?>"><?=$task?></a></h2>
											</td>
											<td style="background: #ffbcbc"><a href="profile.php?client=<?=$clientid?>"><?=$getClient['company_name']?></a></td>
											<td style="background: #ffbcbc">
												<ul class="team-members">
													<?php 

													$mysqli->where('task_id', $task_id);
													$getTaks = $mysqli->get(TASK, 3);
													foreach ($getTaks as $taskV) { 
														$mysqli->where('id', $taskV['employee_list']);

														$getUser = $mysqli->getOne(UADMIN);
														?>
													<li>
														<a href="#" title="<?=$getUser['fname'].' '.$getUser['lname']?>" data-toggle="tooltip"><img src="assets/img/user.jpg" alt="John Doe"><span style="display: none;"><?=$getUser['fname'].' '.$getUser['lname']?></span></a>
													</li>
													<?php }
													$mysqli->where('task_id', $task_id);
													$getTaks = $mysqli->get(TASK);
													$all = count($getTaks) - 3;
													
													if($all > '0'):
													?>
													<li>
														<a href="#" class="all-users">+<?=$all?></a>
													</li>
													<?php endif; ?>
												</ul>
											</td>
											<td style="background: #ffbcbc"><?=$start_date?></td>
											<td style="background: #ffbcbc"><?=$end_date?></td>
											<td style="background: #ffbcbc"><?=$create?></td>
											
											<td style="background: #ffbcbc">

												<div class="dropdown action-label"><a class="btn btn-white btn-sm rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-dot-circle-o text-<?=$circle?>"></i> <?=$textPr?> </a>
												</div>
											</td>
											<td style="background: #ffbcbc"><span class="label label-<?=$label_bg?>"><?=$workStatus?></span></td>
											<td class="text-right" style="background: #ffbcbc">

												<div class="dropdown">
													<a href="profile.php?client=<?=$clientid?>"><i class="fa fa-th m-r-5"></i> </a>
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>

													<ul class="dropdown-menu pull-right">
														<li></li>
														<li><a href="add-task.php?task=<?=$tasks?>" ><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
														<li><a href="#" data-toggle="modal" data-target="#delete_project"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
													</ul>
												</div>
											</td>
										</tr>
										<?php else:?> 
											<tr>
											<td>TSK-<?=$primary_id?></td>
											<td><?=date('d-M-Y', strtotime($created_date))?></td>
											<td>
												<h2><a href="task-view.php?task=<?=$tasks?>"><?=$task?></a></h2>
											</td>
											<td><a href="profile.php?client=<?=$clientid?>"><?=$getClient['company_name']?></a></td>
											<td>
												<ul class="team-members">
													<?php 

													$mysqli->where('task_id', $task_id);
													$getTaks = $mysqli->get(TASK, 3);
													foreach ($getTaks as $taskV) { 
																										
														$mysqli->where('id', $taskV['employee_list']);
														$userName = $mysqli->getOne(UADMIN);
														
														?>
													<li>
														
														<a href="#" title="<?=$userName['fname'].' '.$userName['lname']?>" data-toggle="tooltip"><img src="assets/img/user.jpg" alt="John Doe"><span style="display: none;"><?=$userName['fname'].' '.$userName['lname']?></span></a>
													</li>
													<?php }
													$mysqli->where('task_id', $task_id);
													$getTaks = $mysqli->get(TASK);
													$all = count($getTaks) - 3;
													
													if($all > '0'):
													?>
													<li>
														<a href="#" class="all-users">+<?=$all?></a>
													</li>
													<?php endif; ?>
												</ul>
											</td>
											<td><?=$start_date?></td>
											<td><?=$end_date?></td>
											<td><?=$create?></td>
											
											<td>
												
												<div class="dropdown action-label"><a class="btn btn-white btn-sm rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-dot-circle-o text-<?=$circle?>"></i> <?=$textPr?> </a>
												</div>
											</td>
											<td><span class="label label-<?=$label_bg?>"><?=$workStatus?></span></td>
											<td class="text-right" >

												<div class="dropdown">
													<a href="profile.php?client=<?=$clientid?>"><i class="fa fa-th m-r-5"></i> </a>
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>

													<ul class="dropdown-menu pull-right">
														<li></li>
														<li><a href="add-task.php?task=<?=$tasks?>" ><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
														<li><a href="#" data-toggle="modal" data-target="#delete_project"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
													</ul>
												</div>
											</td>
										</tr>



										<?php endif; } ?>	
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<?php include 'messages.php'?>
            </div>
			<div id="delete_project" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content modal-md">	
						<div class="modal-header">
							<h4 class="modal-title">Delete Project</h4>
						</div>
						<div class="modal-body card-box">
							<p>Are you sure want to delete this?</p>
							<div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
								<button type="submit" class="btn btn-danger">Delete</button>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
        <script type="text/javascript">
   $('#genderType').hide();
    $('#dateView').hide();
  $('#product_typeType').hide();
  $('#stageID').hide();
  $('#brandType').hide();
  $('#priorityType').hide();
  $("#search_from").change(function(){
  var selectVal = $(this).val();
  //alert(selectVal);


if(selectVal == 'id' || selectVal == 'name' || selectVal == 'leader' || selectVal == 'status' || selectVal == 'team' || selectVal == 'priority'){
  $('#type').html("<select class='form-control' name='search_type'><option value='='>Equal</option></select>");
}
else if( selectVal == 'deadline' ){
   $('#type').html("<select class='form-control' name='search_type'><option value='>='>Min </option><option value='<='>Max</option></select>");
}
if(selectVal == 'id' || selectVal == 'name' || selectVal == 'team' || selectVal == 'purchase_rate' || selectVal == 'leader'){
  $('#canId').html('<input class="form-control" type="text" name="search_value">');
}
else if(selectVal == 'deadline'){
    $('#canId').html('<input class="form-control datetimepicker" type="date"  name="search_value" >');
}
else if(selectVal == 'status'){
    $('#canId').html("<select class='form-control' name='search_value' ><option>Select Status</option><option value='Active'>Active</option><option value='Inactive'>Inactive</option></select>");
}
else if(selectVal == 'priority'){
    $("#canId").html("<select class='form-control' name='search_value' id='priorityType'><option>Select Priority</option><option value='high'><i class='fa fa-dot-circle-o text-danger'></i>High</option><option value='medium'>Medium</option><option value='low'>Low</option></select>"); 
}
  });
</script>
<?php include 'footer.php'?>