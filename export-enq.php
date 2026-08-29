<?php 
include_once '../common.php';
extract($_GET);
$date = date('d-m-Y', time());
$delimiter = "\t";
$filename = "Report_enquiry_".$date.".xls";
    
//create a file pointer
$f = fopen('php://memory', 'w');


//set column headers
$fields = array('Sr No', 'Enq No', 'Date', 'Client Name', 'Contact Person', 'Phone', 'Email', 'Address', 'City', 'State', 'Country', 'Product Name');
fputcsv($f, $fields, $delimiter);
    
//output each row of the data, format line as csv and write to file pointer
//$mysqli->where('user_type', '0');
$mysqli->orderBy('id','desc');
$get_vendor = $mysqli->get(ENQ);
$sr = '0';
foreach ($get_vendor as $ven_val){
extract($ven_val);
$mysqli->where('id', $client_id);
$reportUesr = $mysqli->getOne(USER);
$mysqli->where('id', $product_id);
$getProduct = $mysqli->getOne(PRODUCT);
$co_name = $reportUesr['company_name'];
$phone = $reportUesr['contact1'];
$email = $reportUesr['email'];
$userName = $reportUesr['fname'].' '.$reportUesr['lname'];
$product = $getProduct['name'];
$sr ++; 
$reportDate = date('d-M-Y', strtotime($created_date));
 if($hide != '1'){
$lineData = array($sr, 'Enq-'.$id, $reportDate, $co_name,  $userName, $phone, $email, $reportUesr['address1'], $reportUesr['state1'], $reportUesr['city1'], $reportUesr['country1'], $product);
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