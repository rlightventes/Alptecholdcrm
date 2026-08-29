<?php include 'header.php';?>
            <div class="page-wrapper">
                <?php  $tabName = base64_encode(USER); ?>
                <form method="post" action="ajax.php?action=multiHide&loc=clientsHide-list.php&tabName=<?=$tabName?>">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-sm-4 col-xs-3">
							<h4 class="page-title">Clients</h4>
						</div>
						<div class="col-sm-8 text-right m-b-20">
						    <button class="btn btn-primary pull-right rounded" type="submit" style="margin-left:10px"><i class="fa fa-eye"></i> Unhide</button>
							<a href="clients-list.php" class="btn btn-primary pull-right rounded" ><i class="fa fa-plus"></i> Client</a>
							<!--<a href="add-clients.php" class="btn btn-primary rounded pull-right"><i class="fa fa-plus"></i> Add Client</a>-->
						</div>
						<!--<div class="col-sm-1">-->
							<!--<button class="btn btn-primary rounded pull-right" onclick="myFunction()"><i class="fa fa-plus"></i> Filters</button>-->
						<!--</div>-->
					</div>
					<div id="filter">
                    	<form action="" method="post">
                			<table class="table table-striped">
                				<tr >
                    				<td colspan="" width="20%">
                      					<select class="form-control" name="search_from" id="search_from" >
                        					<option value="Search for">Search for</option>
                        					<option value="id">Client Id</option>
                        					<option value="name">Client Name</option>
                        					<option value="mobile">Mobile</option>
                        					<option value="person">Contact Person</option>
                        					<option value="order_value">Order Value</option>
                        					<option value="order_date">Order Date</option>
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
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table" id="example">
									<thead>
										<tr>
										    <th id="ifd">Select</th>  
											<th id="ifd" width="11%;">Client ID</th>
											<th id="ifd" width="20%;">Name</th>
											<th id="ifd">Mobile</th>
											<th id="ifd">Contact Person</th>
											<th id="ifd" >Assigned Staff</th>
											<th id="ifd">Total Invoice</th>
											<th>Status</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									if($getAdmin['profile_type'] != 'Admin'):
										$mysqli->where('assign_to', $getAdmin['id']);
									endif;
									$mysqli->orderBy('id', 'desc');
									$mysqli->where('maturate', '1');
									$getClient = $mysqli->get(USER);
									foreach ($getClient as $getEmp) {
										extract($getEmp);
								
									$primary_id = str_pad($id, 3, '0', STR_PAD_LEFT);
									$lead = base64_encode($id);
									$tabName = base64_encode(USER);
									if($hide == '1'){
									?>	

										<tr>
										    <td><input type="checkbox" name="lead[]" value="<?=$id?>" class="addProduct"/></td>
											<td>CLT-<?=$primary_id ?></td>
											<td>
												<a  class="avatar"><?=substr($getEmp['company_name'],0,1);?></a>
												<h2><?=$getEmp['company_name']?></h2>
											</td>
											<td><?=$getEmp['contact1']?></td>
											<td><?=$getEmp['fname'].' '.$getEmp['lname']?></td>
											<td><?php 
												$mysqli->where('id', $assign_to);
												$getEmp = $mysqli->getOne(UADMIN);
												echo $getEmp['fname']." ".$getEmp['lname'];
											?>
										</td>
											<td></td>
											<td>
												<div class="dropdown action-label">
												
													<a class="btn btn-white btn-sm rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-dot-circle-o text-danger"></i> High <i class="caret"></i></a>
													<ul class="dropdown-menu">
														<li><a href="#"><i class="fa fa-dot-circle-o text-danger"></i> Hot</a></li>
														<li><a href="#"><i class="fa fa-dot-circle-o text-warning"></i> Cold</a></li>
														<li><a href="#"><i class="fa fa-dot-circle-o text-success"></i> Warm</a></li>
													</ul>
												</div>
											</td>
											<td class="text-right">
												<div class="dropdown">
													<a href="profile.php?client=<?=$lead?>" class="text-success size15"><i class="fa fa-table"></i></a> &nbsp; &nbsp;
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="ajax.php?action=unhide&lead=<?=$lead?>&tabName=<?=$tabName?>&loc=clientsHide-list.php"><i class="fa fa-eye m-r-5"></i> Unhide</a></li>
														<li><a href="#" data-toggle="modal" data-target="#delete_client" data-id="<?=$id?>" class="delete"><i class="fa fa-trash-o m-r-5"></i> Permanent Delete</a></li>
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
                </div>
                </form>
				<?php include 'messages.php';?>
            </div>
				<div id="delete_client" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content modal-md">
							<div class="modal-header">
								<h4 class="modal-title">Delete Permanently Client</h4>
							</div>
							<form method="post" action="ajax.php?action=deletePermanat">
								<input type="hidden" name="id" value="" id="del_id" >
								<input type="hidden" name="tab_name" value="<?=USER?>" >
								<input type="hidden" name="col_nam" value="id" >
								<input type="hidden" name="loc" value="clientsHide-list.php" >
								<div class="modal-body card-box">
									<p>Are you sure want to permanently delete this client?</p>
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
   /*$('#genderType').hide();
    $('#dateView').hide();
  $('#product_typeType').hide();
  $('#stageID').hide();
  $('#brandType').hide();
  $('#priorityType').hide();*/
  $("#search_from").change(function(){
  var selectVal = $(this).val();
  //alert(selectVal);


if(selectVal == 'id' || selectVal == 'name' || selectVal == 'person' || selectVal == 'pincode' || selectVal == 'status' || selectVal == 'mobile' || selectVal == 'order_value'){
  $('#type').html("<select class='form-control' name='search_type'><option value='='>Equal</option></select>");
}
else if( selectVal == 'order_date' ){
   $('#type').html("<select class='form-control' name='search_type'><option value='>='>Min </option><option value='<='>Max</option></select>");
}
if(selectVal == 'id' || selectVal == 'name' || selectVal == 'mobile' || selectVal == 'person' || selectVal == 'order_value'){
  $('#canId').html('<input class="form-control" type="text" name="search_value">');
}
else if(selectVal == 'order_date'){
    $('#canId').html('<input class="form-control datetimepicker" type="date"  name="search_value" >');
}
else if(selectVal == 'status'){
    $('#canId').html("<select class='form-control' name='search_value' ><option>Select Status</option><option value='High'>High</option><option value='Cold'>Cold</option><option vlaue='warm'>Warm</option></select>");
}

  });
</script>
		<?php include 'footer.php';?>
		<script type="text/javascript">
			$('.delete').click(function(){
				var id = $(this).attr('data-id');
				$('#del_id').val(id);
				//alert(id);
			})
		</script>