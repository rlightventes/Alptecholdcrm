<?php include 'header.php';?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-sm-4 col-xs-3">
							<h4 class="page-title">Add / Edit Clients</h4>
						</div>
						<div class="col-sm-8 col-xs-9 text-right m-b-20">
							<a href="users.php" class="btn btn-primary rounded pull-right"><i class="fa fa-list" aria-hidden="true"></i> Back</a>
							<!-- <div class="view-icons">
								<a href="clients.php" class="grid-view btn btn-link"><i class="fa fa-th"></i></a>
								<a href="clients-list.php" class="list-view btn btn-link active"><i class="fa fa-bars"></i></a>
							</div> -->
						</div>
					</div>
					<div class="row">
						<?php 

							if(isset($_GET['lead'])):
								$lead = base64_decode($_GET['lead']);
								// $mysqli->where('id', $lead);
								// $getEnq = $mysqli->getOne(ENQ);

								$mysqli->where('id', $lead);
								$getEmp = $mysqli->getOne(USER);
								//	print_r($getEmp);
								$type = 'update'; 
								$fname = $getEmp['fname'];
								$lname = $getEmp['lname'];
								$address1 = $getEmp['address1'];
								$address2 = $getEmp['address2'];
								$email = $getEmp['email'];
								$contact1 = $getEmp['contact1'];
								$contact2 = $getEmp['contact2'];
								$landline = $getEmp['landline'];
								$company = $getEmp['company_name'];
								$pan = 	$getEmp['pan'];
								$tan = 	$getEmp['tan'];
								$ac_code = 	$getEmp['ac_code'];
								$group_code = $getEmp['group_code'];
								$broker_code = $getEmp['broker_code'];
								$vat = $getEmp['vat'];
								$reg = $getEmp['reg'];
								$gst = $getEmp['gst'];
								$gst_applicable = $getEmp['gst_applicable'];
								$priority = $getEmp['priority'];
								$maturate = $getEmp['maturate'];
								$password = $getEmp['password'];
								$assign_to = $getEmp['assign_to'];
								$leadType = $getEmp['lead_type']; 
								$state1 = $getEmp['state1'];
								$city1 = $getEmp['city1'];
								$country1 = $getEmp['country1'];
								$state2 = $getEmp['state2'];
								$city2 = $getEmp['city2'];
								$country2 = $getEmp['country2'];
								$state3 = $getEmp['state3'];
								$city3 = $getEmp['city3'];
								$country3 = $getEmp['country3'];
							else:
								$type = 'new';
								$fname = '';
								$lname = '';
								$address1 = '';
								$address2 = '';
								$email = '';
								$contact1 = '';
								$contact2 = '';
								$landline = '';
								$company = '';
								$pan = 	'';
								$tan = 	'';
								$ac_code = '';
								$group_code = '';
								$broker_code = '';
								$vat = '';
								$reg = '';
								$gst = '';
								$gst_applicable = '';
								$priority = '';
								$maturate = '';
								$password = '';
								$assign_to = '';
								$leadType = '';
								$state1 = '';
								$city1 = '';
								$country1 = 'India';
								$state2 = '';
								$city2 = '';
								$country2 = 'India';
								$state3 = '';
								$city3 = '';
								$country3 = 'India';
							endif;
						
							
							
						?>
                            <?php if(isset($_GET['msg'])){ ?> 
                                <div class="alert alert-danger" id="msg">
                                    <h3>SO SORRY !</h3>
                                    <p>Email ID or Mobile No. is already exists. Please try another...</p>
                                </div>
                            <?php } ?>
						<form method="post" action="ajax.php?action=lead&type=<?=$type?>">
							<?php if(isset($_GET['lead'])): ?>
								<input type="hidden" name="id" value="<?=$_GET['lead']?>">
								<input type="hidden" name="client_id" value="<?=$getEmp['id']?>">
								
							<?php endif;?>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Company Name <span class="text-danger">*</span></label>
									<input class="form-control" type="text" name="company_name" required value="<?=$company?>">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">First Name <span class="text-danger">*</span></label>
									<input class="form-control" type="text" name="fname" required value="<?=$fname?>">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Last Name </label>
									<input class="form-control" type="text" name="lname"  value="<?=$lname?>">
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Email Id <span class="text-danger">*</span><small id="emailError" style="color: #f00"></small></label>
									<input class="form-control" type="email" name="email" id="email" required value="<?=$email?>">
									
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Phone <span class="text-danger">*</span></label>
									<input class="form-control" type="text" id="phone" name="contact1" pattern="^\d{10}$" required value="<?=$contact1?>">
									<small id="phoneError" style="color: #f00"></small>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Password <span class="text-danger">*</span></label>
									<input class="form-control" type="text" name="password" id="password" required value="<?=$password?>"></span>
								</div>
							</div>
							<div class="col-md-4">  
								<div class="form-group">
									<label class="control-label">GST Number</label>
									<input class="form-control" type="text" name="gst"  value="<?=$gst?>">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Alternate Phone </label>
									<input class="form-control" type="text" name="contact2" pattern="^\d{10}$" value="<?=$contact2?>">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Landline </label>
									<input class="form-control" type="text" name="landline" value="<?=$landline?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">Address <span class="text-danger">*</span></label>
									<input class="form-control" type="text" name="address1" required value="<?=$address1?>">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Country <span class="text-danger">*</span></label>
									<select class="form-control" name="country1"  id="country1">
									    <?php if(isset($_GET['lead'])){ ?> 
									    <option value="<?=$country1?>"><?=$country1?></option>
									    <?php }else{ ?>
									    <option value="<?=$country1?>"><?=$country1?></option>
									    <?php } ?>
									    <option value="Other">Other</option>
									</select>
									<input class="form-control" type="text" name="country1" id="country_1"  placeholder="Enter Country" style="display:none">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">State <span class="text-danger">*</span></label>
									<select class="form-control" name="state1"  id="state1">
									    <?php if(isset($_GET['lead'])){ ?> 
									    <option value="<?=$state1?>"><?=$state1?></option>
									     <?php }else{ ?>
									    <option value="">Select State</option>
									    <?php } ?>
									    <?php 
									    $mysqli->groupBy('city_state');
									    $getState = $mysqli->get(CITY);
									    foreach($getState as $allState){ ?> 
									    <option value="<?=$allState['city_state']?>"><?=$allState['city_state']?></option>
									    <?php }    ?>
									</select>
									<input class="form-control" type="text" name="state1" id="state_1"   placeholder="Enter State"  value="" style="display:none">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">City <span class="text-danger">*</span></label>
									<select class="form-control" name="city1"  id="city1">
									    <?php if(isset($_GET['lead'])){ ?> 
									    <option value="<?=$city1?>"><?=$city1?></option>
									     <?php }else{ ?>
									    <option value="">Select City</option>
									    <?php } ?>
									    <?php 
									    $mysqli->groupBy('city_state');
									    $getCity = $mysqli->get(CITY);
									    foreach($getState as $allState){ ?> 
									    <option value="<?=$allState['city_name']?>"><?=$allState['city_name']?></option>
									    <?php }    ?>
									</select>
									<input class="form-control" type="text" name="city1" id="city_1"   placeholder="Enter City"  value="" style="display:none">
								</div>
							</div>
							
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">Additional Address </label>
									<input class="form-control" type="text" name="address2"  value="<?=$address1?>">
								</div>
							</div>
								<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Country </label>
									<select class="form-control" name="country2"  id="country2">
									    <?php if(isset($_GET['lead'])){ ?> 
									    <option value="<?=$country2?>"><?=$country2?></option>
									    <?php }else{ ?>
									    <option value="<?=$country2?>"><?=$country2?></option>
									    <?php } ?>
									    <option value="Other">Other</option>
									</select>
									<input class="form-control" type="text" name="country2" id="country_2"  placeholder="Enter Country" style="display:none">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">State <span class="text-danger">*</span></label>
									<select class="form-control" name="state2"  id="state2">
									    <option value="">Select State</option>
									    <?php 
									    $mysqli->groupBy('city_state');
									    $getState2 = $mysqli->get(CITY);
									    foreach($getState2 as $allState){ ?> 
									    <option value="<?=$allState['city_state']?>"><?=$allState['city_state']?></option>
									    <?php }    ?>
									</select>
									<input class="form-control" type="text" name="state2" id="state_2"   placeholder="Enter State"  value="" style="display:none">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">City <span class="text-danger">*</span></label>
									<select class="form-control" name="city2"  id="city2">
									    <option value="">Select City</option>
									    <?php 
									    $mysqli->groupBy('city_state');
									    $getCity2 = $mysqli->get(CITY);
									    foreach($getState2 as $allState){ ?> 
									    <option value="<?=$allState['city_name']?>"><?=$allState['city_name']?></option>
									    <?php }    ?>
									</select>
									<input class="form-control" type="text" name="city2" id="city_2"   placeholder="Enter City"  value="" style="display:none">
								</div>
							</div>
							
							
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">Other Address</label>
									<input class="form-control" type="text" name="address3"  value="<?=$address1?>">
								</div>
							</div>
								<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Country <span class="text-danger">*</span></label>
									<select class="form-control" name="country3"  id="country3">
									   <?php if(isset($_GET['lead'])){ ?> 
									    <option value="<?=$country3?>"><?=$country3?></option>
									    <?php }else{ ?>
									    <option value="<?=$country3?>"><?=$country3?></option>
									    <?php } ?>
									    <option value="Other">Other</option>
									</select>
									<input class="form-control" type="text" name="country3" id="country_3"  placeholder="Enter Country" style="display:none">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">State <span class="text-danger">*</span></label>
									<select class="form-control" name="state3"  id="state3">
									    <option value="">Select State</option>
									    <?php 
									    $mysqli->groupBy('city_state');
									    $getState3 = $mysqli->get(CITY);
									    foreach($getState3 as $allState){ ?> 
									    <option value="<?=$allState['city_state']?>"><?=$allState['city_state']?></option>
									    <?php }    ?>
									</select>
									<input class="form-control" type="text" name="state3" id="state_3"   placeholder="Enter State"  value="" style="display:none">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">City <span class="text-danger">*</span></label>
									<select class="form-control" name="city3"  id="city3">
									    <option value="">Select City</option>
									    <?php 
									    $mysqli->groupBy('city_state');
									    $getCity3 = $mysqli->get(CITY);
									    foreach($getCity3 as $allState){ ?> 
									    <option value="<?=$allState['city_name']?>"><?=$allState['city_name']?></option>
									    <?php }    ?>
									</select>
									<input class="form-control" type="text" name="city3" id="city_3"   placeholder="Enter City"  value="" style="display:none">
								</div>
							</div>
							
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">PAN Number</label>
									<input class="form-control" type="text" name="pan"  value="<?=$pan?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Tan Number </label>
									<input class="form-control" type="text" name="tan"  value="<?=$tan?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">A/C Code </label>
									<input class="form-control" type="text" name="ac_code"  value="<?=$ac_code?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Group Code </label>
									<input class="form-control" type="text" name="group_code"  value="<?=$group_code?>">
								</div>
							</div>
							<div class="col-md-3">  
								<div class="form-group">
									<label class="control-label">Broker Code </label>
									<input class="form-control" type="text" name="broker_code"  value="<?=$broker_code?>">
								</div>
							</div>
							
							<div class="col-md-3">  
								<div class="form-group">
									<label class="control-label">VAT Number </label>
									<input class="form-control" type="text" name="vat"  value="<?=$vat?>">
								</div>
							</div>
							<div class="col-md-3">  
								<div class="form-group">
									<label class="control-label">Category <span class="text-danger">*</span></label>

									<select name="reg" id="reg" class="form-control" required>
										<?php   if(empty($reg)):?>
										<option value="">Select Category</option>
										<?php
										    $mysqli->orderBy('category', 'asc');
										    $getCAT = $mysqli->get(UCAT);
										    foreach($getCAT as $CATlist){
										        if($CATlist['hide'] != '1'){
										?>
										<option value="<?=$CATlist['category']?>"><?=$CATlist['category']?></option>
										<?php } } else:
										    $mysqli->where('category', $reg);
										    $oneCAT = $mysqli->getOne(UCAT); ?>
										<option value="<?=$oneCAT['category']?>"><?=$oneCAT['category']?></option>
   
										 <?php   $mysqli->orderBy('category', 'asc');
										    $getCAT = $mysqli->get(UCAT);
										    foreach($getCAT as $CATlist){ 
										        if($CATlist['hide'] != '1'){
										        if($reg != $CATlist['category']){
										    ?>
										<option value="<?=$CATlist['category']?>"><?=$CATlist['category']?></option>
										  <?php } } }
										endif; ?>
										<option value="Other">Other</option>
									</select>
									<input type="text" name="otherReg" placeholder="Enter other category" class="form-control" id="regInp" style="display:none"/>
								</div>
							</div>
							<div class="col-md-3">  
								<div class="form-group">
								    
									<label class="control-label">GST Applicable </label><br>
									<?php 
								    if(!empty($gst_applicable)):
								   ?>
                      				<label class="radio-inline"><input type="radio" name="gst_applicable" value="Yes" checked> Yes</label>
                      				<label class="radio-inline"><input type="radio" name="gst_applicable" value="No"   > No</label>
								   <?php
								    else:
								   ?>
                      				<label class="radio-inline"><input type="radio" name="gst_applicable" value="Yes" > Yes</label>
                      				<label class="radio-inline"><input type="radio" name="gst_applicable" value="No"  checked > No</label>
								   <?php
								    endif;
								    ?>
								</div>
							</div>
							<div style="clear: both"></div>
							<div class="col-md-4">  
								<div class="form-group">
									<label class="control-label">Priority <span class="text-danger">*</span></label>
									<select class="select" name="priority" required >
										<?php if(empty($priority)):?>
										<option value="">Select Priority</option>
										<option value="Hot">Hot</option>
										<option value="Cold">Cold</option>
										<option value="Warm">Warm</option>
										<?php else:
										if($priority == 'Hot'):?> 
										<option value="Hot">Hot</option>
										<option value="Cold">Cold</option>
										<option value="Warm">Warm</option>
										<?php elseif($priority == 'Cold'):?> 
										<option value="Cold">Cold</option>
										<option value="Hot">Hot</option>
										<option value="Warm">Warm</option>
										<?php elseif($priority == 'Warm'):?> 
										<option value="Warm">Warm</option>
										<option value="Hot">Hot</option>
										<option value="Cold">Cold</option>
										
										<?php endif; endif;?>
									</select>
								</div>
							</div>
							<?php if(!empty($assign_to)){ $required1 = ''; }else{ $required1 = 'required'; } ?>
							<div class="col-md-4">  
								<div class="form-group">
									<label class="control-label">Assign <span class="text-danger">*</span></label>
									<select class="select" name="assign[]" <?=$required1?> multiple>
										
										<option value="">Select Assign Person</option>
										<?php 
										    $mysqli->orderBy('fname', 'desc');
											$getAssign = $mysqli->get(UADMIN);
											foreach ($getAssign as $assignMenu):
											  if($assignMenu['hide'] != '1'){ 
											 ?>
										<option value="<?=$assignMenu['id']?>"><?=$assignMenu['fname']." ".$assignMenu['lname']?></option>
									    <?php  } 
									    endforeach; ?>
									</select>
									<?php if(!empty($assign_to)){
									    $explodeUser = explode(",", $assign_to);
									    foreach($explodeUser as $userID){
									        $mysqli->where('id', $userID);
									        $getUser = $mysqli->getOne(UADMIN);
echo ($getUser['fname'] ?? 'Guest')." ".($getUser['lname'] ?? '')."&nbsp;&nbsp;";
									        
									    }
									
									}?>
									<?php if(!empty($assign_to)){ ?>
									   <input type="hidden" value="<?=$assign_to?>" name="assList"/> 
									   <?php } ?>
								</div>
							</div>
							<?php if(!empty($leadType)){ $required = ''; }else{ $required = 'required'; } ?>
							<div class="col-md-4">  
								<div class="form-group">
									<label class="control-label">Lead Type <span class="text-danger">*</span></label>
									<select class="select" name="leadType[]" <?=$required?> multiple>
										
										<option value="">Select Lead Type</option>
										  <?php  $mysqli->orderBy('lead', 'asc');
										    $getLead = $mysqli->get(LEAD);
										    foreach($getLead as $leadList){ 
										        if($leadList['hide'] != '1'){ ?>
										   <option value="<?=$leadList['lead']?>"><?=$leadList['lead']?></option>     
										 <?php }   }  ?>
										 
									</select>
									<?php if(!empty($leadType)){ ?>
									   <input type="hidden" value="<?=$leadType?>" name="leadList"/> 
									 <?php $expLead = explode(",", $leadType);
										    foreach($expLead as $leadName){
										        if(!empty($leadName)){
										        echo $leadName;
										    } }
									} ?>
								</div>
							</div>
							<div class="col-md-12 text-center">
								<div class="form-group">
									<button class="btn btn-primary" id="submit">SUBMIT</button>
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
	
				$("#email").blur(function(){
				var email  = $(this).val();
				var action = 'checkEmail';
				 $.ajax({
      type: 'POST',
      url: 'ajax.php',
      data:{email:email, action:action},
      success:function(data){
    //      alert(data);
        if('yes' == data){
      //      alert('This email ID is already registererd. Please try another.');
          $('#emailError').html('This email ID is already registererd. Please try another.');
          $("#submit").attr("disabled", true);
        }else{
           $('#emailError').html('');
          $("#submit").attr("disabled", false);
        }
        //  if(data == 'yes'){
         
        // }
      }
    })
			});
			
			$("#phone").blur(function(){
				var phone  = $(this).val();
				var action = 'checkPhone';
				 $.ajax({
      type: 'POST',
      url: 'ajax.php',
      data:{phone:phone, action:action},
      success:function(data){
        if(data == 'yes'){
          $('#phoneError').html('This Phone no is already registererd. Please try another.');
          $("#submit").attr("disabled", true);
        }else{
          $('#phoneError').html('');
          $("#submit").attr("disabled", false);
        }
      }
    })
			});

