<?php include 'header.php';?>
            <div class="page-wrapper">
                <div class="content container-fluid">
                    <?php
						$lead = base64_decode($_GET['lead']);
						$mysqli->where('id', $lead);
						$getEnq = $mysqli->getOne(QOT);
						extract($getEnq);
						 $id;
						$mysqli->where('id', $client_id);
						$getUser = $mysqli->getOne(USER);
						$client = base64_encode($getUser['id']);
						$mysqli->where('id', $product_id);
						$getProduct = $mysqli->getOne(PRODUCT);

					 ?>
					<div class="row">
						<div class="col-sm-8">
							<h4 class="page-title">Estimate</h4>
						</div>
						<div class="col-sm-4 text-right m-b-30">
							<div class="btn-group btn-group-sm">
								<!-- <button class="btn btn-default">CSV</button>
								<button class="btn btn-default">PDF</button> -->
								<!--<a href="mailSend.php?qtID=<?=$_GET['lead']?>" class="btn btn-default"><i class="fa fa-envelope-o fa-lg"></i> Mail</a>-->
								<a href="mailAttach.php?qtID=<?=$_GET['lead']?>" class="btn btn-default"><i class="fa fa-envelope-o fa-lg"></i> Mail</a>
								<a href="convert_qot.php?qtID=<?=$_GET['lead']?>" class="btn btn-default" target="_blank"><i class="fa fa-file-pdf-o fa-lg"></i> PDF</a>
								<a href="edit-auto-quot.php?edit=<?=$_GET['lead']?>&client=<?=$client?>" class="btn btn-default"><i class="fa fa-edit fa-lg"></i> Edit</a>
								<button class="btn btn-default" id="print_btn"><i class="fa fa-print fa-lg"></i> Print</button>
							</div>
						</div>
					</div>
					
					<div class="row" id="desktop_view">
						<div class="col-md-12">
							<div class="panel" style="box-shadow: none;">
								<div class="panel-body" >
									<div>
										<?php 
							if(isset($_GET['msg'])):
								if($_GET['msg'] == 'fail'):
							?>
							<div class="alert alert-warning" id="msg">
							Opps So Sorry!! <br/>Mail not delivered.
							</div>
						<?php else: ?>
								<div class="alert alert-success" id="msg">
							
					Mail send successful.
							</div>
						<?php endif; endif;?>
									<div class="row" id="DivIdToPrint" style="padding: 20px">
						<table style="width: 100%; " class="qotV ">
										<tr>
											<td colspan="4" style="padding-bottom: 10px">
											   <?php if(!empty($getData['com_name'])){?>  <b><?=$getData['com_name']?></b></br> <?php } ?>
									           <?php if(!empty($getData['co_name'])){?>    <b><?=$getData['co_name']?></b></br> <?php } ?>
									           <?php if(!empty($getData['address'])){?>    <b>Address:</b> <?=$getData['address']?></br> <?php } ?>
									           <?php if(!empty($getData['tel_no'])){?>    <b>Telephone No.:</b> <?=$getData['tel_no']?></br> <?php } ?>
									           <?php if(!empty($getData['email_id'])){?>    <b>Email.:</b> <?=$getData['email_id']?></br> <?php } ?>
									            <?php if(!empty($getData['web_address'])){?>   <b>Web.:</b> <?=$getData['web_address']?></br <?php } ?>
									            <?php if(!empty($getData['pan_no'])){?>   <b>PAN:</b> <?=$getData['pan_no']?> <?php } ?> <?php if(!empty($getData['gst_no'])){?> | <b>GST No.:</b> <?=$getData['gst_no']?><?php } ?><br/><br/> 
									               <!--<b>ALPTECH INTERNATIONAL</b></br>-->
									               <!--<b>C/O MENGI ENGINEERING COMPANY</b></br>-->
									               <!--<b>Address:</b> Plot A-231, road no 21,<br/> Y Lane Wagle Industrial Area</br>-->
									               <!--<b>Telephone No.:</b> 9769976747, 8828216747</br>-->
									               <!--<b>Email.:</b> alptechinternational@gmail.com</br>-->
									               <!--<b>Web.:</b> www.alptechindia.com</br>-->
									               <!--<b>PAN:</b> AARCA9816A<br/><br/>-->
									               <b>To, </b><br/><b><?=$getUser['fname'].' '.$getUser['lname']?></b></br>  
									               <b><?=$getUser['company_name']?></b></br>
									               <b>Address:</b> <?=$getUser['address1']?></br><?=$getUser['city1']?> <?=$getUser['state1']?> <?=$getUser['country1']?></br>
									               <b>Mobile No. :</b> <?=$getUser['contact1']?> | <b>Email. :</b> <?=$getUser['email']?> <br/>
									               <?php if(!empty($getUser['gst'])) { ?><b>GST No. :</b> <?=$getUser['gst']?><?php } ?>
           									</td>
           									<td colspan="3"  style="vertical-align: top; text-align: right">
           										 	<img src="assets/img/alp_logo.png" width="200"><br/><br/><br/><br/><br/><br/><br/><br/><br/>
               										<label>QT No.:</label> <?=$quot_id?><br/>
               										<label>Date:</label> <?=date('d/m/Y', strtotime($quotation_date))?>
           									</td>
										</tr>
										<tr>
										    <td colspan="7" style="background:#fff; padding:20px; text-align:center"><b>Proposal From Alptech International <?=$subject?></b></td>
										</tr>
										<tr>
						                    <th style="background: #000; color: #fff; padding: 10px; ">NO.</th>
						                    <th style="background: #000; color: #fff">PARTICULAR</th>
						                    <th style="background: #000; color: #fff; text-align: left">QTY</th>
						                    <th style="background: #000; color: #fff; text-align: left">UNIT</th>
						                    <th style="background: #000; color: #fff; text-align: left">LIST PRICE</th>
						                    <!--<th style="background: #000; color: #fff; text-align: left">TOTAL PRICE</th>-->
						                    <th style="background: #000; color: #fff">DISCOUNT</th>
						                    <th style="background: #000; color: #fff">NET AMOUNT</th>
						                </tr>
						                
						                <?php 
						                $sr = '1';
						                $listPrice = "0";
						                $mrp = '0';
						                $discount = '0';
						                $netAmt = '0';
						                $total_lisinging = '0';
						                $to_minis_dis = '0';
						                $totalDis = '0';
						                $mysqli->where('quot_id', $quot_id);
						                $getProduct = $mysqli->get(QOT);
						                foreach ($getProduct as $allEnq) {
						                    if($allEnq['hide'] != '1'){
						                    $disAmt = (empty($allEnq['discount']))? '0' : $allEnq['discount'] ;
						                    $mepAmtNo = (empty($allEnq['mrp']))? 0 : $allEnq['mrp'];
						                	$mrp += floatval(str_replace(',', '', $mepAmtNo));
						               	    $discount = str_replace(',', '', $disAmt);
						                	$multDis = $discount * $allEnq['qty'];
						                	$totalDis += $multDis;
						                	$netAmt += floatval(str_replace(',', '', $allEnq['netAmt']));
						                	$listPrice += floatval(str_replace(',', '', $allEnq['listPrice']));
						                	$to_list = $allEnq['qty'] * (float) str_replace(',', '', $allEnq['listPrice']);
						                	$to_distc = $allEnq['qty'] * $discount;
						                	$minis_dis = $to_list - $to_distc;
						                	$to_minis_dis += $minis_dis;
						                	$total_lisinging += $to_list;
						                	$mysqli->where('id', $allEnq['product_id']);
						                    $getProduct = $mysqli->getOne(PRODUCT);
						                    $prName = (!empty($allEnq['product_name']))? $allEnq['product_name'] : $getProduct['name'] ;
						                ?>
									<tr>
											<td class="prod"><?=$sr++?></td>
											<td class="prod"><?=$prName?></td>
											<td class="prod" style=" text-align: left"><?=$allEnq['qty']?></td>
											<td class="prod" style=" text-align: left"><?=$allEnq['unit']?></td>
											<td class="prod" style=" text-align: left"><?=number_format(round(str_replace(",", "", $allEnq['listPrice'])))?></td>
											<!--<td class="prod" style=" text-align: left"><?=number_format(round(str_replace(",", "", $allEnq['mrp'])))?></td>-->
											<td class="prod" style=" text-align: left"><?=number_format(round(str_replace(",", "", $disAmt)))?></td>
											<td class="prod" style=" text-align: left"><?=number_format(round(str_replace(",", "", $minis_dis)))?></td>
										</tr>

										<?php } }?>
										<tfoot>
										<tr>
												<td colspan="4" style="padding: 10px; text-align: right; font-size: 16px; border-top:2px solid #f3f3f3">TOTAL</td>
												<td style="padding: 10px;  font-size: 16px; border-top:2px solid #f3f3f3"><?=number_format(round(str_replace(",", "", $total_lisinging)))?></td>
												<!--<td style="padding: 10px;  font-size: 16px; border-top:2px solid #f3f3f3"><?=number_format(round(str_replace(",", "", $listPrice)))?></td>-->
												<!--<td style="padding: 10px;  font-size: 16px; border-top:2px solid #f3f3f3"><?=number_format(round(str_replace(",", "", $mrp)))?></td>-->
												<td style="padding: 10px;  font-size: 16px; border-top:2px solid #f3f3f3"><?=number_format(round(str_replace(",", "", $totalDis)))?></td>
												<td style="padding: 10px;  font-size: 16px; border-top:2px solid #f3f3f3"><?=number_format(round(str_replace(",", "", $to_minis_dis)))?></td>

											</tr>

											<tr>
											<td colspan="7" style="padding: 10px; background: #fff !important">
												<b>Terms & Conditions:</b><br/>
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

