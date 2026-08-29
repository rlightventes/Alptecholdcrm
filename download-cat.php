<?php include 'header.php';?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-sm-4 col-xs-3">
							<h4 class="page-title">Download Category</h4>
						</div>
						<div class="col-sm-8 text-right m-b-20">
							<a href="add-downCat.php" class="btn btn-primary rounded pull-right"><i class="fa fa-plus"></i> Add Category</a>
						</div>
						<div class="col-sm-1">
							<!--<button class="btn btn-primary rounded pull-right" onclick="myFunction()"><i class="fa fa-plus"></i> Filters</button>-->
						</div>
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
											<th id="ifd" width="11%;">ID</th>
											<th id="ifd" width="20%;">Category Name</th>
											<th>Status</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									$i = 1;
									$mysqli->orderBy('id', 'desc');
									$getCat = $mysqli->get(D_CAT);
									foreach ($getCat as $cat) {
										extract($cat);
									$text = ($status == '1')? 'Active' : 'Inactive';
									$bg = ($status == '1')? 'success' : 'danger';
									$val = ($status == '1')? '0' : '1';
								    $tabName = D_CAT;
								    $loc = 'download-cat.php';
									$lead = base64_encode($id);
									?>	

										<tr>
											<td><?=$i++?></td>
											<td width="50%"><?=$title?></td>
											<td><a class="label label-<?=$bg?>" href="ajax.php?action=status&val=<?=$val?>&loc=<?=$loc?>&tabName=<?=$tabName?>&col_nam=id&id=<?=$id?>"><?=$text?></a></td>
											<td class="text-right">
												<div class="dropdown">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="add-downCat.php?maincat=<?=$id?>"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
														<li><a href="#" data-toggle="modal" data-target=""><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
													</ul>
												</div>
											</td>
										</tr>
									<?php } ?>







									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<?php include 'messages.php';?>
            </div>
			<div id="delete_client" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Delete Client</h4>
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