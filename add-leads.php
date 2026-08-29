<?php include 'header.php';?>
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
						<div class="col-sm-8">
							<h4 class="page-title">Leads  - <?=$getUser['company_name']; ?> <a href="profile.php?client=<?=$_GET['client']?>" class="text-success size15"><i class="fa fa-table"></i></a></h4> 
							<h5><i class="fa fa-user"></i> <?=$getUser['fname'].' '.$getUser['lname']?> | <i class="fa fa-mobile"></i> <?=$getUser['contact1']; ?> |  Assign to: <?=$getEmp['fname']." ".$getEmp['lname']?></h5>
						</div>
						<div class="col-sm-4 pull-right text-right ">
							<!-- <button class="btn btn-primary rounded " onclick="myFunction()"><i class="fa fa-plus"></i> Filters</button>  -->
						    <a href="enq_list.php?client=<?=$_GET['client']?>" class="btn btn-primary rounded m-r-10" ><i class="fa fa-arrow-circle-left"></i> Back</a> 

						<a href="leads.php" class="btn btn-primary rounded pull-right"><i class="fa fa-list" aria-hidden="true"></i> Leads List</a>
							 
						</div>

					
					</div>
					<div class="row">
						<?php 

					
					

							if(isset($_GET['lead'])):
								$lead = base64_decode($_GET['lead']);
								$mysqli->where('id', $lead);
								$getEnq = $mysqli->getOne(ENQ);
								$type = 'update'; 
								$product_id = $getEnq['product_id'];
								$client_id = $getEnq['client_id']; 
								$type_of_industry = $getEnq['type_of_industry'];
								$sub_type1 = $getEnq['sub_type1'];
								$sub_type2 = $getEnq['sub_type2'];
                $int_ext = $getEnq['int_ext'];
								$material_type = $getEnq['material_type'];
								$type_of_cutting = $getEnq['type_of_cutting'];
								$quantum_of_cutting = $getEnq['quantum_of_cutting'];
								$length = $getEnq['length'];
								$breadth = $getEnq['breadth'];
								$weight = $getEnq['weight'];
								$height = $getEnq['height'];
								$thickness = $getEnq['thickness'];
								$setup_type = $getEnq['setup_type'];
								$existing_machine = $getEnq['existing_machine'];
								if($type_of_industry == 'Cutting Operation'):
									$display = 'block';
								else:
									$display = 'none';
								endif;
							else:
								$type = 'new';
								$product_id = "";
								$client_id = "";
								$type_of_industry = "";
								$sub_type1 = "";
								$sub_type2 = "";
                $int_ext = "";
								$material_type = "";
								$type_of_cutting = "";
								$quantum_of_cutting = "";
								$length = "";
								$breadth = "";
								$weight = "";
								$height = "";
								$thickness = "";
								$setup_type = "";
								$existing_machine = "";
								$display = 'none';
							endif;

						?>

						<form method="post" action="ajax.php?action=enquiry&type=<?=$type?>">
							<?php if(isset($_GET['lead'])): ?>
								<input type="hidden" name="id" value="<?=$_GET['lead']?>">
							<?php endif;?>
							
						<input type="hidden" class="form-control" value="<?=$getUser['id']; ?>"  name="client_id"/>
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">Product  <span class="text-danger">*</span></label>
									<select class="form-control" name="prid">
										<?php if(!empty($product_id)): 
											$mysqli->where('id', $product_id);
											$product = $mysqli->getOne(PRODUCT);
										?>
										<option value="<?=$product['id']?>"><?=$product['name']?></option>
										<?php $mysqli->orderBy('name', 'asc');
										$getProduct = $mysqli->get(PRODUCT);
										foreach ($getProduct as $clntVal) {
											if($product_id != $clntVal['id']):
										 ?>
										<option value="<?=$clntVal['id']?>"><?=$clntVal['name']?></option>
										<?php endif; }else:?>
										<option value="">Select Product</option>
										<?php 
										$mysqli->orderBy('name', 'asc');
										$getProduct = $mysqli->get(PRODUCT);
										foreach ($getProduct as $clntVal) { ?>
										<option value="<?=$clntVal['id']?>"><?=$clntVal['name']?></option>
										<?php } ?>								
										<?php endif;?>

									</select> 
								</div>
							</div>
					<div class="col-lg-3">
                  <div class="form-group">
                     <label>Select Operation</label>
                    <select name="operation" id="operation" class="form-control">
                    	<?php if(empty($type_of_industry)): ?>
                       <option value="">Select Operation</option>
                      <option value="Bending Operation">Bending Operation</option>
                      <option value="Cleaning Operation">Cleaning Operation</option>
                      <option value="Cutting Operation">Cutting Operation</option>
                      <option value="Crimping Operation">Crimping Operation</option>
                      <option value="Milling Operation">Milling Operation</option>
                      <option value="Routing Operation">Routing Operation</option>
                      <option value="Punching Operation">Punching Operation</option>
                      <option value="Slitting Operation">Slitting Operation</option>
                      <option value="Welding Operation">Welding Operation</option>
                      <option value="Other">Other</option>
                      <?php else: 
                      		if($type_of_industry == 'Bending Operation'): ?>
                      <option value="Bending Operation">Bending Operation</option>
						          <option value="Cleaning Operation">Cleaning Operation</option>
                      <option value="Cutting Operation">Cutting Operation</option>
                      <option value="Crimping Operation">Crimping Operation</option>
                      <option value="Milling Operation">Milling Operation</option>
                      <option value="Routing Operation">Routing Operation</option>
                      <option value="Punching Operation">Punching Operation</option>
                      <option value="Slitting Operation">Slitting Operation</option>
                      <option value="Welding Operation">Welding Operation</option>
                      <option value="Other">Other</option>
                      <?php elseif($type_of_industry == 'Cleaning Operation'): ?>
                      <option value="Cleaning Operation">Cleaning Operation</option>
                        <option value="Bending Operation">Bending Operation</option>
                      <option value="Cutting Operation">Cutting Operation</option>
                      <option value="Crimping Operation">Crimping Operation</option>
                      <option value="Milling Operation">Milling Operation</option>
                      <option value="Routing Operation">Routing Operation</option>
                      <option value="Punching Operation">Punching Operation</option>
                      <option value="Slitting Operation">Slitting Operation</option>
                      <option value="Welding Operation">Welding Operation</option>
                      <option value="Other">Other</option>
                        <?php elseif($type_of_industry == 'Cutting Operation'): ?>
                      <option value="Cutting Operation">Cutting Operation</option>
                      <option value="Bending Operation">Bending Operation</option>
                      <option value="Cleaning Operation">Cleaning Operation</option>
                      <option value="Crimping Operation">Crimping Operation</option>
                      <option value="Milling Operation">Milling Operation</option>
                      <option value="Routing Operation">Routing Operation</option>
                      <option value="Punching Operation">Punching Operation</option>
                      <option value="Slitting Operation">Slitting Operation</option>
                      <option value="Welding Operation">Welding Operation</option>
                      <option value="Other">Other</option>
                        <?php elseif($type_of_industry == 'Crimping Operation'): ?>
                      <option value="Crimping Operation">Crimping Operation</option>
                      <option value="Cutting Operation">Cutting Operation</option>
                      <option value="Bending Operation">Bending Operation</option>
                      <option value="Cleaning Operation">Cleaning Operation</option>
                      <option value="Milling Operation">Milling Operation</option>
                      <option value="Routing Operation">Routing Operation</option>
                      <option value="Punching Operation">Punching Operation</option>
                      <option value="Slitting Operation">Slitting Operation</option>
                      <option value="Welding Operation">Welding Operation</option>
                      <option value="Other">Other</option>
                        <?php elseif($type_of_industry == 'Milling Operation'): ?>
                      <option value="Milling Operation">Milling Operation</option>
                      <option value="Crimping Operation">Crimping Operation</option>
                      <option value="Cutting Operation">Cutting Operation</option>
                      <option value="Bending Operation">Bending Operation</option>
                      <option value="Cleaning Operation">Cleaning Operation</option>
                      <option value="Routing Operation">Routing Operation</option>
                      <option value="Punching Operation">Punching Operation</option>
                      <option value="Slitting Operation">Slitting Operation</option>
                      <option value="Welding Operation">Welding Operation</option>
                      <option value="Other">Other</option>
                      <?php elseif($type_of_industry == 'Routing Operation'): ?>
                      <option value="Routing Operation">Routing Operation</option>
                      <option value="Punching Operation">Punching Operation</option>
                      <option value="Milling Operation">Milling Operation</option>
                      <option value="Crimping Operation">Crimping Operation</option>
                      <option value="Cutting Operation">Cutting Operation</option>
                      <option value="Bending Operation">Bending Operation</option>
                      <option value="Cleaning Operation">Cleaning Operation</option>
                      <option value="Slitting Operation">Slitting Operation</option>
                      <option value="Welding Operation">Welding Operation</option>
                      <option value="Other">Other</option>
                       <?php elseif($type_of_industry == 'Punching Operation'): ?>
                      <option value="Punching Operation">Punching Operation</option>
                      <option value="Milling Operation">Milling Operation</option>
                      <option value="Crimping Operation">Crimping Operation</option>
                      <option value="Cutting Operation">Cutting Operation</option>
                      <option value="Bending Operation">Bending Operation</option>
                      <option value="Cleaning Operation">Cleaning Operation</option>
                      <option value="Routing Operation">Routing Operation</option>
                      <option value="Slitting Operation">Slitting Operation</option>
                      <option value="Welding Operation">Welding Operation</option>
                      <option value="Other">Other</option>
                      <?php elseif($type_of_industry == 'Slitting Operation'): ?>
                      <option value="Slitting Operation">Slitting Operation</option>  
                      <option value="Punching Operation">Punching Operation</option>
                      <option value="Milling Operation">Milling Operation</option>
                      <option value="Crimping Operation">Crimping Operation</option>
                      <option value="Cutting Operation">Cutting Operation</option>
                      <option value="Bending Operation">Bending Operation</option>
                      <option value="Cleaning Operation">Cleaning Operation</option>
                      <option value="Routing Operation">Routing Operation</option>
                      <option value="Welding Operation">Welding Operation</option>
                      <option value="Other">Other</option>
                      <?php elseif($type_of_industry == 'Welding Operation'): ?>
                      <option value="Welding Operation">Welding Operation</option>
                      <option value="Slitting Operation">Slitting Operation</option>  
                      <option value="Punching Operation">Punching Operation</option>
                      <option value="Milling Operation">Milling Operation</option>
                      <option value="Crimping Operation">Crimping Operation</option>
                      <option value="Cutting Operation">Cutting Operation</option>
                      <option value="Bending Operation">Bending Operation</option>
                      <option value="Cleaning Operation">Cleaning Operation</option>
                      <option value="Routing Operation">Routing Operation</option>
                      <option value="Other">Other</option>
                       <?php elseif($type_of_industry == 'Other'): ?>
                      <option value="Other">Other</option>
                      <option value="Welding Operation">Welding Operation</option>
                      <option value="Slitting Operation">Slitting Operation</option>  
                      <option value="Punching Operation">Punching Operation</option>
                      <option value="Milling Operation">Milling Operation</option>
                      <option value="Crimping Operation">Crimping Operation</option>
                      <option value="Cutting Operation">Cutting Operation</option>
                      <option value="Bending Operation">Bending Operation</option>
                      <option value="Cleaning Operation">Cleaning Operation</option>
                      <option value="Routing Operation">Routing Operation</option>
                         
                         <?php endif; endif;?>
                    </select>

                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label>Type of Industry</label>
                    <select name="industry" id="industry" class="form-control">
                    <?php if(empty($sub_type1)): ?>
                      <option value="">Select Industry</option>
                      <option value="Architecture">Architecture</option>
                      <option value="Engineer">Engineer</option>
                      <option value="Service">Service</option>
                    <?php else: if($sub_type1 == 'Architecture'):?>
                      <option value="Architecture">Architecture</option>
                      <option value="Engineer">Engineer</option>
                      <option value="Service">Service</option>
                    <?php elseif($sub_type1 == 'Engineer'):?>
                      <option value="Engineer">Engineer</option>
                      <option value="Architecture">Architecture</option>
                      <option value="Service">Service</option>
                    <?php elseif($sub_type1 == 'Service'):?>
                      <option value="Service">Service</option>
                      <option value="Engineer">Engineer</option>
                      <option value="Architecture">Architecture</option>
                    <?php endif; endif;?>
                    </select>
                  </div>
                </div>

                <div class="col-lg-3">
                  <div class="form-group">
                    <label>Select Type</label>
                    <select name="type_cat" id="type" class="form-control">
                       <?php if(empty($sub_type2)): ?>
                      <option value="">Select Type</option>
                      
                    <?php else: if($sub_type2 == 'Exterior'):?>
                      <option value="Exterior">Exterior</option>
                      <option value="Interior">Interior</option>
                    <?php elseif($sub_type2 == 'Interior'):?>
                      <option value="Interior">Interior</option>
                      <option value="Exterior">Exterior</option>
                    <?php elseif($sub_type2 == 'Fabricator'):?>
                      <option value="Fabricator">Fabricator</option>
                      <option value="Contractor">Contractor</option>
                    <?php elseif($sub_type2 == 'Contractor'):?>
                      <option value="Contractor">Contractor</option> 
                      <option value="Fabricator">Fabricator</option>
                    <?php elseif($sub_type2 == 'Automotive'):?>
                      <option value="Automotive">Automotive</option> 
                      <option value="Locomotive">Locomotive</option>
                      <option value="Solar">Solar</option>
                      <option value="Refrigeration and Air Conditioinning">Refrigeration and Air Conditioinning</option>
                      <option value="Construction">Construction</option>
                      <option value="Electronicsand Pneumatics">Electronicsand Pneumatics</option>
                  <?php elseif($sub_type2 == 'Locomotive'):?>
                      <option value="Locomotive">Locomotive</option>
                       <option value="Automotive">Automotive</option>
                      <option value="Solar">Solar</option>
                      <option value="Refrigeration and Air Conditioinning">Refrigeration and Air Conditioinning</option>
                      <option value="Construction">Construction</option>
                      <option value="Electronicsand Pneumatics">Electronicsand Pneumatics</option>
                    <?php elseif($sub_type2 == 'Solar'):?>
                      <option value="Solar">Solar</option>
                      <option value="Locomotive">Locomotive</option>
                       <option value="Automotive">Automotive</option>
                      
                      <option value="Refrigeration and Air Conditioinning">Refrigeration and Air Conditioinning</option>
                      <option value="Construction">Construction</option>
                      <option value="Electronicsand Pneumatics">Electronicsand Pneumatics</option>
                    <?php elseif($sub_type2 == 'Refrigeration and Air Conditioinning'):?>
                      <option value="Refrigeration and Air Conditioinning">Refrigeration and Air Conditioinning</option>
                      <option value="Solar">Solar</option>
                      <option value="Locomotive">Locomotive</option>
                      <option value="Automotive">Automotive</option> <option value="Construction">Construction</option>
                      <option value="Electronicsand Pneumatics">Electronicsand Pneumatics</option>

                    <?php elseif($sub_type2 == 'Electronicsand Pneumatics'):?>
                      <option value="Electronicsand Pneumatics">Electronicsand Pneumatics</option>
                      <option value="Refrigeration and Air Conditioinning">Refrigeration and Air Conditioinning</option>
                      <option value="Solar">Solar</option>
                      <option value="Locomotive">Locomotive</option>
                      <option value="Automotive">Automotive</option> <option value="Construction">Construction</option>
                      

                    <?php endif; endif;?>
                   
                    </select>
                      
                  </div>
              
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                      <label>Select Type</label>
                    <select name="type_cat2" id="type2" class="form-control">
                      <?php if(empty($int_ext)):?>
                      <option value="">Select Type</option>
                      <option value="Doors">Doors</option>
                      <option value="Windows">Windows</option>
                      <option value="Facade">Facade</option>
                      <option value="Skylight">Skylight</option>
                      <?php else: 
                        if($int_ext == 'Doors'): ?>
                      <option value="Doors">Doors</option>
                      <option value="Windows">Windows</option>
                      <option value="Facade">Facade</option>
                      <option value="Skylight">Skylight</option>
                      <?php elseif($int_ext == 'Windows'): ?>
                      <option value="Windows">Windows</option>
                      <option value="Doors">Doors</option>
                      <option value="Facade">Facade</option>
                      <option value="Skylight">Skylight</option>
                      <?php elseif($int_ext == 'Facade'): ?>
                      <option value="Facade">Facade</option>
                      <option value="Windows">Windows</option>
                      <option value="Doors">Doors</option>
                      <option value="Skylight">Skylight</option>
                      <?php elseif($int_ext == 'Skylight'): ?>
                      <option value="Skylight">Skylight</option>
                      <option value="Facade">Facade</option>
                      <option value="Windows">Windows</option>
                      <option value="Doors">Doors</option>
                      <?php elseif($int_ext == 'Partition'): ?>
                      <option value="Partition">Partition</option>
                      <option value="Kitchen">Kitchen</option>
                      <?php elseif($int_ext == 'Kitchen'): ?>
                      <option value="Kitchen">Kitchen</option>
                      <option value="Partition">Partition</option>
                      <?php endif; endif;?>
                    </select>
                  </div>
              
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label>Machine Type</label><br/>
                      <label class="radio-inline"><input type="radio" name="setup_type" value="New Setup" <?php if($setup_type == 'New Setup'): echo 'checked'; endif;?>> New Setup</label>
