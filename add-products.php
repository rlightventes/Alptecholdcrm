<?php include 'header.php'?>


            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-sm-4">
							<h4 class="page-title">Add / Edit Products</h4>
						</div>
						<div class="col-sm-8 text-right m-b-20">
							<a href="products.php" class="btn btn-primary rounded pull-right"><i class="fa fa-bars" aria-hidden="true"></i> Products List</a>
						</div>
					</div>
					<?php 
					if(isset($_GET['product'])):
						$id = base64_decode($_GET['product']);
						$mysqli->where('id', $id);
						$getProduct = $mysqli->getOne(PRODUCT);
						$name = $getProduct['name'];
						$country = $getProduct['country'];
						$code = 'PRO-'.$id;
						$codeNo = $id;
						$product_type = $getProduct['product_type'];
						$type = $getProduct['type'];
						$category = $getProduct['category'];
						$brand = $getProduct['brand'];
						$description = stripslashes($getProduct['description']);
						$unit = $getProduct['unit'];
						$sale_rate = $getProduct['sale_rate'];
						$gross_weight = $getProduct['gross_weight'];
						$net_weight = $getProduct['net_weight'];
						$mrp = $getProduct['mrp'];
						$box = $getProduct['box'];
						$product_weight = $getProduct['product_weight'];
						$product_dimension = $getProduct['product_dimension'];
						$hsn_code = $getProduct['hsn_code'];
						$specification = stripslashes($getProduct['specification']);
						$required_status = $getProduct['required_status'];
						$youtube = $getProduct['youtube'];
						$action = 'update';
						$img1 = $getProduct['img1'];
						$img2 = $getProduct['img2'];
						$img3 = $getProduct['img3'];
						$img4 = $getProduct['img4'];
						$pdf1 = $getProduct['pdf1'];
						$pdf2 = $getProduct['pdf2'];
						$pdf3 = $getProduct['pdf3'];
						$country = $getProduct['country'];
						$currency = $getProduct['currency'];
					else:
					    $mysqli->orderBy('id', 'desc');
					    $lastId = $mysqli->getOne(PRODUCT);
					    $codeID = $lastId['id'] + 1;
						$name = '';
						$country = '';
						$code = 'PRO-'.$codeID;
						$codeNo = $codeID;
						$product_type = '';
						$type = '';
						$category = '';
						$brand = '';
						$description = '';
						$unit = '';
						$currency = '';
						$sale_rate = '';
						$gross_weight = '';
                        $net_weight = '';
						$mrp = '';
						$box = '';
						$product_weight = '';
						$product_dimension = '';
						$hsn_code = '';
						$specification = '';
						$required_status = '';
						$youtube = '';
						$action = 'new';
						$img1 = '';
						$img2 = '';
						$img3 = '';
						$img4 = '';
						$pdf1 = '';
						$pdf2 = '';
						$pdf3 = '';
						$country = '';
					endif;

					?>
					<form action="ajax.php?action=product&type=<?=$action?>" method="post" enctype="multipart/form-data" onsubmit="return Validate(this);">
						<?php if(isset($_GET['product'])):?>
							<input type="hidden" name="id" value="<?=$id?>">
						<?php endif; ?>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Product Name</label>
									<input class="form-control" type="text" name="name" value="<?=$name?>" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Product Brand</label>
									<input class="form-control" type="text" name="brand" value="<?=$brand?>" >

								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Import</label><br/>
									<label class="radio-inline"><input type="radio" required name="country" <?php if(!empty($country)): if($country == 'Italian'): echo 'checked'; endif; endif;?> value="Italian"> <img src="../img/italian.jpg"/> Italian</label>
									<label class="radio-inline"><input type="radio" required name="country" <?php if(!empty($country)): if($country == 'Turkish'): echo 'checked'; endif; endif;?>  value="Turkish"><img src="../img/turkish.jpg"/> Turkish</label>
									<label class="radio-inline"><input type="radio" required name="country" <?php if(!empty($country)): if($country == 'Korean'): echo 'checked'; endif; endif;?>  value="Korean"> <img src="../img/koren.jpg"/> Korean</label>
									<label class="radio-inline"><input type="radio" required name="country" <?php if(!empty($country)): if($country == 'India'): echo 'checked'; endif; endif;?>  value="India"> <img src="../img/india.jpg"/> India</label>
								

								</div>
							</div>
						</div>

						<div class="row">
							
							<div class="col-md-3">
								<div class="form-group">
									<label>Product Type</label>
									<select class="select" name="product_type" required id="product_type">
										<?php  if(empty($product_type)):?>
										<option value="">Select Type</option>
										<option value="Machines">Machines</option>
										<option value="Tools">Tools</option>
										<option value="Spare Parts">Spare Parts</option>
										<?php else: if($product_type == 'Machines'):?>
										<option value="Machines">Machines</option>
										<option value="Tools">Tools</option>
										<option value="Spare Parts">Spare Parts</option>
										<?php elseif($product_type == 'Tools'):?>
										<option value="Tools">Tools</option>
										<option value="Machines">Machines</option>
										<option value="Spare Parts">Spare Parts</option>
										<?php elseif($product_type == 'Spare Parts'):?>
										<option value="Spare Parts">Spare Parts</option>	
										<option value="Machines">Machines</option>
										<option value="Tools">Tools</option>
										<?php endif; endif; ?>
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Product Category Type</label>
									<select class="select" name="category" required id="category">
										<?php  if(empty($category)):?>
											<option value="">Select Category</option>
											<?php
											$mysqli->where('status', '1');
											$mysqli->where('category','category');
											$getCategory = $mysqli->get(MAINCAT);
											foreach ($getCategory as $catName) {?>
											<option value="<?=$catName['id']?>"><?=$catName['category_name']?></option>
											<?php } else: 
												$mysqli->where('id', $category);
												$getCat = $mysqli->getOne(MAINCAT); ?>
											<option value="<?=$category?>"><?=$getCat['category_name']?></option>
											<?php 
											$mysqli->where('status', '1');
											$mysqli->where('category','category');
											$getCategory = $mysqli->get(MAINCAT);
											foreach ($getCategory as $catName) {
												if($category != $catName['id']):
												?>
											<option value="<?=$catName['id']?>"><?=$catName['category_name']?></option> 
											<?php endif; } endif; ?>
											<option value="other">Other</option>
									</select><br/><br/>
									<input type="text" name="other_cat" id="other_cat"  style=" display: none" placeholder="Other Category" class="form-control">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Product Sub Category Type</label>
									<select class="select" name="sub_cat_type" required id="type">
										<?php  if(empty($type)):?>
											<option value="">Select Sub Category</option>
											<?php

											$mysqli->where('status', '1');
											$mysqli->where('category','type');
											$getType = $mysqli->get(MAINCAT);
											foreach ($getType as $catName) {?>
											<option value="<?=$catName['id']?>"><?=$catName['category_name']?></option>
											<?php } else: $mysqli->where('id', $type);
												$getSub = $mysqli->getOne(MAINCAT); ?>
											<option value="<?=$type?>"><?=$getSub['category_name']?></option>

											
											<?php 
											$mysqli->where('status', '1');
											$mysqli->where('category','type');
											$getCategory = $mysqli->get(MAINCAT);
											foreach ($getCategory as $catName) {
												if($type != $catName['id']):
												?>
											<option value="<?=$catName['id']?>"><?=$catName['category_name']?></option> 
											<?php endif; } endif; ?>
											<option value="other">Other</option>

									</select><br/><br/>
									<input type="text" name="other_type" id="other_type"  style=" display: none" placeholder="Other Sub Category" class="form-control">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Product Code</label>
									<input class="form-control" type="text" disabled name="code" value="<?=$code?>" required>
									<input type="hidden" name="code" value="<?=$codeNo?>"/>
								</div>
							</div>
						</div>
						<div class="row">
							<!--<div class="col-md-3">-->
							<!--	<div class="form-group">-->
							<!--		<label>Purchase Weight</label>-->
							<!--		<input class="form-control" type="text" name="product_weight" value="<?=$product_weight?>" placeholder="Purchase Weight" >-->
							<!--	</div>-->
							<!--</div>-->
							<div class="col-md-4">
								<div class="form-group">
									<label>Product Dimension</label>
									<input class="form-control" type="text" name="product_dimension"  value="<?=$product_dimension?>" placeholder="Purchase Dimension" >
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>1 Box: </label>
									<input class="form-control" type="text" name="box" value="<?=$box?>" placeholder="Items / Box" >
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Unit (UOM)</label>
									<select class="form-control" name="unit">
									    <?php  if(!empty($unit)){ ?>
									        <option value="<?=$unit?>"><?=$unit?></option>
									       <?php 
									        $mysqli->where('status', '1');
											$getUnit = $mysqli->get(UNIT);
											foreach ($getUnit as $allUnit) { 
											if($unit != $allUnit['unit'] && $allUnit['hide'] != 1){
											?>
									      <option value="<?=$allUnit['unit']?>"><?=$allUnit['unit']?></option>  
									    <?php   }  
											}
									    }else{  ?>
									    
									     <option value="">Select Unit</option>
									    <?php
									    $mysqli->where('status', '1');
											$getUnit = $mysqli->get(UNIT);
											foreach ($getUnit as $allUnit) { 
											if( $allUnit['hide'] != 1){
											?>
									      <option value="<?=$allUnit['unit']?>"><?=$allUnit['unit']?></option>  
									    <?php   }  }
									    } ?>
									</select>
									<!--<input class="form-control" type="text" name="unit" value="<?=$unit?>" placeholder="Unit (UOM)" >-->
								</div>
							</div>
						</div>
						<div class="row">
						    	<div class="col-md-3">
								<div class="form-group">
									<label>List Price</label>
									<input class="form-control" type="text" name="mrp" value="<?=$mrp?>" placeholder="List Price" >
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Sales Price</label>
									<input class="form-control" type="text" name="sale_rate" value="<?=$sale_rate?>" placeholder="Sale Price" >
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Currency</label>
									<select class="form-control" name="currency">
									    <?php 
									    if(!empty($currency)){
									        if($currency == 'INR'){?> 
									        <option value="INR">INR</option>
									        <option value="EURO">EURO</option>
									        <option value="DOLLAR">DOLLAR</option> 
									        <?php }elseif($currency == 'EURO'){?>
									        <option value="EURO">EURO</option>
									        <option value="INR">INR</option>
									        <option value="DOLLAR">DOLLAR</option> 
									        <?php }elseif($currency == 'DOLLAR'){ ?>
									        <option value="DOLLAR">DOLLAR</option> 
									        <option value="EURO">EURO</option>
									        <option value="INR">INR</option>
									        <?php } 
									    }else{ ?>
									     <option value="INR">INR</option>
									    <option value="EURO">EURO</option>
									    <option value="DOLLAR">DOLLAR</option>   
									    <?php } ?>
									    
									    
									</select>
									<!--<input class="form-control" type="text" name="sale_rate" value="<?=$sale_rate?>" placeholder="Sale Price" >-->
								</div>
							</div>
						
							<div class="col-md-2">
								<div class="form-group">
									<label>Gross Weight</label>
									<input class="form-control" type="text" name="gross_weight" value="<?=$gross_weight?>" placeholder="Gross Weight" >
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>Net Weight</label>
									<input class="form-control" type="text" name="net_weight" value="<?=$net_weight?>" placeholder="Net Weight" >
								</div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Required Status</label>
									<input class="form-control" type="text" name="required_status" value="<?=$required_status?>" placeholder="Required Status">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>HSC / SAC Code </label>
										<select class="form-control" name="hsn_code">
									    <?php  if(!empty($hsn_code)){ ?>
									        <option value="<?=$hsn_code?>"><?=$hsn_code?></option>
									       <?php 
									        $mysqli->where('status', '1');
											$getHSC = $mysqli->get(HSN);
											foreach ($getHSC as $allHSC) { 
											if($unit != $allHSC['hsn'] && $allHSC['hide'] != 1){
											?>
									      <option value="<?=$allHSC['hsn']?>"><?=$allHSC['hsn']?></option>  
									    <?php   }  
											}
									    }else{  ?>
									    
									     <option value="">Select Unit</option>
									    <?php
									    $mysqli->where('status', '1');
											$getHSC = $mysqli->get(HSN);
											foreach ($getHSC as $allHSC) { 
											if( $allHSC['hide'] != 1){
											?>
									      <option value="<?=$allHSC['hsn']?>"><?=$allHSC['hsn']?></option>  
									    <?php   }  }
									    } ?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Description</label>

							<textarea rows="4" id="editor"  cols="5" class="form-control summernote" name="description" value="" placeholder="Enter your message here" style="background: #fff"><?=$description?></textarea>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Upload Product Images</label><br>
									<sup>Image Dimension( 300 X 300)</sup>
									<input class="form-control" type="file" name="img1">
									<?php if(!empty($img1)):?>
									<img src="../Images/<?=$img1?>" width="100"><a class="btn btn-primary" id="removeBtn" title="img1" data-id="<?=$id?>"  >X</a>

									<?php endif;?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Upload Product Images</label><br>
									<sup>Image Dimension( 300 X 300)</sup>
									<input class="form-control" type="file" name="img2">
									<?php if(!empty($img2)):?>
									<img src="../Images/<?=$img2?>"  width="100">
									<a class="btn btn-primary" id="removeBtn" title="img2" data-id="<?=$id?>"  >X</a>
									<?php endif;?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Upload Product Images</label><br>
									<sup>Image Dimension( 300 X 300)</sup>
									<input class="form-control" type="file" name="img3">
									<?php if(!empty($img3)):?>
									<img src="../Images/<?=$img3?>"  width="100"><a class="btn btn-primary" id="removeBtn" title="img3" data-id="<?=$id?>"  >X</a>

									<?php endif;?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Upload Product Images</label><br>
									<sup>Image Dimension( 300 X 300)</sup>
									<input class="form-control" type="file" name="img4">
									<?php if(!empty($img4)):?>
									<img src="../Images/<?=$img4?>"  width="100"><a class="btn btn-primary" id="removeBtn" title="img4" data-id="<?=$id?>"  >X</a>

									<?php endif;?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Youtube Link</label>
							<textarea rows="4" id="editor1"  cols="5" class="form-control summernote" name="specification" placeholder="Specialization"><?=$specification?></textarea>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Upload Product Videos Link 	<small>E.g. https://www.youtube.com/embed/TSSOG0H68rk</small></label>
							
									<input class="form-control" type="text" name="youtube" value="<?=$youtube?>" placeholder="Video Youtube Link" >
								
								</div>
									<div class="form-group" id="wrapper1">
							<div>
							    	<!--<input class="form-control" type="text" name="product_ytube[]" placeholder="Video Youtube Link" >-->
							</div>
							
						</div>
						<p><a id="add_fields1" class="btn btn-info">+ Add More Videos</a></p>
							</div>
						</div>
						<div class="row" >
						    
						    <div class="col-md-12">
						        <label>AFTER SALE SECTION</label>
						    </div>
						    <div class="col-md-4">
								<div class="form-group">
									<label><small>Upload Instruction Manual</small></label>
									<input class="form-control" type="file" name="pdf1">
									<?php if(!empty($pdf1)):?>
										<a href="../PDFs/<?=$pdf1?>"><?=$pdf1?></a>
										<a class="btn btn-primary" id="removeBtn" title="pdf1" data-id="<?=$id?>"  >X</a>
									<?php endif;?>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label><small>Upload Electrical Manual</small></label>
									
									<input class="form-control" type="file"  name="pdf2">
									<?php if(!empty($pdf2)):?>
										<a href="../PDFs/<?=$pdf1?>"><?=$pdf2?></a>
										<a class="btn btn-primary" id="removeBtn" title="pdf2" data-id="<?=$id?>"  >X</a>
									<?php endif;?>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label><small>Upload Pneumatic Manual</small></label>
									
									<input class="form-control" type="file"  name="pdf3">
									<?php if(!empty($pdf3)):?>
										<a href="../PDFs/<?=$pdf3?>"><?=$pdf3?></a><a class="btn btn-primary" id="removeBtn" title="pdf3" data-id="<?=$id?>"  >X</a>
									<?php endif;?>
								</div>
							</div>
						</div>
						
					
						
						<div class="row">
					<div class="col-md-12">
						<label><small>Videos <span style="font-size:10px">E.g. https://www.youtube.com/embed/TSSOG0H68rk</span></small></label>
						<?php 
						    if(isset($_GET['product'])){ 
						    $mysqli->where('prod_id', $id);
							$getAfterSale = $mysqli->get(ASALES);
							foreach($getAfterSale as $sales){
							    if($sales['hide'] != '1'){
						    ?> 
						    <div>
						        <input type="hidden" value="<?=$sales['id']?>" name="id_up[]"/>
							    <input type="text" name="nameSale_up[]" placeholder="Enter Video Title" value="<?=$sales['name']?>" class="form-control col-md-6 ">
							    <input type="text" name="nameLink_up[]" placeholder="Enter Video Link" value="<?=$sales['link']?>" class="form-control  col-md-6" style="margin:10px 0"/>
								<textarea class="form-control summernote" placeholder="Enter Description" name="comment_up[]" ><?=$sales['details']?></textarea>
								<a href="#" data-toggle="modal" data-target="#delete_project" class="delete" data-id="<?=$sales['id']?>">Remove</a>
							</div><br/>
						    
						    <?php } } }
						?>
						<div class="form-group" id="wrapper">
							<div>
							    <input type="text" name="nameSale[]" placeholder="Enter Video Title" class="form-control col-md-6 ">
							    <input type="text" name="nameLink[]" placeholder="Enter Video Link" class="form-control  col-md-6" style="margin:10px 0"/>
								<textarea class="form-control summernote" placeholder="Enter Description" name="comment[]" ></textarea>
							</div><br/>
							
						</div>
						<p><a id="add_fields" class="btn btn-info">+ Add</a></p>
					</div>
				
				</div>
						<div class="m-t-20 text-center">
							<button class="btn btn-primary">Submit</button>
						</div>
					</form>
                </div>
				<?php include 'messages.php'?>
            </div>
            <div id="delete_project" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content modal-md">
						<div class="modal-header">
							<h4 class="modal-title">Delete Product</h4>
						</div>
						<form method="post" action="ajax.php?action=delete">
								<input type="hidden" name="id" value="" id="del_id" >
								<input type="hidden" name="tab_name" value="<?=ASALES?>" >
								<input type="hidden" name="col_nam" value="id" >
								<input type="hidden" name="loc" value="add-products.php?product=<?=$_GET['product']?>" >
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
       
        <script>
    		var _validFileExtensions = [".jpg", ".jpeg", ".png", ".gif", ".mp4", ".pdf"];    
    		function Validate(oForm) {
        	var arrInputs = oForm.getElementsByTagName("input");
        		for (var i = 0; i < arrInputs.length; i++) {
            		var oInput = arrInputs[i];
            		if (oInput.type == "file") {
                		var sFileName = oInput.value;
                		if (sFileName.length > 0) {
                    		var blnValid = false;
                    		for (var j = 0; j < _validFileExtensions.length; j++) {
                        		var sCurExtension = _validFileExtensions[j];
                        		if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension. toLowerCase()) {
                            		blnValid = true;
                            		break;
                        		}
                    		}
                    		if (!blnValid) {
                        		alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                        		return false;
                    		}
                		}
            		}
        		}
        	return true;
    		}
		</script>
			<script type="text/javascript" src="assets/js/3.3.1/jquery.min.js"></script>
		<script>
