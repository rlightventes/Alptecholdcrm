<?php include 'header.php'?>
<script src="Flexible.Pagination.js"></script>
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
 <style>
        .hide{display: none;}
        body { background-color: #fafafa; }
        .container { margin: 10px auto; }
    </style>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-sm-4">
							<h4 class="page-title">After Sales</h4>
						</div>
					
					
					</div>

					<div class="row" id="desktop_view">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table" id="example" style="width:100%">
									<thead>
										<tr>
										    <th style="display:none"></th>
											<th>Sr No</th>
											<th id="ifd">Client Name</th>
											<th id="ifd">Name</th>
											<th id="ifd">Email Id</th>
											<th id="ifd">Contact</th>
											<th id="ifd">Product Name</th>
											<!-- <th >Status</th>-->
											<th class="text-right">Action</th> 
										</tr>
									</thead>
									<tbody>
									<?php 
									$srNo = '0';
									$mysqli->orderBy('id', 'desc');
									$getProduct = $mysqli->get(SALES);
									foreach ($getProduct as $prVal) {
										extract($prVal);
										
											$text = ($status == '1')? 'Active' : 'Inactive';
											$bg = ($status == '1')? 'success' : 'danger';
											$val = ($status == '1')? '0' : '1';
											
											$mysqli->where('id', $user_id);
									    	$getUser = $mysqli->getOne(USER);
									    	$client = base64_encode($getUser['id']);
										    if(isset($getUser)){
										        $co_name = $getUser['company_name'];
										    }else{
										        $co_name = "";
										    }
											if($status != '2'):

												
												$loc = 'after_sale.php';
												$tabName = SALES;
												$videos = base64_encode($id);
												$srNo ++;
												
									?>

										<tr>
											<td style="display:none"><?=$id?></td>
											<td><?=$srNo?></td>
											<td><?=$co_name?></td>
											<td><?=$name?></td>
											<td><?=$email?></td>
											<td><?=$phone?></td>
											<td><?=$product?></td>
											
											
											<td class="text-right">
											  
												<div class="dropdown">
												     <?php  if(isset($getUser)){ ?>
											    <a href="profile.php?client=<?=$client?>" class="text-success size15"><i class="fa fa-table"></i></a>
											    <?php } ?>
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a data-toggle="modal" data-target="#myModal_<?=$id?>"><i class="fa fa-eye"></i> View</a></li>
														<li><a href="#" data-toggle="modal" data-target="#delete_project" class="delete" data-id="<?=$id?>"><i class="fa fa-trash-o m-r-5" ></i> Delete</a></li>
													</ul>
												</div>
												<div id="myModal_<?=$id?>" class="modal fade" role="dialog" style="margin-top: 50px">
												  <div class="modal-dialog">

												    <!-- Modal content-->
												    <div class="modal-content">
												      <div class="modal-header ">
												        <button type="button" class="close" data-dismiss="modal">&times;</button>
												        <h4 class="modal-title  text-left"><?=$product?></h4>
												      </div>
												      <div class="modal-body text-left">
												          <?=$message?>
												      </div>
												      
												    </div>

												  </div>
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
                <div class="row staff-grid-row" id="mobile_view">
						<input class="searchBox form-control" placeholder="Search Something...">
            			<div id="content">
            				<?php 
								foreach ($getProduct as $prVal) {
										extract($prVal);
										
											$text = ($status == '1')? 'Active' : 'Inactive';
											$bg = ($status == '1')? 'success' : 'danger';
											$val = ($status == '1')? '0' : '1';
											
											$mysqli->where('id', $user_id);
									    	$getUser = $mysqli->getOne(USER);
									    	$client = base64_encode($getUser['id']);
										    if(isset($getUser)){
										        $co_name = $getUser['company_name'];
										    }else{
										        $co_name = "";
										    }
											if($status != '2'):

												
												$loc = 'after_sale.php';
												$tabName = SALES;
												$videos = base64_encode($id);
												$srNo ++;
										?>
						<div class="col-md-4 col-sm-4 col-xs-12 col-lg-3 result well">
							<div class="profile-widget">
								<div class="profile-img">
									<a href="profile.php?client=<?=$client?>" class="avatar"><?=substr($co_name,0,1);?></a>
								</div>
								 <div class="dropdown profile-action">
									<a aria-expanded="false" class="action-icon dropdown-toggle" data-toggle="dropdown" href="">
										<i class="fa fa-ellipsis-v"></i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li><a href="add-clients.php?lead=<?=$lead?>"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
										<li><a href="#" data-toggle="modal" data-target="#delete_employee" data-id="<?=$id?>" class="delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
									</ul>
								</div> 
								<h4 class="user-name m-t-10 m-b-0 text-ellipsis">
									<?=$co_name?>
								</h4>
								<h5 class="user-name m-t-10 m-b-0 text-ellipsis">
									Client Name: <?=$name?>
								</h5>
								<h4 class="user-name m-t-10 m-b-0 text-ellipsis">
									<a class="small" href="tel:<?=$email?>">
										<i class="fa fa-envelope" style="background: #0b8902;padding: 10px;border-radius: 11%;color: #fff;"></i>
									</a>
									<a class="small" href="tel:<?=$phone?>">
										<i class="fa fa-phone" style="background: #0b8902;padding: 10px;border-radius: 11%;color: #fff;"></i>
									</a>
								</h4>
								<h5 class="user-name m-t-10 m-b-0 text-ellipsis">
									<?=$product?>
								</h5>
								<br>
								<?php  if(isset($getUser)){ ?>
								    <a href="profile.php?client=<?=$client?>" class="btn btn-default btn-sm m-t-10 m-l-5"><i style="color: #55ce63;font-size: 20px;" class="fa fa-table"></i></a>
								<?php } ?>
							</div>
						</div>
						<?php endif; }?>
						</div>
						<div class="clearfix"></div>
						<div id="pagingControls"></div>
            			<div id="showingInfo" class="well" style="margin-top:20px"></div>
					</div>
				<?php include 'messages.php'?>
            </div>			
			<div id="delete_project" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Delete Video</h4>
						</div>
						<form method="post" action="ajax.php?action=delete">
								<input type="hidden" name="id" value="" id="del_id" >
								<input type="hidden" name="tab_name" value="<?=SALES?>" >
								<input type="hidden" name="col_nam" value="id" >
								<input type="hidden" name="loc" value="after_sale.php" >
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
			$('.delete').click(function(){
				var id = $(this).attr('data-id');
				$('#del_id').val(id);
		//	alert(id);
			})
		</script>
       
<?php include 'footer.php'?>
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