<p><b>Bank Detail:</b> HDFC<br><b>Branch:</b> Chembur<br><b>A/C Name:</b> Alptech International Pvt. Ltd.<br><b>A/C No.:</b> 50200038350243<br><b>IFSC Code:</b> HDFC0000013</p><?php } ?>
											</td>
										</tr>
										</tfoot>
									</table>
										</div>
								</div>
							</div>
							</div>
						</div>
					</div>
					
					<div class="row" id="mobile_view">
					    <div class="col-md-12">
							<div class="panel" style="box-shadow: none;">
								<div class="panel-body">
								    <?php if(isset($_GET['msg'])):
								        if($_GET['msg'] == 'fail'): ?>
							            <div class="alert alert-warning" id="msg">
							            Opps So Sorry!! <br/>Mail not delivered.
							            </div>
						            <?php else: ?>
								        <div class="alert alert-success" id="msg">
					                    Mail send successful.
							            </div>
						            <?php endif; endif;?>
						            <div class="row" style="padding: 20px">
						                <div class="col-xs-12">
           								    <img src="assets/img/alp_logo.png" width="200"><br/><br/>
						                    <?php if(!empty($getData['com_name'])){?>  <b><?=$getData['com_name']?></b></br> <?php } ?>
									        <?php if(!empty($getData['co_name'])){?>    <b><?=$getData['co_name']?></b></br> <?php } ?>
									        <?php if(!empty($getData['address'])){?>    <b>Address:</b> <?=$getData['address']?></br> <?php } ?>
									        <?php if(!empty($getData['tel_no'])){?>    <b>Telephone No.:</b> <?=$getData['tel_no']?></br> <?php } ?>
									        <?php if(!empty($getData['email_id'])){?>    <b>Email.:</b> <?=$getData['email_id']?></br> <?php } ?>
									        <?php if(!empty($getData['web_address'])){?>   <b>Web.:</b> <?=$getData['web_address']?></br <?php } ?>
									        <?php if(!empty($getData['pan_no'])){?>   <b>PAN:</b> <?=$getData['pan_no']?> <?php } ?> <?php if(!empty($getData['gst_no'])){?> | <b>GST No.:</b> <?=$getData['gst_no']?><?php } ?><br/><br/> 
									        <b>To, </b><br/><b><?=$getUser['fname'].' '.$getUser['lname']?></b></br>  
									        <b><?=$getUser['company_name']?></b></br>
									        <b>Address:</b> <?=$getUser['address1']?></br><?=$getUser['city1']?> <?=$getUser['state1']?> <?=$getUser['country1']?></br>
									        <b>Mobile No. :</b> <?=$getUser['contact1']?> | <b>Email. :</b> <?=$getUser['email']?> <br/>
									        <?php if(!empty($getUser['gst'])) { ?><b>GST No. :</b> <?=$getUser['gst']?><?php } ?>
               								
						                </div>
						                <div class="col-xs-12" style="margin-top:10px">
						                    <label>QT No.:</label> <?=$quot_id?><br/>
						                    <label>Date:</label> <?=date('d/m/Y', strtotime($quotation_date))?>
						                </div>
						                <div style="clear:both"></div>
						                <hr/>
						                <div class="table-responsive">
						                <table class="table">
						                    <tr>
    						                    <th style="background: #000; color: #fff; padding: 10px; ">NO.</th>
    						                    <th style="background: #000; color: #fff">PARTICULAR</th>
    						                    <th style="background: #000; color: #fff; text-align: left">QTY</th>
    						                    <th style="background: #000; color: #fff; text-align: left">UNIT</th>
    						                    <th style="background: #000; color: #fff; text-align: left">LIST PRICE</th>
    						                    <!--<th style="background: #000; color: #fff; text-align: left">TOTAL PRICE</th>-->
    						                    <th style="background: #000; color: #fff">DISCOUNT</th>
    						                    <th style="background: #000; color: #fff">NET AMOUNT</th>
						                    </tr>
						                      <?php 
						                $sr = '1';
						                $listPrice = "0";
						                $mrp = '0';
						                $discount = '0';
						                $netAmt = '0';
						                $total_lisinging = '0';
						                $to_minis_dis = '0';
						                $mysqli->where('quot_id', $quot_id);
						                $getProduct = $mysqli->get(QOT);
						                foreach ($getProduct as $allEnq) {
						                    if($allEnq['hide'] != '1'){
						                    $disAmt = (empty($allEnq['discount']))? '0' : $allEnq['discount'] ;
						                    $mepAmtNo = (empty($allEnq['mrp']))? 0 : $allEnq['mrp'];
						                	$mrp += floatval(str_replace(',', '', $mepAmtNo));
						               	    $discount = str_replace(',', '', $disAmt);
						                	$multDis = $discount * $allEnq['qty'];
						                	$totalDis += $multDis;
						                	$netAmt += floatval(str_replace(',', '', $allEnq['netAmt']));
						                	$listPrice += floatval(str_replace(',', '', $allEnq['listPrice']));
						                	$to_list = $allEnq['qty'] * floatval(str_replace(',', '', $allEnq['listPrice']));
						                	$to_distc = $allEnq['qty'] * $discount;
						                	$minis_dis = $to_list - $to_distc;
						                	$to_minis_dis += $minis_dis;
						                	$total_lisinging += $to_list;
						                	$mysqli->where('id', $allEnq['product_id']);
						                    $getProduct = $mysqli->getOne(PRODUCT);
						                    $prName = (!empty($allEnq['product_name']))? $allEnq['product_name'] : $getProduct['name'] ;
						                ?>
									<tr>
											<td class="prod"><?=$sr++?></td>
											<td class="prod"><?=$prName?></td>
											<td class="prod" style=" text-align: left"><?=$allEnq['qty']?></td>
											<td class="prod" style=" text-align: left"><?=$allEnq['unit']?></td>
											<td class="prod" style=" text-align: left"><?=substr(number_format(round(str_replace(",", "", $allEnq['listPrice']))), 0, -3)?></td>
											<!--<td class="prod" style=" text-align: left"><?=substr(number_format(round(str_replace(",", "", $allEnq['mrp']))), 0, -3)?></td>-->
											<td class="prod" style=" text-align: left"><?=substr(number_format(round(str_replace(",", "", $disAmt))), 0, -3)?></td>
											<td class="prod" style=" text-align: left"><?=substr(number_format(round(str_replace(",", "", $minis_dis))), 0, -3)?></td>
										</tr>

										<?php } }?>
										<tfoot>
										<tr>
												<td colspan="4" style="padding: 10px; text-align: right; font-size: 16px; border-top:2px solid #f3f3f3">TOTAL</td>
												<td style="padding: 10px;  font-size: 16px; border-top:2px solid #f3f3f3"><?=substr(number_format(round(str_replace(",", "", $total_lisinging))), 0, -3)?></td>
												<!--<td style="padding: 10px;  font-size: 16px; border-top:2px solid #f3f3f3"><?=substr(number_format(round(str_replace(",", "", $listPrice))), 0, -3)?></td>-->
												<!--<td style="padding: 10px;  font-size: 16px; border-top:2px solid #f3f3f3"><?=substr(number_format(round(str_replace(",", "", $mrp))), 0, -3)?></td>-->
												<td style="padding: 10px;  font-size: 16px; border-top:2px solid #f3f3f3"><?=substr(number_format(round(str_replace(",", "", $totalDis))), 0, -3)?></td>
												<td style="padding: 10px;  font-size: 16px; border-top:2px solid #f3f3f3"><?=substr(number_format(round(str_replace(",", "", $to_minis_dis))), 0, -3)?></td>

											</tr>

									    </tfoot>
						                </table>
						                </div>
						                
						                <hr/>
						                <div class="col-xs-12">
						                    <strong>Terms & Conditions:</strong><br/>
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

<p><b>Bank Detail:</b> HDFC<br><b>Branch:</b> Chembur<br><b>A/C Name:</b> Alptech International Pvt. Ltd.<br><b>A/C No.:</b> 50200038350243<br><b>IFSC Code:</b> HDFC0000013</p><?php } ?>

						                </div>
						            </div>
								</div>
							</div>
						</div>
					</div>
                </div>
				<?php include 'messages.php';?>
            </div>
        </div>
        
		<?php include 'footer.php';?>
		
		<script type="text/javascript">
		setTimeout(function(){ $('#msg').hide();}, 8000);
		</script>
	
