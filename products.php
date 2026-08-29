<?php include 'header.php'?>
<script src="Flexible.Pagination.js"></script>
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
 <style>
        .hide{display: none;}
        body { background-color: #fafafa; }
        .container { margin: 10px auto; }
    </style>
        <?php if(isset($_GET['client'])){
            
        if(isset($_GET['invoice'])): 
            if(isset($_GET['edit'])):
                $pageUrl = 'add-invoice.php?edit='.$_GET['edit'].'&client='.$_GET['client']; 
                else:
                $pageUrl = 'add-invoice.php';     
            endif;
            
            $actionPage = $pageUrl;
            $btn = 'INVOICE';
        else: 
            if(isset($_GET['edit'])):
                $pageUrl = 'add-quote.php?edit='.$_GET['edit'].'&client='.$_GET['client']; 
                else:
                $pageUrl = 'add-quote.php';     
            endif;
                $btn = 'QUOT';
             $actionPage = $pageUrl;
        endif; 	?>
			<form method="post" action="<?=$actionPage?>">
			 <?php    $_SESSION['test'] = 'session active' ?>
		<?php } ?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-sm-5">
							<h4 class="page-title">Products</h4>
						</div>
						
						<?php if(isset($_GET['client'])){ ?>
						<input type="hidden" name="client" value="<?=$_GET['client']?>"/>
						
					<div class="col-sm-7 text-right">
							<button class="btn btn-primary rounded pull-right" type="submit">ADD <?=$btn?></button>
						</div>
					<?php }else{?>
					<div class="col-sm-7 text-right m-b-20">
					        <a href="export-product.php" class="btn btn-primary pull-right rounded" > Export to Excel</a>
					        <a href="productsHide.php" class="btn btn-primary pull-right rounded" style="margin-left:10px"><i class="fa fa-eye-slash"></i> Hide</a>
							<a href="add-products.php" class="btn btn-primary rounded"><i class="fa fa-plus"></i> Create Product</a>
						</div>
					<?php } ?>
						<!--<div class="col-sm-1">-->
						<!--	<button class="btn btn-primary rounded pull-right" onclick="myFunction()"><i class="fa fa-list"></i> Filters</button>-->
						<!--</div>-->
					</div>
					<div id="filter">
                    	<form action="" method="post">
                			<table class="table table-striped">
                				<tr >
                    				<td colspan="" width="20%">
                      					<select class="form-control" name="search_from" id="search_from" >
                        					<option value="Search for">Search for</option>
                        					<option value="id">Product Id</option>
                        					<option value="name">Product Name</option>
                        					<option value="product_type">Product Type</option>
                        					<option value="brand">Brand</option>
                        					<option value="purchase_rate">Purchase Rate</option>
                        					<option value="price">Price</option>
                        					<option value="deadline">Deadline</option>
                        					<option value="priority">Priority</option>
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
                    					<div id="canId">
                    						<input class="form-control" type="text" name="search_value">
                    					</div>
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
					
					<div class="row"  id="desktop_view">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table" id="example" style="width:100%">
									<thead>
										<tr>
										    <?php if(isset($_GET['client'])){ ?>
										    <th id="ifd">Select</th>
										    <?php } ?>
											<th id="ifd">Product Id</th>
											<th id="ifd">Product</th>
											<th id="ifd">Type</th>
											<th id="ifd">Category</th>
											<th id="ifd">Subcategory</th>
											<th id="ifd">Country</th>
											<!--<th id="ifd">Units</th>-->
											<!--<th id="ifd">Purchase Rate (<i class="fa fa-rupee"></i>)</th>-->
											<th id="ifd">List Price (<i class="fa fa-rupee"></i>)</th>
											<th id="ifd">Sale Price (<i class="fa fa-rupee"></i>)</th>
											<th>PDF</th>
											<!-- <th >Status</th>-->
											<th class="text-right">Action</th> 
										</tr>
									</thead>
									<tbody>
									<?php 
									if(isset($_GET['type'])):
										$mysqli->orderBy('id', 'desc');
										$mysqli->where($_GET['type'], $_GET['count']);
										//$mysqli->where()
									else:
										$mysqli->orderBy('id', 'desc');
									endif;
									
									$getProduct = $mysqli->get(PRODUCT);
									foreach ($getProduct as $prVal) {
										extract($prVal);
										    $primary_id = str_pad($id, 3, '0', STR_PAD_LEFT);
											$text = ($status == '1')? 'Active' : 'Inactive';
											$bg = ($status == '1')? 'success' : 'danger';
											$val = ($status == '1')? '0' : '1';
											if($hide != '1'):
												$loc = 'products.php';
												$tabName = PRODUCT;
												$product = base64_encode($id);
												if($country == 'Italian'):
													$img = '../img/italian.jpg';
												elseif($country == 'Turkish'):
													$img = '../img/turkish.jpg';
												elseif($country == 'Korean'):
													$img = '../img/koren.jpg';
												elseif($country == 'India'):
													$img = '../img/india.jpg';
												endif;
												$mysqli->where('id', $category);
												$getMain = $mysqli->getOne(MAINCAT);
												$mysqli->where('id', $type);
												$getSub = $mysqli->getOne(MAINCAT);
												
												$prName = str_replace(' ', '_', $name);

									?>

										<tr>
										    <?php if(isset($_GET['client'])){ ?>
										    <td style="verticle-align:top"><input type="checkbox" name="produtID[]" value="<?=$id?>" class="addProduct"/></td>
										    <?php } ?>
											<td>PRO-<?=$primary_id?></td>
											<td style="verticle-align:top">
												<h2><a href="product-view.php?product=<?=$product?>"><?=$name?></a></h2>
											</td>
											<td style="text-transform:uppercase; verticle-align:top"><?=$product_type?></td>
											<td style="verticle-align:top"><?=$getMain['category_name']?></td>
											<td style="verticle-align:top"><?=$getSub['category_name']?></td>
											<td style="verticle-align:top"><?php if(!empty($country)):?><img src="<?=$img?>" width="20"/> <?=$country?><?php endif; ?></td>
											<!--<td><?=$unit?></td>-->
											<!--<td><?=(!empty($purchase_rate))? $purchase_rate : '000'; ?> /-</td>-->
											<td style="verticle-align:top"><?=$mrp?> /-</td>
											<td style="verticle-align:top"><?=$sale_rate?> /-</td>
										    <td style="verticle-align:top">
										        <?php  if($productPDF == '1'){?>
										         <a href="pdf/<?=$prName?>.pdf" download="" class="label label-success">Download</a>   
										          <?php  }else{?>
										          <a href="convert_pdf.php?product=<?=$product?>" class="label label-danger" target="_blank">Generate</a>  
										           <?php  }
										        ?>
										        
										    </td>
										<!-- 	<td>
												<a class="label label-<?=$bg?>" href="ajax.php?action=status&val=<?=$val?>&loc=<?=$loc?>&tabName=<?=$tabName?>&col_nam=id&id=<?=$id?>"><?=$text?></a>
											</td>-->
											<td class="text-right" style="verticle-align:top">
												<div class="dropdown">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="add-products.php?product=<?=$product?>"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
														<li><a href="#" data-toggle="modal" data-target="#delete_project" class="delete" data-id="<?=$id?>"><i class="fa fa-trash-o m-r-5" ></i> Delete</a></li>
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
                <div class="row staff-grid-row" id="mobile_view">
						<input class="searchBox form-control" placeholder="Search Something...">
            			<div id="content">
            				<?php 
								foreach ($getProduct as $prVal) {
										extract($prVal);
										$primary_id = str_pad($id, 3, '0', STR_PAD_LEFT);
											$text = ($status == '1')? 'Active' : 'Inactive';
											$bg = ($status == '1')? 'success' : 'danger';
											$val = ($status == '1')? '0' : '1';
											if($hide != '1'):
												$loc = 'products.php';
												$tabName = PRODUCT;
												$product = base64_encode($id);
												if($country == 'Italian'):
													$img = '../img/italian.jpg';
												elseif($country == 'Turkish'):
													$img = '../img/turkish.jpg';
												elseif($country == 'Korean'):
													$img = '../img/koren.jpg';
												endif;
												$mysqli->where('id', $category);
												$getMain = $mysqli->getOne(MAINCAT);
												$mysqli->where('id', $type);
												$getSub = $mysqli->getOne(MAINCAT);
										?>
						<div class="col-md-4 col-sm-4 col-xs-12 col-lg-3 result well">
							<div class="profile-widget">
								<?php if(isset($_GET['client'])){ ?>
								<input type="checkbox" name="produtID[]" value="<?=$id?>" class="addProduct1" style="height: 20px; width: 50px;"/><?php } ?>
								<div class="dropdown profile-action">
									<a aria-expanded="false" class="action-icon dropdown-toggle" data-toggle="dropdown" href="">
										<i class="fa fa-ellipsis-v"></i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li>
											<a href="add-products.php?product=<?=$product?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
										</li>
										<li>
											<a href="#" data-toggle="modal" data-target="#delete_project" class="delete" data-id="<?=$id?>"><i class="fa fa-trash-o m-r-5" ></i> Delete</a>
										</li>
									</ul>
								</div>
								<h4 class="user-name m-t-10 m-b-0 text-ellipsis">
									<a href="product-view.php?product=<?=$product?>">PRO-<?=$primary_id?></a>
								</h4>
								<h4 class="user-name m-t-10 m-b-0 text-ellipsis">
									<a href="product-view.php?product=<?=$product?>"><?=$name?></a>
								</h4>
								<h6 class="user-name m-t-10 m-b-0 text-ellipsis">
									Type: <?=$product_type?><br>Category: <?=$getMain['category_name']?><br>Sub Category: <?=$getSub['category_name']?>
								</h6><br>
								<?php if(!empty($country)):?><img src="<?=$img?>" width="40"/> <?=$country?><?php endif; ?>
								<h5 class="user-name m-t-10 m-b-0 text-ellipsis">
									List Price: <?=$mrp?> /-
								</h5>
								<h5 class="user-name m-t-10 m-b-0 text-ellipsis">
									Sale Price: <?=$sale_rate?> /-
								</h5><br>
								<h4 class="user-name m-t-10 m-b-0 text-ellipsis">
									<?php  if($productPDF == '1'){?>
									<a href="pdf/PRO-<?=$id?>.pdf" download="" class="label label-success" style="color: #fff;">Download</a>   
									<?php  }else{?>
									<a href="convert_pdf.php?product=<?=$product?>" class="label label-danger" target="_blank" style="color: #fff;">Generate</a>  
									<?php  } ?>
								</h4>
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
            	<?php if(isset($_GET['client'])){ ?>
					</form>
					<?php } ?>
			<div id="delete_project" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Delete Product</h4>
						</div>
						<form method="post" action="ajax.php?action=delete">
								<input type="hidden" name="id" value="" id="del_id" >
								<input type="hidden" name="tab_name" value="<?=PRODUCT?>" >
								<input type="hidden" name="col_nam" value="id" >
								<input type="hidden" name="loc" value="products.php" >
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


if(selectVal == 'id' || selectVal == 'name' || selectVal == 'product_type' || selectVal == 'pincode' || selectVal == 'status' || selectVal == 'brand'){
  $('#type').html("<select class='form-control' name='search_type'><option value='='>Equal</option></select>");
}
else if(selectVal == 'purchase_rate' || selectVal == 'price' || selectVal == 'deadline' ){
   $('#type').html("<select class='form-control' name='search_type'><option value='>='>Min </option><option value='<='>Max</option></select>");
}
if(selectVal == 'id' || selectVal == 'name' || selectVal == 'price' || selectVal == 'purchase_rate'){
  $('#canId').html('<input class="form-control" type="text" name="search_value">');
}
else if(selectVal == 'product_type' ){
    $('#canId').html('<select class="form-control" name="search_value" ><option>Select Product Type</option><option value="Machine">Machine</option><option value="Parts">Parts</option></select>')
}
else if(selectVal == 'deadline'){
    $('#canId').html('<input class="form-control datetimepicker" type="date"  name="search_value" >');
}
else if(selectVal == 'status'){
    $('#canId').html("<select class='form-control' name='search_value' ><option>Select Status</option><option value='Active'>Active</option><option value='Inactive'>Inactive</option></select>");
}
else if(selectVal == 'brand'){
    $('#canId').html("<select class='form-control' name='search_value' id='brandType' ><option>Select Brand</option><option value='brand'>Brand 1</option><option value='brand'>Brand 2</option><option value='brand'>Brand 3</option></select>");
}
else if(selectVal == 'priority'){
    $("#canId").html("<select class='form-control' name='search_value' id='priorityType'><option>Select Priority</option><option value='high'><i class='fa fa-dot-circle-o text-danger'></i>High</option><option value='medium'>Medium</option><option value='low'>Low</option></select>"); 
}
  });
</script>
 <script>
     $(".addProduct").click(function(){
         var prID = $(this).val();
         var action = 'addCART';
        //  alert('ok');
         $.ajax({
             type: 'POST',
             url: 'ajax.php',
             data:{prID:prID, action:action},
             success:function(data){
               //  alert(data);
             }
         })
        //  alert(prID);
     });
     
     
    //   $(".addProduct1").click(function(){
    //      var prID = $(this).attr('title');
    //      var action = 'addCART';
    //      alert('ok');
    //      $.ajax({
    //          type: 'POST',
    //          url: 'ajax.php',
    //          data:{prID:prID, action:action},
    //          success:function(data){
    //           //  alert(data);
    //          }
    //      });
    //      alert(prID);
    //  });
     
    
           
     
 </script>       
<?php include 'footer.php'?>
<script>
// $(".addProduct1").click(function(){
//     //  var prID = $(this).val();
//     // var action = 'addCART';
//     alert('ok');
// })



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