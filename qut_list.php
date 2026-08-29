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
						<div class="col-sm-5 col-xs-12">
							<h4 class="page-title">Leads  - <?=$getUser['company_name']; ?> <a href="profile.php?client=<?=$_GET['client']?>" class="text-success size15"><i class="fa fa-table"></i></a></h4> 
							<h5><i class="fa fa-user"></i> <?=$getUser['fname'].' '.$getUser['lname']?> | <i class="fa fa-mobile"></i> <?=$getUser['contact1']; ?> |  Assign to: <?=$getEmp['fname']." ".$getEmp['lname']?></h5>
						</div>

								<input type="hidden" name="client" value="<?=$_GET['client']?>">
						
						<div class="col-xs-12 col-sm-7 text-right m-b-30">
							<a href="leads.php" class="btn btn-primary rounded" ><i class="fa fa-arrow-circle-left"></i> Back</a> 
							<a href="add-auto-quot.php?client=<?=$_GET['client']?>" class="btn btn-primary  rounded" ><i class="fa fa-plus"></i> Create Quote</a>
							<!--<a href="products.php?client=<?=$_GET['client']?>" class="btn btn-primary  rounded" ><i class="fa fa-plus"></i> Create Quote</a>-->
							<button class="btn btn-primary rounded" name="mail" type="submit"><i class="fa fa-envelope"></i> Send Mail</button>
						</div>
					
						<?php
// session_start();

