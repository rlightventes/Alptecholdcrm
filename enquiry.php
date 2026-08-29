<?php include_once 'include/header.php'; ?>
    <section class="parallex-bg page_banner terms_policy_banner">
      <div class="dark-overlay"></div>
      <div class="container div_zindex white-text">
        <h1>Enquiry</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Enquiry</li>
        </ol>
      </div>
    </section>
      <section class="section_padding pt-0 contact3">
      <div class="container">
        
        <div class="row justify-content-center">
          
          <div class="col-lg-12" style="margin-top: 50px">
           
             <?php if(isset($_GET['msg'])):?>
            <p class="alert alert-success" id="msg">Thank you for contacting us. We will get in touch shortly</p>
            <?php endif; ?>
            <?php if(!empty($_SESSION['user'])):
              $mysqli->where('id', $_SESSION['user_id']);
              $getUser = $mysqli->getOne(USER);
              $name = $getUser['fname'].' '.$getUser['lname'];
              $email = $getUser['email'];
              $contact = $getUser['contact1'] ;
              $client_id = $getUser['id'] ;
            else:
              $name = '';
              $email = '';
              $contact = '';
              $client_id = '';
            endif;
               $prodID = base64_decode($_GET['product_id']);
              $mysqli->where('id', $prodID);
              $getProduct = $mysqli->getOne(PRODUCT);

            ?>

            <form action="ajax.php?action=enquiry" method="POST">
              
              <input type="hidden" name="client_id" value="<?=$_SESSION['user_id']?>">
              <?php if($getProduct['product_type'] != 'Tools'):?>
              <div class="row">
                <input type="hidden" name="product_id" value="<?=$_GET['product_id']?>">
                <div class="col-lg-3">
                  <div class="form-group">
                     <label>Select Operation</label>
                    <select name="operation" id="operation">
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
                    </select>

                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label>Type of Industry</label>
                    <select name="industry" id="industry">
                      <option value="">Select Industry</option>
                      <option value="Architecture">Architecture</option>
                      <option value="Engineer">Engineer</option>
                      <option value="Service">Service</option>
                    </select>
                  </div>
                </div>

                <div class="col-lg-3">
                  <div class="form-group">
                    <label>Select Type</label>
                    <select name="type_cat" id="type">
                      <option value="">Select Architecture</option>
                      <option>Architecture</option>
                      <option>Engineer</option>
                      <option>Service</option>
                    </select>
                      
                  </div>
              
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label>Select Type</label>
                    <select name="type_cat2" id="type2">
                      <option value="">Select Type</option>
                      <option value="Doors">Doors</option>
                      <option value="Windows">Windows</option>
                      <option value="Facade">Facade</option>
                      <option value="Skylight">Skylight</option>
                    </select>
                      
                  </div>
              
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label>Type of Section</label><br/>
                      <label class="radio-inline" style="font-weight: 300"><input type="radio" name="material" value="Aluminium"> Aluminium</label>
                    <label class="radio-inline" style="font-weight: 300"><input type="radio" name="material" value="PVC"> PVC </label>
                </div>
                </div>   
                <div class="col-lg-4" id="cutt" style="display: none;">
                  <div class="form-group">
                    <label>Type of Cutting</label>
                      <label class="radio-inline" style="font-weight: 300"><input type="radio" name="cutting" value="Aluminium" > Aluminium</label>
                    <label class="radio-inline" style="font-weight: 300"><input type="radio" name="cutting" value="PVC"> PVC </label>
                  </div>
                </div>   
                <div class="col-lg-4" id="cutt1" style="display: none;">
                  <div class="form-group">
                    <label>Quantum of Cutting</label>
                      <label class="radio-inline"><input type="radio" name="quantum" value="Yes" id="quantum"> Yes</label>
                    <label class="radio-inline"><input type="radio" name="quantum" value="No" id="quantum"> No </label>
                  </div>
                </div>   

                <div class="col-lg-6" style="display: none;" id="hide">
                  <div class="form-group">
                    <label>Size of Profile</label>
                    <input type="text" class="form-control" name="length" id="email" placeholder="Length" >
                    <p id="emailError" style="color:#f00"></p>
                  </div>
                </div>
                <div class="col-lg-6" style="display: none;"  id="hide1">
                  <div class="form-group">
                    <label></label>
                    <input type="text" class="form-control" name="breadth" placeholder="Breadth" >
                  </div>
                </div>
                  <div class="col-lg-6" style="display: none;"  id="hide2">
                  <div class="form-group">
                    <input type="text" class="form-control" name="height" placeholder="Height" >
                  </div>
                </div>
                <div class="col-lg-6" style="display: none;"  id="hide3">
                  <div class="form-group">
                    <input type="text" class="form-control" name="weight" placeholder="Weight" >
                  </div>
                </div>
                <div class="col-lg-12" style="display: none;"  id="hide4">
                  <div class="form-group">
                    <input type="text" class="form-control" name="thickness" placeholder="Thickness" >
                  </div>
                </div>
                 <div class="col-lg-6">
                  <div class="form-group">
                      <label class="radio-inline"><input type="radio" name="setup_type" value="New Setup" > New Setup</label>
                    <label class="radio-inline"><input type="radio" name="setup_type" value="Upgrade"> Upgrade </label>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Existing Machines</label>
                      <label class="radio-inline"><input type="radio" name="existing_machine" value="Yes" id="existing_machine" value="Yes"> Yes</label>
                <label class="radio-inline"><input type="radio" name="existing_machine" value="No"> No </label>
                <input type="text" name="other_existing" class="form-control" style="display: none;">
                  </div>
                </div>
              </div>
              <?php else: ?> 
                <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                      <label>Product Name</label>
                      <input type="text" disabled="" value="<?=$getProduct['name']?>">
                     </div>
                  </div>
                   <div class="col-lg-6">
                     <div class="form-group">
                      <label>Size</label>
                      <select name="product_id">
                        <option value="">Select Size</option>
                        <?php $mysqli->where('name', $getProduct['name']);
    $geTools = $mysqli->get(PRODUCT);
    foreach ($geTools as $tool) {
      extract($tool); 
      $prod_ID = base64_encode($id);
      ?>    
                        <option value="<?=$prod_ID?>"><?=$product_dimension?></option>
    <?php } ?>
                      </select>
                     </div>
                  </div>
                  <div id="add_product" class="row">
                  
              
                </div>
                
            <br/>
              <div style="clear: both"></div>
              <div class="col-lg-12">
                <p><a id="add_fields" class="btn btn-info">+ Add Product</a></p>
              </div>
            
                  <div class="col-lg-12">
                    <textarea name="detail"></textarea>
                    
                  </div>
                </div>
              <?php endif;?>
              <div class="row">
                <div class="col-lg-2">
                  <button type="submit" name="submit" id="submit" class="btn w-100">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
   
