<?php 
$phpval = json_decode( file_get_contents('php://input'));
header("Access-Control-Allow-Origin: *");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
// echo round(0.33123355084,3);
$result = array();
if($_POST['tag'] == 'sendmail'){    
   $name = $_POST['name'];
   $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $wp_no = $_POST['wp_no'];
    $emirates = $_POST['emirates'];
    //$addr1 = $_POST['addr1'];
    //$addr2 = $_POST['addr2'];
    //$landmark = $_POST['landmark'];
    //$pincode = $_POST['pincode'];
    $msg = 'Name : <b>'.$name.'</b><br>Mobile No : <b>'.$mobile.'</b><br> Email : <b>'.$email.'</b><br>Whatsapp : <b>'.$wp_no.'</b><br> Location  : <b>'.$emirates.'</b>';

    $mailres = usermail($email,$msg,$name);
    $mailres = 1;
    if($mailres == 1){
        $result['status'] = 'success';
        $result['message'] = 'Mail Sended';    
        echo json_encode($result);
    }else{
        $result['status'] = 'failure';
        $result['message'] = 'Server error please try again!';
        echo json_encode($result);   
    }
        
} 
function usermail($email,$msg,$name){
// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'infoanarvva@gmail.com';                     // SMTP username
    $mail->Password   = 'Anarvva@2020!';                               // SMTP password
    //$mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to
 $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
    //Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress('info@anarvva.com', 'Anarvva');     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'New Enquiry form '.$name;
    $mail->Body    = $msg;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    // echo 'Message has been sent';
    return 1;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    return 0;
}
}
?>