<label class="radio-inline"><input type="radio" name="setup_type" value="Upgrade" <?php if($setup_type == 'Upgrade'): echo 'checked'; endif;?>> Upgrade </label>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label>Existing Machines</label><br/>
                      <label class="radio-inline"><input type="radio" name="existing_machine"  id="existing_machine" value="Yes" <?php if($existing_machine == 'Yes'): echo 'checked'; endif;?>> Yes</label>
<label class="radio-inline"><input type="radio" name="existing_machine" value="No" <?php if($existing_machine == 'No'): echo 'checked'; endif;?>> No </label>
<input type="text" name="other_existing" class="form-control" style="display: none;">
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="form-group">
                    <label>Type of Section</label><br/>
                      <label class="radio-inline" style="font-weight: 300"><input type="radio" name="material" value="Aluminium" <?php if($material_type == 'Aluminium'): echo 'checked';endif;?>> Aluminium</label>
<label class="radio-inline" style="font-weight: 300"><input type="radio" name="material" value="PVC" <?php if($material_type == 'PVC'): echo 'checked';endif;?>> PVC </label>
                  </div>
                </div>   
                <div class="col-lg-4" id="cutt" style="display: none;">
                  <div class="form-group">
                    <label>Type of Cutting</label>
                      <label class="radio-inline" style="font-weight: 300"><input type="radio" name="cutting" value="Aluminium" <?php if($type_of_cutting == 'Aluminium'): echo 'checked';endif;?>> Aluminium</label>
