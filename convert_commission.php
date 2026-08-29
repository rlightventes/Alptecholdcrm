<?php
//inckude autoloader
include_once '../common.php';
require_once 'dompdf/autoload.inc.php';

// 	$id = $_GET['id'];
	$mysqli->where('service_no', $_GET['serviceNo']);
	$getComm = $mysqli->getOne(COMM);
	extract($getComm);
	$c_id = base64_encode($client_id);

	$data = array('commPDF' => '1');
	$mysqli->where('id', $id);
	$update = $mysqli->update(COMM, $data);
						
 /*$qtID = str_replace('/', '-', $id); base64_encode();*/

// reference the Dompdf namespace
use Dompdf\Dompdf;

//Instantiate dompdf class
$dompdf = new Dompdf();

//load HTML content
/*$dompdf->loadHtml('<img src="images/logo.png">');*/

//load content from HTML file
$html = file_get_contents("https://alptechindia.com/erp-alptech/creat_commission.php?service_no=".$_GET['serviceNo']);
$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portal');
$dompdf->render();
$output = $dompdf->output();
//file location where we need to store pdf
file_put_contents('pdf/SERVICE-'.$_GET['serviceNo'].'.pdf', $output);
//Output thegenerated PDF
/*header("location:index.php");*/
$dompdf->stream($id, array('Attachment'=> 0));
// header('location:commission_list.php?client='.$c_id);

?>