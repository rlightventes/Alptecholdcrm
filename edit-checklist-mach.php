<?php include 'header.php';?>
<?php 
$mysqli->where('check_id', $_GET['edit']);
$getPack = $mysqli->getOne(AL_LIST);
$client = base64_decode($_GET['client']);
$mysqli->where('id', $client);
$getUser = $mysqli->getOne(USER);
$mysqli->where('id', $getUser['assign_to']);
$getEmp = $mysqli->getOne(UADMIN);
?>
<div class="page-wrapper">
   <div class="content container-fluid">
      <div class="row">
         <div class="col-sm-4 col-xs-3">
            <h4 class="page-title">Check List</small></h4>
         </div>
         <div class="col-sm-8 col-xs-9 text-right m-b-20">
            <a href="getcheckList.php?client=<?=$_GET['client']?>" class="btn btn-primary rounded"><i class="fa fa-list" aria-hidden="true"></i> Back</a>
         </div>
      </div>
      <form method="post" action="ajax.php?action=update_check_list">
      <div class="row" id="desktop_view">
         <div class="panel panel-body">
            <div class="col-md-12 text-center">
              <img src="assets/img/alp_logo.png" width="200"><br/><br/>
              <b>ALPTECH INTERNATIONAL PVT LTD</b></br>
              <b>Plot A-231, road no 21, Y Lane Wagle Industrial Area, Thane - 400 604</b><br/><br>
              <br>
            </div>
             
            <div class="col-md-6 text-left">
                <?php if(!empty($getData['com_name'])){?>  <b><?=$getData['com_name']?></b></br> <?php } ?>
	            <?php if(!empty($getData['co_name'])){?>    <b><?=$getData['co_name']?></b></br> <?php } ?>
	            <?php if(!empty($getData['address'])){?>    <b>Address:</b> <?=$getData['address']?></br> <?php } ?>
	            <?php if(!empty($getData['tel_no'])){?>    <b>Telephone No.:</b> <?=$getData['tel_no']?></br> <?php } ?>
	            <?php if(!empty($getData['email_id'])){?>    <b>Email.:</b> <?=$getData['email_id']?></br> <?php } ?>
	            <?php if(!empty($getData['web_address'])){?>   <b>Web.:</b> <?=$getData['web_address']?></br <?php } ?>
	            <?php if(!empty($getData['pan_no'])){?>   <b>PAN:</b> <?=$getData['pan_no']?> <?php } ?> <?php if(!empty($getData['gst_no'])){?> | <b>GST No.:</b> <?=$getData['gst_no']?><?php } ?>
               <br/><br/>
                
                 
            </div>
            <div class="col-md-6 text-left">
                <b>To, </b><br/><b><?=$getUser['fname'].' '.$getUser['lname']?></b></br>  
               <b><?=$getUser['company_name']?></b></br>
               <b>Address:</b> <?=$getUser['address1']?></br>
               <?=$getUser['city1']?> <?=$getUser['state1']?> <?=$getUser['country1']?><br/>
               <b>Mobile No. :</b> <?=$getUser['contact1']?></br><b>Email. :</b> <?=$getUser['email']?><br/>
               <?php if(!empty($getUser['gst'])) { ?>
               <b>GST No. :</b> <?=$getUser['gst']?>
               <?php } ?>
               <input type="hidden" value="<?=$getUser['id']?>" name="client_id" /><br/><br/>
               <input type="hidden" value="<?=$_GET['edit']?>" name="check_id" /><br/><br/>
                
                <p><b> Date:</b>
               <input type="text" class="form-control datetimepicker" name="check_date" id="datepicker" value="<?=$getPack['check_date']?>"  placeholder="" required></p>
                
               <br>
               
                
            </div>
            <div class="clearfix"></div>
            <div class="col-md-8 text-left">
                <p><b>Machine Name: </b><input type="text" name="machine_name" class="form-control product" data-id="1" id="product1" placeholder="" required value="<?=$getPack['machine_name']?>"></p>
                <div id="productList1" class="productList" data-id="1"></div>
            </div>
            <div class="col-md-4 text-left">
                <p><b>Invoice Date:</b>
               <input type="text" class="form-control datetimepicker" name="inv_date" id="datepicker" value="<?=$getPack['inv_date']?>"  placeholder="" required></p>
            </div>
            <div class="col-md-12" id="overflow">
              <table class="table table-bordered table-hover" id="tab_logic">
                <thead>
                  <tr>
                    <th style="background: #000; color: #fff" class="text-center"> #No </th>
                    <th style="background: #000; color: #fff; text-align: center">List of Part</th>
                    <th style="background: #000; color: #fff; text-align: center">Qty</th>
                    <th style="background: #000; color: #fff; text-align: center">Yes</th>
                    <th style="background: #000; color: #fff; text-align: center">Remark</th>
                  </tr>
                </thead>
                <tbody id="wrapper1">
                  <?php 
                    $sr = '1';
                    $mysqli->where('check_id', $_GET['edit']);
                    $getData = $mysqli->get(AL_LIST);
                    foreach($getData as $dataDetail){
                        extract($dataDetail);
                       
                        if($type_check == '1'){
                           if($sr>=11){  
                    ?>
                    <tr>
                    <td><?=$sr++?></td>
                    <td><input type="text" name="list_part_up[]"  placeholder="Enter Description" value="<?=$list_part?>" class="form-control"/>
                    <input type="hidden" name="list_id[]" value="<?=$id?>"/></td>
                    <td><input type="text" name="check_qty_up[]" placeholder="Enter Qty" value="<?=$qty?>" class="form-control qty" step="0" min="0"/></td>
                    <td><input type="text" name="check_yes_up[]" placeholder="Enter Yes" value="<?=$yes?>" class="form-control" /></td>
                    <td><input type="text" name="check_remark_up[]" placeholder="Enter Remark" value="<?=$remark?>" class="form-control" /></td>
                  </tr>
                  
                  <?php }else{ ?> 
                  <tr>
                    <td><?=$sr++?></td>
                    <td><?=$list_part?><input type="hidden" name="list_part_up[]"  placeholder="Enter Description" value="<?=$list_part?>" class="form-control"/>
                    <input type="hidden" name="list_id[]" value="<?=$id?>"/></td>
                    <td><input type="text" name="check_qty_up[]" placeholder="Enter Qty" value="<?=$qty?>" class="form-control qty" step="0" min="0"/></td>
                    <td><input type="text" name="check_yes_up[]" placeholder="Enter Yes" value="<?=$yes?>" class="form-control" /></td>
                    <td><input type="text" name="check_remark_up[]" placeholder="Enter Remark" value="<?=$remark?>" class="form-control" /></td>
                  </tr>
                  <?php }
                  } 
                  } ?>
                  
                 
                </tbody>
                
                
                    <tr>
                        <th colspan="6"><a id="add_fields1" class="btn btn-info">+ Add More </a> <input type="hidden" id="list_id" value="<?=$sr-1?>"></th>
                    </tr>
              
                <tbody id="wrapper">
                    <tr>
                        <th colspan="6"><h4>TABLES</h4></th>
                    </tr>
                    <?php 
                    $n = '1';
                    $mysqli->where('check_id', $_GET['edit']);
                    $getData = $mysqli->get(AL_LIST);
                    foreach($getData as $dataDetail){
                        extract($dataDetail);
                        if($type_check == '2'){
                    if($n>=8){  
                    ?>
                    <tr>
                    <td><?=$n++?></td>
                    <td><input type="text" name="list_part_up[]"  placeholder="Enter Description" value="<?=$list_part?>" class="form-control"/>
                    <input type="hidden" name="list_id[]" value="<?=$id?>"/></td>
                    <td><input type="text" name="check_qty_up[]" placeholder="Enter Qty" value="<?=$qty?>" class="form-control qty" step="0" min="0"/></td>
                    <td><input type="text" name="check_yes_up[]" placeholder="Enter Yes" value="<?=$yes?>" class="form-control" /></td>
                    <td><input type="text" name="check_remark_up[]" placeholder="Enter Remark" value="<?=$remark?>" class="form-control" /></td>
                  </tr>
                  
                  <?php }else{ ?> 
                  <tr>
                    <td><?=$n++?></td>
                    <td><?=$list_part?><input type="hidden" name="list_part_up[]"  placeholder="Enter Description" value="<?=$list_part?>" class="form-control"/>
                    <input type="hidden" name="list_id[]" value="<?=$id?>"/></td>
                    <td><input type="text" name="check_qty_up[]" placeholder="Enter Qty" value="<?=$qty?>" class="form-control qty" step="0" min="0"/></td>
                    <td><input type="text" name="check_yes_up[]" placeholder="Enter Yes" value="<?=$yes?>" class="form-control" /></td>
                    <td><input type="text" name="check_remark_up[]" placeholder="Enter Remark" value="<?=$remark?>" class="form-control" /></td>
                  </tr>
                  <?php }
                  } 
                  } ?>
                   
                </tbody>
                 <tfoot>
                    <tr>
                        <th colspan="6"><a id="add_fields" class="btn btn-info">+ Add More </a> <input type="hidden" id="list_id1" value="<?=$n-1?>"></th>
                    </tr>
                </tfoot>
              </table>
                          
                          
             

            </div>
            <div style="clear:both"></div><br/>
          
           
            <div class="clearfix"></div>
            <br/>
            <!--<div class="col-md-6">-->
            <!--  <label>Engineer Sign</label>-->
            <!--</div>-->
            <!--<div class="col-md-6">-->
            <!--  <h4>Customer Signature & Stamp</h4>-->
            <!--</div><br><br>-->
            <div class="m-t-20 text-center">
              <button class="btn btn-primary">Submit</button>
            </div>
         </div>
      </div>
      </form>
      <form method="post" action="ajax.php?action=machineCheck">
      <div class="row" id="mobile_view">
          <div class="panel panel-body">
              <div class="col-xs-12 text-center" style="font-size:11px">
                  <img src="assets/img/alp_logo.png" width="150"><br/><br/>
              <b>ALPTECH INTERNATIONAL PVT LTD</b></br>
              <b style="font-size:10px">Plot A-231, road no 21, Y Lane Wagle Industrial Area, Thane-400 604</b><br/>
              </div>
              <div class="clearfix"></div>
              <hr/>
              <div class="col-xs-12  text-left" style="font-size:11px">
                   <?php if(!empty($getData['com_name'])){?>  <b><?=$getData['com_name']?></b></br> <?php } ?>
	            <?php if(!empty($getData['co_name'])){?>    <b><?=$getData['co_name']?></b></br> <?php } ?>
	            <?php if(!empty($getData['address'])){?>    <b>Address:</b> <?=$getData['address']?></br> <?php } ?>
	            <?php if(!empty($getData['tel_no'])){?>    <b>Telephone No.:</b> <?=$getData['tel_no']?></br> <?php } ?>
	            <?php if(!empty($getData['email_id'])){?>    <b>Email.:</b> <?=$getData['email_id']?></br> <?php } ?>
	            <?php if(!empty($getData['web_address'])){?>   <b>Web.:</b> <?=$getData['web_address']?></br <?php } ?>
	            <?php if(!empty($getData['pan_no'])){?>   <b>PAN:</b> <?=$getData['pan_no']?> <?php } ?> <?php if(!empty($getData['gst_no'])){?> <br/> <b>GST No.:</b> <?=$getData['gst_no']?><?php } ?>
               <br/><br/>
               
                <b>To, </b><br/><b><?=$getUser['fname'].' '.$getUser['lname']?></b></br>  
               <b><?=$getUser['company_name']?></b></br>
               <b>Address:</b> <?=$getUser['address1']?></br>
               <?=$getUser['city1']?> <?=$getUser['state1']?> <?=$getUser['country1']?><br/>
               <b>Mobile No. :</b> <?=$getUser['contact1']?></br><b>Email. :</b> <?=$getUser['email']?><br/>
               <?php if(!empty($getUser['gst'])) { ?>
               <b>GST No. :</b> <?=$getUser['gst']?>
               <?php } ?>
               <input type="hidden" value="<?=$getUser['id']?>" name="client_id" /><br/><br/>
                <p><b>Machine Name: </b><input type="text" name="machine_name" class="form-control"placeholder="" required value=""></p>
                 <p><b> Date:</b>
               <input type="text" class="form-control datetimepicker" name="check_date" id="datepicker" value="<?=$qtDate?>"  placeholder="" required></p>
              </div>
                <div class="col-xs-12"><h4>160 MM</h4></div>
                  <?php 
                    for($i=1; $i<7; $i++){
                       if(in_array($i, array(2,3,6))){$des = 'D/A';}
                        elseif(in_array($i, array(4,5))){$des = 'D/P';}
                        else{$des = 'A';}
                        if($i==1){
                            $particular = 'Design to be made with 165 mm height between  Top &  Bottom plate';
                        }elseif($i==2){
                            $particular = '2. At  165mm punch should go minimum 2 to 3 mm inside the die plate from punch short height. If  Die plate thickness less than 10mm then punching longer height goes inside it and should be at least 3mm above die plate bottom face';
                        }elseif($i==3){
                            $particular = 'Punch taper when die plate is more than 10mm thick should be minimum 5mm and can be up to 7 to 8mm .If thickness above 15mm ';
                        }elseif($i==4){
                            $particular = ' In drawing Die and Guide plate cavity distance should always be from mounting holes center.';
                        }elseif($i==5){
                            $particular = ' When die plate thickness is less then 15mm then bottom relief should be 0.5mm each done on milling or drilling  & cutting edge should be minimum 3 mm height.';
                        }elseif($i==6){
                            $particular = 'At  165 adaptor should not touch guide plate.';
                        }
                  ?>
                  <div class="col-xs-12">
                      <p><b><?=$i?>. <?=$particular?></b></p>
                      <p><b>Design/Asse</b> <?=$des?></p>
                      <p><input type="text" name="check<?=$i?>" class="form-control" placeholder="Enter Text"></p>
                      <textarea class="form-control" name="remark<?=$i?>" placeholder="Remark"></textarea>
                  </div>
                  <div style="clear:both"></div>
                  <br/><br/>
                  
                  <?php }?>
                  <div class="col-xs-12"><h4>180 MM</h4></div>
                    <?php 
                    for($s=1; $s<7; $s++){
                       if(in_array($s, array(1,5))){$des = 'D/A';}
                        elseif(in_array($s, array(4,6))){$des = 'A';}
                        else{$des = 'D/P';}
                        if($s==1){
                            $particular = 'When Distance between Top & Bottom plate inside height 180mm punch high point should be at least 3 to 4 mm above die plate';
                        }elseif($s==2){
                            $particular = 'Profile puching dimensions should be same as punch dimensions.';
                        }elseif($s==3){
                            $particular = 'When die plate thickness is less than 15mm die support is compulsory';
                        }elseif($s==4){
                            $particular = 'All sharp edges die plate & guide plate should be chamfer .';
                        }elseif($s==5){
                            $particular = 'Die plate should be minimum 5mm larger than guide plate.';
                        }elseif($s==6){
                            $particular = 'clearance to be between support Block & profile checked after inserting profile in dieplate Max 0.4mm';
                        }
                  ?>
                  <div class="col-xs-12">
                      <p><b><?=$s?>. <?=$particular?></b></p>
                      <p><b>Design/Asse</b> <?=$des?></p>
                      <p><input type="text" name="check_mm<?=$s?>" class="form-control" placeholder="Enter text"></p>
                      <textarea class="form-control" name="remark_mm<?=$s?>" placeholder="Remark"></textarea>
                  </div>
                  <div style="clear:both"></div>
                  <br/><br/>
                  <?php }?>
                   <div class="col-xs-12">
                      <p><b>Trouble shoots</b></p>
                      <p><b>Design/Asse</b> D/A</p>
                  </div>
                 <div style="clear:both"></div>
                  <br/><br/>
                  
                  <div class="col-xs-12">
                      <p><b>1. If punch hitting profile then base block should be machined</b></p>
                      <p><b>Design/Asse</b> D/A</p>
                      <p><input type="text" name="trouble_check" class="form-control" placeholder="Enter text"></p>
                      <textarea class="form-control" name="trouble_remark" placeholder="Remark"></textarea>
                  </div>
                  <div style="clear:both"></div>
                  <br/><br/>
                  <div class="col-xs-12">
                      <p><b>Marking</b></p>
                  </div>
                 <div style="clear:both"></div>
                  <br/><br/>
                   <div class="col-xs-12">
                      <p><b>1. Before Assembly Marking drawing to be checked with baseblock /dieplate And profile sample</b></p>
                      <p><b>Design/Asse</b> D/A</p>
                      <p><input type="text" name="mark_check1" class="form-control" placeholder="Enter text"></p>
                      <textarea class="form-control" name="mark_remark1" placeholder="Remark"></textarea>
                  </div>
                  <div style="clear:both"></div>
                  <br/><br/>
                  
                  <div class="col-xs-12">
                      <p><b>2. spacing of die parts to be checked by marking proto type assembly on the cutting unit.</b></p>
                      <p><b>Design/Asse</b> D/A</p>
                      <p><input type="text" name="mark_check2" class="form-control" placeholder="Enter text"></p>
                      <textarea class="form-control" name="mark_remark1" placeholder="Remark"></textarea>
                  </div>
                  <div style="clear:both"></div>
                  <br/><br/>
                  
                    <div class="col-xs-12">
                      <p><b>Marking</b></p>
                  </div>
                  <div style="clear:both"></div>
                  <br/><br/>
                 
                    <div class="col-xs-12">
                      <p><b>2. Spacing of die parts to be checked by marking proto type assembly on the cutting unit.</b></p>
                      <p><b>Design/Asse</b> D/A</p>
                      <p><input type="text" name="mark_check2" class="form-control" placeholder="Enter text"></p>
                      <textarea class="form-control" name="mark_remark2" placeholder="Remark"></textarea>
                  </div>
                  <div style="clear:both"></div>
                  <br/><br/>
                  
                  
                  
                  <?php 
                    for($x=1; $x<7; $x++){
                       
                        if($x==1){
                            $particular = 'PUNCH TOLERANCE WITH GUIDE PLATE.Punch should be 0.01 plus and guide plate to be 0.01 minus.';
                        }elseif($x==2){
                            $particular = 'PUNCH AND DIE PLATE . Punch and dieplate should have 0.2 mm clearance difference.';
                        }elseif($x==3){
                            $particular = 'while designing all die parts to be designed as per standard material available.RAW MATERIAL TO BE MINIMUM 2 MM MORE THAN FINISH SIZE.';
                        }elseif($x==4){
                            $particular = 'DIE PLATE WPS.GUIDEPLATE OHNS.PUNCH HSS.BLANACE PARTS MS';
                        }elseif($x==5){
                            $particular = 'ALL MOUNTING HOLES TO BE 0.5-0.8 MM MORE THAN THE BOLT SIZE';
                        }elseif($x==6){
                            $particular = 'FOR PUMCH THE HOLE OR SLOT IN ADAPTO TO BE 1 MM MORE THAN PUNCH SIZE.';
                        }
                  ?>
                   <div class="col-xs-12">
                      <p><b><?=$x?>. <?=$particular?></b></p>
                      <p><b>Design/Asse</b> D/A</p>
                      <p><input type="text" name="check_des<?=$x?>" class="form-control" placeholder="Enter text"></p>
                      <textarea class="form-control" name="remark_des<?=$x?>" placeholder="Remark"></textarea>
                  </div>
                  <div style="clear:both"></div>
                  <br/><br/>
                 
                  <?php }?>
                  <div class="m-t-20 text-center">
              <button class="btn btn-primary">Submit</button>
            </div>

          </div>
      </div>
      </form>
   </div>
   <?php include 'messages.php';?>
