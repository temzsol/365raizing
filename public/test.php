<?php
$conn=mysqli_connect("localhost","u819948522_deepak","v;Eag6PE*7E");
$db=mysqli_select_db($conn,"u819948522_rrwebdevelopme");

include('smtp/PHPMailerAutoload.php');
function smtp_mailer($to,$subject, $msg){

	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'ssl'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	//$mail->SMTPDebug = 2; 
	$mail->Username = "info@quickfunding.com.au";
	$mail->Password = "emgctrlmnbmrdztw";
	$mail->SetFrom("info@quickfunding.com.au");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		return 'Sent';
	}
}



  if(!empty($_POST['name'] && $_POST['name']))
  {
      
  
    $name= $_POST['name'];
 	$email= $_POST['email'];
 	$phone= $_POST['phone'];
 	
 	$sql="INSERT INTO `quickfunding_email`(`name`, `email`, `phone`) VALUES ('$name','$email','$phone')";
 	$query=mysqli_query($conn,$sql) or die(mysqli_error($conn));

//     $name="Deepak Prasad";
//  	$email='deepakprasad224@gmail.com';
	
		$body = "Dear ".$name;
        $body .= "<p>Greetings of the day!!</p>";
        $body .= "<p>As per our telephone conversation regarding the Personal/Car/Business Loan, please send us</p>"; 
        
        $body .= "<p> 1. The filled-in form titled <span style='color:red'>Customer Statement of Position</span> (No Print out Required. Open in PDF Software only and save as customer statement-your name after filing all fields. Please sign in the box where it says Signature. Just follow the instructions)</p>" ;
        
        $body .= "<p style='color:red; font-weight: 700;'>Check List</p>";
        
        $body .= "<p style='color:#9900FF'>Income requirements</p> ";
        $body .= "<p style='color:#3D85C6'>For People with Full-Time Employment</p><ol>";
        $body .= "<li>PAYG – 2 payslips within the last 60 days</li> ";
        $body .="<li> 3 Months Bank Statement</li></ol> ";
       
        $body .= "<p style='color:#3D85C6'> For People with Self Employment</p><ol>"; 
        $body .="<li>Bank Statement</li>";
        $body .= "<li>Tax Return / Letter Of Accountant</li></ol>";
        
        $body .="<p style='color:#3D85C6'> Identification Requirement</p><ol>";
        $body .= "<li>Drivers Licence</li>";
        $body .= "<li>Medicare</li></ol>";
        
        $body .=  "<p style='color:#3D85C6'>Loan amount & term</p><ul>";
        $body .= "<li>Starting from $4,000</li>";
        $body .= " <li>2–7 year</li>";
        $body .=   "<p> Please find the attached Credit Guide for your reference and also sign the attached Customer statement of position</p>";
        
        $body .= "<p>In case of any further queries or clarification, please write back to us and we will be glad to help.</p><br>";
        
        // $body .= "<a href='".base_url()."assets/Customer_Statement_of_Position.pdf' download>Customer Statement of Position.pdf</a> | "; 
        // $body .= "<a href='".base_url()."assets/Credit_Guide_Consumer_Asset_Finance_and_Personal_Loans.pdf' download>Credit Guide Consumer Asset Finance and Personal Loans.pdf</a>";
         $body .= "<a href='http://quickfundingcrm.com/assets/Customer_Statement_of_Position.pdf' download>Customer Statement of Position.pdf</a> | "; 
        $body .= "<a href='http://quickfundingcrm.com/assets/Credit_Guide_Consumer_Asset_Finance_and_Personal_Loans.pdf' download>Credit Guide Consumer Asset Finance and Personal Loans.pdf</a>";
        $body .= "<p><b>Regards</b></p>";
        $body .= " <p><b>Admin Support</b></p>";
        
        $body .=  "<p<b>QUICK FUNDING PTY LTD</b></p>";
        $body .=   "<p><b>Complementary Services | Expert Advice | Reliable Team | Lifetime Guidance</b></p>";
        $body .=  "<blockquote><li> Tel:<a href='tel:0282182470'>02 82182470</a> | <a href='tel:0401341626'> 0401341626</a></li>";
        $body .=   "<li>Email: <a href='mailto:info@quickfunding.com.au'>info@quickfunding.com.au</a></li>";
        $body .=  "<li>Website: <a href='www.quickfunding.com.au'>www.quickfunding.com.au</a></li></blockquote>";

 echo smtp_mailer($email,'Personal/Car/Business Loan',$body); 
}
else
{
    echo "Mail Not Send";
}


 
  
  
?>