</script>
<script>
 setTimeout(function(){ $('#msg').hide();}, 10000);
    $("#reg").change(function(){
        var reg = $(this).val();
        if(reg == 'Other'){
            $("#regInp").css('display', 'block');
        }else{
             $("#regInp").css('display', 'none');
        }
    });
    
    $("#state1").change(function(){
       var state = $(this).val();
       var action = 'cityList';
       $.ajax({
           type:'POST',
           url:'ajax.php',
           data:{state:state, action:action},
           success:function(data){
               $("#city1").html(data);
           }
           
       });
    //   alert(state);
    });
     $("#state2").change(function(){
       var state = $(this).val();
       var action = 'cityList';
       $.ajax({
           type:'POST',
           url:'ajax.php',
           data:{state:state, action:action},
           success:function(data){
               $("#city2").html(data);
           }
           
       });
    //   alert(state);
    });
     $("#state3").change(function(){
       var state = $(this).val();
       var action = 'cityList';
       $.ajax({
           type:'POST',
           url:'ajax.php',
           data:{state:state, action:action},
           success:function(data){
               $("#city3").html(data);
           }
           
       });
    //   alert(state);
    });
    $("#country1").change(function(){
        var country = $(this).val();
        // alert(country);
        if(country == "Other"){
            $("#country_1").css('display', 'block');
            $("#country1").css('display', 'none');
            $("#state_1").css('display', 'block');
            $("#state1").css('display', 'none');
            $("#city_1").css('display', 'block');
            $("#city1").css('display', 'none');
        }else{
            $("#country_1").css('display', 'none');
            $("#country1").css('display', 'block');
            $("#state_1").css('display', 'none');
            $("#state1").css('display', 'block');
            $("#city_1").css('display', 'none');
            $("#city1").css('display', 'block');
        }
    });
     $("#country2").change(function(){
        var country = $(this).val();
        // alert(country);
        if(country == "Other"){
            $("#country_2").css('display', 'block');
            $("#country2").css('display', 'none');
            $("#state_2").css('display', 'block');
            $("#state2").css('display', 'none');
            $("#city_2").css('display', 'block');
            $("#city2").css('display', 'none');
        }else{
            $("#country_2").css('display', 'none');
            $("#country2").css('display', 'block');
            $("#state_2").css('display', 'none');
            $("#state2").css('display', 'block');
            $("#city_2").css('display', 'none');
            $("#city2").css('display', 'block');
        }
    });
     $("#country3").change(function(){
        var country = $(this).val();
        // alert(country);
        if(country == "Other"){
            $("#country_3").css('display', 'block');
            $("#country3").css('display', 'none');
            $("#state_3").css('display', 'block');
            $("#state3").css('display', 'none');
            $("#city_3").css('display', 'block');
            $("#city3").css('display', 'none');
        }else{
            $("#country_3").css('display', 'none');
            $("#country3").css('display', 'block');
            $("#state_3").css('display', 'none');
            $("#state3").css('display', 'block');
            $("#city_3").css('display', 'none');
            $("#city3").css('display', 'block');
        }
    });
</script>