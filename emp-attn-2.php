<?php include_once 'header.php'; ?>

<!-- Stylesheet file -->
<link rel="stylesheet" href="style.css">

<!-- jQuery library -->
<script src="jquery.min.js"></script>

<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="row">
			<div class="col-md-12" >
				<div class="col-md-12" style="background: #fff; padding: 10px">
					<br/>
					<?php 
				$userRe	 = base64_decode($_GET['emp']);
      		if(isset($_POST['submit'])):
      			 $month = (!empty($_POST['sel_month']))? $_POST['sel_month'] : date('m', time()) ;
      			 $year = (!empty($_POST['sel_year']))? $_POST['sel_year'] : date('Y', time()) ;

      		else:
      			$month = date('m', time());
      			$year = date('Y', time());

      		endif;
      		$mysqli->where('id', $userRe);
			$reportUesr = $mysqli->getOne(UADMIN);	
      	?>
			
					<div class="col-md-9">
						<form method="post" action="">
						   
                            <?php $Currmonth = date('m', time());?>
                            <div class="col-md-3 col-xs-12">
							<select name="sel_month" class="form-control col-md-3"  required="" style="width: 100%; margin-right: 20px" >
								<option value="">Select Month</option>
								<?php 
								 for($i=1;$i<=12;$i++) 
    { 
    	if($i != $_GET['month']):
       // $value = ($i < 10)?'0'.$i:$i; 
      //  $selectedOpt = ($value == $selected)?'selected':''; 
        echo '<option value="'.$i.'">'.date("F", mktime(0, 0, 0, $i+1, 0, 0)).'</option>'; 

    endif; } ?>
							</select>
							</div>
							<div class="col-md-3 col-xs-12">
							<select name="sel_year" class="form-control col-md-3" required=""  style="width: 100%; margin-right: 20px" >
								<option value="">Select Year</option>
								<?php 
								$currentYear = date('Y', time());
								 for($i=$currentYear; $i>=2000;$i--) 
    { 
    	
       // $value = ($i < 10)?'0'.$i:$i; 
      //  $selectedOpt = ($value == $selected)?'selected':''; 
        echo '<option value="'.$i.'">'.$i.'</option>'; 
} ?>
							</select>
							
							</div>

							
							<button type="submit" name="submit" class="btn btn-info col-md-2 col-xs-12">SUBMIT</button>
						</form>

					</div>
					<div class="col-md-3 col-xs-12 text-right">
							<!--<a href="add-report.php" class="btn btn-primary">Add New Report</a>-->
							<form method="post" action="exportEmpAttn.php">
						    <?php 	if(isset($_POST['submit'])){ ?> 
						    <input type="hidden" name="emp" value="<?=$_GET['emp']?>" />
						    <input type="hidden" name="month" value="<?=$_POST['sel_month']?>" />
						    <input type="hidden" name="year" value="<?=$_POST['sel_year']?>" />
						    <?php }?>
     <input type="submit" name="export" class="btn btn-success" value="Export" />
    </form>
							<!--<a href="export-report.php?month=<?=$month?>&year=<?=$year?>&user=<?=$userRe?>" class="btn btn-success">Export</a>-->
					</div>
					<br/><br/>
					<div style="clear: both"></div>
					 
					 <hr/>
      			<div>
						<h4 style="margin-left: 30px"><?=$reportUesr['fname'].' '.$reportUesr['lname']?> <small><?=date("F", mktime(0, 0, 0, $month+1, 0, 0))?> - <?=$year?></small></h4>
						 <div class="calendar-dates" style="margin: 15px 30px"> 

						 	<ul >  	
						 	<?php 
					
 						$nowDate = date('Y', time()).'-'.date('m', time()).'-'.date('d', time());
						$days =   cal_days_in_month(CAL_GREGORIAN, $month, $year);
						//$dayName1 = "";
						for($i=1; $i<=7; $i++){
						 $dayName1 = date('D', strtotime($year.'-'.$month.'-'.$i));
						if($dayName1 == "Sun"){
						    $bg = "f9acac";
						    $color = "e61818";
						}else{
						    $bg = "";
						    $color="666";
						}
					//	echo $dayName1;
							?>
							<li style="width: 13.33%; border-bottom: 1px solid #ccc; background:#<?=$bg?>">
							    <h4 style="margin-top: 25px; text-transform: uppercase;  font-weight: bold;  color: #<?=$color?>;"><?=$dayName1?></h4>
							</li>
							<?php }
						for($i=1; $i<=$days; $i++):
							$dayName = date('D', strtotime($year.'-'.$month.'-'.$i));
							 $currDate = $year.'-'.str_pad($month, 2, '0', STR_PAD_LEFT).'-'.str_pad($i, 2, '0', STR_PAD_LEFT);
							
							//$reportDate = $year.'-'.str_pad($month, 2, '0', STR_PAD_LEFT).'-'.
							if($nowDate == $currDate):
								$color = '#ff9b44';
								$label = 'warning';
							else:
								$color = '#a0a0a0';
								$label = 'default';
							endif;
							$mysqli->where('user_id', $userRe);
							$mysqli->where('date', $currDate);
							$userAtt = $mysqli->getOne(ATTN);
							
							$hours = strtotime($userAtt['out_time']) - strtotime($userAtt['in_time']);
                                        $total = $hours/60;
                                        $working = sprintf("%02d:%02d", floor($total/60), $total%60);
                                        if (!empty($userAtt['out_time'])) {
                                        	$out = date('h:i:s', strtotime($userAtt['out_time']));
                                        	$tet = (empty($userAtt['in_time']))?'0': $working;
                                        }
                                        else{
                                        	$out = '';
                                        	$tet = '';
                                        }
							
							if($dayName == "Sun"){
						    $bg = "f9acac";
						    $color = "#e61818";
						}else{
						    if($nowDate == $currDate):
								$color = '#ea6f03';
								$label = 'warning';
								$bg = "fbc595";
							else:
								$color = '#a0a0a0';
								$label = 'default';
								$bg = "";
							endif;
							
						   // $bg = "";
						  //  $color="666";
						}
						if(!empty($userAtt['out_time'])){
						    $outTime = date('h:i:a', strtotime($userAtt['out_time']));
						}else{
						    $outTime = "00.00";
						}
						$hours = strtotime($userAtt['out_time']) - strtotime($userAtt['in_time']);
                                        $total = $hours/60;
                                        $working = sprintf("%02d:%02d", floor($total/60), $total%60);
                                        if (!empty($userAtt['out_time'])) {
                                        	$out = date('h:i:s', strtotime($userAtt['out_time']));
                                        	$tet = (empty($userAtt['in_time']))?'0': $working;
                                        }
                                        else{
                                        	$out = '';
                                        	$tet = '';
                                        }
							?>
						<li style="width: 13.33%; border-bottom: 1px solid #ccc; background:#<?=$bg?>">
						    <!--<span class="label label-<?=$label?>"><?=$dayName?></span>-->
						   
							<h3 style="font-weight: bold; margin-top: 10px; margin-bottom: 5px; color: <?=$color?>"><?php echo $i ?></h3>
							 <?php if(isset($userAtt)):
						        $top = '10';
						    ?> 
						    <!--<span class="label" style="background-color: #fff" data-toggle="modal" data-target="#<?=$userAtt['id']?>"><i class="fa fa-circle" style="color: #0b8902"></i></span>-->
						    <small><a href="viewInfo.php?user=<?=$userRe?>&currnt=<?=$currDate?>" target="_blank" style="text-align:right; " ><i class="fa fa-eye" style="color: #0b8902; font-size:14px"></i></a>
						  
						    <?=date('h:i:a', strtotime($userAtt['in_time'])).'-'.$outTime?></small><br/>
						    <small><i class="fa fa-clock-o"></i> WH: <?=$tet?> </small>
						    
						   	

						    <?php else: $top = '30'; endif;?>
							
