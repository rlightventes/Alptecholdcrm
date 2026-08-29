<?php
//inckude autoloader
include_once '../common.php';
require_once 'dompdf/autoload.inc.php';

	$lead = base64_decode($_GET['qtID']);
						$mysqli->where('id', $lead);
						$getEnq = $mysqli->getOne(QOT);
						extract($getEnq);
					
							$data = array('qotPDF' => '1');
	$mysqli->where('quot_id', $quot_id);
	$update = $mysqli->update(QOT, $data);
						
 $qtID = str_replace('/', '-', $quot_id); /*base64_encode();*/

// reference the Dompdf namespace
use Dompdf\Dompdf;

//Instantiate dompdf class
$dompdf = new Dompdf();

//load HTML content
/*$dompdf->loadHtml('<img src="images/logo.png">');*/

//load content from HTML file
$html = file_get_contents("https://www.alptechindia.com/erp-alptech/creat_qot.php?qtID=".$_GET['qtID']);
$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portal');
$dompdf->render();
$output = $dompdf->output();
//file location where we need to store pdf
file_put_contents('https://www.alptechindia.com/erp-alptech/creat_qot.php?qtID='.$qtID.'.pdf', $output);
//Output thegenerated PDF
/*header("location:index.php");*/
$dompdf->stream($qtID, array('Attachment'=> 0));
header('location:pdf/'.$qtID.'.pdf');

?>