</div>
</div>
<?php include 'footer.php';?>
<script>
     $(document).ready(function(){
      
      $(".product").on("keyup", function(){
          
        //   alert("ok");
        var getID = $(this).attr('data-id');
        var productName = $("#product"+getID).val();
        // alert("#product"+getID);
        // alert(city);
        if (productName !=="") {
          $.ajax({
            url:"ajax-product-search.php",
            type:"POST",
            cache:false,
            data:{city:productName, getID:getID},
            success:function(data){
              $('#productList'+getID).html(data);
              $('#productList'+getID).fadeIn();
            }  
          });
        }else{
          $('#productList'+getID).html("");  
          $('#productList'+getID).fadeOut();
        }
      });
      

      // click one particular city name it's fill in textbox
      $(".productList").on("click", "li", function(){
         
          
    //           e.preventDefault();
    // var $this = $(this).parent();
    // $this.addClass("select").siblings().removeClass("select");
           
            var selVal = $(this).attr("data-value");
            //  alert(selVal);
             var res = selVal.split("#");
            var getID = res['0'];
            var getName = res['1'];
            var getPrId = res['2'];
            var getUnit = res['3'];
            var getMrp = res['4'];
            var getDiscount = res['5'];
            var getNet = res['6'];
            
              if(getUnit == "0" || getUnit == ""){
                var nameUnit = 'Nos';
            }else{
                var nameUnit = getUnit;
            }

        $('#product'+getID).val(getName);
        $('#productList'+getID).fadeOut("fast");
        
     
      });

  });
 
