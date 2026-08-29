<?php 
include_once '../common.php';
extract($_GET);

$delimiter = "\t";
$filename = "Report_list_".$month."_".$year.".xls";
    
//create a file pointer
$f = fopen('php://memory', 'w');



$days =   cal_days_in_month(CAL_GREGORIAN, $month, $year);
$startDate = $year.'-'.str_pad($month, 2, '0', STR_PAD_LEFT).'-01';					
$endDate = $year.'-'.str_pad($month, 2, '0', STR_PAD_LEFT).'-'.str_pad($days, 2, '0', STR_PAD_LEFT);					

//set column headers
$fields = array('Sr No', 'Name', 'Date', 'Report');
fputcsv($f, $fields, $delimiter);
    
//output each row of the data, format line as csv and write to file pointer
//$mysqli->where('user_type', '0');
$mysqli->where('user_id', $user);
$mysqli->where('date', Array ('BETWEEN' => Array($startDate, $endDate)));
$get_vendor = $mysqli->get(REPORT);
$sr = '0';
foreach ($get_vendor as $ven_val){
extract($ven_val);
$mysqli->where('id', $user);
$reportUesr = $mysqli->getOne(UADMIN);	
$userName = $reportUesr['fname'].' '.$reportUesr['lname'];
$sr ++; 
$reportDate = date('d-M-Y', strtotime($date));
$lineData = array($sr, $userName, $reportDate, $report);
fputcsv($f, $lineData, $delimiter);
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