<?php
//inckude autoloader
include_once '../common.php';
require_once 'dompdf/autoload.inc.php';
	$id = base64_decode($_GET['product']);
	$mysqli->where('id', $id);
	$getProduct = $mysqli->getOne(PRODUCT);
	extract($getProduct);
	
	
	$data = array('productPDF' => '1');
	$mysqli->where('id', $id);
	$update = $mysqli->update(PRODUCT, $data);
    $prName = str_replace(' ', '_', $name);


// reference the Dompdf namespace
use Dompdf\Dompdf;

//Instantiate dompdf class
$dompdf = new Dompdf();

//load HTML content
$dompdf->loadHtml('<img src="https://www.alptechindia.com/assets/img/alp_logo.png">');

//load content from HTML file
$html = file_get_contents("https://www.alptechindia.com/erp-alptech/create_pdf.php?product=".$_GET['product']);
$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portal');
$dompdf->render();
$output = $dompdf->output();
//file location where we need to store pdf
file_put_contents('pdf/'.$prName.'.pdf', $output);
//Output thegenerated PDF
/*header("location:index.php");*/
$dompdf->stream('PRO-'-$name, array('Attachment'=> 0));
header('location:pdf/'.$prName.'.pdf');

?>