//Add Adfter sales videos
$(document).ready(function() {
    var max_fields = 10; //Maximum allowed input fields 
    var wrapper    = $("#wrapper"); //Input fields wrapper
    var add_button = $("#add_fields"); //Add button class or ID
	var x = 1; //Initlal input field is set to 1
	
	//When user click on add input button
	$(add_button).click(function(e){
        e.preventDefault();
		//Check maximum allowed input fields
        if(x < max_fields){ 
            x++; //input field increment
			 //add input field
            $(wrapper).append('<div><input type="text" name="nameSale[]" placeholder="Enter Video Title" class="form-control  col-md-6"/><br/><input type="text" name="nameLink[]" placeholder="Enter Video Link" style="margin:10px 0" class="form-control  col-md-6"/><br/><textarea class="form-control summernote" placeholder="Enter Description" name="comment[]" ></textarea><a href="javascript:void(0);" id="remove_field">Remove</a></div><br/>');
        }
    });
	
    //when user click on remove button
    $(wrapper).on("click","#remove_field", function(e){ 
        e.preventDefault();
		$(this).parent('div').remove(); //remove inout fieldx--; //inout field decrement
    })
});




//Add product videos
$(document).ready(function() {
    var max_fields1 = 10; //Maximum allowed input fields 
    var wrapper1    = $("#wrapper1"); //Input fields wrapper
    var add_button1 = $("#add_fields1"); //Add button class or ID
	var x1 = 1; //Initlal input field is set to 1
	
	//When user click on add input button
	$(add_button1).click(function(e){
        e.preventDefault();
		//Check maximum allowed input fields
        if(x1 < max_fields1){ 
            x1++; //input field increment
			 //add input field
            $(wrapper1).append('<div>	<input class="form-control" type="text" name="product_ytube[]" placeholder="Video Youtube Link" ><a href="javascript:void(0);" id="remove_field1">Remove</a></div><br/>');
        }
    });
	
    //when user click on remove button
    $(wrapper1).on("click","#remove_field1", function(e){ 
        e.preventDefault();
		$(this).parent('div').remove(); //remove inout fieldx--; //inout field decrement
    })
});

</script>
		<?php include 'footer.php'?>
<script type="text/javascript">
	$("#removeBtn").click(function(){
		var id = $(this).attr('data-id');
		var col = $(this).attr('title');
		var action = 'imgDelete';
	//	alert(id+col);
		$.ajax({
			type: 'POST',
			url: 'ajax.php',
			data:{id:id, col:col, action:action},
			sucess:function(data){
				location.reload();
				//window.location.href='add-products.php?product=<?=$_GET['product']?>';
			}
		});
  	
  });
	$("#category").change(function(){
		var category = $(this).val();
		
		if(category == 'other'){
			$("#other_cat").css('display', 'block');
		}else{
			$("#other_cat").css('display', 'none');
		}
	})
</script>
<script type="text/javascript">
	$("#type").change(function(){
		var type = $(this).val();
		
		if(type == 'other'){
			$("#other_type").css('display', 'block');
		}else{
			$("#other_type").css('display', 'none');
		}
	});
	$("#product_type").change(function(){
		var product_type = $(this).val();
		//alert(product_type);
	})
</script>

<script>
  new FroalaEditor('textarea#froala-editor');
 </script>
 	