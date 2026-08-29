<?php include'header.php'?>
<?php 
echo	$id = base64_decode($_GET['task']);
	$mysqli->where('task_id', $id);
	$getTask = $mysqli->getOne(TASK);
	extract($getTask);
	$mysqli->where('id', $client);
	$getClient = $mysqli->getOne(USER);
	$startDate = strtotime($start_date);
	$endDate = strtotime($end_date);
	$clientID = base64_encode($getClient['id']);
	$mysqli->where('id', $getClient['assign_to']);
	$getEmp = $mysqli->getOne(UADMIN);
?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-8">
				    	<h4 class="page-title">Leads  - <?=$getClient['company_name']; ?> <a href="profile.php?client=<?=$clientID?>" class="text-success size15"><i class="fa fa-table"></i></a></h4> 
							<h5><i class="fa fa-user"></i> <?=$getClient['fname'].' '.$getClient['lname']?> | <i class="fa fa-mobile"></i> <?=$getClient['contact1']; ?> |  Assign to:
							
							<?=$getEmp['fname']." ".$getEmp['lname']?></h5>
						    
						    
						</div>
						<div class="col-sm-4 text-right m-b-30">
							<!--<a href="add-task.php?task=<?=$_GET['task']?>" class="btn btn-primary rounded" ><i class="fa fa-plus"></i> Edit Task</a>-->
						</div>
					</div>
					<div class="row">
						<div class="col-lg-9">
							<div class="panel">
								<div class="panel-body">
									<div class="project-title">
										<h4 class="page-title"><?=$task?></h4>
										<p><b>Start Date: </b><?=$start_date?> | 
										<b>End Date: </b><?=$end_date?> | 
										<b>Priority: </b><?=$priority?> </p>
										<hr/>
										
										<h5 class="panel-title"><strong>Description</strong></h5>
									</div>
									<?=$indivisual_task?>
								</div>
							</div>
							<div class="panel">
								<div class="panel-body">
				                    <h5 class="panel-title m-b-20">Uploaded files</h5>
									<div class="row">
									    <?php if(empty($img)){?>
										<div class="col-md-3 col-sm-6">
											<div class="thumbnail">
												<div class="thumb">
													<img src="assets/img/placeholder.png" class="img-responsive" alt="">
												</div>
												<div class="caption text-center">
													 demo.png
												</div>
											</div>
										</div>
										
										<?php }else{ ?> 
										<div class="col-md-12 col-sm-12">
										    <a href="" download>Click here</a>
										</div>
										
										<?php } ?>
										
									</div>
								</div>
							</div>
						
							    <?php 
							 //	$mysqli->groupBy('employee_list');
								$mysqli->where('task_id', $task_id);
								$getAssign = $mysqli->get(TASK);
								foreach ($getAssign as $assignLead) {
								$mysqli->where('id', $assignLead['employee_list']);
								$getUser = $mysqli->getOne(UADMIN);
								 if($assignLead['workStatus'] == '1'){
									      $statusName = 'Working';
									      $bg = 'warning';
								}elseif($assignLead['workStatus'] == '2'){
									      $statusName = 'Complete';
									      $bg = 'success';
								}elseif($assignLead['workStatus'] == '3'){
									      $statusName = 'Pending';
									      $bg = 'danger';
							    }elseif($assignLead['workStatus'] == '4'){
									      $statusName = 'Overdue';
									      $bg = 'danger';
							    }else{
									       $statusName = 'New';
									       $bg = 'info';
									  }
								?>
									<div class="panel">
							 <div class="panel-body">
							 <h6 class="panel-title m-b-20">Assigned work to  <small><?=$getUser['fname']?> <?=$getUser['lname']?> | <span class="label label-<?=$bg?>"><?=$statusName?></span> </small></h6>
    						 <div>
    							 <div style="padding: 0 5px; "><?= $assignLead['comment']?></div>
    							 <hr/>
							    <?php 
							        $sr = '1';
							        $mysqli->where('emp_id', $assignLead['employee_list']);
							        $mysqli->where('task_id', $task_id);
							        $mysqli->where('history_type', 'Task');
							        $allHistory = $mysqli->get(HISTORY);
							        foreach($allHistory as $taskChar){ ?>
    							<div class="col-md-11" style="margin:10px 10px 10px 30px;  padding:10px; color:#666; background: #f2f2f2; border-radius:3px">
    							    <div ><?=$taskChar['comment']?></div>
    							    <div class="text-right"><small><?=$taskChar['create_date']?> | <?=$getUser['fname']?> <?=$getUser['lname']?> | </small> <span class="label label-primary approval" id="<?=$taskChar['id']?>">Reply</span></div>
    							</div>  
    							<div style="clear:both"></div>
    							<?php if(!empty($taskChar['replyCpmment'])){?>
    							    <div class="col-md-11 pull-right" style="margin:10px 10px 10px 50px; background:#e2e2e2; padding:10px; color:#999;  border-radius:3px">
    							      <?=$taskChar['replyCpmment']?>
                                    <div class="text-right" style="color:#999"><small>Replied</small></div>
                                    </div>
    							<?php }?>
    							    <div class="show-<?=$taskChar['id']?> col-md-11" style="display:none; margin:10px 10px 10px 20px;">
    							    <form method="post" action="ajax.php?action=approval">
    							       <input type="hidden" value="<?=$assignLead['id']?>" name="assignID"/>
    							       <input type="hidden" value="<?=$task_id?>" name="task_id"/>
    							       <input type="hidden" value="<?=$taskChar['id']?>" name="commentId"/>
    							       <input type="hidden" value="<?=$assignLead['employee_list']?>" name="employee_list"/>
    							       <select class="form-control" name="task_status">
            							<option value="">Working Status</option>
            							<option value="1">Working</option>
            							<option value="4">Overdue</option>
            							<option value="3">Pending</option>
            							<option value="2">Completed</option>
            					        </select> <br/>
    							       <textarea class="form-control" name="indivisual_task"><?=$taskChar['replyCpmment']?></textarea><br/>
    							       <button type="submit" class="btn btn-primary">REPLY</button>
    							    </form>
    							    </div>
    							    <?php } ?>
    							 </div>

							 </div>
							 	</div>
							 	<?php } ?>
						
						
						</div>
						<div class="col-lg-3">
							<div class="panel project-user">
								<div class="panel-body">
									<h6 class="panel-title m-b-20">Created By </h6>
									<ul class="list-box">
										<?php 
										$mysqli->where('id', $createTask);
										$created = $mysqli->getOne(UADMIN);
										
										?>
										<li>
											<a href="profile.php">
												<div class="list-item">
													<div class="list-left">
														<span class="avatar"><?=substr($created['fname'],0,1);?></span>
													</div>
													<div class="list-body">
														<span class="message-author"><?=$created['fname'].' '.$created['lname']?></span>
														<div class="clearfix"></div>
														<span class="message-content"><?=$created['profile_type']?></span>
													</div>
												</div>
											</a>
										</li>
								
										
									</ul>
								</div>
							</div>
							<div class="panel project-user">
								<div class="panel-body">
									<h6 class="panel-title m-b-20">Assigned Leader </h6>
									<ul class="list-box">
										<?php 
										$mysqli->where('task_id', $task_id);
										$mysqli->groupBy('employee_list');
										$getAssign = $mysqli->get(TASK);
										foreach ($getAssign as $assignLead) {
										$mysqli->where('id', $assignLead['employee_list']);
										$getUser = $mysqli->getOne(UADMIN);
										//print_r($getUser);
										if(isset($getUser)){
										?>
										<li>
											<a href="profile.php">
												<div class="list-item">
													<div class="list-left">
														<span class="avatar"><?=substr($getUser['fname'],0,1);?></span>
													</div>
													<div class="list-body">
														<span class="message-author"><?=$getUser['fname'].' '.$getUser['lname']?></span>
														<div class="clearfix"></div>
														<span class="message-content"><?=$getUser['profile_type']?></span>
													</div>
												</div>
											</a>
										</li>
									<?php } } ?>
										
									</ul>
								</div>
							</div>
							
						</div>
					</div>
                </div>
				<?php include 'messages.php';?>
            </div>
			
			
        </div>
        
    <?php include'footer.php';?>
    <script>
        $(".approval").click(function(){
            var getID = $(this).attr('id');
            var showDiv = ".show-"+getID;
            $(showDiv).css('display', 'block');
        })
    </script>