<?php 
include_once '../common.php';
if(empty($_SESSION['user'])): 
	header('location:index.php');
else:
$mysqli->where('email', $_SESSION['user']);
$getAdmin = $mysqli->getOne(UADMIN);	
$userGetID = $getAdmin['id'];
endif;
$delimiter = "\t";
$filename = "Invoice_list_".date('Y-m-d H:i').".xls";
    
//create a file pointer
$f = fopen('php://memory', 'w');
    
//set column headers
$fields = array('SR NO.', 'INVOICE NO', 'INVOICE DATE', 'CLIENT NAME', 'GST NO.', 'TOTAL AMOUNT', 'PAID', 'BALANCE', 'DUE DATE', 'PAYMENT MODE');
fputcsv($f, $fields, $delimiter);
    
//output each row of the data, format line as csv and write to file pointer
	$sr = '0';
	$totalMep = array();
	$totalAMT = '';
	$sum ='0';
	if($getAdmin['profile_type'] != 'Admin'):
	$mysqli->where('assign', $getAdmin['id']);
	endif;
	if(isset($_POST['startDate']) || isset($_POST['endDate'])){
	     $startDate =  $_POST['startDate'];
	    $exploeStart = explode('/', $startDate);
	     $fromDate = $exploeStart['2']."-".$exploeStart['1']."-".$exploeStart['0'];
	    $endDate =  $_POST['endDate'];
	    $exploeEnd = explode('/', $endDate);
	     $toDate = $exploeEnd['2']."-".$exploeEnd['1']."-".$exploeEnd['0'];
	    	$mysqli->where('inv_date', Array($fromDate, $toDate), 'BETWEEN');
	}else{
	$mysqli->orderBy('id','desc');
	}
//	$mysqli->where('client_id', $client);
	$getLeads = $mysqli->get(INV);
	foreach ($getLeads as $leadsVal) {
		extract($leadsVal);
		$mysqli->where('id', $client_id);
		$getUser = $mysqli->getOne(USER);
		$client = base64_encode($getUser['id']);
    	 $lead = base64_encode($id);
	      $mysqli->where('inv_no', $id);
	    $mysqli->orderBy('id','desc');
		$getInv = $mysqli->getOne(PAYHIS);
		if(isset($getInv)):
		    $balAmt = $getInv['bal_amt'];
		    $paidAmt = $getInv['paid_amt'];
		    $dueDate = date('d-M-Y', strtotime($getInv['due_date']));
		 else:
		     $paidAmt = '0';
		      $balAmt = $grand_amt;
		      $dueDate = '';
		 endif;
		$sr++;
		$invDate = date('d-M-Y', strtotime($inv_date));
		$clientName = $getUser['company_name'];
		$gstNo = $getUser['gst'];
		$totalAmt = substr_replace($grand_amt, "", -3);
		$paidAmt = substr_replace($paidAmt, "", -3);
		$balAmt = substr_replace($balAmt, "", -3);
		$dueDate = $dueDate;
		$payMode = $getInv['payment_mode'];
			if($hide != 1){
$lineData = array($sr, $inv_no, $invDate, $clientName, $gstNo, $totalAmt, $paidAmt, $balAmt, $dueDate, $payMode);
fputcsv($f, $lineData, $delimiter);
}
}

//move back to beginning of file
fseek($f, 0);
  
//set headers to download file rather than displayed
header("Content-Type: application/xls");    
header('Content-Disposition: attachment; filename="' . $filename . '";');
header("Pragma: no-cache"); 
header("Expires: 0");

//output all remaining data on a file pointer
fpassthru($f);
exit();
?>