</script>

<script>
    $(document).ready(function() {
    var max_fields1 = 30; //Maximum allowed input fields 
    var wrapper1    = $("#wrapper1"); //Input fields wrapper
    var add_button1 = $("#add_fields1"); //Add button class or ID
	var x1 = $("#list_id").val(); //Initlal input field is set to 1
	
	//When user click on add input button
	$(add_button1).click(function(e){
        e.preventDefault();
		//Check maximum allowed input fields
        if(x1 < max_fields1){ 
            x1++; //input field increment
			 //add input field
            $(wrapper1).append('<tr><td>'+x1+'</td><td><input type="text" name="list_part[]"  placeholder="Enter Description"  class="form-control"/><input type="hidden" name="type_check[]" value="1"/></td><td><input type="text" name="check_qty[]" placeholder="Enter Qty" class="form-control qty" step="0" min="0"/></td><td><input type="text" name="check_yes[]" placeholder="Enter Yes" class="form-control" /></td><td><input type="text" name="check_remark[]" placeholder="Enter Remark" class="form-control" /></td></tr>');
        }
    });
	
    //when user click on remove button
    $(wrapper1).on("click","#remove_field1", function(e){ 
        e.preventDefault();
		$(this).parent('div').remove(); //remove inout fieldx--; //inout field decrement
    })
});


$(document).ready(function() {
    var max_fields = 30; //Maximum allowed input fields 
    var wrapper    = $("#wrapper"); //Input fields wrapper
    var add_button = $("#add_fields"); //Add button class or ID
	var s1 = $("#list_id1").val();; //Initlal input field is set to 1
	
	//When user click on add input button
	$(add_button).click(function(e){
        e.preventDefault();
		//Check maximum allowed input fields
        if(s1 < max_fields){ 
            s1++; //input field increment
			 //add input field
            $(wrapper).append('<tr><td>'+s1+'</td><td><input type="text" name="list_part[]"  placeholder="Enter Description" class="form-control"/><input type="hidden" name="type_check[]" value="2"/></td><td><input type="text" name="check_qty[]" placeholder="Enter Qty" class="form-control qty" step="0" min="0"/></td><td><input type="text" name="check_yes[]" placeholder="Enter Yes" class="form-control" /></td><td><input type="text" name="check_remark[]" placeholder="Enter Remark" class="form-control" /></td></tr>');
        }
    });
	
    //when user click on remove button
    $(wrapper).on("click","#remove_field", function(e){ 
        e.preventDefault();
		$(this).parent('tr').remove(); //remove inout fieldx--; //inout field decrement
    })
});

</script>
