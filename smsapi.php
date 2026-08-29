<?php 
function sendOtp($otp, $mobile_no){
       // This is the sms text that will be sent via sms
       $sms_content = "Greetings from Alptech India: ".$otp;
       
       // Encoding the text in url format
       $sms_text = urlencode($sms_content);
       
       // This is the Actual API URL concatnated with required values
       $api_url = "http://bulksms.rlightventes.com/websms/sendsms.aspx?userid=Alptech&password=12345&sender=Alptec&mobileno=".$mobile_no."&msg=".$sms_text."";
   
       // Envoking the API url and getting the response
       $response['status'] = 1;
       $response['otp_message'] = file_get_contents( $api_url);
       
       // Returning the response
       return $response;
   }
?>