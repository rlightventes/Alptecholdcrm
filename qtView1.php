<?php include 'header.php';?>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-sm-8">
							<h4 class="page-title">Estimate</h4>
						</div>
						<div class="col-sm-4 text-right m-b-30">
							<div class="btn-group btn-group-sm">
								<!-- <button class="btn btn-default">CSV</button>
								<button class="btn btn-default">PDF</button> -->
								<a href="mailSend.php?qtID=<?=$_GET['lead']?>" class="btn btn-default"><i class="fa fa-envelope-o fa-lg"></i> Mail</a>
								<a href="pdf/generatePdf.php?qtID=<?=$_GET['lead']?>" class="btn btn-default"><i class="fa fa-file-pdf-o fa-lg"></i> PDF</a>
								<a href="quote_view.php?edit=quote&qtID=<?=$_GET['lead']?>" class="btn btn-default"><i class="fa fa-edit fa-lg"></i> Edit</a>
								<button class="btn btn-default" id="print_btn"><i class="fa fa-print fa-lg"></i> Print</button>
							</div>
						</div>
					</div>
					<?php
						$lead = base64_decode($_GET['lead']);
						$mysqli->where('id', $lead);
						$getEnq = $mysqli->getOne(QOT);
						extract($getEnq);
						$mysqli->where('id', $client_id);
						$getUser = $mysqli->getOne(USER);
						$mysqli->where('id', $product_id);
						$getProduct = $mysqli->getOne(PRODUCT);

					 ?>
					<div class="row">
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
									<div class="row" id="DivIdToPrint">
									<table style="width: 100%; ">
										<tr>
											<td style="padding-left: 20px; vertical-align: top"><img src="assets/img/alp_logo.png" class="m-b-20" style="width: 200px;"></td>
											<td  style="padding-right: 20px; width: 35%">		
												<b>ALPTECH INTERNATIONAL</b></br>
												<b>C/O MENGI ENGINEERING COMPANY</b></br>
												<b>Address:</b> Plot A-231, road no 21, Y Lane Wagle Industrial Area</br>
												<b>Telephone No.:</b> 9769976747, 8828216747</br>
												<b>Email.:</b> alptechinternational@gmail.com</br>
												<b>Web.:</b> www.alptechindia.com</br>
												<b>PAN:</b> AARCA9816A
											</td>
										</tr>
										<tr>
											<td  style="padding-left: 20px; ">
											<p style="width: 55%">
												<strong>To: </strong><b><?=$getUser['fname'].' '.$getUser['lname']?></b></br>	
												<b><?=$company_name?></b></br>
												<b>Address:</b> <?=$address?></br>
												<b>Mobile No. :</b> <?=$mobile_no?></br>
												<b>Email. :</b> <?=$email?>
											</p>
											</td>
											<td style="padding-right: 20px; padding-bottom:  10px;  vertical-align: bottom;">
												<b>Enquiry Date :</b> <?=date('d-M-Y'	, strtotime($enquiry_date))?></br>
												<b>Qtotation Date :</b> <?=date('d-M-Y', strtotime($quotation_date))?>
											</td>
										</tr>
										<tr>
											<td colspan="2" align="center" style="padding: 10px; border-top:1px solid; border-bottom:1px solid;"><h5 style="margin: 0; font-weight: 600"><?=$getProduct['name']?></h5></td>
										</tr>
										<tr>
											<td colspan="2" style="padding: 10px">
												<strong>Description:</strong> <?=$getProduct['description']?>
											</td>
										</tr>
										<tr>
											<td colspan="2" style="padding: 10px">
												<strong>Specification:</strong> <?=$getProduct['specification']?>
											</td>
										</tr>
										<tr>
											<td colspan="2"  style="padding: 10px">
												<?php if(!empty($getProduct['img1'])):?>
												<img src="../Images/<?=$getProduct['img1']?>" style="width: 200px; margin:10px">
												<?php endif; ?>
												<?php if(!empty($getProduct['img2'])):?>
												<img src="../Images/<?=$getProduct['img2']?>" style="width: 200px; margin:10px">
												<?php endif; ?>
												<?php if(!empty($getProduct['img3'])):?>
												<img src="../Images/<?=$getProduct['img3']?>" style="width: 200px; margin:10px">
												<?php endif; ?>
												<?php if(!empty($getProduct['img4'])):?>
												<img src="../Images/<?=$getProduct['img4']?>" style="width: 200px; margin:10px">
												<?php endif; ?>
												<?php $netAmt = str_replace(',', '', $mrp) - str_replace(',', '', $discount) ?>
											</td>
										</tr>
										<tr>
											
											<td  colspan="2" align="right" style="padding-right: 10px; padding-top: 10px; border-top: 1px solid;  text-align: right; ">
													<h5><b>MRP: <?=$mrp?>/-</b> </h5>
													<h5><b>Discount: <?=$netAmt?> /-</b> </h5>
													
											</td>
											
										</tr>
										
										<tr>
											
											<td colspan="2" align="right" style="padding: 5px 10px;  border-bottom: 1px solid;  border-top: 1px solid;  text-align: right; width: 100%">
												<h5>Net Payable: <?php echo number_format(str_replace(',', '', $discount))  ?>/- </h5>
											</td>
											
										</tr>
										<tr>
											<td colspan="2" style="padding: 20px"><strong>Terms & Conditions:</strong><br/> <?=$terms_conditions?></td>
										</tr>
									</table>




















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
	
