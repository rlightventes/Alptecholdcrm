<?php include 'header.php';?>
<style type="text/css">
    .list-unstyled{
      margin-top: 0px;
      background: #fff;
      color: #000;
    }
    .list-unstyled li{
      padding: 12px;
      cursor: pointer;
      color: black;
    }
   .list-unstyled li:hover{
      background: #f0f0f0;
    }
</style>
<div class="page-wrapper" >
   <div class="content container-fluid">
      <div class="row">
         <div class="col-sm-4 col-xs-3">
            <h4 class="page-title">New Quotation</small></h4>
         </div>
         <?php 
         
           if(isset($_POST['client'])):
                    $client = $_POST['client'];
                else:
                    $client = $_GET['client'];
                endif;
                ?>
         <div class="col-sm-8 col-xs-9 text-right m-b-20">
            <a href="qut_list.php?client=<?=$client?>" class="btn btn-primary rounded"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>
         </div>
      </div>
      <?php 
     
               $id = base64_decode($client);
               $mysqli->where('id', $id);
               $getUser = $mysqli->getOne(USER);
               $gstState = $getUser['state1'];
                $mysqli->orderBy('quot_id', 'desc');
                $getQt = $mysqli->getOne(QOT);
                $explodNo = explode('/', $getQt['quot_id']);
                $expNo = $explodNo['0'] + 1;
                $firstFour = substr($getAdmin['fname'], 0, 4);
                $empName = ucfirst($firstFour);
                $primary_id = str_pad($expNo, 3, '0', STR_PAD_LEFT);
                $qtDate = date('d/m/Y', time());
                $action = 'new';
                $subject = '';
                $qotNo = $primary_id.'/'.$empName.'/'.date('Y', time());
                $action = 'new';
                $terms = '<ul>
                        <li><span style="font-weight: normal;">Payment: 100% advance.</span></li>
                        <li><span style="font-weight: normal;">Installation/commisioning/training of the machine extra. Accomodation to be provided by the Client during installation.Minimum 3 star stay.</span></li>
                        <li><span style="font-weight: normal;">Freight forwarding extra from mumbai.</span></li>
                        <li><span style="font-weight: normal;">Warranty: 12 months spares warranty only due to manufacturing defects. Warranty not applicable for Electricals if stabilised Voltage not available and Pneumatic spares not covered if Compressor without dryer unit .</span></li>
                        <li><span style="font-weight: normal;">Packaging: standard with thermo retractable plastic film, suitable for transport by container.</span></li>
                        <li><span style="font-weight: normal;">Delivery : As per stock availability.</span></li>
                        <li><span style="font-weight: normal;">Wooden packing extra.</span></li>
                        <li><span style="font-weight: normal;">GST: extra  @18 percent or as per government tax laws.</span></li>
                        <li><span style="font-weight: normal;">All Import duties included.</span></li>
                        <li>Note: <span style="font-weight: normal;">above prices are ex mumbai. It includes all import taxes.</span></li>
                        <li>Validity :<span style="font-weight: normal;"> 4 weeks</span></li>
                      </ul>
                      <p><b>Bank Detail:</b> HDFC | <b>Branch:</b> Chembur<br><b>A/C Name:</b> Alptech International Pvt Ltd<br><b>A/C No.:</b> 50200038350243 | <b>IFSC Code:</b> HDFC0000013</p>';

      
      if(isset($_GET['edit'])){ $type = 'update';}else{$type = 'new'; } 
        
        //  print_r( $_SESSION['shopping_cart']);
      ?>
   
      <form method="post" action="ajax.php?action=multiQt&type=<?=$type?>" autocomleted="off">
      <div class="row" id="desktop_view">
         <div class="panel panel-body">
           
            <div class="col-md-8">
                <?php if(!empty($getData['com_name'])){?>  <b><?=$getData['com_name']?></b></br> <?php } ?>
	            <?php if(!empty($getData['co_name'])){?>    <b><?=$getData['co_name']?></b></br> <?php } ?>
	            <?php if(!empty($getData['address'])){?>    <b>Address:</b> <?=$getData['address']?></br> <?php } ?>
	            <?php if(!empty($getData['tel_no'])){?>    <b>Telephone No.:</b> <?=$getData['tel_no']?></br> <?php } ?>
	            <?php if(!empty($getData['email_id'])){?>    <b>Email.:</b> <?=$getData['email_id']?></br> <?php } ?>
	            <?php if(!empty($getData['web_address'])){?>   <b>Web.:</b> <?=$getData['web_address']?></br <?php } ?>
	            <?php if(!empty($getData['pan_no'])){?>   <b>PAN:</b> <?=$getData['pan_no']?> <?php } ?> <?php if(!empty($getData['gst_no'])){?> | <b>GST No.:</b> <?=$getData['gst_no']?><?php } ?>
               <br/><br/>
               <!--<b>ALPTECH INTERNATIONAL</b></br>-->
               <!--<b>C/O MENGI ENGINEERING COMPANY</b></br>-->
               <!--<b>Address:</b> Plot A-231, road no 21,<br/> Y Lane Wagle Industrial Area</br>-->
               <!--<b>Telephone No.:</b> 9769976747, 8828216747</br>-->
               <!--<b>Email.:</b> alptechinternational@gmail.com</br>-->
               <!--<b>Web.:</b> www.alptechindia.com</br>-->
               <!--<b>PAN:</b> AARCA9816A-->
               <b>To, </b><br/><b><?=$getUser['fname'].' '.$getUser['lname']?></b></br>  
               <b><?=$getUser['company_name']?></b></br>
               <b>Address:</b> <?=$getUser['address1']?></br>
               <?=$getUser['city1']?> <?=$getUser['state1']?> <?=$getUser['country1']?><br/>
               <b>Mobile No. :</b> <?=$getUser['contact1']?></br><b>Email. :</b> <?=$getUser['email']?><br/>
               <?php if(!empty($getUser['gst'])) { ?>
               <b>GST No. :</b> <?=$getUser['gst']?>
               <?php } ?>
            </div>
            <input type="hidden" name="client_id" value="<?=$id?>">
            <input type="hidden" name="company_name" value="<?=$getUser['company_name']?>">
            <input type="hidden" name="address" value="<?=$getUser['address1']?>">
            <input type="hidden" name="mobile_no" value="<?=$getUser['contact1']?>">
            <input type="hidden" name="email" value="<?=$getUser['email']?>">
             <input type="hidden" name="emp_id" value="<?=$userGetID?>">
            <div class="col-md-4 text-left">
               <br/>
               <img src="assets/img/alp_logo.png" width="250"><br/><br/><br/>
               <label>QT No.:</label>
               <input type="text" disabled class="form-control"placeholder="" required value="<?=$qotNo?>"><br/>
               <input type="hidden"  class="form-control"placeholder="" name="quot_id" required value="<?=$qotNo?>"><br/>
               <label>Date:</label>
               <input type="text" class="form-control datetimepicker" name="quotation_date" id="datepicker" value="<?=$qtDate?>"  placeholder="" required>
            </div>
            <div style="clear: both;"></div>
            <br/><br/>
            <div class="col-md-5 text-right">
                <label>Proposal From Alptech International</label> 
            </div>
            <div class="col-md-7 text-left">
                <input type="text" class="form-control"placeholder="" name="subject" required value="<?=$subject?>">
            </div>
             <div style="clear: both;"></div>
            <br/><br/>
            <table class="table table-stripped form-table" >
               <thead>
                  <tr>
                     <th style="background: #000; color: #fff; ">NO.</th>
                     <th style="background: #000; color: #fff;">PARTICULAR</th>
                     <th style="background: #000; color: #fff; text-align: left">QTY</th>
                     <th style="background: #000; color: #fff; text-align: left">UNIT</th>
                     <th style="background: #000; color: #fff; text-align: left">LIST PRICE</th>
                     <!--<th style="background: #000; color: #fff; text-align: left">TOTAL PRICE</th>-->
                     <th style="background: #000; color: #fff; text-align: left">DISCOUNT</th>
                     <th style="background: #000; color: #fff">NET AMOUNT</th>
                    
                     
                  </tr>
               </thead>
               <tbody>
                   <?php for($i=1; $i<=15; $i++){ ?>
                    <tr>
                     <td><?=$i?></td>
                     <td>
                        <input type="hidden" name="product_id[]" id="prID<?=$i?>" value="<?=$prID?>" />
                        <input type="text" value="" name="productName[]" class="form-control product" data-id="<?=$i?>" id="product<?=$i?>"/>
                        <div id="productList<?=$i?>" class="productList" data-id="<?=$i?>"></div>
                     </td>
                     <td><input type="text" value="" name="qty[]" class="form-control qty" data-id="<?=$i?>" id="qty<?=$i?>"></td>
                     <td><input type="text" value=""  name="unit[]" class="form-control" id="unit<?=$i?>"></td>
                     <td><input type="text" value=""   name="list[]" class="form-control list"  data-id="<?=$i?>" id="list<?=$i?>"> 
                     <input type="hidden" value=""  name="mrp[]" class="form-control mrp"  data-id="<?=$i?>" id="mrp<?=$i?>"></td>
                     <!--<td></td>-->
                     <td><input type="text" value=""   name="discount[]"  class="form-control list-discount" data-id="<?=$i?>"  id="list-discount<?=$i?>">
                     <input type="hidden" value="" class="form-control discount" data-id="<?=$i?>"  id="discount<?=$i?>"></td> 
                     <td><input type="text" value="" name="netAmt[]" class="form-control sale" data-id="<?=$i?>" id="sale<?=$i?>"></td>
                 </tr>
                 <?php } ?>
               </tbody>
               <tfoot>
                  <tr>
                     <td colspan="4" class="text-right">
                      <h4> TOTAL</h4>
                     </td>
                 
                     
                       <td class="text-center">
                         
                         <h4 id="totalMrpAmt1"><?=money_format('%!i', round($totalMrp))?></h4></td>
                   
                    <td class="text-center">
                         
                         <h4 id="totalDisAmt1"><?=money_format('%!i', round($totalDiscount))?></h4></td>  
                     <td class="text-center">
                        
                         <h4 id="totalSaleAmt1"><?=money_format('%!i', round($totalSale))?></h4></td>
                  </tr>
               </tfoot>
            </table>
            <hr/>
            <label>Terms and Condition</label>
            <textarea class="form-control" name="terms_conditions" id="editor"><?=$terms?></textarea>
            <div class="col-md-12 text-right">
               <button class="bth btn-primary btn-md">SUBMIT</button>
            </div>
         </div>
      </div>
      </form>
      <form method="post" action="ajax.php?action=multiQt&type=<?=$type?>">
        <div class="row" id="mobile_view">
            <div class="panel panel-body">
                <div class="col-xs-12">
                    <img src="assets/img/alp_logo.png" width="250"><br/><br/>
                    <?php if(!empty($getData['com_name'])){?>  <b><?=$getData['com_name']?></b></br> <?php } ?>
    	            <?php if(!empty($getData['co_name'])){?>    <b><?=$getData['co_name']?></b></br> <?php } ?>
    	            <?php if(!empty($getData['address'])){?>    <b>Address:</b> <?=$getData['address']?></br> <?php } ?>
    	            <?php if(!empty($getData['tel_no'])){?>    <b>Telephone No.:</b> <?=$getData['tel_no']?></br> <?php } ?>
    	            <?php if(!empty($getData['email_id'])){?>    <b>Email.:</b> <?=$getData['email_id']?></br> <?php } ?>
    	            <?php if(!empty($getData['web_address'])){?>   <b>Web.:</b> <?=$getData['web_address']?></br <?php } ?>
    	            <?php if(!empty($getData['pan_no'])){?>   <b>PAN:</b> <?=$getData['pan_no']?> <?php } ?> <?php if(!empty($getData['gst_no'])){?> | <b>GST No.:</b> <?=$getData['gst_no']?><?php } ?>
                    <br/><br/><b>To, </b><br/><b><?=$getUser['fname'].' '.$getUser['lname']?></b></br>  
               <b><?=$getUser['company_name']?></b></br>
               <b>Address:</b> <?=$getUser['address1']?></br>
               <?=$getUser['city1']?> <?=$getUser['state1']?> <?=$getUser['country1']?><br/>
               <b>Mobile No. :</b> <?=$getUser['contact1']?></br><b>Email. :</b> <?=$getUser['email']?><br/>
               <?php if(!empty($getUser['gst'])) { ?>
               <b>GST No. :</b> <?=$getUser['gst']?>
               <?php } ?><br/><br/>
                <input type="hidden" name="client_id" value="<?=$id?>">
            <input type="hidden" name="company_name" value="<?=$getUser['company_name']?>">
            <input type="hidden" name="address" value="<?=$getUser['address1']?>">
            <input type="hidden" name="mobile_no" value="<?=$getUser['contact1']?>">
            <input type="hidden" name="email" value="<?=$getUser['email']?>">
             <input type="hidden" name="emp_id" value="<?=$userGetID?>">
           
                    <label>QT No.:</label>
                    <input type="text" disabled class="form-control"placeholder="" required value="<?=$qotNo?>">
                    <input type="hidden"  class="form-control"placeholder="" name="quot_id" required value="<?=$qotNo?>"><br/>
                    <label>Date:</label>
                    <input type="text" class="form-control datetimepicker" name="quotation_date" id="datepicker" value="<?=$qtDate?>"  placeholder="" required>
                    <br/>
                    <label>Proposal From Alptech International</label><br/>
                    <input type="text" class="form-control"placeholder="" name="subject" required value="<?=$subject?>">
                 
                    <hr/>
                  </div>
                       
                  <?php for($i=1; $i<=2; $i++){ ?>     
                    <div class="form-group">
                    <div class="col-xs-12">
                        <label>Product name</label>
                    </div>
                    <div class="col-xs-12">
                        <input type="hidden" name="product_id[]" id="prIDD<?=$i?>" value="<?=$prID?>" />
                        <input type="text" value="" name="productName[]" class="form-control productt" data-id="<?=$i?>" id="productt<?=$i?>"/>
                        <div id="productListt<?=$i?>" class="productListt" data-id="<?=$i?>"></div>                    </div>    
                    <div style="clear:both"></div><br/>
                   
                 
                    <div class="col-xs-4"><label>Qty</label></div>
                    <div class="col-xs-8">
                        <input type="text" value="" name="qty[]" class="form-control qtyy" data-id="<?=$i?>" id="qtyy<?=$i?>">
                    </div>
                    <div style="clear:both"></div><br/>
                    <div class="col-xs-4"><label>Unit</label></div>
                    <div class="col-xs-8">
                        <input type="text" value=""  name="unit[]" class="form-control unitt" id="unitt<?=$i?>">
                    </div>
                    <div style="clear:both"></div><br/>
                    <div class="col-xs-4"><label>List Price</label></div>
                    <div class="col-xs-8">
                        <input type="text" value=""  name="list[]" class="form-control listt"  data-id="<?=$i?>" id="listt<?=$i?>">
                        <input type="hidden" value=""  name="mrp[]" class="form-control mrpp"  data-id="<?=$i?>" id="mrpp<?=$i?>">
                     </div>
                    <div style="clear:both"></div><br/>
                    <!--<div class="col-xs-4"><label>Total Price</label></div>-->
                    <!--<div class="col-xs-8">-->
                        
                    <!-- </div>-->
                    <!--<div style="clear:both"></div><br/>-->
                    <div class="col-xs-4"><label>Discount</label></div>
                    <div class="col-xs-8">
                        <input type="text" value=""   name="discount[]"  class="form-control list-discountt" data-id="<?=$i?>"  id="list-discount<?=$i?>">
                        <input type="hidden" value="" class="form-control discountt" data-id="<?=$i?>"  id="discount<?=$i?>">
                    </div>
                    <div style="clear:both"></div><br/>
                    <div class="col-xs-4"><label>Net Amount</label></div>
                    <div class="col-xs-8"><input type="text" value="" name="netAmt[]" class="form-control salee" data-id="<?=$i?>" id="salee<?=$i?>"></div>
                    </div>
                    <div style="clear:both"></div>
                    <br/><hr/>
                <div style="clear:both"></div>
                <?php } ?>
                  <hr/>
                  <div class="form-group">
                    <div class="col-xs-12"><h3>TOTAL</h3></div>
                    <div style="clear:both"></div><br/>
                    <div class="col-xs-4"><label>MRP Price</label></div>
                    <div class="col-xs-8"><h4 id="totalMrpAmtt1"><?=money_format('%!i', round($totalMrp))?></h4></div>
                    <div style="clear:both"></div><br/>
                    <div class="col-xs-4"><label>Discount</label></div>
                    <div class="col-xs-8"><h4 id="totalDisAmtt1"><?=money_format('%!i', round($totalDiscount))?></h4></div>
                    <div style="clear:both"></div><br/>
                    <div class="col-xs-4"><label>Net Amount</label></div>
                    <div class="col-xs-8"><h4 id="totalSaleAmtt1"><?=money_format('%!i', round($totalSale))?></h4></div>
                </div>
                    <div style="clear:both"></div>
                   <div class="col-xs-12"><label>Terms and Condition</label></div>
                    <div class="col-xs-12"><textarea class="form-control" name="terms_conditions" id="editor1"><?=$terms?></textarea></div>
 <div style="clear:both"></div><br/>
            <div class="col-md-12 ">
               <button class="bth btn-primary btn-md">SUBMIT</button>
            </div>
               
            </div>
        </div>
      </form>
   </div>
   <?php include 'messages.php';?>
