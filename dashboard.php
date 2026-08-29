<?php include_once 'header.php';?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-lg-3">
							<div class="dash-widget clearfix card-box">
								<span class="dash-widget-icon"><i class="fa fa-cubes" aria-hidden="true"></i></span>
								<div class="dash-widget-info">
									<?php $getProduct = $mysqli->get(PRODUCT); ?>
									<h3><?=count($getProduct)?></h3>
									<span>Products</span>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-3">
							<div class="dash-widget clearfix card-box">
								<span class="dash-widget-icon"><i class="fa fa-users" aria-hidden="true"></i></span>
								<div class="dash-widget-info">
									<?php $getUser = $mysqli->get(USER); ?>
									<h3><?=count($getUser)?></h3>
									<span>Clients</span>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-3">
							<div class="dash-widget clearfix card-box">
								<span class="dash-widget-icon"><i class="fa fa-tasks" aria-hidden="true"></i></span>
								<div class="dash-widget-info">
									<?php $mysqli->groupBy('task'); $getTask = $mysqli->get(TASK); ?>
									<h3><?=count($getUser)?></h3>
									<span>Total Tasks</span>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-3">
							<div class="dash-widget clearfix card-box">
								<span class="dash-widget-icon"><i class="fa fa-tasks" aria-hidden="true" style="color:#0b8902"></i></span>
								<div class="dash-widget-info">
									<?php $mysqli->where('complete_task','2'); $getComplete = $mysqli->get(TASK); ?>
									<h3><?=count($getComplete)?></h3>
									<span>Completed Task</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6 text-center">
									<div class="card-box">
										<h3 class="card-title">Total Revenue</h3>
										<div id="bar-charts"></div>
									</div>
								</div>
								<div class="col-md-6 text-center">
									<div class="card-box">
										<h3 class="card-title">Sales Overview</h3>
										<div id="line-charts"></div>
									</div>
								</div>
								<div class="col-md-6 text-center">
									<div class="card-box">
										<h3 class="card-title">Invoice Status</h3>
										<div id="area-charts"></div>
									</div>
								</div>
								<div class="col-md-6 text-center">
									<div class="card-box">
										<h3 class="card-title">Overall Status</h3>
										<div id="pie-charts"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="panel panel-table">
								<div class="panel-heading">
									<h3 class="panel-title">Invoices</h3>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table m-b-0">
											<thead>
												<tr>
													<th>Invoice No</th>
													<th>Invoice Date</th>
													<th>Client</th>
													<th>Amount</th>
													<th>GST</th>
													<th>Total Amount</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
											<?php 
											$sr = '1';
										$totalMep = array();
										$totalAMT = '';
										$sum ='0';
										$lead = '0';
										if($getAdmin['profile_type'] != 'Admin'):
										$mysqli->where('assign', $getAdmin['id']);
										endif;
										$mysqli->orderBy('id','desc');
									//	$mysqli->where('client_id', $client);
										$getLeads = $mysqli->get(INV);
										foreach ($getLeads as $leadsVal) {
											extract($leadsVal);
											$mysqli->where('id', $client_id);
											$getUser = $mysqli->getOne(USER);
											$client = base64_encode($getUser['id']);
											
											?>
												<tr>
													<td><a href="invView.php?lead=<?=$lead?>"><?=$inv_no?></a></td>
													<td><?=date('d-M-Y', strtotime($inv_date))?></td>
													<td><?=$getUser['company_name']?></td>
													
													<td><?=substr_replace($subTotal, "", -3)?></td>
													<td><?=substr_replace($gstAmt, "", -3)?></td>
													<td><?=substr_replace($grand_amt, "", -3)?></td>
													<td><a href="profile.php?client=<?=$client?>" class="text-success size15"><i class="fa fa-table"></i></a></td>
												</tr>
											<?php } ?>
												
											</tbody>
										</table>
									</div>
								</div>
								<div class="panel-footer">
									<a href="all_invoice.php" class="text-primary">View all invoices</a>
								</div>
							</div>
						</div>
				
						
						<div class="col-md-6">
							<div class="panel panel-table">
								<div class="panel-heading">
									<h3 class="panel-title">Recent Products</h3>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table m-b-0">
											<thead>
												<tr>
													<th class="col-md-3">Products Name </th>
													<th class="col-md-3">Country</th>
													<th class=" col-md-1">MRP (<i class="fa fa-rupee"></i>)</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$mysqli->orderBy('id', 'desc');
													$getProduct = $mysqli->get(PRODUCT, 5);
													foreach ($getProduct as $valProduct) {
														extract($valProduct);
												?>
												<tr>
													<td>
														<h2><a href="project-view.php"><?=$name?></a></h2>
														<small class="block text-ellipsis">
															<!-- <span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
															<span class="text-xs">9</span> <span class="text-muted">tasks completed</span> -->
														</small>
													</td>
													<td>
														<?=$country?>
													</td>
													<td>
														<?=$mrp?>
													</td>
													
												</tr>
												<?php } ?>
												
											</tbody>
										</table>
									</div>
								</div>
								<div class="panel-footer">
									<a href="products.php" class="text-primary">View all products</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>	
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="fa fa-exclamation-circle"></i>&nbsp; Today's Reminder</h4>
        </div>
        <div class="modal-body">
            <?php 
            $srNo = '0';
					$mysqli->where('status', '1');
					$mysqli->where('employee_list', $getAdmin['id']);
					$mysqli->groupBy('task');
					$getNotificationReminder = $mysqli->get(TASK); 
					
					?>
							<?php  
					        $srNo = "0";
							foreach ($getNotificationReminder as $notification) {
								extract($notification);
								$taskID = base64_encode($task_id);
								$taskDate = date('d-M-Y', strtotime($end_date));
								$today = date('d-M-Y', time());
								$m= date('m', strtotime($end_date)); // Month value
                                $de= date('d', strtotime($end_date)); //today's date

                                $y= date('Y', strtotime($end_date));; // Year value

$weekDate =  date('d-M-Y', mktime(0,0,0,$m,($de-7),$y)); 
$monthDate =  date('d-M-Y', mktime(0,0,0,$m,($de-30),$y)); 
	$mysqli->where('id', $createTask);
							    $createUser = $mysqli->getOne(UADMIN); 
							    $create =  $createUser['fname']." ".$createUser['lname'];
							     if($taskDate == $today){
							       $srNo++;  
							     }elseif($taskDate == $today || $taskDate == $weekDate){
							          $srNo++;  
							     }elseif($taskDate == $today || $taskDate == $weekDate || $taskDate == $monthDate){
							          $srNo++;  
							     }else{
							         $srNo = "0";
							         
							     }
							   
                              } ?>
									
						
					<?php
				// 	  echo $srNo;
					  if($srNo != "0"){ ?>
					  <ul class="media-list">
							<?php  
					        $srNo = "0";
							foreach ($getNotificationReminder as $notification) {
								extract($notification);
								$taskID = base64_encode($task_id);
								$taskDate = date('d-M-Y', strtotime($end_date));
								$today = date('d-M-Y', time());
								$m= date('m', strtotime($end_date)); // Month value

$de= date('d', strtotime($end_date)); //today's date

$y= date('Y', strtotime($end_date));; // Year value

$weekDate =  date('d-M-Y', mktime(0,0,0,$m,($de-7),$y)); 
$monthDate =  date('d-M-Y', mktime(0,0,0,$m,($de-30),$y)); 
	$mysqli->where('id', $createTask);
							    $createUser = $mysqli->getOne(UADMIN); 
							    $create =  $createUser['fname']." ".$createUser['lname'];
							     
                                if($reminder == '1'){
                                    if($taskDate == $today){
                                // }elseif($reminder == '2'){
                                //     if($taskDate == $today || $taskDate == $weekDate){
                                // }elseif($reminder == '2'){
                                //     if($taskDate == $today || $taskDate == $weekDate || $taskDate == $monthDate){
                                // }

								
							
								
								?>
									<li class="media notification-message">
										<a href="task_view.php?task=<?=$taskID?>">
											
										<div class="media-body">
											<p class="m-0 noti-details"><span class="noti-title"><?=$create?></span> added new task <span class="noti-title">TSK-<?=$task_id?></span></p>
											<p class="m-0"><span class="notification-time"><?=date('d M Y', strtotime($created_date))?></span></p>
											</div>
										</a>
									</li>
									<?php } }elseif($reminder == '2'){
									    if($taskDate == $today || $taskDate == $weekDate){ ?>
									  <li class="media notification-message">
										<a href="task_view.php?task=<?=$taskID?>">
											
										<div class="media-body">
											<p class="m-0 noti-details"><span class="noti-title"><?=$create?></span> added new task <span class="noti-title">TSK-<?=$task_id?></span></p>
											<p class="m-0"><span class="notification-time"><?=date('d M Y', strtotime($created_date))?></span></p>
											</div>
										</a>
									</li> 
									<?php } }elseif($reminder == '3'){
									if($taskDate == $today || $taskDate == $weekDate || $taskDate == $monthDate){?>
									<li class="media notification-message">
										<a href="task_view.php?task=<?=$taskID?>">
											
										<div class="media-body">
											<p class="m-0 noti-details"><span class="noti-title"><?=$create?></span> added new task <span class="noti-title">TSK-<?=$task_id?></span></p>
											<p class="m-0"><span class="notification-time"><?=date('d M Y', strtotime($created_date))?></span></p>
											</div>
										</a>
									</li> 
									<?php }} } ?>
									
								</ul>
					  <?php
					      
					  }else{?>
	                    <h5>Today's no any notification</h5>	
					 <?php  } ?>
				
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
</div>
<?php include_once 'footer.php';?>
<!-- Modal -->

<script>
    $(window).on('load',function(){
	$('#myModal').modal('show');
});
</script>