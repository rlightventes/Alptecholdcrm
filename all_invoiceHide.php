<?php include'header.php';?>
            <div class="page-wrapper">
                <?php  $tabName = base64_encode(INV); ?>
                <form method="post" action="ajax.php?action=multiHideInvoice&loc=all_invoiceHide.php&tabName=<?=$tabName?>">
                <div class="content container-fluid">
					<div class="row">
						<?php 
						$totalAmount = '0';
						$totalGST = '0';
						$totalGSTAMT = '0';
						$totalNETAmount = '0';
						    if($getAdmin['profile_type'] != 'Admin'):
										$mysqli->where('assign', $getAdmin['id']);
										endif;
										$mysqli->orderBy('id','desc');
										$totalCal = $mysqli->get(INV);
										foreach ($totalCal as $allCal){
										    if($allCal['hide'] != 1){
										    $totalAmount += str_replace(',', '', $allCal['subTotal']);
                    						$totalGSTAMT += str_replace(',', '', $allCal['gstAmt']);
                    						$totalNETAmount += str_replace(',', '', $allCal['grand_amt']);
										} }
						?>
						<div class="col-sm-2">
							<h4> Invoice</h4> 	</div>
	                    <div class="col-sm-2 profile-info-right">
							<center>
								<a href="#" target="_blank" class="primeColor">
							<h5 class="counter" style="font-size:16px"><?=substr_replace(money_format('%!i', round($totalAmount)), "", -3)?></h5> <small>AMOUNT</small></a>
							</center>
						</div>
						<div class="col-sm-2 profile-info-right">
							<center>
								<a href="#" target="_blank" class="primeColor">
							<h5 class="counter" style="font-size:16px"><?=substr_replace(money_format('%!i', round($totalGSTAMT)), "", -3)?></h5> <small>GST AMOUNT</small></a>
							</center>
						</div>
						<div class="col-sm-2 profile-info-right">
							<center>
								<a href="#" target="_blank" class="primeColor">
							<h5 class="counter"  style="font-size:16px"><?=substr_replace(money_format('%!i', round($totalNETAmount)), "", -3)?></h5> <small>TOTAL AMOUNT</small></a>
							</center>
						</div>
								<div class="col-sm-3">
							<button class="btn btn-primary pull-right rounded" type="submit" style="margin-left:10px"><i class="fa fa-eye"></i> Unhide</button>   
							<button class="btn btn-primary rounded pull-right" onclick="myFunction()"><i class="fa fa-list"></i> Filters</button>
						</div>
						<div class="col-sm-1 text-right">   <form method="post" action="exportInvoice.php">
						    <?php 	if(isset($_POST['filter'])){ ?> 
						    <input type="hidden" name="startDate" value="<?=$_POST['start_date']?>" />
						    <input type="hidden" name="endDate" value="<?=$_POST['end_date']?>" />
						    <?php }?>
     <input type="submit" name="export" class="btn btn-success" value="Export" />
    </form></div>
	                    
					</div><br/>
					<div style="clear:both"></div>
						<div id="filter">
                    	<form action="all_invoice.php" method="post">
                			<div class="col-md-4 text-left">
						<div class="form-group">
							<label>From Date</label>
							<div class="cal-icon"><input class="form-control datetimepicker" id="startDate"  type="text" name="start_date" required placeholder="Enter From Date"></div>
						</div>
					</div>
					<div class="col-md-4  text-left">
						<div class="form-group">
							<label>To Date</label>
							<div class="cal-icon"><input class="form-control datetimepicker" type="text" name="end_date" required placeholder="Enter To Date"></div>
						</div>
					</div>
					<div class="col-md-4">
    					<div class="m-t-20 text-left">
    					    <button class="btn btn-primary" name="filter" type="submit">Filter</button>
    				    </div>
    				</div>
                    	</form>
					</div>
					<div class="row">
						<div class="col-md-12">
						
							<div class="table-responsive">
								<table class="table table-striped custom-table m-b-0" id="example">
									<thead>
										<tr>
											<th style="display: none;"></th>
											
											<th id="ifd"><input type="checkbox" id="select_all"> All <span class="rows_selected" id="select_count"></span></th>
											<th id="ifd">Client Name</th>
											
											<th id="ifd">Invoice Date</th>
											
											<th id="ifd"># Invoice No </th>
											<th id="ifd">Due Date</th>
											<th id="ifd">Total Amount</th>
											<th id="ifd">Paid Amount</th>
											<th id="ifd">Balance Amount</th>
											<th id="ifd">Payment Mode</th>
											<th id="ifd">PDF</th>
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
											if(isset($_POST['filter'])){
										    $startDate =  $_POST['start_date'];
										    $exploeStart = explode('/', $startDate);
										     $fromDate = $exploeStart['2']."-".$exploeStart['1']."-".$exploeStart['0'];
										    $endDate =  $_POST['end_date'];
										    $exploeEnd = explode('/', $endDate);
										     $toDate = $exploeEnd['2']."-".$exploeEnd['1']."-".$exploeEnd['0'];
										    	$mysqli->where('inv_date', Array($fromDate, $toDate), 'BETWEEN');
										}else{
										    	$mysqli->orderBy('id','desc');
										}
										if($getAdmin['profile_type'] != 'Admin'):
										$mysqli->where('assign', $getAdmin['id']);
										endif;
								//		$mysqli->orderBy('id','desc');
									//	$mysqli->where('client_id', $client);
										$getLeads = $mysqli->get(INV);
										foreach ($getLeads as $leadsVal) {
											extract($leadsVal);
											$mysqli->where('id', $client_id);
											$getUser = $mysqli->getOne(USER);
											$client = base64_encode($getUser['id']);
											 $date1 = strtotime($create_date);  
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
										    $mysqli->where('inv_no', $id);
										    $mysqli->orderBy('id','desc');
											$getInv = $mysqli->getOne(PAYHIS);
											if(isset($getInv)):
											    $balAmt = $getInv['bal_amt'];
											    $paidAmt = $getInv['paid_amt'];
											    $dueDate = date('d-M-Y', strtotime($getInv['due_date']));
											 else:
											     $paidAmt = '0';
											      $balAmt = $grand_amt;
											      $dueDate = '';
											 endif;
											$sr++;
											if($hide ==  1){
										?>
										<tr>
											<td style="display: none;"><?=$id?></td>
											<td><input type="checkbox" class="emp_checkbox" name="check[]" data-emp-id="<?=$id?>" value="<?=$id?>" ></td>
											<td><?=$getUser['company_name']?></td>
											<td><?=date('d-M-Y', strtotime($inv_date))?></td>
											<td><a href="invView.php?lead=<?=$lead?>"><?=$inv_no?></a></td>
											<td><?=$dueDate?></td>
											<td><?=substr_replace($grand_amt, "", -3)?></td>
											<td><?=substr_replace($paidAmt, "", -3)?></td>
											<td><?=substr_replace($balAmt, "", -3)?></td>
											<td><?=$getInv['payment_mode']?></td>
											<td>
											     <?php  if($pdf == '1'){?>
										         <a href="pdf/<?=$inv_no?>.pdf" download="" class="label label-success">Download</a>   
										          <?php  }else{?>
										          <a href="convert_inv.php?qtID=<?=$lead?>" class="label label-danger" target="_blank">Generate</a>  
										           <?php  }
										        ?></td>
											<!--<td></td>-->
											<td><?=$create?></td>
											
											<td class="text-right">
											
												<div class="dropdown">
														<a href="profile.php?client=<?=$client?>" class="text-success size15"><i class="fa fa-table"></i></a>
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="ajax.php?action=unhide&lead=<?=$lead?>&tabName=<?=$tabName?>&loc=all_invoiceHide.php"><i class="fa fa-eye m-r-5"></i> Unhide</a></li>
														<li><a href="#" data-toggle="modal" data-target="#delete_employee" data-id="<?=$id?>" class="delete"><i class="fa fa-trash-o m-r-5"></i> Permanent Delete</a></li>
												</ul>
												</div>
											</td>
										</tr>
										<?php } }?>
										
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
								<h4 class="modal-title">Delete Permanently Invoice</h4>
							</div>
							<form method="post" action="ajax.php?action=deletePermanat">
								<input type="hidden" name="id" value="" id="del_id" >
								<input type="hidden" name="tab_name" value="<?=INV?>" >
								<input type="hidden" name="col_nam" value="id" >
								<input type="hidden" name="loc" value="all_invoiceHide.php" >
								<div class="modal-body card-box">
									<p>Are you sure want to permanently delete this invoice?</p>
									<div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
										<button type="submit" class="btn btn-danger">Delete</button>
									</div>
								</div>
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
	