<div id="<?=$userAtt['id']?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content text-left">
      <div class="modal-header">
          
        <h4 class="modal-title">Report <?=$currDate?>  </h4>
        <p style="color:#666"><small><b>In Time:</b> <?=date('h:i a', strtotime($userAtt['in_time']))?> <?=$userAtt['in_address']?></small></p>
        <p style="color:#666"><small><b>Out Time:</b> <?=date('h:i a', strtotime($userAtt['out_time']))?> <?=$userAtt['out_address']?></small></p>
      </div>
      <div class="modal-body">

          <table class="table table-stripped">
              <thead>
                  <tr>
                      <th>Sr. No.</th>
                      <th>Type</th>
                      <th>Detail</th>
                  </tr>
              </thead>
              <tbody>
                 <?php
                 $s = '1';
        	$mysqli->orderBy('id', 'desc');
			$mysqli->where('emp_id', $userRe);
			$getTask = $mysqli->get(HISTORY);
			foreach($getTask as $taskVal){
			    
			 $getDate = date("Y-m-d", strtotime($taskVal['create_date']));
			 
			 
			if($getDate == $currDate){ ?>  
                  <tr>
                     <td><?=$s++?></td>
                     <td><?=$taskVal['history_type']?></td>
                     <td><?=$taskVal['comment']?></td>
                  </tr>
            <?php 	}  } 

             
             $mysqli->where('user_id', $userRe);
			  $mysqli->where('date', $currDate);
			  $getReport = $mysqli->getOne(REPORT);

            ?>
            <tr>
                <td><?=$s+1?></td>
                <td>Report</td>
                <td><?=$getReport['report']?></td>
            </tr>
                  
              </tbody>
          </table>
       	   
		
       
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
					</div>
				</div>
							
							 </li>
					<?php  endfor;?>
        	
            


            </ul>
						
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

						<!-- Modal -->

			</div>
		</div>
	</div>
</div>

 