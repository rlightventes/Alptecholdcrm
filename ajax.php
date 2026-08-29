<?php
	include_once '../common.php';
	include_once 'smsapi.php';
	include_once '../API/noti_API.php';

	extract($_POST);
	extract($_GET);
	
function multi_attach_mail($to, $subject, $message, $senderEmail, $senderName, $files = array()){ 
 
    $from = $senderName." <".$senderEmail.">";  
    $headers = "From: $from"; 
    $headers .= "\nBcc: alptechinternational@gmail.com";
 
    // Boundary  
    $semi_rand = md5(time());  
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
 
    // Headers for attachment  
    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

 
    // Multipart boundary  
    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
    "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n";  
 
    // Preparing attachment 
    if(!empty($files)){ 
        for($i=0;$i<count($files);$i++){ 
            if(is_file($files[$i])){ 
                $file_name = basename($files[$i]); 
                $file_size = filesize($files[$i]); 
                 
                $message .= "--{$mime_boundary}\n"; 
                $fp =    @fopen($files[$i], "rb"); 
                $data =  @fread($fp, $file_size); 
                @fclose($fp); 
                $data = chunk_split(base64_encode($data)); 
                $message .= "Content-Type: application/octet-stream; name=\"".$file_name."\"\n" .  
                "Content-Description: ".$file_name."\n" . 
                "Content-Disposition: attachment;\n" . " filename=\"".$file_name."\"; size=".$file_size.";\n" .  
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
            } 
        } 
    } 
     
    $message .= "--{$mime_boundary}--"; 
    $returnpath = "-f" . $senderEmail; 
     
    // Send email 
    $mail = @mail($to, $subject, $message, $headers, $returnpath);  
     
    // Return true, if email sent, otherwise return false 
    if($mail){ 
        return true; 
    }else{ 
        return false; 
    } 
}
	
	function remove_cart($pr_ID = null) {
        if (!empty($_SESSION["shopping_cart"])) {
            foreach ($_SESSION["shopping_cart"] as $k => $v) {

                if ($pr_ID == $k) {
                    unset($_SESSION["shopping_cart"][$k]);
                }

                if (empty($_SESSION["shopping_cart"])) {
                    unset($_SESSION["shopping_cart"]);
                }
            }
            return TRUE;
        }
    }

	function clean($string) {
   $string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
	if(isset($action)):
		switch ($action) {
		    case'check_list':
		        $mysqli->orderBy('id','desc');
		        $getLastID = $mysqli->getOne(AL_LIST);
		        if(isset($getLastID)){
		            $pack_no = $getLastID['check_id'] + 1;
		        }else{
		           $pack_no =  001;
		        }

		        for($i=0; $i<count($list_part); $i++){
		          echo  $listName = $list_part[$i];
		            $typeVal = $type_check[$i];
		            $qtyNo = $check_qty[$i];
		            $Yes = $check_yes[$i];
		            $No = $check_no[$i];
		            $remark = $check_remark[$i];
		            
		            $data = array(
		                'check_id' => $pack_no,
		                'clt_id' => $client_id,
		                'user_id' => $_SESSION['user_id'],
		                'check_date' => $check_date,
		                'inv_date' => $inv_date,
		                'type_check' => $typeVal,
		                'machine_name' => $machine_name,
		                'list_part' => $listName,
		                'qty' => $qtyNo,
		                'yes' => $Yes,
		                'no' => $No,
		                'remark' => $remark,
		                'status' => 1,
		                'create_date' => time()
		                );
		              //  print_r($data);
		                
		                $insertData = $mysqli->insert(AL_LIST, $data);
		            

		        }
		        
		        header("location:getcheckList.php?client=".base64_encode($client_id));
		        
		    break;
		     case'update_check_list':
		       
		        $pack_no = $check_id;

		        
		        for($s=0; $s<count($list_id); $s++){
		            $up_id = $list_id[$s];
		            $listName = $list_part_up[$s];
		          //  $typeVal = $type_check[$s];
		            $qtyNo = $check_qty_up[$s];
		            $Yes = $check_yes_up[$s];
		            $remark = $check_remark_up[$s];
		            
		            $data = array(
		                'check_id' => $pack_no,
		                'clt_id' => $client_id,
		                'check_date' => $check_date,
		                'inv_date' => $inv_date,
		                'machine_name' => $machine_name,
		                'list_part' => $listName,
		                'qty' => $qtyNo,
		                'yes' => $Yes,
		                'remark' => $remark,
		                'status' => 1,
		                'pdf' => 0,
		                'create_date' => time()
		                );
		              //  print_r($data);
		                $mysqli->where('id', $up_id);
		                $insertData = $mysqli->update(AL_LIST, $data);
		            
		        }
		        
		        for($i=0; $i<count($list_part); $i++){
		          echo  $listName = $list_part[$i];
		            $typeVal = $type_check[$i];
		            $qtyNo = $check_qty[$i];
		            $Yes = $check_yes[$i];
		            $remark = $check_remark[$i];
		            
		            $data = array(
		                'check_id' => $pack_no,
		                'clt_id' => $client_id,
		                'user_id' => $_SESSION['user_id'],
		                'check_date' => $check_date,
		                'inv_date' => $inv_date,
		                'type_check' => $typeVal,
		                'machine_name' => $machine_name,
		                'list_part' => $listName,
		                'qty' => $qtyNo,
		                'yes' => $Yes,
		                'remark' => $remark,
		                'status' => 1,
		                'pdf' => 0,
		                'create_date' => time()
		                );
		              //  print_r($data);
		                
		                $insertData = $mysqli->insert(AL_LIST, $data);
		            
		        }
		        
		        header("location:getcheckList.php?client=".base64_encode($client_id));
		        
		    break;
		    case'packing':
		        $mysqli->orderBy('id','desc');
		        $getLastID = $mysqli->getOne(AL_PRICE);
		        if(isset($getLastID)){
		            $pack_no = $getLastID['pack_no'] + 1;
		        }else{
		           $pack_no =  001;
		        }
		        
		        for($i=0; $i<count($description); $i++){
		            $description_data = $description[$i];
		            $dimension_data = $dimension[$i];
		            $gross_weight_data = $gross_weight[$i];
		            $net_weight_data = $net_weight[$i];
		            $no_pack_data = $no_pack[$i];
		            $data = array(
		                'pack_no' => $pack_no,
		                'clt_id' => $client_id,
		                'user_id' =>  $_SESSION['user_id'],
		                'description' => $description_data,
		                'dimension' => $dimension_data,
		                'gross_weight' => $gross_weight_data,
		                'net_weight' => $net_weight_data,
		                'no_pack' => $no_pack_data,
		                'pack_date' => $check_date,
		                'status' => 1,
		                'create_date' => time());
		                $mysqli->insert(AL_PRICE, $data);
		        }
		        header("location:packlist.php?client=".base64_encode($client_id));
		    break;
		    case'update_packing':
		      
		        
		        for($s=0; $s<count($description_up); $s++){
		            $pack_id = $update_id[$s];
		            $description_data = $description_up[$s];
		            $dimension_data = $dimension_up[$s];
		            $gross_weight_data = $gross_weight_up[$s];
		            $net_weight_data = $net_weight_up[$s];
		            $no_pack_data = $no_pack_up[$s];
		            $data = array(
		                'description' => $description_data,
		                'dimension' => $dimension_data,
		                'gross_weight' => $gross_weight_data,
		                'net_weight' => $net_weight_data,
		                'no_pack' => $no_pack_data,
		                'pack_date' => $check_date,
		                'pdf' => '0'
		                );
		                $mysqli->where('id', $pack_id);
		                $mysqli->update(AL_PRICE, $data);
		        }
		        for($i=0; $i<count($description); $i++){
		            if(!empty($description_data)){
		            $description_data = $description[$i];
		            $dimension_data = $dimension[$i];
		            $gross_weight_data = $gross_weight[$i];
		            $net_weight_data = $net_weight[$i];
		            $no_pack_data = $no_pack[$i];
		            $data = array(
		                'pack_no' => $pack_no,
		                'clt_id' => $client_id,
		                'user_id' =>  $_SESSION['user_id'],
		                'description' => $description_data,
		                'dimension' => $dimension_data,
		                'gross_weight' => $gross_weight_data,
		                'net_weight' => $net_weight_data,
		                'no_pack' => $no_pack_data,
		                'pack_date' => $check_date,
		                'pdf' => '0',
		                'status' => 1,
		                'create_date' => time());
		                $mysqli->insert(AL_PRICE, $data);
		            }
		        }
		        header("location:packlist.php?client=".base64_encode($client_id));
		    break;

		    case'checklist':
		        $data = array(
		            'usr_id' => $_SESSION['user_id'],
		            'clt_id' => $client_id,
		            'machine_name' => $machine_name,
		            'check_date' => $check_date,
		            'des1' => $des1,
		            'des2' => $des2,
		            'des3' => $des3,
		            'des4' => $des4,
		            'des5' => $des5,
		            'des6' => $des6,
		            'check1' => $check1,
		            'check2' => $check2,
		            'check3' => $check3,
		            'check4' => $check4,
		            'check5' => $check5,
		            'check6' => $check6,
		            'remark1' => $remark1,
		            'remark2' => $remark2,
		            'remark3' => $remark3,
		            'remark4' => $remark4,
		            'remark5' => $remark5,
		            'remark6' => $remark6,
		            'des_mm1' => $des_mm1,
		            'des_mm2' => $des_mm2,
		            'des_mm3' => $des_mm3,
		            'des_mm4' => $des_mm4,
		            'des_mm5' => $des_mm5,
		            'des_mm6' => $des_mm6,
		            'check_mm1' => $check_mm1,
		            'check_mm2' => $check_mm2,
		            'check_mm3' => $check_mm3,
		            'check_mm4' => $check_mm4,
		            'check_mm5' => $check_mm5,
		            'check_mm6' => $check_mm6,
		            'remark_mm1' => $remark_mm1,
		            'remark_mm2' => $remark_mm2,
		            'remark_mm3' => $remark_mm3,
		            'remark_mm4' => $remark_mm4,
		            'remark_mm5' => $remark_mm5,
		            'remark_mm6' => $remark_mm6,
		            'trouble_des' => $trouble_des,
		            'trouble_check' => $trouble_check,
		            'trouble_remark' => $trouble_remark,
		            'mark_des1' => $mark_des1,
		            'mark_des2' => $mark_des2,
		            'mark_des3' => $mark_des3,
		            'mark_check1' => $mark_check1,
		            'mark_check2' => $mark_check2,
		            'mark_check3' => $mark_check3,
		            'mark_remark1' => $mark_remark1,
		            'mark_remark2' => $mark_remark2,
		            'mark_remark3' => $mark_remark3,
		            'des_des1' => $des_des1,
		            'des_des2' => $des_des2,
		            'des_des3' => $des_des3,
		            'des_des4' => $des_des4,
		            'des_des5' => $des_des5,
		            'des_des6' => $des_des6,
		            'check_des1' => $check_des1,
		            'check_des2' => $check_des2,
		            'check_des3' => $check_des3,
		            'check_des4' => $check_des4,
		            'check_des5' => $check_des5,
		            'check_des6' => $check_des6,
		            'remark_des1' => $remark_des1,
		            'remark_des2' => $remark_des2,
		            'remark_des3' => $remark_des3,
		            'remark_des4' => $remark_des4,
		            'remark_des5' => $remark_des5,
		            'remark_des6' => $remark_des6,
		            'status' => 1,
		            'create_date' => time()
		            );
		            $cltId = base64_encode($client_id);
		            $mysqli->insert(CHECK, $data);
		            header('location:checklist.php?client='.$cltId);
		    break;
		    case'update_checklist':
		        $data = array(
		            'machine_name' => $machine_name,
		            'check_date' => $check_date,
		            'des1' => $des1,
		            'des2' => $des2,
		            'des3' => $des3,
		            'des4' => $des4,
		            'des5' => $des5,
		            'des6' => $des6,
		            'check1' => $check1,
		            'check2' => $check2,
		            'check3' => $check3,
		            'check4' => $check4,
		            'check5' => $check5,
		            'check6' => $check6,
		            'remark1' => $remark1,
		            'remark2' => $remark2,
		            'remark3' => $remark3,
		            'remark4' => $remark4,
		            'remark5' => $remark5,
		            'remark6' => $remark6,
		            'des_mm1' => $des_mm1,
		            'des_mm2' => $des_mm2,
		            'des_mm3' => $des_mm3,
		            'des_mm4' => $des_mm4,
		            'des_mm5' => $des_mm5,
		            'des_mm6' => $des_mm6,
		            'check_mm1' => $check_mm1,
		            'check_mm2' => $check_mm2,
		            'check_mm3' => $check_mm3,
		            'check_mm4' => $check_mm4,
		            'check_mm5' => $check_mm5,
		            'check_mm6' => $check_mm6,
		            'remark_mm1' => $remark_mm1,
		            'remark_mm2' => $remark_mm2,
		            'remark_mm3' => $remark_mm3,
		            'remark_mm4' => $remark_mm4,
		            'remark_mm5' => $remark_mm5,
		            'remark_mm6' => $remark_mm6,
		            'trouble_des' => $trouble_des,
		            'trouble_check' => $trouble_check,
		            'trouble_remark' => $trouble_remark,
		            'mark_des1' => $mark_des1,
		            'mark_des2' => $mark_des2,
		            'mark_des3' => $mark_des3,
		            'mark_check1' => $mark_check1,
		            'mark_check2' => $mark_check2,
		            'mark_check3' => $mark_check3,
		            'mark_remark1' => $mark_remark1,
		            'mark_remark2' => $mark_remark2,
		            'mark_remark3' => $mark_remark3,
		            'des_des1' => $des_des1,
		            'des_des2' => $des_des2,
		            'des_des3' => $des_des3,
		            'des_des4' => $des_des4,
		            'des_des5' => $des_des5,
		            'des_des6' => $des_des6,
		            'check_des1' => $check_des1,
		            'check_des2' => $check_des2,
		            'check_des3' => $check_des3,
		            'check_des4' => $check_des4,
		            'check_des5' => $check_des5,
		            'check_des6' => $check_des6,
		            'remark_des1' => $remark_des1,
		            'remark_des2' => $remark_des2,
		            'remark_des3' => $remark_des3,
		            'remark_des4' => $remark_des4,
		            'remark_des5' => $remark_des5,
		            'remark_des6' => $remark_des6,
		            'pdf' => 0
		            );
		            $cltId = base64_encode($client_id);
		            $mysqli->where('id', base64_decode($updateID));
		            $mysqli->update(CHECK, $data);
		            header('location:checklist.php?client='.$cltId);
		            
		    break;
		    case'cityList':
		        $mysqli->orderBy('city_name', 'asc');
		        $mysqli->where('city_state', $state);
		        $getCityName = $mysqli->get(CITY);
		        foreach($getCityName as $allCity){
		            
		        echo '<option value="'.$allCity['city_name'].'">'.$allCity['city_name'].'</option>';
		        }
		    break;
		    case'setting':
		        if(!empty($_FILES['upload_file']['name'])):
					$img1 = $_FILES['upload_file']['name'];
					$imgtmp1 = $_FILES['upload_file']['tmp_name'];
					$imgpath1 = 'assets/img/'.$img1;
					move_uploaded_file($imgtmp1, $imgpath1);
				else:
					$img1 = $prv_logo;
				endif;
				 if(!empty($_FILES['upload_fav']['name'])):
					$img2 = $_FILES['upload_fav']['name'];
					$imgtmp2 = $_FILES['upload_fav']['tmp_name'];
					$imgpath2 = 'assets/img/'.$img2;
					move_uploaded_file($imgtmp2, $imgpath2);
				else:
					$img2 = $fav_logo;
				endif;
				
				$data = array(
				    'title' => $title_name,
				    'logo_img' => $img1,
				    'com_name' => $com_name,
				    'co_name' => $co_name,
				    'address' => $address,
				    'tel_no' => $tel_no,
				    'email_id' => $email_id,
				    'web_address' => $web_address,
				    'pan_no' => $pan_no,
				    'gst_no' => $gst_no,
				    'fav_img' => $img2,
				    'create_date' => time()
				    );
				    $mysqli->where('id', '1');
				    $insert = $mysqli->update(SETT, $data);
				    if(isset($insert)):
				        header('location:settings.php');
				    endif;
		    break;
		    case'reminder':
		        $currTime = time();
		      //  echo $current = date('Y-m-d', strtotime('+1 days'));
		       echo $current = '2020-12-12';
		        
		       $mysqli->where('end_date', array($current, $current), 'BETWEEN');
		       $getTask = $mysqli->get(TASK);
		       		       echo '<pre>';

		       foreach($getTask as $allTask){
		             $mysqli->where('id', $allTask['task_id']);
					$getTask = $mysqli->getOne(TASKNAME);
		           
		           $mysqli->where('id', $allTask['employee_list']);
					$get_user_id = $mysqli->getOne(UADMIN);
					echo $name =  $get_user_id['fname'].' '.$get_user_id['lname'];
					$emailRed = base64_encode($get_user_id['email']);
					$pwRed = base64_encode($get_user_id['password']);
				echo 	$task = base64_encode($allTask['task_id']);
		                $subject = 'Reminder For '.$getTask['name'];
                        $to = $get_user_id['email'];
                        $from = 'donotreply@alptechindia.com';
                        $fromName = 'ALPTECH INTERNATIONAL'; 
                        $files = '';
			            $message = '<html><body>';
                        $message .= '<h4><b>Dear '.$get_user_id['fname'].' '.$get_user_id['lname'].'</b></h4>';
                        $message .= '<h4><b>Task name:</b> '.$getTask['name'].'</h4>';
                        $message .= '<p>TASK ID: TSK-'.$allTask['task_id'].'</p>';
                        $message .= '<p>TASK END DATE: '.$allTask['end_date'].'</p>';
                        $message .= '<p>DESCRIPTION: '.$allTask['indivisual_task'].'</p>';
                        $message .= '<p>See your task <a target="_blank" href="https://www.alptechindia.com/erp-alptech/taskRedirect.php?user='.$emailRed.'&pw='.$pwRed.'&task='.$task.'">Click here</a></p>';
                        $message .= '</body></html>';
                        
                        // echo $message;
                        $sendEmail = multi_attach_mail($to, $subject, $message, $from, $fromName, $files); 
					    
					    if (isset($sendEmail)) {
                            	header('location:dashboard.php');  
                          }
		           
		       }
		       print_r($getTask);
		    break;
		    case'attendance':
				if($type == 'in'){
					$mysqli->where('email', $_SESSION['user']);
					$get_user_id = $mysqli->getOne(UADMIN);
					$inTime = date('Y-m-d H:i:s', time());
					$inTimeMail = date('d-m-Y h:i:a', time());
					$data = array(
						'user_id' => $get_user_id['id'],
						'date' => date('Y-m-d', time()),
						'in_time' => $inTime
					);
					$comm_id = $mysqli->insert(ATTN, $data);
					if(isset($comm_id)){
					    $subject = 'In Time for '.$get_user_id['fname'].' '.$get_user_id['lname'];
                        $to = 'alptechinternational@gmail.com';
                        $from = 'donotreply@alptechindia.com';
                        $fromName = 'ALPTECH INTERNATIONAL'; 
                        $files = '';
			            $message = '<html><body>';
                        $message .= '<h4><b>Attendance for '.$get_user_id['fname'].' '.$get_user_id['lname'].'</b></h4>';
                        $message .= '<h4><b>In Time:</b> '.$inTimeMail.'</h4>';
                        $message .= '</body></html>';
                        $sendEmail = multi_attach_mail($to, $subject, $message, $from, $fromName, $files); 
					    
					    if (isset($sendEmail)) {
					         $loc = 'attendance.php';
					        $title = 'In Time for '.$get_user_id['fname'].' '.$get_user_id['lname'].' In Time:'.$inTime;
					        $messages = "In Time:".$inTime;
					         $sendAlert = alertApp('Admin', $title,  $messages, $loc);
                            // 	header('location:attendance.php');  
                          }
					}
				}
				if($type == 'out'){
					$mysqli->where('email', $_SESSION['user']);
					$get_user_id = $mysqli->getOne(UADMIN);
					$outTime = date('Y-m-d H:i:s', time());
					$data = array(
						'out_time' => $outTime
					);
				// 	print_r($data);
					$id = base64_decode($_GET['user_id']);
					$mysqli->where('id', $id);
					$comm_id = $mysqli->update(ATTN, $data);
					
						if(isset($comm_id)){
					    $subject = 'Out Time for '.$get_user_id['fname'].' '.$get_user_id['lname'];
                        $to = 'alptechinternational@gmail.com';
                        $from = 'donotreply@alptechindia.com';
                        $fromName = 'ALPTECH INTERNATIONAL'; 
                        $files = '';
			            $message = '<html><body>';
                        $message .= '<h4><b>Attendance for '.$get_user_id['fname'].' '.$get_user_id['lname'].'</b></h4>';
                        $message .= '<h4><b>Out Time:</b> '.$outTime.'</h4>';
                        $message .= '</body></html>';
                        $sendEmail = multi_attach_mail($to, $subject, $message, $from, $fromName, $files); 
					    
					    if (isset($sendEmail)) {
					        $loc = 'attendance.php';
					        $title = 'Out Time for '.$get_user_id['fname'].' '.$get_user_id['lname'].' Out Time:'.$outTime;
					        $messages = "Out Time:".$outTime;
					         $sendAlert = alertApp('Admin', $title,  $messages, $loc);
                            //	header('location:attendance.php');  
                          }
					}
				// 	header('location:attendance.php');
				}
			break;
		    case'commission':
				$mysqli->where('email', $_SESSION['user']);
				$get_user_id = $mysqli->getOne(UADMIN);
				echo $cl_id = base64_encode($client_id);
				$m_type = implode(" || ",$machine_type);
				$m_name = implode(" || ",$machine_name);
				$m_remark = implode(" || ",$remark);
				for($i=0; $i<count($machine_name); $i++){
				    $mach_name =  $machine_name[$i];
				    $mach_type =  $machine_type[$i];
				    $mach_remark =  $remark[$i];
				$data = array(
					'client_id' => $client_id,
					'service_no' => $service_no,
					'commission' => $commission,
					'amc' => $amc,
					'service_breakdown' => $service_breakdown,
					'inspect_gen' => $inspect_gen,
					'complaint_no' => $complaint_no,
					'complaint_date' => $complaint_date,
					'machine_type' => $mach_type,
					'machine_name' => $mach_name,
					'remark' => $mach_remark,
					'eng_name' => $eng_name,
					'no_days' => $no_days,
					'attendance' => $attendance,
					'invoice_no' => $invoice_no,
					'mode_travel' => $mode_travel,
					'invoice_date' => $invoice_date,
					'mode_kms' => $mode_kms,
					'amt' => $amt,
					'work_carried' => $work_carried,
					'recommendations' => $recommendations,
					'feedback' => $feedback,
					'comments' => $comments,
					'hide' => '0',
					'send_pdf' => '0',
					'emp_id' => $get_user_id['id']
					
				);
				    $comm_id = $mysqli->insert(COMM, $data);
				    
				}
				// print_r($data);
				$comm_id = $mysqli->insert(COMM, $data);
				// header('location:convert_commission.php?service_no='.$service_no);
				header('location:commission_list.php?client='.$cl_id);
			break;
			case'update_commission':
				$mysqli->where('email', $_SESSION['user']);
				$get_user_id = $mysqli->getOne(UADMIN);
				echo $cl_id = base64_encode($client_id);
				$m_type = implode(" || ",$machine_type);
				$m_name = implode(" || ",$machine_name);
				$m_remark = implode(" || ",$remark);
				for($i=0; $i<count($machine_name); $i++){
				    $mach_name =  $machine_name[$i];
				    $mach_type =  $machine_type[$i];
				    $mach_remark =  $remark[$i];
				    if(!empty($mach_name)){
				$data = array(
					'client_id' => $client_id,
					'service_no' => $service_no,
					'commission' => $commission,
					'amc' => $amc,
					'service_breakdown' => $service_breakdown,
					'inspect_gen' => $inspect_gen,
					'complaint_no' => $complaint_no,
					'complaint_date' => $complaint_date,
					'machine_type' => $mach_type,
					'machine_name' => $mach_name,
					'remark' => $mach_remark,
					'eng_name' => $eng_name,
					'no_days' => $no_days,
					'attendance' => $attendance,
					'invoice_no' => $invoice_no,
					'mode_travel' => $mode_travel,
					'invoice_date' => $invoice_date,
					'mode_kms' => $mode_kms,
					'amt' => $amt,
					'work_carried' => $work_carried,
					'recommendations' => $recommendations,
					'feedback' => $feedback,
					'comments' => $comments,
					'hide' => '0',
					'send_pdf' => '0',
					'emp_id' => $get_user_id['id']
					
				);
				    $comm_id = $mysqli->insert(COMM, $data);
				    }
				}
					for($i=0; $i<count($machine_name_up); $i++){
				    $mach_name =  $machine_name_up[$i];
				    $mach_type =  $machine_type_up[$i];
				    $mach_remark =  $remark_up[$i];
				    $up_id =  $mach_id[$i];
				    if(!empty($mach_name)){
				$dataUP = array(
				// 	'client_id' => $client_id,
					'service_no' => $service_no,
					'commission' => $commission,
					'amc' => $amc,
					'service_breakdown' => $service_breakdown,
					'inspect_gen' => $inspect_gen,
					'complaint_no' => $complaint_no,
					'complaint_date' => $complaint_date,
					'machine_type' => $mach_type,
					'machine_name' => $mach_name,
					'remark' => $mach_remark,
					'eng_name' => $eng_name,
					'no_days' => $no_days,
					'attendance' => $attendance,
					'invoice_no' => $invoice_no,
					'mode_travel' => $mode_travel,
					'invoice_date' => $invoice_date,
					'mode_kms' => $mode_kms,
					'amt' => $amt,
					'work_carried' => $work_carried,
					'recommendations' => $recommendations,
					'feedback' => $feedback,
					'comments' => $comments,

				);
				// print_r($dataUP);
				    $mysqli->where('id', $up_id);
				    $update_data = $mysqli->update(COMM, $dataUP);
				    }
				}
				
				// print_r($data);
				// $comm_id = $mysqli->insert(COMM, $data);
				// header('location:convert_commission.php?service_no='.$service_no);
				header('location:commission_list.php?client='.$cl_id);
			break;
		    case'removeCart':
		      //  unset($_SESSION[$idGet]);

				remove_cart($idGet);
		    break;
		    case'taskStaus':
		        echo $taskID;
		        echo $client;
		        $mysqli->where('task_id', $taskID);
		        $mysqli->where('employee_list', $client);
		        $getTask = $mysqli->getOne(TASK);
		        print_r($getTask);
		     //   echo $getTask['workStatus'];
		    break;
		    case'removeAssign':
		        $assgnID;
		        $newAssign = '';
		        $id = base64_decode($client);
		        $mysqli->where('id', $id);
		        $getUser = $mysqli->getOne(USER);
		        $assignList = $getUser['assign_to'];
		       $expAssign = explode(',', $assignList);
		       foreach($expAssign as $user){
		           if($assgnID != $user){
		               $newAssign .= $user.", ";
		           }
		       }
		      $data = array('assign_to' => $newAssign);
				$mysqli->where('id', $id);
				$update = $mysqli->update(USER, $data);
		    break;
		    case'assign':
		         $asg = '';
				    foreach($assign as $assignName){
				      $asg .=  $assignName.", "; 
				    }
				    if(empty($assList)){
				        $assgnName = $asg;
				    }else{
				        $assgnName = $assList." ".$asg;
				    }
				$data = array('assign_to' => $assgnName);
				$mysqli->where('id', $id);
				$update = $mysqli->update(USER, $data);
				$client = base64_encode($id);
			 header('location:profile.php?client='.$client);
		    break;
		    case'hsn':
		        if($type == 'add'){
		            $data = array(
		               'hsn' => $department,
		               'cgst' => $cgst,
		               'sgst' => $sgst,
		               'igst' => $igst
		               );
		          $mysqli->insert(HSN, $data);
		        }
		     
		        if($type == 'update'){
		            $data = array(
		               'hsn' => $department,
		               'cgst' => $cgst,
		               'sgst' => $sgst,
		               'igst' => $igst
		               );
		               $mysqli->where('id', $id);
		         $mysqli->update(HSN, $data);
		        }
		        header("location:hsnCode.php");
		    break;
		    case'addCART':
		        $code = $prID;
        $cartArray = array($code);
        if(empty($_SESSION["shopping_cart"])):
            $_SESSION["shopping_cart"] = $cartArray;
        else:
            $array_keys = array_keys($_SESSION["shopping_cart"]);
            if(in_array($code, $array_keys)): 
            else:
                $_SESSION["shopping_cart"] = array_merge(
                $_SESSION["shopping_cart"], $cartArray);
            endif;
        endif;
      //  print_r($_SESSION["shopping_cart"]);
		    break;
		    case'payment':
		        $convDate = explode('/', $inv_date);
			    $invDate = $convDate['2'].'-'.$convDate['1'].'-'.$convDate['0'];
			    $convDueDate = explode('/', $due_date);
			    $dueDate = $convDueDate['2'].'-'.$convDueDate['1'].'-'.$convDueDate['0'];
			    
			    if($payment_mode == 'NEFT'){
			        $bankName = $bank_name1;
			        $branchName = $branch_name1;
			        $cheNo = $cheque_no1;
			         $cheqDueDate = explode('/', $cheque_date1);
			        $cheDate = $cheqDueDate['2'].'-'.$cheqDueDate['1'].'-'.$cheqDueDate['0'];
			    }else{
			        $bankName = $bank_name;
			        $branchName = $branch_name;
			        $cheNo = $cheque_no;
			        $cheqDueDate1 = explode('/', $cheque_date);
			        $cheDate = $cheqDueDate1['2'].'-'.$cheqDueDate1['1'].'-'.$cheqDueDate1['0'];
			    }
		        $data = array(
		                'emp_id' => $emp_id,
		                'client_id' => $client_id,
		                'inv_no' => $inv_no,
		                'grand_amt' => $grand_amt,
		                'paid_amt' => $paid_amt,
		                'bal_amt' => $bal_amt,
		                'pay_amt' => $pay_amt,
		                'payment_date' => $invDate,
		                'payment_mode' => $payment_mode,
		                'payment_info' => $pay_info,
		                'due_date' => $dueDate,
		                'bank_name' => $bankName,
		                'branch_name' => $branchName,
		                'chq_no' => $cheNo,
		                'chq_date' => $cheDate
		            );
		            $mysqli->insert(PAYHIS, $data);
		            $client = base64_encode($client_id);
		            header('location:inv_list.php?client='.$client);
		        
		    break;
		    
		    case'approval':
		        echo $task_status;
		        	$data = array(
						'workStatus' => $task_status
					);
		//			echo $assignID;
					$mysqli->where('id', $assignID);
					$insertTask = $mysqli->update(TASK, $data); 
					
					$dataHistory  = array(
				    'replyCpmment' => $indivisual_task,
				
				);
				$mysqli->where('id', $commentId);
					$updateHistory = $mysqli->update(HISTORY, $dataHistory); 

				
					$task = base64_encode($task_id);
					print_r($data);
					if(isset($insertTask)){
                        $mysqli->where('id', $assignID);
					    $getEmp = $mysqli->getOne(TASK); 
					    $mysqli->where('id', $getEmp['task_id']);
					    $getTask = $mysqli->getOne(TASKNAME); 
					    $mysqli->where('id', $getEmp['employee_list']);
					    $getEmail = $mysqli->getOne(UADMIN);
					    $subject = 'Replied for Task '.$getTask['name'];
                        $to = $getEmail['email'];
                        $from = 'donotreply@alptechindia.com';
                        $fromName = 'ALPTECH INTERNATIONAL'; 
                        $files = '';
			            $message = '<html><body>';
                        $message .= '<h4><b>Replied - '.$indivisual_task.'</b></h4>';
                        $message .= '<h4><b> Time:</b> '.date('d-m-Y H:i', time()).'</h4>';
                        $message .= '</body></html>';
                        $sendEmail = multi_attach_mail($to, $subject, $message, $from, $fromName, $files); 
					    
					    if (isset($sendEmail)) {
                             header('location:task_view.php?task='.$task);
                          }
                          
					   
					}
				
		          
		    break;
		    case'multiInv':
		        $convDate = explode('/', $inv_date);
			    $invDate = $convDate['2'].'-'.$convDate['1'].'-'.$convDate['0'];
			    
			    $soConDate = explode('/', $so_date);
			    $soDate = $soConDate['2'].'-'.$soConDate['1'].'-'.$soConDate['0'];
			    
			    $chConDate = explode('/', $ch_date);
			    $chDate = $chConDate['2'].'-'.$chConDate['1'].'-'.$chConDate['0'];
			    
			    $client = base64_encode($client_id);
		        echo $type;
		        if($type == 'new'):
		             echo '<pre>';
		            print_r($_POST);
		            $data = array(
		                'inv_no' => $inv_no,
		                'inv_date'=> $invDate,
		                'ch_no' => $ch_no,
		                'ch_date' => $chDate,
		                'so_date' => $soDate,
		                'so_no' => $so_no,
		                'tax_pay' => $tax_pay,
		                'supply_to' => $supply_to,
		                'subTotal' => $total_amt,
		                'gstTotal' => $gstVal,
		                'gstAmt' => $gstAmt,
		                'grand_amt' => $grand_amt,
		                'client_id' => $client_id,
		                'emp_id' => $emp_id,
		                'terms_conditions' => $terms_conditions
		                );
		          $insertInvoice = $mysqli->insert(INV, $data);
		         
		          for($i=0; $i<count($product_name); $i++)
						{
						 	$productID = $product_id[$i];
						  	$productName = $product_name[$i];
						 
							$hsnCode = $hsn[$i];
							$qtyNo = $qty[$i];
							$unitVal = $unit[$i];
							$saleRate = $sale_rate[$i];
							$totalAm = $total[$i];
							$disc = $discount[$i];
							$disAmt = $dis_amt[$i];
							$gstNo = $gst_val[$i];
							$cgstNo = $cgst[$i];
							$sgstNo = $sgst[$i];
							$igstNo = $igst[$i];
						 	$gstAmt = $gst_amt[$i];
						 	$netAmt = $net_amt[$i];
						 	
						 	if(empty($igstNo)){
						 	    $IGSTVAL = $cgstNo + $sgstNo;
						 	}else{
						 	    $IGSTVAL = $igstNo;
						 	}
						 	if(empty($cgstNo)){
						 	    $CGSTTVAL = $IGSTVAL / 2;
						 	    $SGSTTVAL = $IGSTVAL / 2;
						 	}else{
						 	    $CGSTTVAL = $cgstNo;
						 	    $SGSTTVAL = $sgstNo;
						 	}
						 
							if(!empty($productName)){ 
							    $dataInv = array(
							'product_id' => $productID,
							'product_name' => $productName,
							'hsn' => $hsnCode,
							'qty' => $qtyNo,
							'unit' => $unitVal,
							'sale_rate' => $saleRate,
							'total' => $totalAm,
							'discount' => $disc,
							'dis_amt' => $disAmt,
							'gst_val' => $gstNo,
							'cgst' => $CGSTTVAL,
							'sgst' => $SGSTTVAL,
							'igst' => $IGSTVAL,
							'gst_amt' => $gstAmt,
							'net_amt' => $netAmt,
							'inv_no' => $insertInvoice,
							
							);
							   $mysqli->insert(INHIS, $dataInv);
					print_r($dataInv);
							}
						$invNo = base64_encode($insertInvoice);
					}
				
		        endif;
		        if($type == 'update'):
		            $data = array(
		                'inv_no' => $inv_no,
		                'inv_date'=> $invDate,
		                'ch_no' => $ch_no,
		                'ch_date' => $chDate,
		                'so_date' => $soDate,
		                'so_no' => $so_no,
		                'tax_pay' => $tax_pay,
		                'supply_to' => $supply_to,
		                'subTotal' => $total_amt,
		                'gstTotal' => $gstVal,
		                'gstAmt' => $gstAmt,
		                'grand_amt' => $grand_amt,
		                'client_id' => $client_id,
		                'emp_id' => $emp_id,
		                'terms_conditions' => $terms_conditions
		                );
		          $mysqli->where('id', $id);
		          $insertInvoice = $mysqli->update(INV, $data);
		          
		          for($i=0; $i<count($product_name); $i++)
						{
						  	$productName = $product_name[$i];
						 
							$hsnCode = $hsn[$i];
							$qtyNo = $qty[$i];
							$saleRate = $sale_rate[$i];
							$totalAm = $total[$i];
							$disc = $discount[$i];
							$disAmt = $dis_amt[$i];
							$gstNo = $gst_val[$i];
						 	$gstAmt = $gst_amt[$i];
						 	$netAmt = $net_amt[$i];
						 	$cgstNo = $cgst[$i];
							$sgstNo = $sgst[$i];
							$igstNo = $igst[$i];
							$unitVal =  $unit[$i];
							
							if(empty($igstNo)){
						 	    $IGSTVAL = $cgstNo + $sgstNo;
						 	}else{
						 	    $IGSTVAL = $igstNo;
						 	}
						 	if(empty($cgstNo)){
						 	    $CGSTTVAL = $IGSTVAL / 2;
						 	    $SGSTTVAL = $IGSTVAL / 2;
						 	}else{
						 	    $CGSTTVAL = $cgstNo;
						 	    $SGSTTVAL = $sgstNo;
						 	}
						 	
							if(!empty($productName)){ 
							    $dataInv = array(
							'product_id' => $productID,
							'product_name' => $productName,
							'hsn' => $hsnCode,
							'qty' => $qtyNo,
							'unit' => $unitVal,
							'sale_rate' => $saleRate,
							'total' => $totalAm,
							'discount' => $disc,
							'dis_amt' => $disAmt,
							'gst_val' => $gstNo,
							'cgst' => $CGSTTVAL,
							'sgst' => $SGSTTVAL,
							'igst' => $IGSTVAL,
							'gst_amt' => $gstAmt,
							'net_amt' => $netAmt,
							'inv_no' => $id,
							
							);
							   $mysqli->insert(INHIS, $dataInv);
				
							}
						
					}
				
				
				for($i=0; $i<count($product_name_up); $i++)
						{
						 	$productIDUp = $updateID[$i];
						  	$productNameUp = $product_name_up[$i];
						 
							$hsnCodeUp = $hsn_up[$i];
							$qtyNoUp = $qty_up[$i];
							$saleRateUp = $sale_rate_up[$i];
							$totalAmUp = $total_up[$i];
							$discUp = $discount_up[$i];
							$disAmtUp = $dis_amt_up[$i];
							$gstNoUp = $gst_val_up[$i];
						 	$gstAmtUp = $gst_amt_up[$i];
						 	$netAmtUp = $net_amt_up[$i];
						 	$cgstNo = $cgst_up[$i];
							$sgstNo = $sgst_up[$i];
							$igstNo = $igst_up[$i];
							$unitVal =  $unit_up[$i];
							
							if(empty($igstNo)){
						 	    $IGSTVAL = $cgstNo + $sgstNo;
						 	}else{
						 	    $IGSTVAL = $igstNo;
						 	}
						 	if(empty($cgstNo)){
						 	    $CGSTTVAL = $IGSTVAL / 2;
						 	    $SGSTTVAL = $IGSTVAL / 2;
						 	}else{
						 	    $CGSTTVAL = $cgstNo;
						 	    $SGSTTVAL = $sgstNo;
						 	}
						 	
							if(!empty($productNameUp)){ 
							    $dataInvUp = array(
							'product_name' => $productNameUp,
							'hsn' => $hsnCodeUp,
							'qty' => $qtyNoUp,
							'unit' => $unitVal,
							'sale_rate' => $saleRateUp,
							'total' => $totalAmUp,
							'discount' => $discUp,
							'dis_amt' => $disAmtUp,
							'gst_val' => $gstNoUp,
							'cgst' => $CGSTTVAL,
							'sgst' => $SGSTTVAL,
							'igst' => $IGSTVAL,
							'gst_amt' => $gstAmtUp,
							'net_amt' => $netAmtUp,
                            'inv_no' => $id,
							
							);
							    $mysqli->where('id', $productIDUp);
							   $mysqli->update(INHIS, $dataInvUp);
				
							}
						$invNo = base64_encode($id);
						
					}
				
		        endif;
		        	unset($_SESSION['shopping_cart']);
		        $loc = 'inv_list.php?client='.$client;
		       header('location:convert_inv.php?qtID='.$invNo.'&loc='.$loc);
		    break;
			case'multiQt':
				if($type == 'new'):
					$convDate = explode('/', $quotation_date);
					$qtDate = $convDate['2'].'-'.$convDate['1'].'-'.$convDate['0'];
				        $grandTotal = '0';
						for($i=0; $i<count($productName); $i++)
						{
							$prod_id = $product_id[$i];
						 	$prod_name = $productName[$i];
							$qt_val = $qty[$i];
							$unit_val = $unit[$i];
							$list_val = $list[$i];
							$mrp_val = $mrp[$i];
							$mep_val = $mep[$i]?? null;
							$dis_val = $discount[$i];
						 	$netAmt_val = $netAmt[$i];
						 
							if(!empty($prod_name)){ 
							    $data = array(
							'client_id' => $client_id,
							'quot_id' => $quot_id,
							'product_id' => $prod_id,
							'company_name' => $company_name,
							'address' => $address,
							'mobile_no' => $mobile_no,
							'email' => $email,
							'product_name' => $prod_name,
							'quotation_date' => $qtDate,
							'qty' => $qt_val,
							'unit' => $unit_val,
							'listPrice' => $list_val,
							'mrp' => $mrp_val,
							'mep' => $mep_val,
							'discount' => $dis_val,
							'netAmt' => $netAmt_val,
							'emp_id' => $emp_id,
							'subject' => $subject,
							'terms_conditions' => $terms_conditions
							);
							   $mysqli->insert(QOT, $data);
						//	   echo '<pre>';
							  	print_r($data);
							}
						
					}
					
				

					$client = base64_encode($client_id);
					
				endif;	
				$mep = '0';
				if($type == 'update'):
				    echo '<pre>';
				    $convDate = explode('/', $quotation_date);
					$qtDate = $convDate['2'].'-'.$convDate['1'].'-'.$convDate['0'];
					$client = base64_encode($client_id);
				
				
						for($i=0; $i<count($productName); $i++)
						{
							$prod_id = $product_id[$i];
							$prod_name = $productName[$i];
							print_r($prod_name);
							$qt_val = $qty[$i];
							$unit_val = $unit[$i];
							$list_val = $list[$i];
							$mrp_val = $mrp[$i];
							$mep_val = $mep[$i];
							$dis_val = $discount[$i];
							$netAmt_val = $netAmt[$i];
                       	if(!empty($prod_id)){ 
						$data = array(
							'client_id' => $client_id,
							'quot_id' => $quot_id,
							'product_id' => $prod_id,
							'product_name' => $prod_name,
							'company_name' => $company_name,
							'address' => $address,
							'mobile_no' => $mobile_no,
							'email' => $email,
							'quotation_date' => $qtDate,
							'qty' => $qt_val,
							'unit' => $unit_val,
							'listPrice' => $list_val,
							'mrp' => $mrp_val,
							'mep' => $mep_val,
							'discount' => $dis_val,
							'netAmt' => $netAmt_val,
							'emp_id' => $emp_id,
							'subject' => $subject,
							'terms_conditions' => $terms_conditions
							);
							
				// 		print_r($data);
						$mysqli->insert(QOT, $data);
						}
						if(empty($prod_id)){
						    if(!empty($prod_name)){
						        $dataName = array(
							    'client_id' => $client_id,
							    'quot_id' => $quot_id,
							    'product_id' => 0,
							    'product_name' => $prod_name,
							    'company_name' => $company_name,
							    'address' => $address,
							    'mobile_no' => $mobile_no,
							    'email' => $email,
							    'quotation_date' => $qtDate,
							    'qty' => $qt_val,
							    'unit' => $unit_val,
							    'listPrice' => $list_val,
							    'mrp' => $mrp_val,
							    'mep' => $mep_val,
							    'discount' => $dis_val,
							    'netAmt' => $netAmt_val,
							    'emp_id' => $emp_id,
							    'subject' => $subject,
							    'terms_conditions' => $terms_conditions
							    );
							
						  //  print_r($data);
						    $mysqli->insert(QOT, $dataName);
						    }
						}
					}
					
				//	echo count($updateID);
			
				for($i=0; $i<count($updateID); $i++)
						{   
						    $id = $updateID[$i];
							$prod_id = $product_id_up[$i];
							$prod_name = $productName_up[$i];
							$qt_val = $qty_up[$i];
							$unit_val = $unit_up[$i];
							$list_val = $list_up[$i];
							$mrp_val = $mrp_up[$i];
							$mep_val = $mep_up[$i];
							$dis_val = $discount_up[$i];
							$netAmt_val = $netAmt_up[$i];
                        if(!empty($id)){
						$dataUpdate = array(
							'quot_id' => $quot_id,
							'product_id' => $prod_id,
							'product_name' => $prod_name,
							'quotation_date' => $qtDate,
							'qty' => $qt_val,
							'unit' => $unit_val,
							'listPrice' => $list_val,
							'mrp' => $mrp_val,
							'mep' => $mep_val,
							'discount' => $dis_val,
							'netAmt' => $netAmt_val,
							'emp_id' => $emp_id,
								'subject' => $subject,
							'terms_conditions' => $terms_conditions
							);
							print_r($data);
						$mysqli->where('id', $id);
						$mysqli->update(QOT, $dataUpdate);
					}
						}

				endif;
// 					unset($_SESSION['shopping_cart']);
			header('location:qut_list.php?client='.$client);
			break;

	        case'multiInv':
				if($type == 'new'):
					$convDate = explode('/', $quotation_date);
					$qtDate = $convDate['2'].'-'.$convDate['1'].'-'.$convDate['0'];
				        $grandTotal = '0';
						for($i=0; $i<count($productName); $i++)
						{
							$prod_id = $product_id[$i];
						 	$prod_name = $productName[$i];
							$qt_val = $qty[$i];
							$mep_val = $mep[$i];
							$dis_val = $discount[$i];
						 	$netAmt_val = $netAmt[$i];
						 
							if(!empty($prod_name)){ 
							    $data = array(
							'client_id' => $client_id,
							'invoice_no' => $quot_id,
							'ch_no' => $ch_no,
							'ch_date' => $ch_no,
							'so_no' => $ch_no,
							'so_date' => $ch_no,
							'product_id' => $prod_id,
							'client_name' => $company_name,
							'address1' => $address,
							'mobile_no' => $mobile_no,
							'quotation_date' => $qtDate,
							'quantity' => $qt_val,
							'mep' => $mep_val,
							'discount' => $dis_val,
							'netAmt' => $netAmt_val,
							'emp_id' => $emp_id,
							'subject' => $subject,
							'terms_conditions' => $terms_conditions
							);
							   $mysqli->insert(QOT, $data);
						//	   echo '<pre>';
						//	  	print_r($data);
							}
						
					}
					
					

					$client = base64_encode($client_id);
					
				endif;	
				if($type == 'update'):
				    $convDate = explode('/', $quotation_date);
					$qtDate = $convDate['2'].'-'.$convDate['1'].'-'.$convDate['0'];
					$client = base64_encode($client_id);
				
						for($i=0; $i<count($productName); $i++)
						{
							$prod_id = $product_id[$i];
							$prod_name = $productName[$i];
							$qt_val = $qty[$i];
							$mrp_val = $mrp[$i];
							$mep_val = $mep[$i];
							$dis_val = $discount[$i];
							$netAmt_val = $netAmt[$i];
                       	if(!empty($prod_name)){ 
						$data = array(
							'client_id' => $client_id,
							'quot_id' => $quot_id,
							'product_id' => $prod_id,
							'product_name' => $prod_name,
							'company_name' => $company_name,
							'address' => $address,
							'mobile_no' => $mobile_no,
							'email' => $email,
							'quotation_date' => $qtDate,
							'qty' => $qt_val,
							'mrp' => $mrp_val,
							'mep' => $mep_val,
							'discount' => $dis_val,
							'netAmt' => $netAmt_val,
							'emp_id' => $emp_id,
							'subject' => $subject,
							'terms_conditions' => $terms_conditions
							);
							
						
						$mysqli->insert(QOT, $data);
						}
					}
				//	echo count($updateID);
			
				for($i=0; $i<count($updateID); $i++)
						{  
						    $id = $updateID[$i];
						    $prod_id = $product_id_up[$i];
							$prod_name = $productName_up[$i];
							$qt_val = $qty_up[$i];
							$mrp_val = $mrp_up[$i];
							$mep_val = $mep_up[$i];
							$dis_val = $discount_up[$i];
							$netAmt_val = $netAmt_up[$i];
						    
						    
				// 			$prod_id = $product_id_up[$i];
				// 			$qt_val = $qty_up[$i];
				// 			$mrp_val = $mrp_up[$i];
				// 			$mep_val = $mep_up[$i];
				// 			$dis_val = $discount_up[$i];
				// 			$netAmt_val = $netAmt_up[$i];
                        if(!empty($id)){
						$data = array(
						    
							'product_name' => $prod_name,
							'quotation_date' => $qtDate,
							'qty' => $qt_val,
							'mrp' => $mrp_val,
							'mep' => $mep_val,
							'discount' => $dis_val,
							'netAmt' => $netAmt_val,
							'subject' => $subject,
							'terms_conditions' => $terms_conditions
							
							);
						$mysqli->where('id', $id);
						$mysqli->update(QOT, $data);
					}
						}
				endif;
				
			header('location:qut_list.php?client='.$client);
			break;

			case'checkMRP':
				
				$mysqli->where('id', $product);
				$getMrp = $mysqli->getOne(PRODUCT);
				$merpPr = $getMrp['sale_rate'];
				$mrpPr = $getMrp['mrp'];

				// $mrpAmt = str_replace(',', '', $getMrp['mrp']);
				// $disAmt = str_replace(',', '', $getMrp['discount']);
				//$netAmt = $mrpAmt - $disAmt;
				//print_r($getMrp);
				
				//$mrpAmt = number_format($getMrp['mrp']);
				//$netAmt = number_format($getMrp['discount']);
				//$disAmt = number_format($getMrp['mrp']) - number_format($getMrp['discount']);
				//echo $mrpAmt."|".$disAmt."|".$netAmt;
				echo $merpPr."|".$mrpPr;

			break;
			case'report':
			$explode = explode('/', $report_date);
			$reportDate = $explode['2'].'-'.$explode['1'].'-'.$explode['0'];
			 $data = array(
			 	'date' => $reportDate,
			 	'report' => $report,
			 	'user_id' => $user,
			 );
			 $addreport = $mysqli->insert(REPORT, $data);
		//	 print_r($data);
			 if(isset($addreport)):
			 

			 	header('location:report.php');
			 endif;

			break;

			case'checkEmail':
			$mysqli->where('email', $email);
			$getEmail = $mysqli->getOne(USER);
			
			break;

			case'checkPhone':
			$mysqli->where('contact1', $phone);
			$getEmail = $mysqli->getOne(USER);
			if(isset($getEmail)):
				echo 'yes';
			endif;
			break;

			break;
			case 'invoice':
				$data  = array(
					'invoice_no' => $invoice_no,
					'inv_date' => $inv_date,
					'ch_no' => $ch_no,
					'ch_date' => $ch_date,
					'so_no' => $so_no,
					'so_date' => $so_date,
					'place_supply' => $place_supply,
					'tax_pay' => $tax_pay,
					'client_id' => $client_id,
					'client_name' => $company_name,
					'address' => $address,
					'mobile_no' => $mobile_no,
					'email' => $email,
					'emp_id' => $emp_id
				);				
				$insData = $mysqli->insert(INV, $data);
				if(isset($insData)):
						$dataPr = array(
						'inv_id' => $insData,
						'product_id' => $product_name,
						'product_qty' => $qty,
						'product_mrp' => $product_mrp,
						'product_discount' => $product_discount,
						'net_amt' => $net_amt,
						'status' => 1,
						'create_date' => time()
						);

					$insProduct = $mysqli->insert(INVHIS, $data);	
				endif;




			break;
			case'quote':
					$nomep = (!empty($mep))? $mep : '0';
					$disAmt = (!empty($discount))? $discount : '0';
					$explode = explode('/', $quotation_date);
					$qtDate = $explode['2'].'-'.$explode['1'].'-'.$explode['0'];
					$data = array(
						'client_id' => $client_id,
						'product_id' => $product_id,
						'enquiry_id' =>  $enquiry_id,
						'company_name' => $company_name,
						'address' => $address,
						'mobile_no' => $mobile_no,
						'email' => $email,
						'enquiry_date' => $enquiry_date,
						'quotation_date' => $qtDate,
						'product_name' => 	$product_name,
						'description' => 		$description,	
						'specification' =>  $specification,
						'mrp' => $mrp,
						'mep' =>  $nomep,
						'product_weight' => $product_weight,
						'product_dimension' => $product_dimension,
						'terms_conditions' => $terms_conditions,
						'discount' => $disAmt
					);
					if($type == 'new'):
							$insert = $mysqli->insert(QOT, $data);
							$lead = $insert;
					else:
							$mysqli->where('id', $editID);
							$insert = $mysqli->update(QOT, $data);
							$lead = $editID;
					endif;		

					
					if(isset($insert)):
					//	print_r($data);
						 $lead = base64_encode($lead);
							header('location:qtView.php?lead='.$lead);
					endif;

			break;
			case'imgDelete':
				$data = array($col => '');
				$mysqli->where('id', $id);
				$updateImg = $mysqli->update(PRODUCT, $data);
				//print_r($data);
			break;
			case 'enquiry':
			$cutt = (!empty($cutting))? $cutting : '0';
			$enqDate = time();
			if($type == 'new'):
				$dataEnq = array(
				'product_id' => $prid,
				'client_id' => $client_id,
				'type_of_industry' => $operation,
				'sub_type1' => $industry,
				'sub_type2' => $type_cat,
				'int_ext' => $type_cat2,
				'material_type' => $material,
				'type_of_cutting' => $cutt,
				'quantum_of_cutting' => $quantum,
				'length' => $length,
				'breadth' => $breadth,
				'weight' => $weight,
				'height' => $height,
				'thickness' => $thickness,
				'setup_type' => $setup_type,
				'existing_machine' => $existing_machine,
				'enq_date' => $enqDate
				);
				$insertEnq = $mysqli->insert(ENQ, $dataEnq);
			
			
				$dataIn = array('enq_date' => $enqDate);
				$mysqli->where('id', $client_id);
				$updatEnq = $mysqli->update(USER, $dataIn);
			endif;
			if($type == 'update'):
				$dataEnq = array(
				'product_id' => $prid,
				'client_id' => $client_id,
				'type_of_industry' => $operation,
				'sub_type1' => $industry,
				'sub_type2' => $type_cat,
				'int_ext' => $type_cat2,
				'material_type' => $material,
				'type_of_cutting' => $cutt,
				'quantum_of_cutting' => $quantum,
				'length' => $length,
				'breadth' => $breadth,
				'weight' => $weight,
				'height' => $height,
				'thickness' => $thickness,
				'setup_type' => $setup_type,
				'existing_machine' => $existing_machine,
				'enq_date' => $enqDate
				);
				$updateid = base64_decode($id);
				$mysqli->where('id', $updateid);
				$insertEnq = $mysqli->update(ENQ, $dataEnq);
				
				$dataIn = array('enq_date' => $enqDate);
				$mysqli->where('id', $client_id);
				$updatEnq = $mysqli->update(USER, $dataIn);
			
			endif;
			if(isset($insertEnq)):
				header('location:leads.php');
			endif;
			break;
			case 'videos':
				if($type == 'new'):
					foreach ($youtub_link as $key => $value) {
						$link = $youtub_link[$key];
						$data = array(
					'name' => $name,
					'youtub_link' => $link,
					'status' => 1,
					'create_date' => time());
					$mysqli->insert(VIDEO, $data);
					}
					
				endif;
				if($type == 'update'):
					$data = array(
					'name' => $name,
					'youtub_link' => $you_link);
					$mysqli->where('id', $id);
					$update = $mysqli->update(VIDEO, $data);
					if(isset($update)):
					foreach ($youtub_link as $key => $value) {
						$link = $youtub_link[$key];
						$data = array(
					'name' => $name,
					'youtub_link' => $link,
					'status' => 1,
					'create_date' => time());
					$mysqli->insert(VIDEO, $data);
					}
				endif;
				endif;
				header('location:videos.php');
			break;
			case 'history':
				$mysqli->where('email', $_SESSION['user']);
				$user = $mysqli->getOne(UADMIN);
				if(!empty($_FILES['attachment']['name'])):
					$img2 = $_FILES['attachment']['name'];
					$imgtmp2 = $_FILES['attachment']['tmp_name'];
					$imgpath2 = 'task/'.$img2;
					move_uploaded_file($imgtmp2, $imgpath2);
				else:
					$img2 = '';
				endif;
			$meetType = (empty($meeting_type))? '0' : $meeting_type;
			$empMail = '';
			$totalEmp = '0';
			if(isset($emp)):
				foreach ($emp as $value) {
					$empMail .= $value.', ';
					$totalEmp += $value;
				}
				 $empMail;
			endif;
				$data  = array(
				    'subject' => $subject,
					'history_type' => $history_type, 
					'comment' => $comments, 
					'attachment' => $img2, 
					'reminder' => $reminder, 
					'meeting_date' => $meeting_date, 
					'meeting_type' => $meetType, 
					'client_id' => $client_id, 
					'emp_id' => $user['id'], 
					'send_type' => $send_type,
					'cc_email' => $empMail,
					'task_id' => $task_list, 
					'mailSend' => '1',
					'status' => 1
				);

				
				$client = base64_encode($client_id);
				$insert = $mysqli->insert(HISTORY, $data);
				if($history_type == 'Task'):
				    $mysqli->where('employee_list', $user['id']);
				    $mysqli->where('task_id', $task_list);
				    $listID = $mysqli->getOne(TASK);
				 //   print_r($listID);
					$dataTask = array('complete_task' => $task_status, 'workStatus' => $task_status);
					$mysqli->where('id', $listID['id']);
					$mysqli->update(TASK, $dataTask);
				endif;

				$dataMat = array('maturate' => $maturate);
				$mysqli->where('id', $client_id);
				$updatemat = $mysqli->update(USER, $dataMat);

				$mysqli->where('id', $client_id);
				$getClient = $mysqli->getOne(USER);
				$sms = strip_tags($comments);
				//$link = '<a href="http://google.com/">Clik here</a>';
				//$link = 'WWW';
				$smsMsg = $sms;
				$mobile_no = $getClient['contact1'];
			//	print_r($data);
				if(!empty($empMail)):

					if( $send_type == 'SMS'):
					    sendOtp($smsMsg, $mobile_no);
					    header('location:profile.php?client='.$client.'&success=success');
					elseif($send_type == 'Email'):
					    header('location:mail.php?action=history&email=yes&client='.$insert);
					elseif($send_type == 'Both'):
					    sendOtp($smsMsg, $mobile_no);
					    header('location:mail.php?action=history&email=yes&client='.$insert);
					else:
						header('location:mail.php?action=history&client='.$insert);
					endif;
				else:   
				     $smsMsg;
			   			if( $send_type == 'SMS'):
					    sendOtp($smsMsg, $mobile_no);
					   header('location:profile.php?client='.$client.'&success=success');
					elseif($send_type == 'Email'):
					    header('location:mail.php?action=history&email=yes&client='.$insert);
					elseif($send_type == 'Both'):
					    sendOtp($smsMsg, $mobile_no);
					    header('location:mail.php?action=history&email=yes&client='.$insert);
					else:
						header('location:profile.php?client='.$client.'&success=success');
					endif;

				endif;


			break;
			case 'login':
				$mysqli->where('email', $username);
				$mysqli->where('password', $password);
				$login = $mysqli->getOne(UADMIN);
				if(isset($login)):
					 if(!empty($remeber)) {
				        setcookie ("member_login",$username,time()+ (10 * 365 * 24 * 60 * 60));
				       setcookie ("member_pass",$password,time()+ (10 * 365 * 24 * 60 * 60));
			        } else {
        				if(isset($_COOKIE["member_login"])) {
        					setcookie ("member_login","");
        				}
        				if(isset($_COOKIE["member_pass"])) {
        					setcookie ("member_pass","");
        				}
			        }
				    
					$_SESSION['user'] = $username;
					$_SESSION['user_id'] = $login['id'];
				// 	if(!empty($pageDirect)):
				// 	   header('location:tasks.php');
				// 	else:
					    header('location:dashboard.php');
					    
				// 	endif;
					
				else:
					header('location:index.php?textMsg=fail');
				endif;
			break;
			case 'forgot_check':
				$mysqli->where('email', $user);
				$getUser = $mysqli->getOne(UADMIN);
				if(!isset($getUser)): echo 'no'; endif;
			break;
			case 'forgot':
				$mysqli->where('email', $user);
				$getUser = $mysqli->getOne(UADMIN);
				if(isset($getUser)):header('location:mail.php?mail=forgot&admin='.$getUser['id']); endif;
			break;
			case 'delete':
			  
				$data = array('hide' => '1');
				$mysqli->where($col_nam, $id);
				$delete = $mysqli->update($tab_name, $data);
			    if(isset($delete)): header('location:'.$loc); endif;
			break;
			case 'deleteRow':
				$mysqli->where($col_nam, $id);
				$delete = $mysqli->delete($tab_name);
			    if(isset($delete)): header('location:'.$loc); endif;
			break;
			case'unhide':
			     $id = base64_decode($lead);
			     $tab_name = base64_decode($tabName);
			    $data = array('hide' => '0');
			    $mysqli->where('id', $id);
				$delete = $mysqli->update($tab_name, $data);
			    if(isset($delete)): header('location:'.$loc); endif;
			break;
			case'unhideTask':
			     $id = base64_decode($lead);
			     $tab_name = base64_decode($tabName);
			    $data = array('hide' => '0');
			    $mysqli->where('task_id', $id);
				$delete = $mysqli->update($tab_name, $data);
			    if(isset($delete)): header('location:'.$loc); endif;
			break;
			case'multiHide':
			     $tab_name = base64_decode($tabName);
			    foreach($lead as $id){
			       $data = array('hide' => '0');
			        $mysqli->where('id', $id);
				    $delete = $mysqli->update($tab_name, $data);  
			    }
			     header('location:'.$loc);
			break;
			case'multiHideInvoice':
			     $tab_name = base64_decode($tabName);
			    foreach($check as $id){
			       $data = array('hide' => '0');
			        $mysqli->where('id', $id);
				    $delete = $mysqli->update($tab_name, $data);  
			    }
			     header('location:'.$loc);
			break;
			case'multiHideProduct':
			     $tab_name = base64_decode($tabName);
			    foreach($produtID as $id){
			       $data = array('hide' => '0');
			        $mysqli->where('id', $id);
				    $delete = $mysqli->update($tab_name, $data);  
			    }
			     header('location:'.$loc);
			break;
				case'multiHideTask':
			     $tab_name = base64_decode($tabName);
			    foreach($lead as $id){
			       $data = array('hide' => '0');
			        $mysqli->where('task_id', $id);
				    $delete = $mysqli->update($tab_name, $data);  
			    }
			     header('location:'.$loc);
			break;
			case 'deletePermanat':
			   
				// $data = array('hide' => '1');
				$mysqli->where($col_nam, $id);
				$delete = $mysqli->delete($tab_name, $data);
			    if(isset($delete)): header('location:'.$loc); endif;
			break;
			case 'deleteProd':
			   
			 $data = array('hide' => '1');
			 $mysqli->where($col_nam, $id);
				 $delete = $mysqli->update($tab_name, $data);
				
			break;
			case 'deleteProdQuot':
			   
			 //$data = array('hide' => '1');
			 $mysqli->where($col_nam, $id);
				 $delete = $mysqli->delete($tab_name);
				
			break;
			case 'status':
				$data = array('status' => $val);
				$mysqli->where($col_nam, $id);
				$delete = $mysqli->update($tabName, $data);
				if(isset($delete)): header('location:'.$loc); endif;
			break;
//////////////////////// DEPARTMENT //////////////////////////////////////////////
			case 'department':
				if($type == 'add'):
					$data = array('name' => $department, 'status' => '1');
					$insertData = $mysqli->insert(DEPARTMENT, $data);
					
				endif;
				if($type == 'update'):
					$data = array('name' => $department);
					$mysqli->where('id', $id);
					$insertData = $mysqli->update(DEPARTMENT, $data);
					
				endif;
				if(isset($insertData)):
					header('location:departments.php');
				endif;
			break;
//////////////////////// LEAD TYPE //////////////////////////////////////////////
			case 'userLead':
				if($type == 'add'):
					$data = array('lead' => $department, 'status' => '1');
					$insertData = $mysqli->insert(LEAD, $data);
					
				endif;
				if($type == 'update'):
					$data = array('lead' => $department);
					$mysqli->where('id', $id);
					$insertData = $mysqli->update(LEAD, $data);
					
				endif;
				if(isset($insertData)):
					header('location:userLead.php');
				endif;
			break;
//////////////////////// USER CATEGORY //////////////////////////////////////////////
			case 'usercat':
			    
				if($type == 'add'):
				    $mysqli->where('category', $department);
			        $sameCat = $mysqli->getOne(UCAT);
			        if(!isset($sameCat)){
			        $dataCat = array('category' => $department, 'status' => '1');
					$insertData = $mysqli->insert(UCAT, $dataCat);
			        }
					
				// 	$data = array('category' => $department, 'status' => '1');
				// 	$insertData = $mysqli->insert(UCAT, $data);
				endif;
				if($type == 'update'):
					$data = array('category' => $department);
					$mysqli->where('id', $id);
					$insertData = $mysqli->update(UCAT, $data);
					
				endif;
				if(isset($insertData)):
					header('location:userCategory.php');
				endif;
			break;

//////////////////////// UNIT MEASURMENT  //////////////////////////////////////////////
			case 'unit':
			    
				if($type == 'add'):
				    $mysqli->where('unit', $department);
			        $sameCat = $mysqli->getOne(UNIT);
			        if(!isset($sameCat)){
			        $dataCat = array('unit' => $department, 'status' => '1');
					$insertData = $mysqli->insert(UNIT, $dataCat);
			        }
					
				// 	$data = array('category' => $department, 'status' => '1');
				// 	$insertData = $mysqli->insert(UCAT, $data);
				endif;
				if($type == 'update'):
					$data = array('unit' => $department);
					$mysqli->where('id', $id);
					$insertData = $mysqli->update(UNIT, $data);
					
				endif;
				if(isset($insertData)):
					header('location:unit_measurment.php');
				endif;
			break;
//////////////////////// DOWNLOAD CATEGORY  //////////////////////////////////////////////
            case 'down_main':
                if($type == 'add'):
                    $mysqli->where('title', $cat_name);
			        $get_c = $mysqli->getOne(D_CAT);
			        if(isset($get_c)):
		        ?>		
		                <script type="text/javascript">
		                    alert('So Sorry!! This Dowanload Category is already in database... ');
		                    window.location.href='download-cat.php?action=add';
		                </script>
		                <?php else:
			                $dataDownCat = array(
				                'title' => $cat_name,
				                'status' => 1,
				                'create_date' => time()
			                );
			                /*print_r($dataDownCat);*/
			                $insertData = $mysqli->insert(D_CAT, $dataDownCat);
			        endif;
                endif;
                if($type == 'update'):
                    $data = array('title' => $cat_name);
					$mysqli->where('id', $id);
					$insertData = $mysqli->update(D_CAT, $data);
                endif;
                if(isset($insertData)):
					header('location:download-cat.php');
				endif;
            break;
/////////////////////////////Downloads /////////////////////////////////////////////
		case'downloads':
		    if(!empty($_FILES['d_image']['name'])):
		    	$temp = explode(".", $_FILES['d_image']['name']);
		    	$d_image = round(microtime(true)).'.'.end($temp);
		    	$imgtmp1 = $_FILES['d_image']['tmp_name'];
		    	$imgpath1 = '../downloads/'.$d_image;
		    	move_uploaded_file($imgtmp1, $imgpath1);
		    else:
		    	$d_image = '';
		    endif;
		    if(!empty($_FILES['download']['name'])):
	        	$temp4 = explode(".", $_FILES['download']['name']);
	        	$download = round(microtime(true)).'.'.end($temp4);
	        	$pdftmp1 = $_FILES['download']['tmp_name'];
	        	$pdfpath1 = '../downloads/'.$download;
	        	move_uploaded_file($pdftmp1, $pdfpath1);
	        else:
	   	    	$download = '';
	   	    endif;
		    if($type == 'new'):
		    	$data = array(
		    	    'title' =>	$title, 
		    	    'main_id' =>	$main_id,
		    	    'd_image' =>	$d_image,
		    	    'download' =>	$download,
		    	    'status' => 1,
		    	    'create_date' => time()
		    	);
		    	print_r($data);
		        $insertData = $mysqli->insert(D_SCAT, $data);
		        $productID = base64_encode($insertData);
		    endif;

		    if($type == 'update'):
		    	$mysqli->where('id', $id);
		    	$getData = $mysqli->getOne(D_SCAT);
		    	if(!empty($d_image)):
		    	 	$imgname1 = $d_image;
		    	else:
		    		$imgname1 = $getData['d_image'];
		    	endif;
		    	if(!empty($download)):
		    		$pdfname1 = $download;
		    	else:
		    		$pdfname1 = $getData['download'];
		    	endif;
		    	$data = array(
			    	'title' =>	$title,
			        'main_id' =>	$main_id,
			    	'd_image' =>	$imgname1,
			    	'download' =>	$pdfname1
			    );
			    $mysqli->where('id', $id);
			    $insertData = $mysqli->update(D_SCAT, $data);
			    $productID = base64_encode($id);
	        endif;
		
			if(isset($insertData)):
			    header('location:download-list.php');
			endif;
		break;
            
//////////////////////// CATEGORY //////////////////////////////////////////////
			case 'maincat':
				if($type == 'add'):
					$mysqli->orderBy('orders','desc');
					$getOrderNo = $mysqli->getOne(MAINCAT);
					$orderNo = $getOrderNo['orders'] + 1;
					$data = array('category_name' => $department, 'category' => 'category', 'status' => '1', 'orders' => $orderNo);
					$insertData = $mysqli->insert(MAINCAT, $data);
				endif;
				if($type == 'update'):
					$data = array('category_name' => $department);
					$mysqli->where('id', $id);
					$insertData = $mysqli->update(MAINCAT, $data);
					
				endif;
				if(isset($insertData)):
					header('location:category-list.php');
				endif;
			break;
			
			case 'mainCatDup':
			    $mysqli->where('category_name', $depart);
			    $mysqli->where('category', 'category');
			    $sameMainCat = $mysqli->getOne(MAINCAT);
			    if(isset($sameMainCat)){
			        echo $depart.' this category already exits';
			    }else{
			        echo '';
			    }
			break;

//////////////////////// CATEGORY //////////////////////////////////////////////
			case 'subcat':
				if($type == 'add'):
					$data = array('category_name' => $department, 'category' => 'type', 'status' => '1');
					$insertData = $mysqli->insert(MAINCAT, $data);
				endif;
				if($type == 'update'):
					$data = array('category_name' => $department);
					$mysqli->where('id', $id);
					$insertData = $mysqli->update(MAINCAT, $data);
					
				endif;
				if(isset($insertData)):
					header('location:sub-category-list.php');
				endif;
			break;
			
			case 'subCatDup':
			    $mysqli->where('category_name', $depart);
			    $mysqli->where('category', 'type');
			    $sameMainCat = $mysqli->getOne(MAINCAT);
			    if(isset($sameMainCat)){
			        echo $depart.' this sub category already exits';
			    }else{
			        echo '';
			    }
			break;

			case 'designation':
				if($type == 'add'):
					$data = array('name' => $designation, 'status' => '1');
					$insertData = $mysqli->insert(DESIGNATION, $data);
					
				endif;
				if($type == 'update'):
					$data = array('name' => $designation);
					$mysqli->where('id', $id);
					$insertData = $mysqli->update(DESIGNATION, $data);
					
				endif;
				if(isset($insertData)):
					header('location:designations.php');
				endif;
			break;
///////////////////////// EMPLOYEE ////////////////////////////////////////
			case'employee':
				if($type == 'update'):
					$uid = base64_decode($id);
					$data = array(
						'doj' => $doj,
						'fname' => $fname,
						'lname' => $lname,
						'profile_type' => $department,
						'designation' => $designation,
						'email' => $email,
						'whats_app' => $whats_app,
						'mobile_no' => $mobile_no,
						'password' => $password,
					);
				$mysqli->where('id', $uid);
				$insertData = $mysqli->update(UADMIN, $data);
				if(isset($insertData)):
					header('location:employees-list.php');
				endif;
				endif;
				if($type == 'new'):
					$mysqli->where('email', $email);
		    		$getRegister = $mysqli->getOne(UADMIN);
		    		$mysqli->where('mobile_no', $mobile_no);
		    		$getRegister_m = $mysqli->getOne(UADMIN);
		    		if (isset($getRegister)) {
		    			echo "<script>alert('Email id is already registered');</script>";
		    			echo "<script>window.open('add-employees.php','_SELF');</script>";
		    			
		    		}
		    		elseif(isset($getRegister_m)) {
		    		    echo "<script>alert('Phone Number is already registered');</script>";
		    			echo "<script>window.open('add-employees.php','_SELF');</script>";
				    }
		    		else{
						$otp = rand(1000,9999);
						$data = array(
							'doj' => $doj,
							'fname' => $fname,
							'lname' => $lname,
							'profile_type' => $department,
						    'designation' => $designation,
							'email' => $email,
							'mobile_no' => $mobile_no,
							'whats_app' => $whats_app,
							'password' => $password,
							'otp' => $otp,
							'status' => '1',
							'verified' => '1',
							'access' => '1'
						);
						$insertData = $mysqli->insert(UADMIN, $data);
						if(isset($insertData)){
							echo "<script>window.open('employees-list.php','_SELF');</script>";
						}
		    		}
				endif;
			break;
///////////////////////////// LEAD ////////////////////////////////////////
			case 'lead':
			    if($reg == 'Other'){
			            $assign = isset($_POST['assign']) ? $_POST['assign'] : [];
    $leadType = isset($_POST['leadType']) ? $_POST['leadType'] : [];
			        $mysqli->where('category', $otherReg);
			        $sameCat = $mysqli->getOne(UCAT);
			        if(!isset($sameCat)){
			        $dataCat = array('category' => $otherReg, 'status' => '1');
					$insertData = $mysqli->insert(UCAT, $dataCat);
					 $regName = $otherReg;
			        }else{
			             $regName = $sameCat['category'];
			        }
			    }else{
			        $regName = $reg;
			    }
			    
				if($type == 'update'):
				    $asg = '';
				    foreach($assign as $assignName){
				      $asg .=  $assignName.", "; 
				    }
				        $assTo = $assList." ".$asg;
				    $ldTYP = '';
				    foreach($leadType as $ldTy){
				        $ldTYP .= $ldTy.", ";
				    }
				    $leadName = $leadList." ".$ldTYP;
				$data = array(
					'fname' =>	$fname,
					'lname' =>	$lname,
					'contact1' => $contact1,
					'contact2' => $contact2,
					'landline' => $landline,
					'company_name' => $company_name,
					'email' => $email,
					'gst' => $gst,
					'tan' =>	$tan,
					'address1' => $address1,
					'address2' =>	$address2,
					'address3' =>	$address3,
					'state1' => $state1,
					'state2' => $state2,
					'state3' => $state3,
					'city1' => $city1,
					'city2' => $city2,
					'city3' => $city3,
					'country1' => $country1,
					'country2' => $country2,
					'country3' => $country3,
					'ac_code' =>	$ac_code,
					'group_code' =>	$group_code,
					'broker_code' => $broker_code,
					'gst_applicable' => $gst_applicable,
					'vat' =>	$vat,
					'pan' =>	$pan,
					'reg' =>	$regName,
					'priority' => $priority,
					'assign_to' => $assTo,
					'password' => $password,                                                                  
					'lead_type' => $leadName
					);
					$mysqli->where('id', $client_id);
					$insertUser = $mysqli->update(USER, $data);
					$client = base64_encode($client_id);
					$loc = 'profile.php?client='.$client;
				endif;
				if($type == 'new'):
				    
	                 /* ===============================
                       STOP EMPTY / INVALID DATA
                    ================================ */
                
                    if (
                        empty($fname) ||
                        empty($company_name) ||
                        empty($email) ||
                        empty($contact1)
                    ) {
                        header('Location: add-clients.php?msg=invalid');
                        exit;
                    }
                    
                      /* ===============================
                       EMAIL VALIDATION
                    ================================ */
                
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        header('Location: add-clients.php?msg=invalid_email');
                        exit;
                    }
                
                
                    /* ===============================
                       PHONE VALIDATION
                    ================================ */
                
                    $contact1 = preg_replace('/\s+/', '', $contact1);
                
                    if (!preg_match('/^[0-9]{10}$/', $contact1)) {
                        header('Location: add-clients.php?msg=invalid_phone');
                        exit;
                    }
                    
                    
                        /* ===============================
                           CHECK DUPLICATE PHONE
                        ================================ */
                    
                        $mysqli->where('contact1', $contact1);
                        $phoneUser = $mysqli->getOne(USER);
                    
                        if (!empty($phoneUser)) {
                            header('Location: add-clients.php?msg=phone_exists');
                            exit;
                        }

    	                   /* ===============================
                               CHECK DUPLICATE EMAIL
                            ================================ */
                        
                            $mysqli->where('email', $email);
                            $emailUser = $mysqli->getOne(USER);
                        
                            if (!empty($emailUser)) {
                                header('Location: add-clients.php?msg=email_exists');
                                exit;
                            }
                            
                                                    
                            /* ===============================
                               ASSIGN
                            ================================ */
                        
                            $assign = $_POST['assign'] ?? [];
                            $asg = '';
                        
                            if (is_array($assign)) {
                                foreach ($assign as $assignName) {
                                    if (!empty($assignName)) {
                                        $asg .= $assignName . ', ';
                                    }
                                }
                            }
                            
                            /* ===============================
                               LEAD TYPE
                            ================================ */
                        
                            $leadType = $_POST['leadType'] ?? [];
                            $ldTYP = '';
                        
                            if (is_array($leadType)) {
                                foreach ($leadType as $ldTy) {
                                    if (!empty($ldTy)) {
                                        $ldTYP .= $ldTy . ', ';
                                    }
                                }
                            }
                            
                            /* ===============================
                       INSERT DATA
                    ================================ */
                
                    $data = array(
                        'fname' => trim($fname),
                        'lname' => trim($lname),
                        'contact1' => $contact1,
                        'contact2' => trim($contact2),
                        'landline' => trim($landline),
                        'company_name' => trim($company_name),
                        'email' => trim($email),
                
                        'gst' => $gst,
                        'tan' => $tan,
                        'lead_type' => $ldTYP,
                
                        'address1' => $address1,
                        'address2' => $address2,
                        'address3' => $address3,
                
                        'state1' => $state1,
                        'state2' => $state2,
                        'state3' => $state3,
                
                        'city1' => $city1,
                        'city2' => $city2,
                        'city3' => $city3,
                
                        'country1' => $country1,
                        'country2' => $country2,
                        'country3' => $country3,
                
                        'ac_code' => $ac_code,
                        'group_code' => $group_code,
                        'broker_code' => $broker_code,
                
                        'gst_applicable' => $gst_applicable,
                        'vat' => $vat,
                        'pan' => $pan,
                
                        'reg' => $regName,
                        'assign_to' => $asg,
                
                        'status' => '1',
                        'verified' => '1',
                        'access' => '1',
                
                        'priority' => $priority,
                        'password' => $password,
                        'cl_ref' => 'erp'
                    );


                /* FINAL INSERT */
            
                $insertUser = $mysqli->insert(USER, $data);
                
                if (!$insertUser) {
            
                    die(
                        'Client not added: ' .
                        $mysqli->getLastError()
                    );
            
                }
            
                header('Location: users.php');
                exit;


				endif;
			break;
/////////////////////////////PRODUCT /////////////////////////////////////////////
		case'product':
		if(!empty($_FILES['img1']['name'])):
			$temp = explode(".", $_FILES['img1']['name']);
			$img1 = round(microtime(true)).'.'.end($temp);
			$imgtmp1 = $_FILES['img1']['tmp_name'];
			$imgpath1 = '../Images/'.$img1;
			move_uploaded_file($imgtmp1, $imgpath1);
		else:
			$img1 = '';
		endif;
		if(!empty($_FILES['img2']['name'])):
			$temp1 = explode(".", $_FILES['img2']['name']);
			$img2 = round(microtime(true)).'.'.end($temp1);
			$imgtmp2 = $_FILES['img2']['tmp_name'];
			$imgpath2 = '../Images/'.$img2;
			move_uploaded_file($imgtmp2, $imgpath2);
		else:
			$img2 = '';
		endif;
		if(!empty($_FILES['img3']['name'])):
			$temp2 = explode(".", $_FILES['img3']['name']);
			$img3 = round(microtime(true)).'.'.end($temp2);
			$imgtmp3 = $_FILES['img3']['tmp_name'];
			$imgpath3 = '../Images/'.$img3;
			move_uploaded_file($imgtmp3, $imgpath3);
		else:
				$img3 = '';
		endif;
		if(!empty($_FILES['img4']['name'])):
			$temp3 = explode(".", $_FILES['img4']['name']);
			$img4 = round(microtime(true)).'.'.end($temp3);
			$imgtmp4 = $_FILES['img4']['tmp_name'];
			$imgpath4 = '../Images/'.$img4;
			move_uploaded_file($imgtmp4, $imgpath4);
			else:
				$img4 = '';
			endif;
			if(!empty($_FILES['pdf1']['name'])):
			$temp4 = explode(".", $_FILES['pdf1']['name']);
			$pdf1 = round(microtime(true)).'.'.end($temp4);
				$pdftmp1 = $_FILES['pdf1']['tmp_name'];
				$pdfpath1 = '../PDFs/'.$pdf1;
				move_uploaded_file($pdftmp1, $pdfpath1);
			else:
				$pdf1 = '';
			endif;

			if(!empty($_FILES['pdf2']['name'])):
			$temp5 = explode(".", $_FILES['pdf2']['name']);
			$pdf2 = round(microtime(true)).'.'.end($temp5);
				$pdftmp2 = $_FILES['pdf2']['tmp_name'];
				$pdfpath2 = '../PDFs/'.$pdf2;
				move_uploaded_file($pdftmp2, $pdfpath2);
			else:
				$pdf2 = '';
			endif;

			if(!empty($_FILES['pdf3']['name'])):
			$temp6 = explode(".", $_FILES['pdf3']['name']);
			$pdf3 = round(microtime(true)).'.'.end($temp6);
				$pdftmp3 = $_FILES['pdf3']['tmp_name'];
				$pdfpath3 = '../PDFs/'.$pdf3;
				move_uploaded_file($pdftmp3, $pdfpath3);
			else:
				$pdf3 = '';
			endif;
			if($category == 'other'):
				$mysqli->where('category', 'category');
				$mysqli->where('category_name', $other_cat);
				$getSame  = $mysqli->getOne(MAINCAT);
				if(isset($getSame)):
					$no_category = $getSame['id'];
				else:
					$data = array(
						'category' => 'category',
						'category_name' => $other_cat,
						'status' => 1
					);
					$addCat = $mysqli->insert(MAINCAT, $data);
					$no_category = $addCat;
				endif;
			else:
					$no_category = $category;
			endif;
			if($sub_cat_type == 'other'):
				$mysqli->where('category', 'type');
				$mysqli->where('category_name', $other_type);
				$getSame  = $mysqli->getOne(MAINCAT);
				if(isset($getSame)):
					$no_subcategory = $getSame['id'];
				else:
					$data = array(
						'category' => 'type',
						'category_name' => $other_type,
						'status' => 1
					);
					$addSubCat = $mysqli->insert(MAINCAT, $data);
					$no_subcategory = $addSubCat;
				endif;
			else:
					$no_subcategory = $sub_cat_type;
			endif;
			$code1 = (!empty($code))? $code : '0';
			$brand1 = (!empty($brand))? $brand : '0';
			$unit1 = (!empty($unit))? $unit : '0';
			$sale_rate1 = (!empty($sale_rate))? $sale_rate : '0';
			$purchase_rate1 = (!empty($purchase_rate))? $purchase_rate : '0';
			$mrp1 = (!empty($mrp))? $mrp : '0';
			$box1 = (!empty($box))? $box : '0';
			$product_weight1 = (!empty($product_weight))? $product_weight : '0';
			$product_dimension1 = (!empty($product_dimension))? $product_dimension : '0';
			$hsn_code1 = (!empty($hsn_code))? $hsn_code : '0';
			$required_status1 = (!empty($required_status))? $required_status : '0';
			$youtube1 = (!empty($youtube))? $youtube : '0';
				if($type == 'new'):
					$data = array(
					'name' =>	$name, 
					'country' =>	$country, 
					'code' =>	$code1, 
					'product_type' =>	$product_type, 
					'type' =>	$no_subcategory,
					'category' =>	$no_category,
					'brand' =>	$brand1,
					'description' =>	$description,
					'unit' =>	$unit1,
					'sale_rate' =>	$sale_rate1,
					'gross_weight' =>	$gross_weight,
					'net_weight' =>	$net_weight,
					'mrp' =>	$mrp1,
					'box' =>	$box1,
					'currency' =>	$currency,
					'product_weight' =>	$product_weight1,
					'product_dimension' =>	$product_dimension1,
					'hsn_code' =>	$hsn_code1,
					'specification' =>	$specification,
					'required_status' =>	$required_status1,
					'youtube' =>	$youtube1,
					'img1' =>	$img1,
					'img2' =>	$img2,
					'img3' =>	$img3,
					'img4' =>	$img4,
					'pdf1' =>	$pdf1,
					'pdf2' =>	$pdf2,
					'pdf3' =>	$pdf3
					);
				$insertData = $mysqli->insert(PRODUCT, $data);
					$productID = base64_encode($insertData);
					
			      foreach ($nameSale as $k => $v) {
			          echo $title = $nameSale[$k];
			          echo $link = $nameLink[$k];
			          echo $detail = $comment[$k];
			          if(!empty($title)){
			              $dataSale = array(
			                  'prod_id' => $insertData,
			                  'name' => $title,
			                  'details' => $detail,
			                  'link' => $link,
			                  'status' => 1,
			                  'create_date' => time()
			                  );
			                  $mysqli->insert(ASALES, $dataSale);
			          }
			      }
			      
			      foreach ($product_ytube as $k => $v) {
			          echo $title = $product_ytube[$k];
			          if(!empty($title)){
			              $dataSale = array(
			                  'prod_id' => $insertData,
			                  'yt_link' => $title,
			                  'status' => 1,
			                  'create_date' => time()
			                  );
			                  $mysqli->insert(YOUTUBE, $dataSale);
			          }
			      }



				endif;

				if($type == 'update'):
					$mysqli->where('id', $id);
					$getData = $mysqli->getOne(PRODUCT);
					if(!empty($img1)):
					 	$imgname1 = $img1;
					else:
						$imgname1 = $getData['img1'];
					endif;
					if(!empty($img2)):
						$imgname2 = $img2;
					else:
						$imgname2 = $getData['img2'];
					endif;
					if(!empty($img3)):
						$imgname3 = $img3;
					else:
						$imgname3 = $getData['img3'];
					endif;
					if(!empty($img4)):
						$imgname4 = $img4;
					else:
						$imgname4 = $getData['img4'];
					endif;
					if(!empty($pdf1)):
						$pdfname1 = $pdf1;
					else:
						$pdfname1 = $getData['pdf1'];
					endif;
					if(!empty($pdf2)):
						$pdfname2 = $pdf2;
					else:
						$pdfname2 = $getData['pdf2'];
					endif;
					if(!empty($pdf3)):
						$pdfname3 = $pdf3;
					else:
						$pdfname3 = $getData['pdf3'];
					endif;

					$data = array(
					'name' =>	$name, 
					'country' =>	$country, 
					'code' =>	$code1, 
					'product_type' =>	$product_type, 
					'type' =>	$no_subcategory,
					'category' =>	$no_category,
					'brand' =>	$brand1,
					'description' =>	$description,
					'unit' =>	$unit1,
					'sale_rate' =>	$sale_rate1,
					'gross_weight' =>	$gross_weight,
					'net_weight' =>	$net_weight,
					'mrp' =>	$mrp1,
					'box' =>	$box1,
					'currency' =>	$currency,
					'product_weight' =>	$product_weight1,
					'product_dimension' =>	$product_dimension1,
					'hsn_code' =>	$hsn_code1,
					'specification' =>	$specification,
					'required_status' =>	$required_status1,
					'youtube' =>	$youtube1,
					'img1' =>	$imgname1,
					'img2' =>	$imgname2,
					'img3' =>	$imgname3,
					'img4' =>	$imgname4,
					'pdf1' =>	$pdfname1,
					'pdf2' =>	$pdfname2,
					'pdf3' =>	$pdfname3
					);
					$mysqli->where('id', $id);
				$insertData = $mysqli->update(PRODUCT, $data);
				foreach ($nameSale as $k => $v) {
			          echo $title = $nameSale[$k];
			          echo $link = $nameLink[$k];
			          echo $detail = $comment[$k];
			          if(!empty($title)){
			              $dataSale = array(
			                  'prod_id' => $id,
			                  'name' => $title,
			                  'details' => $detail,
			                  'link' => $link,
			                  'status' => 1,
			                  'create_date' => time()
			                  );
			                  $mysqli->insert(ASALES, $dataSale);
			          }
			      }
			      
			        foreach ($product_ytube as $k => $v) {
			          echo $title = $product_ytube[$k];
			          if(!empty($title)){
			              $dataSale = array(
			                  'prod_id' => $id,
			                  'yt_link' => $title,
			                  'status' => 1,
			                  'create_date' => time()
			                  );
			                  $mysqli->insert(YOUTUBE, $dataSale);
			          }
			      }
			      
			      foreach ($product_ytube_up as $k => $v) {
			          echo $title = $product_ytube_up[$k];
			          if(!empty($title)){
			              $dataSale = array(
			                  'prod_id' => $id,
			                  'yt_link' => $title,
			                  );
			                  $mysqli->where('id', $aID);
			                  $mysqli->update(YOUTUBE, $dataSale);
			          }
			      }
			      
			      
			      foreach ($nameSale_up as $k => $v) {
			          echo $aID = $id_up[$k];
			          echo $title = $nameSale_up[$k];
			          echo $link = $nameLink_up[$k];
			          echo $detail = $comment_up[$k];
			          if(!empty($title)){
			              $dataSaleUp = array(
			                  'prod_id' => $id,
			                  'name' => $title,
			                  'details' => $detail,
			                  'link' => $link,
			                  'status' => 1,
			                  'create_date' => time()
			                  );
			                  $mysqli->where('id', $aID);
			                  $mysqli->update(ASALES, $dataSaleUp);
			          }
			      }
					$productID = base64_encode($id);
				endif;
		
				if(isset($insertData)):
				    if($type == 'new'):
				        $loc = 'product-view.php?product='.$productID;
				     //   $loc = 'mail.php?mail=register&client='.$client;
					$title = 'New Product Added.';
					$message = 'Product Name - '.$name.'Product Type - '.$product_type.' Product Category - '.$no_category.' Product Sub-Category - '.$no_subcategory;
			        	$sendAlert = alertApp('All', $title,  $message, $loc);
				    else:
				        header('location:product-view.php?product='.$productID);
				    endif;
				endif;
			break;	
			case'task':
				if($type == 'insert'):
					if(!empty($_FILES['upload_file']['name'])):
						$taskImg = $_FILES['upload_file']['name'];
						$imgtmp1 = $_FILES['upload_file']['tmp_name'];
						$imgpath1 = '../task/'.$taskImg;
						move_uploaded_file($imgtmp1, $imgpath1);
					else:
						$taskImg = '';
					endif;
					$dataTask = array(
						'name' => $name
					);
					$insertT = $mysqli->insert(TASKNAME, $dataTask); 
					$startDate = "";
					$endDate = "";
					$priorityName = "";
					if(isset($insertT)):
						foreach ($team_name as $key => $value) {
							$teamName = $team_name[$key];
							$commName = $comment[$key];
						$general = ($task_type == 'General')? '1': '0';
						$bank = ($task_type == 'Bank')? '1': '0';
						$government = ($task_type == 'Tax')? '1': '0';
						$tax = ($task_type == 'Other')? '1': '0';
						$explode_start = explode('/', $start_date);
						$converStart = $explode_start['2'].'-'.$explode_start['1'].'-'.$explode_start['0'];
						$explode_end = explode('/', $end_date);
						$converEnd = $explode_start['2'].'-'.$explode_start['1'].'-'.$explode_start['0'];
						$startDate = $converStart;
						$endDate = $converEnd;
						$priorityName = $priority;
							if(!empty($teamName)){
					$data = array(
						'task_id' => $insertT,
						'createTask' => $createTask,
						'task' => $name,
						'client' => $client,
						'indivisual_task' => $client,
						'start_date' => $converStart,
						'end_date' => $converEnd,
						'priority' => $priority,
						'reminder' => $reminder,
						'reminder_set' => $reminder_set,
						'indivisual_task' => $description,
						'employee_list' => $teamName,
						'comment' => $commName,
						'img' => $taskImg,
						'general' => $general,
						'bank' => $bank,
						'government' => $government,
						'complete_task' => 0,
						'tax' => $tax,
						'status' => 1,
						'workStatus' => 0
					);
					$insertTask = $mysqli->insert(TASK, $data); 
					}
						    
						}
					$mysqli->where('id', $client);
					$getName = $mysqli->getOne(USER);
					
					
				    	$subject = 'New Task Assign - '.$name;
                        $to = 'design.rlight@gmail.com';
                        $from = 'donotreply@alptechindia.com';
                        $fromName = 'ALPTECH INTERNATIONAL'; 
                        $files = '';
			            $message = '<html><body>';
                        $message .= '<h4><b>New Task - '.$name.'</b></h4>';
                        $message .= '<p><b>Task ID:</b> TSK-'.$insertT.'</p>';
                        $message .= '<p><b>Client Name:</b> '.$getName['fname'].' '.$getName['lname'].'</p>';
                        $message .= '<p><b>Company:</b> '.$getName['company_name'].'</p>';
                        $message .= '<p><b>Start Date:</b> '.$startDate.' <b>End Date:</b> '.$endDate.'</p>';
                        $message .= '<p><b>Priority:</b> '.$priorityName.'</p>';
                        $message .= '<p><b>Description:</b> '.$description.'</p>';
                        $message .= '<p><b>Assign Employees:</b> </p>';
                    	foreach ($team_name as $key => $value) {
							$teamName = $team_name[$key];
							$commName = $comment[$key];
							$mysqli->where('id', $teamName);
							$getUser = $mysqli->getOne(UADMIN);
                    	$message .= '<p><b>Employee Name:</b> '.$getUser['fname'].' '.$getUser['lname'].'</p>';    
                        $message .= '<p><b>Description:</b> '.$commName.'</p><hr/>';
                    	}
                        $message .= '</body></html>';
                        $sendEmail = multi_attach_mail($to, $subject, $message, $from, $fromName, $files); 
                        if(isset($sendEmail)){
                            foreach ($team_name as $key => $value) {
							$teamName = $team_name[$key];
							$commName = $comment[$key];
							$mysqli->where('id', $teamName);
							$getUserEmail = $mysqli->getOne(UADMIN);
							$toAssign = $getUserEmail['email'];
							$filesAssign = '';
    			            $messageAssign = '<html><body>';
                            $messageAssign .= '<h4><b>New Task - '.$name.'</b></h4>';
                            $messageAssign .= '<p><b>Task ID:</b> TSK-'.$insertT.'</p>';
                            $messageAssign .= '<p><b>Client Name:</b> '.$getName['fname'].' '.$getName['lname'].'</p>';
                            $messageAssign .= '<p><b>Company:</b> '.$getName['company_name'].'</p>';
                            $messageAssign .= '<p><b>Start Date:</b> '.$startDate.' <b>End Date:</b> '.$endDate.'</p>';
                            $messageAssign .= '<p><b>Priority:</b> '.$priorityName.'</p>';
                            $messageAssign .= '<p><b>Description:</b> '.$description.'</p>';
                            if(isset($getUserEmail)){
                            $messageAssign .= '<p><b>Assign Work:</b> '.$commName.'</p>';
                            }
                            $sendEmailAssign = multi_attach_mail($toAssign, $subject, $messageAssign, $from, $fromName, $filesAssign); 

                          }
                        }
					endif;

				endif;
				if($type == 'update'):
				    echo $end_date;
					$explode_start = explode('/', $start_date);
					$converStart = $explode_start['2'].'-'.$explode_start['1'].'-'.$explode_start['0'];
					$explode_end = explode('/', $end_date);
					$converEnd = $explode_end['2'].'-'.$explode_end['1'].'-'.$explode_end['0'];
					$data = array(
						'task' => $name,
						'client' => $client,
						'indivisual_task' => $client,
						'start_date' => $converStart,
						'end_date' => $converEnd,
						'priority' => $priority,
						'indivisual_task' => $description,
						'complete_task' => $working_status,
					);
					$id = base64_decode($id);
					$mysqli->where('task_id', $id);
					$updateData = $mysqli->update(TASK, $data);
					$dataNw = array('name' => $name);
					$mysqli->where('id', $id);
					$dataUpdate = $mysqli->update(TASKNAME, $dataNw);
					print_r($data);
						foreach ($team_name as $key => $value) {
							$teamName = $team_name[$key];
							$commName = $comment[$key];
						$general = ($task_type == 'General')? '1': '0';
						$bank = ($task_type == 'Bank')? '1': '0';
						$government = ($task_type == 'Tax')? '1': '0';
						$tax = ($task_type == 'Other')? '1': '0';
						$explode_start = explode('/', $start_date);
						$converStart = $explode_start['2'].'-'.$explode_start['1'].'-'.$explode_start['0'];
						$explode_end = explode('/', $end_date);
						$converEnd = $explode_start['2'].'-'.$explode_start['1'].'-'.$explode_start['0'];
						$startDate = $converStart;
						$endDate = $converEnd;
						$priorityName = $priority;
						if(!empty($teamName)){
					$dataNw = array(
						'task_id' => $id,
						'createTask' => $createTask,
						'task' => $name,
						'client' => $client,
						'indivisual_task' => $client,
						'start_date' => $converStart,
						'end_date' => $converEnd,
						'priority' => $priority,
						'reminder' => $reminder,
						'reminder_set' => $reminder_set,
						'indivisual_task' => $description,
						'employee_list' => $teamName,
						'comment' => $commName,
						'img' => $taskImg,
						'general' => $general,
						'bank' => $bank,
						'government' => $government,
						'complete_task' => $working_status,
						'tax' => $tax,
						'status' => 1,
						'workStatus' => 0
					);
					$insertTask = $mysqli->insert(TASK, $dataNw); }
					}
					foreach ($assign_id as $key => $value) {
							$update_id = $assign_id[$key];
				// 			$teamName = $team_name[$key];
							$commName = $comment[$key];
					
					$dataAssign = array(
				// 		'employee_list' => $teamName,
						'comment' => $commName
						
					);
					$mysqli->where('id', $update_id);
					$updateTaskData = $mysqli->update(TASK, $dataAssign); 
					}
				endif;
			$clID = base64_encode($client);
			if($type == 'insert'):
			       //   $loc = 'tasks.php?client='.$clID;
				     //   $loc = 'mail.php?mail=register&client='.$client;
				     $senderID = 'employees_'.$teamName;
					$title = 'New Task Assign - '.$name;
					$message = $commName;
					$sendAlert = alertApp($senderID, $title,  $message, $loc);
		//	else:
				
			endif;
		//	$loc = 'tasks.php?client='.$clID;
            header('location:task_list.php?client='.$clID);
			break;

			
		}
	endif;
 ?>