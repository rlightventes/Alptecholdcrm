<?php include 'header.php'?>
<script src="Flexible.Pagination.js"></script>
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<!-- Stylesheet file -->
<link rel="stylesheet" href="style.css">

<!-- jQuery library -->
<script src="jquery.min.js"></script>

 <style>
        .hide{display: none;}
        body { background-color: #fafafa; }
        .container { margin: 10px auto; }
    </style>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-sm-4">
							<h4 class="page-title">Tasks</h4>
						</div>
					
						<div class="col-sm-8">
						    <a href="taskHide.php" class="btn btn-primary pull-right rounded" style="margin-left:10px"><i class="fa fa-eye-slash"></i> Hide</a>
						    <a href="#" class="btn btn-primary pull-right rounded" style="margin-left:10px" id="export"><i class="fa fa-file-xls"></i> Export</a>

							<!--<button class="btn btn-primary rounded pull-right" onclick="myFunction()"><i class="fa fa-list"></i> Filters</button>-->
						</div>
						<div class="col-md-12">
					<form method="post" action="">
                        <?php $Currmonth = date('m', time());?>
                        <div class="col-md-3 col-xs-12">
							<div class="cal-icon"><input class="form-control datetimepicker" id="startDate"  type="text" name="start_date" required placeholder="From "></div>
						</div>
						<div class="col-md-3 col-xs-12">
					        <div class="cal-icon"><input class="form-control datetimepicker" id="endDate"  type="text" name="end_date" required placeholder="To"></div>
						</div>
						<button type="submit" name="submit" class="btn btn-info col-md-2 col-xs-12">SUBMIT</button>
					</form>
				</div>
				<br/><br/>
						<!--<div class="col-sm-1">-->
						<!--	<a href="export_to_xl.php" class="btn btn-primary rounded pull-right"><i class="fa fa-plus"></i> Export</a>-->
						<!--</div>-->
					</div>
					<div class="row" id="desktop_view">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table" id="example">
									<thead>
										<tr>
										    <th id="ifd" style="display:none"></th>
											<th id="ifd" width="7%">Task Id</th>
											<th id="ifd">Task Date</th>
											<th id="ifd">Category</th>
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
									  if($getAdmin['profile_type'] != "ADMIN" && $getAdmin['profile_type'] != "Admin"){
									  $mysqli->where('employee_list', $userGetID);
									  }
									  if(isset($_POST['submit'])){
									      $startDate = explode('/', $_POST['start_date']);
									      $endDate = explode('/', $_POST['end_date']);
									       $from = $startDate['2'].'-'.$startDate['1'].'-'.$startDate['0'];
									       $to = $endDate['2'].'-'.$endDate['1'].'-'.$endDate['0'];
									   $mysqli->where('start_date', array($from, $to), 'BETWEEN');   
									   $mysqli->where('end_date', array($from, $to), 'BETWEEN');   
									  }
									  $mysqli->orderBy('task_id', 'desc');
									  $mysqli->groupBy('task_id');
									  $allTask = $mysqli->get(TASK);
								// 	  print_r($allTask);
									  foreach($allTask as $taskVal){
									      $task = base64_encode($taskVal['task_id']);
									      $mysqli->where('id', $taskVal['client']);
									      $getClient = $mysqli->getOne(USER);
									      $clientID = base64_encode($getClient['id']);
									    if($taskVal['complete_task'] == '1'){
									      $statusName = 'Working';
									  }elseif($taskVal['complete_task'] == '2'){
									      $statusName = 'Complete';
									  }elseif($taskVal['complete_task'] == '3'){
									      $statusName = 'Pending';
									  }elseif($taskVal['complete_task'] == '4'){
									      $statusName = 'Overdue';
									  }else{
									       $statusName = 'New';
									  }
									  	$lead = base64_encode($getClient['id']);
									  	if($taskVal['hide'] != '1'){
									  ?>  
									    <tr>
									        <td style="display:none"><?=$taskAll['task_id']?></td>
									        <td style="vertical-align:top"><a href="task_view.php?task=<?=$task?>">TSK-<?=$taskVal['task_id']?></a></td>
									        <td style="vertical-align:top"><?=date('d/m/Y', strtotime($taskVal['created_date']))?></td>
									        <td style="vertical-align:top"><?=$getClient['reg']?></td>
									        <td style="vertical-align:top"><?=$taskVal['task']?></td>
									        <td style="vertical-align:top"><?=$getClient['company_name']?></td>
									       <td style="text-transform:capitalize">
									     <?php 
									     $mysqli->groupBy('employee_list');
									     $mysqli->where('task_id', $taskVal['task_id']);
									     $empName = $mysqli->get(TASK);
									     foreach($empName as $nameEmp){
									      if(!empty($nameEmp['employee_list'])):
								        $mysqli->where('id', $nameEmp['employee_list']);
							            $nameUser = $mysqli->getOne(UADMIN);
									        echo "<p>&bull; ".$nameUser['fname']." ".$nameUser['lname']."</p>";
									     endif;
									         
									     }
									     
									     
									     ?>
									        </td>
									        <td style="vertical-align:top"><?=$taskVal['start_date']?></td>
									        <td style="vertical-align:top"><?=$taskVal['end_date']?></td>
									        <td style="vertical-align:top">
									             <?php 
								$mysqli->where('id', $taskVal['createTask']);
							    $createUser = $mysqli->getOne(UADMIN); 
							    echo $createUser['fname']." ".$createUser['lname'];
									       ?>   </td>
									        <td style="vertical-align:top"><?=$taskVal['priority']?></td>
									        <td style="vertical-align:top"><?=$statusName?></td>
									        <td class="text-right" style="vertical-align:top">

												<div class="dropdown">
													<a href="profile.php?client=<?=$lead?>" class="text-success size15"><i class="fa fa-th m-r-5"></i> </a>
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>

													<ul class="dropdown-menu pull-right">
														<li><a href="add-task.php?task=<?=$task?>&client=<?=$clientID?>" ><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
														<li><a href="#" data-toggle="modal" data-target="#delete_task" data-id="<?=$taskVal['task_id']?>" class="delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
													</ul>
												</div>
											</td>
									    </tr>
									    <?php
									    } 
									    } ?>
									</tbody>
								</table>
								<table class="table table-striped custom-table" id="studtable" style="display:none">
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
										</tr>
									</thead>
									<tbody>
									  <?php
									  if($getAdmin['profile_type'] != "ADMIN" && $getAdmin['profile_type'] != "Admin"){
									  $mysqli->where('employee_list', $userGetID);
									  }
									  if(isset($_POST['submit'])){
									      $startDate = explode('/', $_POST['start_date']);
									      $endDate = explode('/', $_POST['end_date']);
									       $from = $startDate['2'].'-'.$startDate['1'].'-'.$startDate['0'];
									       $to = $endDate['2'].'-'.$endDate['1'].'-'.$endDate['0'];
									   $mysqli->where('start_date', array($from, $to), 'BETWEEN');   
									   $mysqli->where('end_date', array($from, $to), 'BETWEEN');   
									  }
									  $mysqli->orderBy('task_id', 'desc');
									  $mysqli->groupBy('task_id');
									  $allTask = $mysqli->get(TASK);
								// 	  print_r($allTask);
									  foreach($allTask as $taskVal){
									      $task = base64_encode($taskVal['task_id']);
									      $mysqli->where('id', $taskVal['client']);
									      $getClient = $mysqli->getOne(USER);
									      $clientID = base64_encode($getClient['id']);
									    if($taskVal['complete_task'] == '1'){
									      $statusName = 'Working';
									  }elseif($taskVal['complete_task'] == '2'){
									      $statusName = 'Complete';
									  }elseif($taskVal['complete_task'] == '3'){
									      $statusName = 'Pending';
									  }elseif($taskVal['complete_task'] == '4'){
									      $statusName = 'Overdue';
									  }else{
									       $statusName = 'New';
									  }
									  	$lead = base64_encode($getClient['id']);
									  	if($taskVal['hide'] != '1'){
									  ?>  
									    <tr>
									        <td style="vertical-align:top"><a href="task_view.php?task=<?=$task?>">TSK-<?=$taskVal['task_id']?></a></td>
									        <td style="vertical-align:top"><?=date('d/m/Y', strtotime($taskVal['created_date']))?></td>
									        <td style="vertical-align:top"><?=$taskVal['task']?></td>
									        <td style="vertical-align:top"><?=$getClient['company_name']?></td>
									       <td style="text-transform:capitalize">
									     <?php 
									     $mysqli->groupBy('employee_list');
									     $mysqli->where('task_id', $taskVal['task_id']);
									     $empName = $mysqli->get(TASK);
									     foreach($empName as $nameEmp){
									      if(!empty($nameEmp['employee_list'])):
								        $mysqli->where('id', $nameEmp['employee_list']);
							            $nameUser = $mysqli->getOne(UADMIN);
									        echo "<p>- ".$nameUser['fname']." ".$nameUser['lname']."</p>";
									     endif;
									         
									     }
									     
									     
									     ?>
									        </td>
									        <td style="vertical-align:top"><?=$taskVal['start_date']?></td>
									        <td style="vertical-align:top"><?=$taskVal['end_date']?></td>
									        <td style="vertical-align:top">
									             <?php 
								$mysqli->where('id', $taskVal['createTask']);
							    $createUser = $mysqli->getOne(UADMIN); 
							    echo $createUser['fname']." ".$createUser['lname'];
									       ?>   </td>
									        <td style="vertical-align:top"><?=$taskVal['priority']?></td>
									        <td style="vertical-align:top"><?=$statusName?></td>
									        
									    </tr>
									    <?php
									    } 
									    } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
                <div class="row staff-grid-row" id="mobile_view">
						<input class="searchBox form-control" placeholder="Search Something...">
            			<div id="content">
            				<?php 
								foreach($allTask as $taskVal){
									      $task = base64_encode($taskVal['task_id']);
									      $mysqli->where('id', $taskVal['client']);
									      $getClient = $mysqli->getOne(USER);
									    if($taskVal['complete_task'] == '1'){
									      $statusName = 'Working';
									  }elseif($taskVal['complete_task'] == '2'){
									      $statusName = 'Complete';
									  }elseif($taskVal['complete_task'] == '3'){
									      $statusName = 'Pending';
									  }elseif($taskVal['complete_task'] == '4'){
									      $statusName = 'Overdue';
									  }else{
									       $statusName = 'New';
									  }
									  	$lead = base64_encode($getClient['id']);
									  	if($taskVal['hide'] != '1'){ 
							?>
						<div class="col-md-4 col-sm-4 col-xs-12 col-lg-3 result well">
							<div class="profile-widget">
							    <h4 class="user-name m-t-10 m-b-0 text-ellipsis">
									<a href="task_view.php?task=<?=$task?>" style="color:#009ce7;">TSK-<?=$taskVal['task_id']?></a>
								</h4>
								<h5 class="user-name m-t-10 m-b-0 text-ellipsis">
									Task Date: <?=date('d/m/Y', strtotime($taskVal['created_date']))?>
								</h5><br>
								
								<div class="profile-img">
									<a href="profile.php?client=<?=$client?>" class="avatar"><?=substr($taskVal['task'],0,1);?></a>
								</div>
								 <div class="dropdown profile-action">
									<a aria-expanded="false" class="action-icon dropdown-toggle" data-toggle="dropdown" href="">
										<i class="fa fa-ellipsis-v"></i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li><a href="add-task.php?task=<?=$task?>" ><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
										<li><a href="#" data-toggle="modal" data-target="#delete_task" data-id="<?=$taskVal['task_id']?>" class="delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
									</ul>
								</div> 
								<h4 class="user-name m-t-10 m-b-0 text-ellipsis">
									<?=$taskVal['task']?>
								</h4>
								<h5 class="user-name m-t-10 m-b-0 text-ellipsis">
									<?=$getClient['company_name']?>
								</h5>
								<h5 class="user-name m-t-10 m-b-0 text-ellipsis">
								    Assigned Team<br>
									 <?php 
									     $mysqli->groupBy('employee_list');
									     $mysqli->where('task_id', $taskVal['task_id']);
									     $empName = $mysqli->get(TASK);
									     foreach($empName as $nameEmp){
									      if(!empty($nameEmp['employee_list'])):
								        $mysqli->where('id', $nameEmp['employee_list']);
							            $nameUser = $mysqli->getOne(UADMIN);
									        echo "<p>&bull; ".$nameUser['fname']." ".$nameUser['lname']."</p>";
									     endif;
									         
									     }	?>
								</h5>
								<h5 class="user-name m-t-10 m-b-0 text-ellipsis">
									Start Date: <?=$taskVal['start_date']?><br>
									End Date: <?=$taskVal['end_date']?>
								</h5>
								<h5 class="user-name m-t-10 m-b-0 text-ellipsis">
								    Created: 
									<?php 
								$mysqli->where('id', $taskVal['createTask']);
							    $createUser = $mysqli->getOne(UADMIN); 
							    echo $createUser['fname']." ".$createUser['lname'];
									       ?> 
								</h5>
								<h5 class="user-name m-t-10 m-b-0 text-ellipsis">
								    Priority: <?=$taskVal['priority']?>
								</h5>
								<h5 class="user-name m-t-10 m-b-0 text-ellipsis">
								    Status: <?=$statusName?>
								</h5>
								<br>
								<a href="profile.php?client=<?=$lead?>" class="btn btn-default btn-sm m-t-10 m-l-5">
									<i style="color: #55ce63;font-size: 20px;" class="fa fa-table"></i>
								</a>
							</div>
						</div>
						<?php } }?>
						</div>
						<div class="clearfix"></div>
						<div id="pagingControls"></div>
            			<div id="showingInfo" class="well" style="margin-top:20px"></div>
					</div>
				<?php include 'messages.php'?>
            </div>
			<div id="delete_task" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content modal-md">
							<div class="modal-header">
								<h4 class="modal-title">Delete Leads</h4>
							</div>
							<form method="post" action="ajax.php?action=delete">
								<input type="hidden" name="id" value="" id="del_id" >
								<input type="hidden" name="tab_name" value="<?=TASK?>" >
								<input type="hidden" name="col_nam" value="task_id" >
								<input type="hidden" name="loc" value="tasks.php" >
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
<script type="text/javascript">
			$('.delete').click(function(){
				var id = $(this).attr('data-id');
				$('#del_id').val(id);
				//alert(id);
			})
		</script>
		<script>
            $(function() {
                var flexiblePagination = $('#content').flexiblePagination({
                    itemsPerPage : 10,
                    itemSelector : 'div.result:visible',
                    pagingControlsContainer : '#pagingControls',
                    showingInfoSelector : '#showingInfo',
                    css: {
                        btnNumberingClass: 'btn btn-sm btn-success',
                        btnFirstClass: 'btn btn-sm btn-success',
                        btnLastClass: 'btn btn-sm btn-success',
                        btnNextClass: 'btn btn-sm btn-success',
                        btnPreviousClass: 'btn btn-sm btn-success'
                    }
                });
                flexiblePagination.getController().onPageClick = function(pageNum, e){
                    console.log('You Clicked Page: '+pageNum)
                };
                // Direct JS Object method of using the FlexiblePagination
                //        var pager = new Flexible.Pagination();
                //        pager.itemsPerPage = 1;
                //        pager.pagingContainer = '#content';
                //        pager.itemSelector = 'div.result:visible';  //That is, Select and paginate only the filtered visible '.result' div.
                //        pager.pagingControlsContainer = '#pagingControls';
                //        pager.showCurrentPage();
            });
        </script>
        <script>
  
 $("#export").click(function () {
    XLExport("studtable");
    // $("#studtable").table2excel({
    //     filename: "Students.xls"
    // });
 });
  
  function XLExport(tableId){
    var tab_text = "<table border='2px'><tr>";
    var textRange;
    var j = 0;
    tab = document.getElementById(tableId);
    for (j = 0; j < tab.rows.length; j++){
        tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
    }
    tab_text = tab_text + "</table>";
    tab_text = tab_text.replace(/<A[^>]*>|<\/A>/gi, "");
    tab_text = tab_text.replace(/<img[^>]*>/gi, "");
    tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, "");
    var uri = 'data:application/vnd.ms-excel,' + encodeURIComponent(tab_text);
    sa = window.open(uri);
    return (sa);

  }
</script>