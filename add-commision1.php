<?php include 'header.php';?>
<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<?php 
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
            <h4 class="page-title">New Commisioning</small></h4>
         </div>
         <div class="col-sm-8 col-xs-9 text-right m-b-20">
            <a href="" class="btn btn-primary rounded"><i class="fa fa-list" aria-hidden="true"></i> Back</a>
         </div>
      </div>
      <form method="post" action="ajax.php?action=commission">
      <div class="row">
         <div class="panel panel-body">
            <div class="col-md-12 text-center">
              <img src="assets/img/alp_logo.png" width="200"><br/><br/>
              <b>ALPTECH INTERNATIONAL PVT LTD</b></br>
              <b>Plot A-231, road no 21, Y Lane Wagle Industrial Area, Thane - 400 604</b><br/><br>
              <br>
            </div>
            <div class="col-md-6 text-left">
               <label>Service Report No:</label>
               <input type="text" class="form-control" name="service_no" placeholder="" required value=""><br/>
            </div>
            <div class="col-md-6 text-left">
              <div class="col-md-6"><br>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <label>Commissioning: </label>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                  <input type="checkbox" class="" name="commission" placeholder=""  value="1">   
                </div>
              </div>
              <div class="col-md-6"><br>
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <label>AMC: </label>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                  <input type="checkbox" class="" name="amc" placeholder=""  value="1">
                </div>
              </div>
              <div class="col-md-6">
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <label>Service/Breakdown:</label>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                  <input type="checkbox" class="" name="service_breakdown" placeholder=""  value="1">  
                </div>
              </div>
              <div class="col-md-6">
                <div class="col-md-9 col-sm-9 col-xs-9">
                  <label>Inspection/General: </label>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                  <input type="checkbox" class="" name="inspect_gen" placeholder=""  value="1">
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-6" style="padding-top: 20px;">
              <input type="hidden" class="" name="client_id" placeholder="" required value="<?=base64_decode($_GET['client'])?>">
              <h4><?=$getUser['company_name']?></h4>
              <p><b>M/s <?=$getUser['fname'].' '.$getUser['lname']?></b><br>
                <?=$getUser['address1'].',<br/> '.$getUser['state1'].', '.$getUser['city1'].', '.$getUser['country1']?> <br/>
                Tel: <?=$getUser['contact1']?><br>
                <?php 
                if (empty($getUser['gst'])) {
                  echo '';
                }else{
                  echo 'Gstin: '.$getUser['gst'];
                }
                ?>
              </p>
            </div>
            <div class="col-md-6" style="padding-top: 20px;">
              <div class="col-md-12">
                <p><b>Contact Person: <?=$getUser['fname'].' '.$getUser['lname']?></b></p>
              </div>
              <div class="col-md-12">
                <p><b>Mobile No: <?=$getUser['contact1']?></b></p>
                <p><b>Email Id: <?=$getUser['email']?></b></p>
              </div>
              <div class="col-md-12">
                <p><b>Complaint No: </b><input type="text" name="complaint_no" class="form-control"placeholder="" required value=""></p>
                <p><b>Complaint Date:</b>
               <input type="text" class="form-control datetimepicker" name="complaint_date" id="datepicker" value="<?=$qtDate?>"  placeholder="" required><br/></p>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12" id="overflow">
              <table class="table table-bordered table-hover" id="tab_logic">
                <thead>
                  <tr>
                    <th style="background: #000; color: #fff" class="text-center"> #No </th>
                    <th style="background: #000; color: #fff; text-align: center">Machine Type</th>
                    <th style="background: #000; color: #fff; text-align: center">Machine Name</th>
                    <th style="background: #000; color: #fff">Remark</th>
                  </tr>
                </thead>
                <tbody>
                  <tr id='addr0'>
                    <td>1</td>
                    <td><input type="text" name='machine_type[]'  placeholder='Enter Machine Type' class="form-control"/></td>
                    <td><input type="text" name='machine_name[]' placeholder='Enter Machine Name' class="form-control qty" step="0" min="0"/></td>
                    <td><input type="text" name='remark[]' placeholder='Remark' class="form-control" /></td>
                  </tr>
                  <tr id='addr1'></tr>
                </tbody>
              </table>
              <div class="row clearfix">
                <div class="col-md-12">
                  <a id="add_row" class="btn btn-default pull-left">Add Row</a>
                  <a id='delete_row' class="pull-right btn btn-default">Delete Row</a>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <br/>
              <h4><b>Work Carried Out: </b></h4>
              <textarea rows="4" id="editor"  cols="5" class="form-control summernote" name="work_carried" value="" placeholder="Enter your message here" style="background: #fff"></textarea>
              <br/>
            </div>
            <div class="col-md-12">
              <h4><b>Engineer's Recommendations: </b></h4>
              <textarea rows="4" id="editor1"  cols="5" class="form-control summernote" name="recommendations" placeholder="Recommendations"></textarea>
              <br/>
            </div>
            <div class="col-md-12">
              <h4><b>Spares Used (if any): </b></h4>
              <ul style="list-style: none;">
                <li></li>
              </ul><br><br>
            </div>
            <div class="col-md-12">
              <table class="table table-stripped">
                <tbody>
                  <tr>
                    <td width="50%"><b>Engineer Attended:<br/>
                      <input type="text" class="form-control" name="eng_name" placeholder="" required value="">
                    </b></td>
                    <td width="50%"><b>No of Days taken: <input type="number" name="no_days" class="form-control"placeholder="" required value=""></b></td>
                  </tr>
                  <tr>
                    <td width="50%"><b>Date of Attendance: 
                    <input type="text" class="form-control datetimepicker" name="attendance" placeholder="" required value=""></b></td>
                    <td width="50%"><b>Invoice Number: <input type="text" name="invoice_no" class="form-control"placeholder="" required value=""></b></td>
                  </tr>
                  <tr>
                    <td width="50%"><b>Mode of travel: 
                      <input type="text" class="form-control" name="mode_travel" placeholder="" required value="">
                    </b></td>
                    <td width="50%"><b>Invoice Date: 
                      <input type="text" class="form-control datetimepicker" name="invoice_date" placeholder="" required value="">
                    </b></td>
                  </tr>
                  <tr>
                    <td width="50%"><b>Mode of Kms:
                      <input type="text" class="form-control" name="mode_kms" placeholder="" required value="">
                    </b></td>
                    <td width="50%"><b>Amount Payable: 
                      <input type="number" class="form-control" name="amt" placeholder="" required value="">
                    </b></td>
                  </tr>
                </tbody>
              </table>
              <br/>
            </div>
            <div class="col-md-12">
              <h4>Customers Feedback</h4>
              <textarea rows="4" id="editor2"  cols="5" class="form-control summernote" name="feedback"></textarea>
            </div>
            <div class="col-md-12">
              <h4>Comments</h4>
              <textarea rows="4" cols="5" class="form-control summernote" name="comments" placeholder=""></textarea>
              <br>
            </div>
            <div class="clearfix"></div>
            <br/>
            <div class="col-md-6">
              <h4>Engineer Sign</h4>
            </div>
            <div class="col-md-6">
              <h4>Customer Signature & Stamp</h4>
            </div><br><br>
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
  
   $(".netAmt").keyup(function(){
     var netAmt = $(this).attr("data-id");
     var netVal = $("#net"+netAmt).val().replace(/,/g, '');
     var mepVal = $("#merp"+netAmt).val().replace(/,/g, '');
     var disAmount = +mepVal - +netVal;
   
     $("#dis"+netAmt).val(disAmount);
     
     var sum = 0;
     $(".netAmt").each(function(){
         sum += +$(this).val().replace(/,/g, '');
     });
     $("#totalNet").html(sum);
   
     var sum1 = 0;
     $(".dis").each(function(){
         sum1 += +$(this).val().replace(/,/g, '');
     });
     $("#totaldis").html(sum1);
   
     var sum2 = 0;
     $(".mep").each(function(){
         sum2 += +$(this).val().replace(/,/g, '');
     });
     
      var sum3 = 0;
     $(".merp").each(function(){
         sum3 += +$(this).val().replace(/,/g, '');
     });
     $("#totalmrp").html(sum2);
   
   });
   
    $(".dis").keyup(function(){
     var getID = $(this).attr("data-id");
     var listAmt = $("#list"+getID).val().replace(/,/g, '');
     var saleAmt = $("#sale"+getID).val().replace(/,/g, '');
     var disAmt = $("#dis"+getID).val().replace(/,/g, '');
     var disAmount = +listAmt - +disAmt;
        $("#dis"+getID).val(disAmt);
        $("#net"+getID).val(disAmount);
     
     var sum = 0;
     $(".net").each(function(){
         sum += +$(this).val().replace(/,/g, '');
     });
     $("#totalNet").html(sum);
   
     var sum1 = 0;
     $(".dis").each(function(){
         sum1 += +$(this).val().replace(/,/g, '');
     });
     $("#totaldis").html(sum1);
   
     var sum2 = 0;
     $(".sale").each(function(){
         sum2 += +$(this).val().replace(/,/g, '');
     });
     
      var sum3 = 0;
     $(".list").each(function(){
         sum3 += +$(this).val().replace(/,/g, '');
     });
     $("#totalmrp").html(sum2);
   
   });
    
    $(".list").keyup(function(){
     var getID = $(this).attr("data-id");
     var listAmt = $("#list"+getID).val().replace(/,/g, '');
     var saleAmt = $("#sale"+getID).val().replace(/,/g, '');
     var disAmt = +listAmt - +saleAmt;
     var disAmount = +listAmt - +disAmt;
        $("#dis"+getID).val(disAmt);
        $("#net"+getID).val(disAmount);

     var sum = 0;
     $(".net").each(function(){
         sum += +$(this).val().replace(/,/g, '');
     });
     $("#totalNet").html(sum);
   
     var sum1 = 0;
     $(".dis").each(function(){
         sum1 += +$(this).val().replace(/,/g, '');
     });
     $("#totaldis").html(sum1);
   
     var sum2 = 0;
     $(".sale").each(function(){
         sum2 += +$(this).val().replace(/,/g, '');
     });
     
     var sum3 = 0;
     $(".list").each(function(){
         sum3 += +$(this).val().replace(/,/g, '');
     });
     
     $("#totalmerp").html(sum3);
   });
   
   $(".sale").keyup(function(){
       
    var getID = $(this).attr("data-id");
    var listAmt = $("#list"+getID).val().replace(/,/g, '');
    var saleAmt = $("#sale"+getID).val().replace(/,/g, '');
    var disAmt = +listAmt - +saleAmt;
    var disAmount = +listAmt - +disAmt;
        $("#dis"+getID).val(disAmt);
        $("#net"+getID).val(disAmount);
       
   
     var sum = 0;
     $(".net").each(function(){
         sum += +$(this).val().replace(/,/g, '');
     });
     $("#totalNet").html(sum);
   
     var sum1 = 0;
     $(".dis").each(function(){
         sum1 += +$(this).val().replace(/,/g, '');
     });
     $("#totaldis").html(sum1);
   
     var sum2 = 0;
     $(".sale").each(function(){
         sum2 += +$(this).val().replace(/,/g, '');
     });
     
      var sum3 = 0;
     $(".list").each(function(){
         sum3 += +$(this).val().replace(/,/g, '');
     });
     
     $("#totalmrp").html(sum2);
   });
   
