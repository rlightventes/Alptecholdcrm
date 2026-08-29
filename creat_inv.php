<?php
    include_once '../common.php';
	$lead = base64_decode($_GET['qtID']);
	$mysqli->where('id', $lead);
	$getEnq = $mysqli->getOne(INV);
	extract($getEnq);
    $mysqli->where('id', $client_id);
	$getUser = $mysqli->getOne(USER);
	$gstState = $getUser['state1'];
	$client = base64_encode($getUser['id']);
    $getData = $mysqli->getOne(SETT);
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <style>
 
    @page { margin: 160px 25px 100px; }
    header { position: fixed; height:120px; top: -130px; left: 0px; right: 0px;  text-align: center; border-bottom:2px solid #000; }
    footer{position:fixed; bottom:0px; text-align:center; border-top:1px solid #000; }
     { page-break-after: always; margin-top:200px;}
    section:last-child { page-break-after: never; }
  </style>
    </head>
    <body>
    <header><img src="assets/img/alp_logo.png" width="200"><h5 style="font-size: 13px;letter-spacing: 1px; margin-top:5px; margin-bottom: 0px;"><?php if(!empty($getData['com_name'])){ echo $getData['com_name']; } ?></h5><h4 style="font-size:12px;margin-top:5px;font-weight: 400;"><?php if(!empty($getData['address'])){?>    <b>Address:</b> <?=$getData['address']?> <?php } ?>  | <b>Telephone No.:</b> <?php if(!empty($getData['tel_no'])){?>  <?=$getData['tel_no']?></br> <?php } ?> / 22-25823203 <br><b>Email:</b> <?php if(!empty($getData['email_id'])){ echo $getData['email_id']; } ?> | <b>Web.:</b><?php if(!empty($getData['web_address'])){ echo $getData['web_address']; } ?> <?php if(!empty($getData['pan_no'])){?>  | <b>PAN:</b> <?=$getData['pan_no']?> <?php } ?> <?php if(!empty($getData['gst_no'])){?> | <b>GST No.: </b>  <?=$getData['gst_no']?><?php } ?></h4></header>
    <footer><h4 style="font-size:12px;margin-top:5px;font-weight: 400;"><b>Sale Office: </b>Office No 9 Gound Floor Sakhi House, Trombay Road, Chembur East, Mumbai - 400071. | <b>Warehouse:</b> Gala No 9, A 6 Block, Padmini Complex Off Kalher Naka, Bhiwandi. | <b>Telephone No.: </b>91 9769976747 | <b>Email: </b> alptechinternational@gmail.com </h4></footer>
   
        <div class="container" >
            <div class="row">
                <div style="width:100%; text-align:center; font-size:11px; font-weight:bold">PROFORMA  INVOICE</div>
                <div style="width:60%; float:left; line-height:14px; font-size:11px">
				<p style="margin-top:5px"><b><?=$getUser['fname'].' '.$getUser['lname']?></b></p>  
				<p style="margin-top:-5px"><b><?=$getUser['company_name']?></b></p>
				<p style="margin-top:-5px"><b>Address:</b> <?=$getUser['address1']?></br><?=$getUser['city1']?> <?=$getUser['state1']?> <?=$getUser['country1']?><br/></p>
				<p style="margin-top:-5px"><b>Mobile No. :</b> <?=$getUser['contact1']?> | <b>Email. :</b> <?=$getUser['email']?></p>
					<?php if(!empty($getUser['gst'])) { ?><p style="margin-top:-5px"><b>GST No. :</b> <?=$getUser['gst']?></p> <?php } ?>
                </div>
                <div style="width:45%;float:right; text-align:right; line-height:14px; font-size:11px">
                    <p style="margin-top:5px"><b>PF Invoice No.:</b> <?=$inv_no?><p/>
                    <p style="margin-top:-5px"><b>PF Invoice Date:</b> <?=date('d/m/Y', strtotime($inv_date))?><p/>
                    <p style="margin-top:-5px"><b>So No.:</b> <?=$so_no?> | <b>So Date:</b> <?=$so_date?><p/>
                    <p style="margin-top:-5px"><b>Challan No.:</b> <?=$ch_no?> | <b>Challan Date:</b> <?=$ch_date?><p/>

               
                </div>
                <div style="clear:both"></div>
                <div style="width:100%;float:left; text-align:left; line-height:14px; font-size:11px">
                    <p><b>Place of supply to:  </b><?=$supply_to?></p>
                    <?php if(!empty($tax_pay)){ ?><p><b>Tax is Payable on Reverse Charge:  </b><?=$tax_pay?></p><?php } ?>
                </div>
                <div style="clear:both"></div>
                <div  style="width:100%; float:left; text-align:center; line-height:14px; font-size:11px;  padding-top:10px">
                    <table style="width:100%" cellspacing="0" cellpadding="0" style="font-size:11px">
                        <tr>
                            <th style="padding:5px 10px; border-top:1px solid #000; border-bottom:1px solid #000">NO.</th>
                            <th style="padding:5px 10px; border-top:1px solid #000; border-bottom:1px solid #000">PARTICULAR</th>
                            <th style="padding:5px 10px; border-top:1px solid #000; border-bottom:1px solid #000">HSN</th>
                            <th style="padding:5px 10px; border-top:1px solid #000; border-bottom:1px solid #000">QTY</th>
                            <th style="padding:5px 10px; border-top:1px solid #000; border-bottom:1px solid #000">UNIT</th>
                            <th style="padding:5px 10px; border-top:1px solid #000; border-bottom:1px solid #000">SALE PRICE</th>
                            <th style="padding:5px 10px; border-top:1px solid #000; border-bottom:1px solid #000">TOTAL AMOUNT</th>
                             <?php if(in_array($gstState,  array('Maharashtra', 'maharashtra', 'MAHARASHTRA'))){ ?> 
						    <th style="padding:5px 10px; border-top:1px solid #000; border-bottom:1px solid #000">CGST %</th>
						    <th style="padding:5px 10px; border-top:1px solid #000; border-bottom:1px solid #000">SGST %</th>
						                    <?php }else{?>
						    <th style="padding:5px 10px; border-top:1px solid #000; border-bottom:1px solid #000">IGST %</th>
						                    <?php }?>
                            <th style="padding:5px 10px; border-top:1px solid #000; border-bottom:1px solid #000">GST AMOUNT</th>
                            <th style="padding:5px 10px; border-top:1px solid #000; border-bottom:1px solid #000">NET AMOUNT</th>
                        </tr>
                        <?php 
		                $sr = '1';
		                $total = '0';
		                $gstVal = '0';
		                $gstAmt = '0';
		                $netAmt = '0';
		                $mysqli->where('inv_no', $lead);
		                $getProduct = $mysqli->get(INHIS);
		                foreach ($getProduct as $allEnq) {
		                   $total += str_replace(',', '', $allEnq['dis_amt']);
		                   $gstAmt += str_replace(',', '', $allEnq['gst_amt']);
		                   $netAmt += str_replace(',', '', $allEnq['net_amt']);
		                   ?>                        
						<tr>
                            <td style="padding:5px 10px"><?=$sr++?></td>
                            <td style="padding:5px 10px"><?=$allEnq['product_name']?></td>
                            <td style="padding:5px 10px"><?=$allEnq['hsn']?></td>
                            <td style="padding:5px 10px"><?=$allEnq['qty']?></td>
                            <td style="padding:5px 10px"><?=$allEnq['unit']?></td>
                            <td style="padding:5px 10px"><?=$allEnq['sale_rate']?>.00</td>
                            <td style="padding:5px 10px"><?=$allEnq['dis_amt']?></td>
                            <?php if(in_array($gstState,  array('Maharashtra', 'maharashtra', 'MAHARASHTRA'))){ ?> 
						    <td style="padding:5px 10px; text-align:center"><?=$allEnq['cgst']?></td>
						    <td style="padding:5px 10px; text-align:center"><?=$allEnq['sgst']?></td>
						    <?php }else{?>
						    <td style="padding:5px 10px; text-align:center"><?=$allEnq['igst']?></td>
						    <?php }?>
                            <td style="padding:5px 10px"><?=$allEnq['gst_amt']?></td>
                            <td style="padding:5px 10px"><?=$allEnq['net_amt']?></td>
                        </tr>
                        	<?php } 
                        	?>
                        <tr>
                            <th colspan="6" style="padding:5px 10px; text-align:right; border-top:2px solid #000; border-bottom:1px solid #000">TOTAL</th>
                            <td style="padding:5px 10px; border-top:2px solid #000; border-bottom:1px solid #000"><?=money_format('%!i', round($total))?></td>
                            		
										  <?php if(in_array($gstState,  array('Maharashtra', 'maharashtra', 'MAHARASHTRA'))){ ?> 
                     <td style="padding:5px 10px; border-top:2px solid #000; border-bottom:1px solid #000" colspan="2"></td>
                     <?php }else{?>
                     <td style="padding:5px 10px; border-top:2px solid #000; border-bottom:1px solid #000"></td>
                     <?php }?>
                            <td style="padding:5px 10px; border-top:2px solid #000; border-bottom:1px solid #000"><?=money_format('%!i', round($gstAmt))?></td>
                            <td style="padding:5px 10px; border-top:2px solid #000; border-bottom:1px solid #000"><?=money_format('%!i', round($netAmt))?></td>
                        </tr>
                        
                        
                    </table>
                    
                </div>
                <div style="clear:both"></div><br/>
                <div style="width:100%;float:left; text-align:left; line-height:14px; font-size:11px; margin-top:10px">
                    <p><b>Terms & Conditions:</b></p>
												<?php if(!empty($terms_conditions)){
												    echo $terms_conditions;
												}else{ ?>
												<ul style="margin-left: -20px">
	<li>Payment: 100% advance.</li>
	<li style="margin-top: 5px">Installation/commisioning/training of the machine extra. Accomodation to be provided by the Client during installation.Minimum 3 star stay.</li>
	<li style="margin-top: 5px">Freight forwarding extra from mumbai.</li>
	<li style="margin-top: 5px">Warranty period-12 months for spares 12 months for service.</li>
	<li style="margin-top: 5px">Packaging: standard with thermo retractable plastic film, suitable for transport by container.</li>
	<li style="margin-top: 5px">Delivery- Immediate.</li>
	<li style="margin-top: 5px">Wooden packing extra.</li>
	<li style="margin-top: 5px">GST@18%:as applicable.</li>
	<li style="margin-top: 5px">All Import duties included.</li>
	<li style="margin-top: 5px">Note: above prices are ex mumbai. It includes all import taxes.</li>
	<li style="margin-top: 5px">Validity : 4 weeks</li>
</ul>

<p><b>Bank Detail:</b> PUNJAB NATIONAL BANK |<br><b>Branch:</b> Chembur<br><b>A/C Name:</b> Alptech International Pvt Ltd<br><b>A/C No.:</b> 0077002102304473 <br><b>IFSC Code:</b> PUNB0007700</p><?php } ?>
                </div>
            </div>
        </div>
    </body>
</html>