unset($_SESSION['shopping_cart']);  ?>
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
					<div class="row" id="desktop_view">
						<div class="col-md-12">
						  
							<?php 
							if(isset($_GET['msg'])):
								if($_GET['msg'] == 'fail'):
							?>
							<div class="alert alert-warning" id="msg">
							Opps So Sorry!! <br/>Mail not delivered.
							</div>
						<?php else: ?>
								<div class="alert alert-success" id="msg">
							
					Mail send successful.
							</div>
						<?php endif; endif;?>

							<div class="table-responsive">
								<table class="table table-striped custom-table m-b-0" id="example">
									<thead>
										<tr>
											<th id="ifd" style="display: none;"></th>
											<th id="ifd"><input type="checkbox" id="select_all"> All <span class="rows_selected" id="select_count"></span></th>
											<th id="ifd">Date</th>
											<th id="ifd"># QT No </th>
											<th id="ifd">Subject </th>
											<th id="ifd">PDF</th>
											<!--<th id="ifd">Discount </th>-->
											<!--<th id="ifd">Net Amount</th>-->
											<th id="ifd" >Created </th>
											<th class="text-right">Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$sr = '1';
										$totalMep = array();
										$totalAMT = '';
										$sum ='0';
								// 		if($getAdmin['profile_type'] != 'Admin'):
								// 		$mysqli->where('assign', $getAdmin['id']);
								// 		endif;
										$client = base64_decode($_GET['client']);
										$mysqli->orderBy('id','asc');
										$mysqli->where('client_id', $client);
										//$mysqli->where('hide', '0');
										$mysqli->groupBy('quot_id');
										$getLeads = $mysqli->get(QOT);
										foreach ($getLeads as $leadsVal) {
											extract($leadsVal);
										    /*echo $id;*/
											
											$mysqli->where('id', $client_id);
											$getUser = $mysqli->getOne(USER);
											$client = base64_encode($getUser['id']);
											$mysqli->where('id', $product_id);
											$getProduct = $mysqli->getOne(PRODUCT);
											$product = base64_encode($product_id);
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
											 $lead = base64_encode($id);
											 
											$qtID = str_replace('/', '-', $quot_id); 	
								// 			if($hide == 1){
										?>
										<tr>
											<td style="display: none;"><?=$sr++?></td>
											<td><input type="checkbox" class="emp_checkbox" name="check[]" data-emp-id="<?=$id?>" value="<?=$id?>" ></td>
											<td><?=date('d-M-Y', strtotime($quotation_date))?></td>
											<td><a href="qtView.php?lead=<?=$lead?>"><?=$quot_id?></a></td>
											<td><?=$subject?></td>
											<td>
											     <?php  if($qotPDF == '1'){?>
										         <a href="pdf/<?=$qtID?>.pdf" download="" class="label label-success">Download</a>   
										          <?php  }else{?>
										          <a href="convert_qot.php?qtID=<?=$lead?>" class="label label-danger" target="_blank">Generate</a>  
										           <?php  }
										        ?></td>
											<!--<td></td>-->
											<td><?=$create?></td>
											
											<td class="text-right">
												
												<div class="dropdown">
													
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="edit-auto-quot.php?edit=<?=$lead?>&client=<?=$_GET['client']?>"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
														<!--<li><a href="add-quote.php?edit=<?=$lead?>&client=<?=$_GET['client']?>"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>-->
														<li><a href="#" data-toggle="modal" data-target="#delete_employee" data-id="<?=$quot_id?>" class="delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
													</ul>
												</div>
											</td>
										</tr>
										<?php
								// 		} 
										}?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<br>
					<div class="row staff-grid-row" id="mobile_view">
						<!-- <input class="searchBox form-control" placeholder="Search Something..."> -->
            			<div id="content">
            				<?php 
            				    	$sr = '1';
										$totalMep = array();
										$totalAMT = '';
										$sum ='0';
								// 		if($getAdmin['profile_type'] != 'Admin'):
								// 		$mysqli->where('assign', $getAdmin['id']);
								// 		endif;
										$client = base64_decode($_GET['client']);
										$mysqli->orderBy('id','desc');
										$mysqli->where('client_id', $client);
										//$mysqli->where('hide', '0');
										$mysqli->groupBy('quot_id');
										$getLeadsMob = $mysqli->get(QOT);
										
								foreach ($getLeadsMob as $leadsVal) {
											extract($leadsVal);
										    
											
											$mysqli->where('id', $client_id);
											$getUser = $mysqli->getOne(USER);
											$client = base64_encode($getUser['id']);
											$mysqli->where('id', $product_id);
											$getProduct = $mysqli->getOne(PRODUCT);
											$product = base64_encode($product_id);
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
											 $lead = base64_encode($id);
											 
											$qtID = str_replace('/', '-', $quot_id); 	
											if($hide != 1){
										?>
						<div class="col-md-4 col-sm-4 col-xs-12 col-lg-3 result well">
							<div class="profile-widget">
								<h5 class="user-name m-t-10 m-b-0 text-ellipsis">
									<input type="checkbox" class="emp_checkbox" name="check[]" data-emp-id="<?=$id?>" value="<?=$id?>" >
								</h5>
								<h5 class="user-name m-t-10 m-b-0 text-ellipsis">
									Date: <?=date('d-M-Y', strtotime($quotation_date))?>
								</h5>
								<div class="profile-img">
<a href="profile.php?client=<?=$client?>" class="avatar">
    <?= isset($getProduct['name']) ? substr($getProduct['name'], 0, 1) : 'N'; ?>
</a>								</div>
								
								<h5 class="user-name m-t-10 m-b-0 text-ellipsis">
									<a href="qtView.php?lead=<?=$lead?>" style="color: #009ce7;"><?=$quot_id?></a>
								</h5>
								<h4 class="user-name m-t-10 m-b-0 text-ellipsis">
									<?=$subject?>
								</h4>
								<h5 class="user-name m-t-10 m-b-0 text-ellipsis">
									<a href=""><?=$create?></a>
								</h5>
							
								<h4 class="user-name m-t-10 m-b-0 text-ellipsis">
									<?php  if($qotPDF == '1'){?>
									<a href="pdf/<?=$qtID?>.pdf" download="" style="color: #fff" class="small label label-success">Download</a>   
									<?php  }else{?>
									<a href="convert_qot.php?qtID=<?=$lead?>" style="color: #fff;" class="small label label-danger" target="_blank">Generate</a>  
									<?php  } ?>
									<a class="small" href="qtView.php?lead=<?=$lead?>">
										<i class="fa fa-eye" style="background: #0b8902;padding: 10px;border-radius: 11%;color: #fff;"></i>
									</a>
									<a class="small" href="add-quote.php?edit=<?=$lead?>&client=<?=$_GET['client']?>">
										<i class="fa fa-pencil" style="background: #0b8902;padding: 10px;border-radius: 11%;color: #fff;"></i>
									</a>
									<a  href="#" data-toggle="modal" data-target="#delete_employee" data-id="<?=$quot_id?>" class="delete">
										<i class="fa fa-trash-o" style="background: #0b8902;padding: 10px;border-radius: 11%;color: #fff;"></i>
									</a>
									
								</h4>

							</div>
						</div>
						<?php } }?>
					</div>
				<?php include'messages.php';?>
            </div>
        </form>
				<div id="delete_employee" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content modal-md">
							<div class="modal-header">
								<h4 class="modal-title">Delete Leads</h4>
							</div>
							<form method="post" action="ajax.php?action=delete">
								<input type="hidden" name="id" value="" id="del_id" >
								<input type="hidden" name="tab_name" value="<?=QOT?>" >
								<input type="hidden" name="col_nam" value="quot_id" >
								<input type="hidden" name="loc" value="qut_list.php?client=<?=$_GET['client']?>" >
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
	
