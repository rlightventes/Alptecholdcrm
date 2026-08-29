<?php 
include_once '../common.php';
extract($_GET);
$date = date('d-m-Y', time());
$delimiter = "\t";
$filename = "Product_".$date.".xls";
    
//create a file pointer
$f = fopen('php://memory', 'w');


//set column headers
$fields = array('Product ID', 'Product', 'Type', 'Description', 'Category', 'Subcategory', 'Country', 'List Price', 'Sale Price', 'HSN Code', 'Unit', 'Gross Weight', 'Net Weight', 'Dimension', 'Img1', 'Img2', 'Img3', 'Img4', 'Specification','Youtube');
fputcsv($f, $fields, $delimiter);
    
//output each row of the data, format line as csv and write to file pointer
//$mysqli->where('user_type', '0');
	$mysqli->orderBy('id', 'desc');
	$getProduct = $mysqli->get(PRODUCT);
	foreach ($getProduct as $prVal) {
extract($prVal);
        $primary_id = str_pad($id, 3, '0', STR_PAD_LEFT);
		$text = ($status == '1')? 'Active' : 'Inactive';
		$bg = ($status == '1')? 'success' : 'danger';
		$val = ($status == '1')? '0' : '1';
 if($hide != '1'){
    if($country == 'Italian'):
		$img = '../img/italian.jpg';
	elseif($country == 'Turkish'):
		$img = '../img/turkish.jpg';
	elseif($country == 'Korean'):
		$img = '../img/koren.jpg';
	endif;
	$mysqli->where('id', $category);
	$getMain = $mysqli->getOne(MAINCAT);
	$mysqli->where('id', $type);
	$getSub = $mysqli->getOne(MAINCAT);
	
	$prName = str_replace(' ', '_', $name);
$lineData = array('PRO-'.$primary_id, $name, $product_type, $description, $getMain['category_name'],  $getSub['category_name'], $country, $mrp, $sale_rate, $hsn_code, $unit, $gross_weight, $net_weight, $product_dimension, $img1, $img2, $img3, $img4, $specification,$youtube);
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