<label class="radio-inline" style="font-weight: 300"><input type="radio" name="cutting" value="PVC" <?php if($type_of_cutting == 'PVC'): echo 'checked';endif;?>> PVC </label>
                  </div>
                </div>   
                <div class="col-lg-4" id="cutt1" style="display: none;">
                  <div class="form-group">
                    <label>Quantum of Cutting</label>
                      <label class="radio-inline"><input type="radio" name="quantum"  value="Yes" id="quantum" <?php if($quantum_of_cutting == 'Yes'): echo 'checked';endif;?>> Yes</label>
<label class="radio-inline"><input type="radio" name="quantum" value="No" id="quantum" <?php if($quantum_of_cutting == 'No'): echo 'checked';endif;?>> No </label>
                  </div>
                </div>   
                <div style="clear: both"></div>
                <div class="col-lg-4" style="display: <?=$display?>;" id="hide">
                  <div class="form-group">
                    <label>Size of Profile</label>
                    <input type="text" class="form-control" name="length" id="email" placeholder="Length" value="<?=$length?>" >
                    <p id="emailError" style="color:#f00"></p>
                  </div>
                </div>
                <div class="col-lg-4" style="display: <?=$display?>;"  id="hide1">
                  <div class="form-group">
                    <label></label>
                    <input type="text" class="form-control" name="breadth" placeholder="Breadth" value="<?=$breadth?>" >
                  </div>
                </div>
                  <div class="col-lg-4" style="display: <?=$display?>;"  id="hide2">
                  <div class="form-group">
                  	<label></label>
                    <input type="text" class="form-control" name="height" placeholder="Height" value="<?=$height?>">
                  </div>
                </div>
                <div style="clear: both;"></div>
                <div class="col-lg-6" style="display: <?=$display?>;"  id="hide3">
                  <div class="form-group">
                    <input type="text" class="form-control" name="weight" placeholder="Weight" value="<?=$weight?>">
                  </div>
                </div>
                <div class="col-lg-6" style="display: <?=$display?>;"  id="hide4">
                  <div class="form-group">
                    <input type="text" class="form-control" name="thickness" placeholder="Thickness" value="<?=$thickness?>">
                  </div>
                </div>
                 

							
							
							<div class="col-md-12 text-center">
								<div class="form-group">
									<button class="btn btn-primary">SUBMIT</button>
								</div>
							</div>
						</form>
					</div>				
                </div>
				<?php include 'messages.php';?>
            </div>
        </div>
		<?php include 'footer.php';?>
		<script type="text/javascript">
		$("#industry").change(function(){
    var ind = $(this).val();
    if(ind == 'Architecture'){
        $("#type").html('<option value="">Select Architecture</option><option value="Exterior">Exterior</option><option value="Interior">Interior</option>');
        }
     if(ind == 'Service'){
        $("#type").html('<option value="">Select Service</option><option value="Fabricator">Fabricator</option><option value="Contractor">Contractor</option>');
        }
       if(ind == 'Engineer'){
        $("#type").html('<option value="">Select Engineer</option><option value="Automotive">Automotive</option><option value="Locomotive">Locomotive</option><option value="Solar">Solar</option><option value="Refrigeration and Air Conditioinning">Refrigeration and Air Conditioinning</option><option value="Construction">Construction</option><option value="Electronicsand Pneumatics">Electronicsand Pneumatics</option>');
        }
    
  });

  $("#type").change(function(){
      var typVal = $(this).val();
      if(typVal == 'Interior'){
           $("#type2").html('<option value="">Select Type</option><option value="Kitchen">Kitchen</option><option value="Partition">Partition</option>');
      }else{
        $("#type2").html('<option value="">Select Type</option><option value="Doors">Doors</option><option value="Windows">Windows</option><option value="Facade">Facade</option><option value="Skylight">Skylight</option>');
      }
  });
   setTimeout(function(){ $('#msg').hide();}, 5000);
  $("#operation").change(function(){
    var operation = $(this).val();
    if(operation == 'Cutting Operation'){
      $("#cutt").css('display','block');
      $("#cutt1").css('display','block');
    }else{
      $("#cutt").css('display','none');
      $("#cutt1").css('display','none');
      $("#hide").css('display','none');
      $("#hide1").css('display','none');
      $("#hide2").css('display','none');
      $("#hide3").css('display','none');
      $("#hide4").css('display','none');
    }
  });
  
  $("#quantum").click(function(){
   // var quantum = $("input[name='quantum']:checked"). val();
    var quantum =$(this).val();
    if(quantum == 'Yes'){
      $("#hide").css('display','block');
      $("#hide1").css('display','block');
      $("#hide2").css('display','block');
      $("#hide3").css('display','block');
      $("#hide4").css('display','block');
    }else{
      $("#hide").css('display','none');
      $("#hide1").css('display','none');
      $("#hide2").css('display','none');
      $("#hide3").css('display','none');
      $("#hide4").css('display','none');
    }
  });
  $("#existing_machine").click(function(){
    var machine = $(this).val();
    if(machine == 'Yes'){
      $("#other_existing").css('display', 'block');
    }else{
      $("#other_existing").css('display', 'none');
    }
  })
		</script>