<?php include 'header.php';?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-sm-8">
							<h4 class="page-title">Designation</h4>
						</div>
						<div class="col-sm-4 text-right m-b-30">
						    <a href="designationsHide.php" class="btn btn-primary pull-right rounded" style="margin-left:10px"><i class="fa fa-eye-slash"></i> Hide</a>
							<a href="add-designations.php" class="btn btn-primary rounded" ><i class="fa fa-plus"></i> Add New Designation</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div>
								<table class="table table-striped custom-table m-b-0 datatable">
									<thead>
										<tr>
											<th>#</th>
											<th>Designations Name</th>
											<th>Status</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											$sr = '1';
											$mysqli->orderBy('name', 'asc');
											$getDepart = $mysqli->get(DESIGNATION);
											foreach ($getDepart as $departVal) {
											$text = ($departVal['status'] == '1')? 'Active' : 'Inactive';
											$bg = ($departVal['status'] == '1')? 'success' : 'danger';
											$val = ($departVal['status'] == '1')? '0' : '1';
											if($departVal['hide'] != '1'):
												$loc = 'designations.php';
												$tabName = DESIGNATION;
										?>
										<tr>
											<td><?=$sr++?></td>
											<td><?=$departVal['name']?></td>
											<td><a class="label label-<?=$bg?>" href="ajax.php?action=status&val=<?=$val?>&loc=<?=$loc?>&tabName=<?=$tabName?>&col_nam=id&id=<?=$departVal['id']?>"><?=$text?></a></td>
											<td class="text-right">
												<div class="dropdown">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="add-designations.php?designation=<?=$departVal['id']?>"  title="Edit"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
														<li><a href="#" data-toggle="modal" data-target="#delete_department" data-id="<?=$departVal['id']?>" title="Delete"  class="delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>

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
				<?php include 'messages.php';?>
            </div>
			<div id="delete_department" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Delete Designation</h4>
						</div>
						<form method="post" action="ajax.php?action=delete">
								<input type="hidden" name="id" value="" id="del_id" >
								<input type="hidden" name="tab_name" value="<?=DESIGNATION?>" >
								<input type="hidden" name="col_nam" value="id" >
								<input type="hidden" name="loc" value="designations.php" >
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