</script>
<script type="text/javascript">
//     $(".dis").blur(function(){
//         var getID = $(this).attr('data-id'); 
//         var disAmt = $("#dis"+getID).val().replace(/,/g, '');
//         var listAmt = $("#merp"+getID).val().replace(/,/g, '');
//         var netAmt = listAmt - disAmt;
//         $("#net"+getID).val(netAmt);
//     });
//   $("#dis_per").blur(function(){
//      var dis_per = $(this).val();
//      var mrp_amt = $("#mrp_amt").val().replace(/,/g, '');
//      var amount = mrp_amt * dis_per / 100;
//      var rAmt = Math.round(amount);
//      $("#dis_amt").val(rAmt);
//   });
//     $("#dis_amt").blur(function(){
//      var dis_amt = $(this).val().replace(/,/g, '');
//      var mrp_amt = $("#mrp_amt").val().replace(/,/g, '');
//      var amount = dis_amt * 100 / mrp_amt;
//      var rAmt = Math.round(amount);
//      $("#dis_per").val(rAmt);
//   });
//      $("#mrp_amt").blur(function(){
//      var mrp_amt = $(this).val().replace(/,/g, '');
//      var dis_per = $("#dis_per").val();
//      var amount = mrp_amt * dis_per / 100;
//      var rAmt = Math.round(amount);
//      $("#dis_amt").val(rAmt);
//   });
</script>
<script>
    $(".delete").click(function(){
         if (confirm("Are you sure?")) {
        var colNam = 'id';
        var id = $(this).attr('id');
        var action = 'deleteProd';
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
    })
</script>
<script type="text/javascript">
  $(document).ready(function(){
    var i=1;
    $("#add_row").click(function(){b=i-1;
        $('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
        $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
        i++; 
    });
    $("#delete_row").click(function(){
      if(i>1){
    $("#addr"+(i-1)).html('');
    i--;
    }
    calc();
  });
});

</script>