</div>
</div>
<?php include 'footer.php';?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
  

  $(document).ready(function(){
      $(".product").on("keyup", function(){
          alert("ok");
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
          $('#productLiRst'+getID).fadeOut();
        }
      });

      // click one particular city name it's fill in textbox
      $(".productList").on("click", "li", function(e){
         
          
              e.preventDefault();
    var $this = $(this).parent();
    $this.addClass("select").siblings().removeClass("select");
           
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

        $('#qty'+getID).val('1');
        $('#product'+getID).val(getName);
        $('#prID'+getID).val(getPrId);
        $('#unit'+getID).val(nameUnit);
        $('#mrp'+getID).val(getMrp);
        $('#list'+getID).val(getMrp);
        $('#discount'+getID).val(getDiscount);
        $('#list-discount'+getID).val(getDiscount);
        $('#sale'+getID).val(getNet);
        $('#productList'+getID).fadeOut("fast");
        
        
         var sum = 0;
        $(".mrp").each(function(){
         sum += +$(this).val().replace(/,/g, '');
        });
        var totalSUM = (Math.round(sum)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalMrpAmt1").html(totalSUM);
        $("#totalMrpAmt").val(totalSUM);
        
      
        
        var sum1 = 0;
        $(".discount").each(function(){
         sum1 += +$(this).val().replace(/,/g, '');
        });
        var totalSUM1 = (Math.round(sum1)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalDisAmt").val(totalSUM1);
        $("#totalDisAmt1").html(totalSUM1);
     

        var sum3 = 0;
        $(".sale").each(function(){
         sum3 += +$(this).val().replace(/,/g, '');
        });
        var totalSUM3 = (Math.round(sum3)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalSaleAmt").val(totalSUM3);
        $("#totalSaleAmt1").html(totalSUM3);

      });

  });
 $(document).ready(function(){
      $(".productt").on("keyup", function(){
        var getID = $(this).attr('data-id');
        var productName = $("#productt"+getID).val();
        // alert("ol");
        if (productName !=="") {
          $.ajax({
            url:"ajax-product-search.php",
            type:"POST",
            cache:false,
            data:{city:productName, getID:getID},
            success:function(data){
                // alert(data);
              $('#productListt'+getID).html(data);
              $('#productListt'+getID).fadeIn();
            }  
          });
        }else{
          $('#productListt'+getID).html("");  
          $('#productLiRstt'+getID).fadeOut();
        }
      });

      // click one particular city name it's fill in textbox
      $(".productListt").on("click", "li", function(e){
         
          
              e.preventDefault();
    var $this = $(this).parent();
    $this.addClass("select").siblings().removeClass("select");
           
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

        $('#qtyy'+getID).val('1');
        $('#productt'+getID).val(getName);
        $('#prID'+getID).val(getPrId);
        $('#unitt'+getID).val(nameUnit);
        $('#mrpp'+getID).val(getMrp);
        $('#listt'+getID).val(getMrp);
        $('#discountt'+getID).val(getDiscount);
        $('#list-discountt'+getID).val(getDiscount);
        $('#salee'+getID).val(getNet);
        $('#productListt'+getID).fadeOut("fast");
        
        
         var sum = 0;
        $(".mrpp").each(function(){
         sum += +$(this).val().replace(/,/g, '');
        });
        var totalSUM = (Math.round(sum)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalMrpAmtt1").html(totalSUM);
        $("#totalMrpAmtt").val(totalSUM);
        
      
        
        var sum1 = 0;
        $(".discountt").each(function(){
         sum1 += +$(this).val().replace(/,/g, '');
        });
        var totalSUM1 = (Math.round(sum1)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalDisAmtt").val(totalSUM1);
        $("#totalDisAmtt1").html(totalSUM1);
     

        var sum3 = 0;
        $(".salee").each(function(){
         sum3 += +$(this).val().replace(/,/g, '');
        });
        var totalSUM3 = (Math.round(sum3)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalSaleAmtt").val(totalSUM3);
        $("#totalSaleAmtt1").html(totalSUM3);
           
       
  });
</script>
<script type="text/javascript">
    $(".productId").change(function(){
    var idSel = $(this).attr('id');
    var prVal = $("#"+idSel).val();
     var action = 'checkMRP';
  
  $.ajax({
     type: 'POST',
     url: 'ajax.php',
     data:{product:prVal,action:action},
     success:function(data){
      $valData = data.split('|');
      $("#qty"+idSel).val(1);
      $("#merp"+idSel).val($valData['0']);
      $("#mep"+idSel).val($valData['1']);
      $("#dis"+idSel).val(0);
      $("#net"+idSel).val($valData['1']);
       
       
   
     var sum = 0;
     $(".netAmt").each(function(){
         sum += +$(this).val().replace(/,/g, '');
     });
     $("#totalNet").html(sum);
     $("#totalNett").html(sum);
   
     var sum1 = 0;
     $(".dis").each(function(){
         sum1 += +$(this).val().replace(/,/g, '');
     });
     $("#totaldis").html(sum1);
   
     var sum2 = 0;
     $(".mep").each(function(){
         sum2 += +$(this).val().replace(/,/g, '');
     });
     $("#totalmrp").html(sum2);
     }
  });
   
      var sum = 0;
  $(".netAmt").each(function(){
  sum += +$(this).val().replace(/,/g, '');
  });
  // alert(sum);
  $("#totalNet").html(sum);
  // alert(prVal);
  });

    $(".qty").on('keyup blur', function(){
       // DESKTOP VIEW //
        var getID = $(this).attr('data-id');
        var qty = $("#qty"+getID).val();
        // var mrpRate = $("#mrp"+getID).val().replace(/,/g, '');
        var listRate = $("#list"+getID).val().replace(/,/g, '');
        // var disRate = $("#discount"+getID).val().replace(/,/g, '');
        var listDis = $("#list-discount"+getID).val().replace(/,/g, '');
        var saleRate = $("#sale"+getID).val().replace(/,/g, '');
        var disAmt =  +listRate * +qty;
        var multDis = +listDis * +qty;
        var netAmt = +disAmt - +multDis;
        
        $("#mrp"+getID).val(disAmt);
        $("#discount"+getID).val(multDis);
        
        var totalAmt = (Math.round(netAmt)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#sale"+getID).val(totalAmt);
        
        
        var sum = 0;
        $(".mrp").each(function(){
         sum += +$(this).val().replace(/,/g, '');
        });
        var totalSUM = (Math.round(sum)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalMrpAmt1").html(totalSUM);
        $("#totalMrpAmt").val(totalSUM);
        
        
        var sum1 = 0;
        $(".discount").each(function(){
         sum1 += +$(this).val().replace(/,/g, '');
        });
        
        var totalSUM1 = (Math.round(sum1)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalDisAmt").val(totalSUM1);
        $("#totalDisAmt1").html(totalSUM1);
        
        var sum3 = 0;
        $(".sale").each(function(){
         sum3 += +$(this).val().replace(/,/g, '');
        });
        var totalSUM3 = (Math.round(sum3)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalSaleAmt").val(totalSUM3);
        $("#totalSaleAmt1").html(totalSUM3);
        
       
    });
    
    $(".product").on('click keydown focus', function(){
        var getID = $(this).attr('data-id');
        var qty = $("#qty"+getID).val();
        var mrpRate = $("#mrp"+getID).val().replace(/,/g, '');
        var listRate = $("#list"+getID).val().replace(/,/g, '');
        var disRate = $("#discount"+getID).val().replace(/,/g, '');
        var saleRate = $("#sale"+getID).val().replace(/,/g, '');
        var disAmt =  +listRate * +qty;
        var netAmt = +disAmt - +disRate;
        
        
          $("#mrp"+getID).val(disAmt);
        var totalAmt = (Math.round(netAmt)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#sale"+getID).val(totalAmt);
       
       
        var sum = 0;
        $(".mrp").each(function(){
         sum += +$(this).val().replace(/,/g, '');
        });
        var totalSUM = (Math.round(sum)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalMrpAmt1").html(totalSUM);
        $("#totalMrpAmt").val(totalSUM);
        
        var sum1 = 0;
        $(".discount").each(function(){
         sum1 += +$(this).val().replace(/,/g, '');
        });
        var totalSUM1 = (Math.round(sum1)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalDisAmt").val(totalSUM1);
        $("#totalDisAmt1").html(totalSUM1);

        var sum3 = 0;
        $(".sale").each(function(){
         sum3 += +$(this).val().replace(/,/g, '');
        });
        var totalSUM3 = (Math.round(sum3)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalSaleAmt").val(totalSUM3);
        $("#totalSaleAmt1").html(totalSUM3);

    });
    
    $(".list-discount").on('keyup blur', function(){
        var getID = $(this).attr('data-id');
        var qty = $("#qty"+getID).val();
        var mrpRate = $("#mrp"+getID).val().replace(/,/g, '');
        var listRate = $("#list"+getID).val().replace(/,/g, '');
         
         var listDis = $("#list-discount"+getID).val().replace(/,/g, '');
        var saleRate = $("#sale"+getID).val().replace(/,/g, '');
        var disAmt =  +listRate * +qty;
        var multDis = +listDis * +qty;
        var netAmt = +disAmt - +multDis;
        
        $("#mrp"+getID).val(disAmt);
        $("#discount"+getID).val(multDis);
        
        
        
        
        var totalAmt = (Math.round(netAmt)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#sale"+getID).val(totalAmt);
        
        
       
        var sum = 0;
        $(".mrp").each(function(){
         sum += +$(this).val().replace(/,/g, '');
        });
        var totalSUM = (Math.round(sum)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalMrpAmt1").html(totalSUM);
        $("#totalMrpAmt").val(totalSUM);
        
        $("#totalMrpAmtt1").html(totalSUM);
        $("#totalMrpAmtt").val(totalSUM);
        
        var sum1 = 0;
        $(".discount").each(function(){
         sum1 += +$(this).val().replace(/,/g, '');
        });
        var totalSUM1 = (Math.round(sum1)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalDisAmt").val(totalSUM1);
        $("#totalDisAmt1").html(totalSUM1);
        
         $("#totalDisAmtt").val(totalSUM1);
        $("#totalDisAmtt1").html(totalSUM1);

        var sum3 = 0;
        $(".sale").each(function(){
         sum3 += +$(this).val().replace(/,/g, '');
        });
        var totalSUM3 = (Math.round(sum3)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalSaleAmt").val(totalSUM3);
        $("#totalSaleAmt1").html(totalSUM3);
        
        $("#totalSaleAmtt").val(totalSUM3);
        $("#totalSaleAmtt1").html(totalSUM3);

    });
    
    $(".mrp").on('keyup blur', function(){
        var getID = $(this).attr('data-id');
        var qty = $("#qty"+getID).val();
        var mrpRate = $("#mrp"+getID).val().replace(/,/g, '');
        var listRate = $("#list"+getID).val().replace(/,/g, '');
        var disRate = $("#discount"+getID).val().replace(/,/g, '');
        var saleRate = $("#sale"+getID).val().replace(/,/g, '');
        var disAmt =  +listRate * +qty;
        var netAmt = +disAmt - +disRate;
        
         $("#mrp"+getID).val(disAmt);
        var totalAmt = (Math.round(netAmt)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#sale"+getID).val(totalAmt);
        
        var sum = 0;
        $(".mrp").each(function(){
         sum += +$(this).val().replace(/,/g, '');
        });
        var totalSUM = (Math.round(sum)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalMrpAmt1").html(totalSUM);
        $("#totalMrpAmt").val(totalSUM);
        
        
        var sum1 = 0;
        $(".discount").each(function(){
         sum1 += +$(this).val().replace(/,/g, '');
        });
        var totalSUM1 = (Math.round(sum1)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalDisAmt").val(totalSUM1);
        $("#totalDisAmt1").html(totalSUM1);
        
       
        var sum3 = 0;
        $(".sale").each(function(){
         sum3 += +$(this).val().replace(/,/g, '');
        });
        var totalSUM3 = (Math.round(sum3)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalSaleAmt").val(totalSUM3);
        $("#totalSaleAmt1").html(totalSUM3);
       
    });
    $(".sale").on('keyup blur', function(){
        var getID = $(this).attr('data-id');
        var qty = $("#qty"+getID).val();
        var mrpRate = $("#mrp"+getID).val().replace(/,/g, '');
        var listRate = $("#list"+getID).val().replace(/,/g, '');
         var listDis = $("#list-discount"+getID).val().replace(/,/g, '');
        var saleRate = $("#sale"+getID).val().replace(/,/g, '');
        var disAmt =  +listRate * +qty;
        var multDis = +listDis * +qty;
        var netAmt = +disAmt - +multDis;
        
        $("#mrp"+getID).val(disAmt);
        $("#discount"+getID).val(multDis);
        
        // var disRate = $("#discount"+getID).val().replace(/,/g, '');
        // var saleRate = $("#sale"+getID).val().replace(/,/g, '');
        // var disAmt =  +listRate * +qty;
        // var netAmt = +disAmt - +saleRate;
        
          $("#mrp"+getID).val(disAmt);
                
        var totalAmt = (Math.round(netAmt)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#discount"+getID).val(totalAmt);
        
        
       
        var sum = 0;
        $(".mrp").each(function(){
         sum += +$(this).val().replace(/,/g, '');
        });
        var totalSUM = (Math.round(sum)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalMrpAmt1").html(totalSUM);
        $("#totalMrpAmt").val(totalSUM);
        
        var sum1 = 0;
        $(".discount").each(function(){
         sum1 += +$(this).val().replace(/,/g, '');
        });
        var totalSUM1 = (Math.round(sum1)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalDisAmt").val(totalSUM1);
        $("#totalDisAmt1").html(totalSUM1);
        
        var sum3 = 0;
        $(".sale").each(function(){
         sum3 += +$(this).val().replace(/,/g, '');
        });
        var totalSUM3 = (Math.round(sum3)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalSaleAmt").val(totalSUM3);
        $("#totalSaleAmt1").html(totalSUM3);
        
    });
    
    $(".productt").on('click keydown', function(){
        var getID = $(this).attr('data-id');
        var qty = $("#qtyy"+getID).val();
        var mrpRate = $("#mrpp"+getID).val().replace(/,/g, '');
        var listRate = $("#listt"+getID).val().replace(/,/g, '');
       
        var disRate = $("#discountt"+getID).val().replace(/,/g, '');
        var saleRate = $("#salee"+getID).val().replace(/,/g, '');
        var disAmt =  +listRate * +qty;
        var netAmt = +disAmt - +disRate;
                $("#mrpp"+getID).val(disAmt1);
    //    alert(getID);
        
        var totalAmt = (Math.round(netAmt)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#salee"+getID).val(totalAmt);
       
       
        var sum = 0;
        $(".mrp").each(function(){
         sum += +$(this).val().replace(/,/g, '');
        });
        var totalSUM = (Math.round(sum)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalMrpAmtt1").html(totalSUM);
        $("#totalMrpAmtt").val(totalSUM);
        
        var sum1 = 0;
        $(".discount").each(function(){
         sum1 += +$(this).val().replace(/,/g, '');
        });
        var totalSUM1 = (Math.round(sum1)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalDisAmtt").val(totalSUM1);
        $("#totalDisAmtt1").html(totalSUM1);

        var sum3 = 0;
        $(".sale").each(function(){
         sum3 += +$(this).val().replace(/,/g, '');
        });
        var totalSUM3 = (Math.round(sum3)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalSaleAmtt").val(totalSUM3);
        $("#totalSaleAmtt1").html(totalSUM3);

    });
    
    $(".qtyy").on('keyup blur', function(){
       // DESKTOP VIEW //
        var getID = $(this).attr('data-id');
        var qty = $("#qtyy"+getID).val();
        // var mrpRate = $("#mrp"+getID).val().replace(/,/g, '');
        var listRate = $("#listt"+getID).val().replace(/,/g, '');
        // var disRate = $("#discount"+getID).val().replace(/,/g, '');
        var listDis = $("#list-discountt"+getID).val().replace(/,/g, '');
        var saleRate = $("#salee"+getID).val().replace(/,/g, '');
        var disAmt =  +listRate * +qty;
        var multDis = +listDis * +qty;
        var netAmt = +disAmt - +multDis;
        
        $("#mrpp"+getID).val(disAmt);
        $("#discountt"+getID).val(multDis);
        
        var totalAmt = (Math.round(netAmt)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#salee"+getID).val(totalAmt);
        
        
        var sum = 0;
        $(".mrpp").each(function(){
         sum += +$(this).val().replace(/,/g, '');
        });
        var totalSUM = (Math.round(sum)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalMrpAmtt1").html(totalSUM);
        $("#totalMrpAmtt").val(totalSUM);
        
        
        var sum1 = 0;
        $(".discountt").each(function(){
         sum1 += +$(this).val().replace(/,/g, '');
        });
        
        var totalSUM1 = (Math.round(sum1)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalDisAmtt").val(totalSUM1);
        $("#totalDisAmtt1").html(totalSUM1);
        
        var sum3 = 0;
        $(".salee").each(function(){
         sum3 += +$(this).val().replace(/,/g, '');
        });
        var totalSUM3 = (Math.round(sum3)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalSaleAmtt").val(totalSUM3);
        $("#totalSaleAmtt1").html(totalSUM3);
        
    });
        
    $(".list-discountt").on('keyup blur', function(){
        var getID = $(this).attr('data-id');
        var qty = $("#qtyy"+getID).val();
        var mrpRate = $("#mrpp"+getID).val().replace(/,/g, '');
        var listRate = $("#listt"+getID).val().replace(/,/g, '');
         
         var listDis = $("#list-discountt"+getID).val().replace(/,/g, '');
        var saleRate = $("#salee"+getID).val().replace(/,/g, '');
        var disAmt =  +listRate * +qty;
        var multDis = +listDis * +qty;
        var netAmt = +disAmt - +multDis;
        
        $("#mrpp"+getID).val(disAmt);
        $("#discountt"+getID).val(multDis);
        
        
       
        
        
        var totalAmt = (Math.round(netAmt)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#salee"+getID).val(totalAmt);
        
       
        var sum = 0;
        $(".mrpp").each(function(){
         sum += +$(this).val().replace(/,/g, '');
        });
        var totalSUM = (Math.round(sum)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalMrpAmtt1").html(totalSUM);
        $("#totalMrpAmtt").val(totalSUM);
        
        var sum1 = 0;
        $(".discountt").each(function(){
         sum1 += +$(this).val().replace(/,/g, '');
        });
        var totalSUM1 = (Math.round(sum1)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalDisAmtt").val(totalSUM1);
        $("#totalDisAmtt1").html(totalSUM1);
        
         

        var sum3 = 0;
        $(".salee").each(function(){
         sum3 += +$(this).val().replace(/,/g, '');
        });
        var totalSUM3 = (Math.round(sum3)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalSaleAmtt").val(totalSUM3);
        $("#totalSaleAmtt1").html(totalSUM3);
        
       

    });
    
    $(".mrpp").on('keyup blur', function(){
        var getID = $(this).attr('data-id');
        var qty = $("#qtyy"+getID).val();
        var mrpRate = $("#mrpp"+getID).val().replace(/,/g, '');
        var listRate = $("#listt"+getID).val().replace(/,/g, '');
        var disRate = $("#discountt"+getID).val().replace(/,/g, '');
        var saleRate = $("#salee"+getID).val().replace(/,/g, '');
        var disAmt =  +listRate * +qty;
        var netAmt = +disAmt - +disRate;
        
       
        
       
         $("#mrpp"+getID).val(disAmt);
                
        var totalAmt = (Math.round(netAmt)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#salee"+getID).val(totalAmt);
        
       
       
        var sum = 0;
        $(".mrpp").each(function(){
         sum += +$(this).val().replace(/,/g, '');
        });
        var totalSUM = (Math.round(sum)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalMrpAmtt1").html(totalSUM);
        $("#totalMrpAmtt").val(totalSUM);
        
       
        
        var sum1 = 0;
        $(".discountt").each(function(){
         sum1 += +$(this).val().replace(/,/g, '');
        });
        var totalSUM1 = (Math.round(sum1)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalDisAmtt").val(totalSUM1);
        $("#totalDisAmtt1").html(totalSUM1);
        
      

        var sum3 = 0;
        $(".salee").each(function(){
         sum3 += +$(this).val().replace(/,/g, '');
        });
        var totalSUM3 = (Math.round(sum3)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        
        $("#totalSaleAmtt").val(totalSUM3);
        $("#totalSaleAmtt1").html(totalSUM3);

    });
    $(".salee").on('keyup blur', function(){
        var getID = $(this).attr('data-id');
        var qty = $("#qtyy"+getID).val();
        var mrpRate = $("#mrpp"+getID).val().replace(/,/g, '');
        var listRate = $("#listt"+getID).val().replace(/,/g, '');
         var listDis = $("#list-discountt"+getID).val().replace(/,/g, '');
        var saleRate = $("#sale"+getID).val().replace(/,/g, '');
        var disAmt =  +listRate * +qty;
        var multDis = +listDis * +qty;
        var netAmt = +disAmt - +multDis;
        
        $("#mrp"+getID).val(disAmt);
        $("#discount"+getID).val(multDis);
        
        
          $("#mrpp"+getID).val(disAmt);

        var totalAmt = (Math.round(netAmt)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#discountt"+getID).val(totalAmt);
        

        var sum = 0;
        $(".mrpp").each(function(){
         sum += +$(this).val().replace(/,/g, '');
        });
        var totalSUM = (Math.round(sum)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        
        $("#totalMrpAmtt1").html(totalSUM);
        $("#totalMrpAmtt").val(totalSUM);
        
        var sum1 = 0;
        $(".discountt").each(function(){
         sum1 += +$(this).val().replace(/,/g, '');
        });
        var totalSUM1 = (Math.round(sum1)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
        $("#totalDisAmtt").val(totalSUM1);
        $("#totalDisAmtt1").html(totalSUM1);

        var sum3 = 0;
        $(".salee").each(function(){
         sum3 += +$(this).val().replace(/,/g, '');
        });
        var totalSUM3 = (Math.round(sum3)).toFixed(2).replace(/(\d)(?=(\d{2})+\d\.)/g, '$1,');
       
        $("#totalSaleAmtt").val(totalSUM3);
        $("#totalSaleAmtt1").html(totalSUM3);

    });

    
   </script>
<script>
    $(document).ready(function() {
      $(".qty").bind("keypress", function () {
                      $(this).val($(this).val().replace(/[^0-9]/g, '')); 

      });
    });
    
</script>
<script>
    $(".delete").click(function(){
         if (confirm("Are you sure?")) {
        var colNam = 'id';
        var id = $(this).attr('id');
        var action = 'deleteProdQuot';
        var tab_name = '<?=QOT?>';
       // alert(colNam+id+action+tab_name);
        $.ajax({
            type:'POST',
            url:'ajax.php',
            data:{col_nam:colNam, id:id, action:action, tab_name:tab_name},
            success:function(data){
               // alert(data);
                window.location.href="add-quote.php?edit=<?=$_GET['edit']?>&client=<?=$_GET['client']?>";
            }
        });
       }  return false;
        //alert('ok');
    });
    
    
    
    $(".removeCart").click(function(){
       var action = 'removeCart';
       var idGet = $(this).attr("data-id");
      // alert(idGet);
       $.ajax({
           type:"POST",
           url:"ajax.php",
           data:{action:action,idGet:idGet},
           success:function(data){
              window.location.href="add-quote.php?edit=<?=$_GET['edit']?>&client=<?=$_GET['client']?>";
           }
       })
    });
     $(".removeCartNew").click(function(){
       var action = 'removeCart';
       var idGet = $(this).attr("data-id");
      // alert(idGet);
       $.ajax({
           type:"POST",
           url:"ajax.php",
           data:{action:action,idGet:idGet},
           success:function(data){
              window.location.href="add-quote.php";
           }
       })
    });
</script>
<script type="text/javascript">
//   $(function() {
//      $( "#productName" ).autocomplete({
//       source: 'ajax-product-search.php',
//      });
//   });
</script>


 