<?php include_once 'include/footer.php'; ?>
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
<script>
//Add Input Fields
$(document).ready(function() {
    var max_fields = 10; //Maximum allowed input fields 
    var wrapper    = $("#add_product"); //Input fields wrapper
    var add_button = $("#add_fields"); //Add button class or ID
  var x = 1; //Initlal input field is set to 1
  
  //When user click on add input button
  $(add_button).click(function(e){
        e.preventDefault();
    //Check maximum allowed input fields
        if(x < max_fields){ 
            x++; //input field increment
       //add input field
            $(wrapper).append('<div class="col-lg-6" style="padding-left:30px"><div class="form-group"><label>Select Product Name</label><select name="prName[]" class="form-control " id="productID"><option value="">Select Product</option><?php $mysqli->orderBy('id', 'desc');$mysqli->groupBy('name'); $mysqli->where('product_type', 'Tools'); $getPr = $mysqli->get(PRODUCT); foreach($getPr as $datapr):?><option value="<?=$datapr['name']?>"><?=$datapr['name']?></option><?php endforeach;  ?></select></div></div><div class="col-lg-6" style="padding-right:30px"><div class="form-group"><label>Size</label><select name="prSize[]" class="form-control " id="productID"><option value="">Select Product</option><?php $mysqli->orderBy('id', 'desc'); $mysqli->where('product_type', 'Tools');  $getSize = $mysqli->get(PRODUCT); foreach($getSize as $dataSize): if(!empty($dataSize['product_dimension'])):?><option value="<?=$dataSize['id']?>"><?=$dataSize['product_dimension']?></option><?php endif; endforeach;  ?></select></div></div> <div style="clear: both"></div>');
        }
    });
  
    //when user click on remove button
    $(wrapper).on("click","#remove_field", function(e){ 
        e.preventDefault();
    $(this).parent('div').remove(); //remove inout field
    x--; //inout field decrement
    })
});
$("#productID").change(function(){
  alert('ok');
})
</script>