<?php
//inckude autoloader
include_once '../common.php';
require_once 'dompdf/autoload.inc.php';
	$mysqli->where('pack_no', $_GET['pack']);
	$getProduct = $mysqli->getOne(AL_PRICE);
	extract($getProduct);
	
	
	$data = array('pdf' => '1');
	$mysqli->where('pack_no', $_GET['pack']);
	$update = $mysqli->update(AL_PRICE, $data);


// reference the Dompdf namespace
use Dompdf\Dompdf;

//Instantiate dompdf class
$dompdf = new Dompdf();

//load HTML content
$dompdf->loadHtml('<img src="https://www.alptechindia.com/assets/img/alp_logo.png">');

//load content from HTML file
$html = file_get_contents("https://www.alptechindia.com/erp-alptech/create_packlist.php?pack=".$_GET['pack']);
$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portal');
$dompdf->render();
$output = $dompdf->output();
//file location where we need to store pdf
file_put_contents('pdf/PACKNO-'.$_GET['pack'].'.pdf', $output);
//Output thegenerated PDF
/*header("location:index.php");*/
$dompdf->stream('PACKNO-'.$_GET['pack'], array('Attachment'=> 0));
// header('location:pdf/'.$prName.'.pdf');

?>