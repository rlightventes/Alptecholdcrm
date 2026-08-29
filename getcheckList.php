<?php include'header.php';?>
		<form method="post" action="mailQt.php">
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<?php
							$client = base64_decode($_GET['client']);
							$mysqli->where('id', $client);
							$getUser = $mysqli->getOne(USER);
							$mysqli->where('id', $getUser['assign_to']);
							$getEmp = $mysqli->getOne(UADMIN);
						?>
						<div class="col-sm-10">
							<h4 class="page-title">Leads  - <?=$getUser['company_name']; ?> <a href="profile.php?client=<?=$_GET['client']?>" class="text-success size15"><i class="fa fa-table"></i></a></h4> 
							<h5><i class="fa fa-user"></i> <?=$getUser['fname'].' '.$getUser['lname']?> | <i class="fa fa-mobile"></i> <?=$getUser['contact1']; ?> |  Assign to: <?=$getEmp['fname']." ".$getEmp['lname']?></h5>
						</div>

								<input type="hidden" name="client" value="<?=$_GET['client']?>">
						
						<div class="col-xs-2 text-right m-b-30">
							
							<a href="add-checklist-mach.php?client=<?=$_GET['client']?>" class="btn btn-primary  rounded" ><i class="fa fa-plus"></i> Create Checklist</a>
						</div>
						<!--<div class="col-sm-2 ">-->
						<!--	<button class="btn btn-primary rounded" name="mail" type="submit"><i class="fa fa-envelope"></i> Send Mail</button>-->
						<!--</div>-->
					</div>
					<!-- <div id="filter">
                    	<form action="" method="post">
                			<table class="table table-striped">
                				<tr >
                    				<td colspan="" width="20%">
                      					<select class="form-control" name="search_from" id="search_from" >
                        					<option value="Search for">Search for</option>
                        					<option value="id">Lead Id</option>
                        					<option value="name">Lead Name</option>
                        					<option value="email">Email</option>
                        					<option value="mobile">Mobile</option>
                        					<option value="product">Product</option>
                        					<option value="assigned_staff">Assigned Staff</option>
                        					<option value="created">Created</option>
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
                    					<div id="canId"><input class="form-control" type="text" name="search_value"></div>
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
					</div> -->
					<div class="row">
						<div class="col-md-12">
							
							<div class="table-responsive">
								<table class="table table-striped custom-table m-b-0" id="example">
									<thead>
										<tr>
											<th style="display:none">Sr no</th>
											<th id="ifd">Sr no</th>
											<th id="ifd">Date </th>
											<th id="ifd">Machine Name</th>
										    <th id="ifd">PDF</th>
											<!--<th id="ifd">Discount </th>-->
											<!--<th id="ifd">Net Amount</th>-->
											<th class="text-right">Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php 
									    $sr = '1';
										$client = base64_decode($_GET['client']);
										$mysqli->orderBy('id','desc');
										$mysqli->where('clt_id', $client);
										$mysqli->groupBy('check_id');
										$getLeads = $mysqli->get(AL_LIST);
										foreach ($getLeads as $leadsVal) {
											extract($leadsVal);
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
										    if($hide != 1){
											
											
										?>
										<tr>
										    <td style="display:none"><?=$id?></td>
											<td><?=$sr++?></td>
											<td><?=$check_date?></td>
											<td><a href="view_checklist_machine.php?check=<?=$check_id?>"><?=$machine_name?></a></td>
										
											<td>
											     <?php  if($pdf == '1'){?>
										         <a href="pdf/CHECKNO-<?=$check_id?>.pdf" download="" class="label label-success">Download</a>   
										          <?php  }else{?>
										          <a href="convert_checklist.php?check=<?=$check_id?>" class="label label-danger" target="_blank">Generate</a>  
										           <?php  }
										        ?></td>
										
											
											<td class="text-right">
												
												<div class="dropdown">
													
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="edit-checklist-mach.php?edit=<?=$check_id?>&client=<?=$_GET['client']?>"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
														<li><a href="#" data-toggle="modal" data-target="#delete_employee" data-id="<?=$check_id?>" class="delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
													</ul>
												</div>
											</td>
										</tr>
										<?php } } ?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				<?php include'messages.php';?>
            </div>
        </form>
				<div id="delete_employee" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content modal-md">
							<div class="modal-header">
								<h4 class="modal-title">Delete Row</h4>
							</div>
							<form method="post" action="ajax.php?action=delete">
								<input type="hidden" name="id" value="" id="del_id" >
								<input type="hidden" name="tab_name" value="<?=AL_LIST?>" >
								<input type="hidden" name="col_nam" value="check_id" >
								<input type="hidden" name="loc" value="getcheckList.php?client=<?=$_GET['client']?>" >
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
        </div>
		<?php include'footer.php';?>
		<script type="text/javascript">
			$('.delete').click(function(){
				var id = $(this).attr('data-id');
				$('#del_id').val(id);
				//alert(id);
			})
		</script>
		<script type="text/javascript">
			$("#checkAl").click(function () {
$('input:checkbox').not(this).prop('checked', this.checked);
});
$(document).on('click', '#select_all', function() {
$(".emp_checkbox").prop("checked", this.checked);
$("#select_count").html($("input.emp_checkbox:checked").length);
});
$(document).on('click', '.emp_checkbox', function() {
if ($('.emp_checkbox:checked').length == $('.emp_checkbox').length) {
$('#select_all').prop('checked', true);
} else {
$('#select_all').prop('checked', false);
}
$("#select_count").html($("input.emp_checkbox:checked").length);
});
		</script>
		
		<script type="text/javascript">
		setTimeout(function(){ $('#msg').hide();}, 8000);

		</script>
	
