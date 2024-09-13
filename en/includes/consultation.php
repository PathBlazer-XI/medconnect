<?php

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Display form data received
    echo "<h2>Form Data Received:</h2>";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    
    // Process form data here
    // For example, you can access form fields like $_POST['fieldname']
}
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

 require_once 'dbconnection.php';


if (isset($_POST["submit"])) {
	
	$name = $_POST["name"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	$datepicker = $_POST["datepicker"];
	$time = $_POST["time"];
	$department = $_POST["department"];
	$googlemeet = "https://meet.google.com/yau-jfdc-tph";
    $admin = "info@medconnectneu.com";

	
}

$sql=mysqli_query($con,"select id from users where email='$email'");
$row=mysqli_num_rows($sql);
if($row>1000)
{
	header("location:../signup.php?msg=email exists");

	exit();

}
 else{
	$msg=mysqli_query($con,"insert into users(name,email,phone,datepicker,time,department) values('$name','$email','$phone','$datepicker','$time','$department')");

if($msg)
{

 //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.titan.email';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'info@medconnectneu.com';                     //SMTP username
    $mail->Password   = 'Whitewalker#1';                               //SMTP password
    $mail->SMTPSecure = 'ssl';           						//Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('info@medconnectneu.com', 'MedConnectNEU');
    $mail->addAddress("$email");     //Add a recipient
     $mail->addAddress("$admin");     //Add a recipient
	$mail->addReplyTo('info@medconnectneu.com', 'MedConnectNEU');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Online consultation booking';
    $mail->Body    = '<div style="background: transparent; margin: 0px auto; border-radius: 0px; max-width: 600px;">
  <table style="border-collapse: collapse; background: transparent; width: 600px; border-radius: 0px;" border="0" cellspacing="0" cellpadding="0" align="center">
    <tbody>
      <tr>
        <td style="border-collapse: collapse; border: none; direction: ltr; font-size: 0px; padding: 32px 16px;">
          <div style="max-width: 568px; width: 568px; direction: ltr; display: inline-block; vertical-align: middle;">
            <table style="border-collapse: collapse; background-color: transparent; border: none; vertical-align: middle;" border="0" width="100%" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td style="border-collapse: collapse; padding: 0px; word-break: break-word;" align="center">
                    <table style="border-collapse: collapse; border-spacing: 0px;" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td style="border-collapse: collapse; width: 124px;">
                            <center>
                              <img style="border: 0px; height: 100%; line-height: 13px; outline: none; text-decoration-line: none; border-radius: 0px; display: block; width: 245%; font-size: 13px;" src="https://medconnectneu.com/en/assets/icons/MedConnect_Black_Logo.png" alt="MedConnectNEU" width="124">
                            </center>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>
<div style="margin: 0px auto; max-width: 600px;">
  <table style="border-collapse: collapse; width: 600px;" border="0" cellspacing="0" cellpadding="0" align="center">
    <tbody>
      <tr>
        <td style="border-collapse: collapse; direction: ltr; font-size: 0px; padding: 0px; text-align: center;">
          <div style="max-width: 100%; width: 600px; text-align: left; direction: ltr; display: inline-block; vertical-align: top;">
            <table style="border-collapse: collapse;" border="0" width="100%" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td style="border-collapse: collapse; vertical-align: top; padding: 0px;">
                    <table style="border-collapse: collapse;" border="0" width="100%" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td style="border-collapse: collapse; padding: 0px; word-break: break-word;" align="left">
                            <table style="border-collapse: collapse; border-spacing: 0px;" border="0" cellspacing="0" cellpadding="0">
                              <tbody>
                                <tr>
                                  <td style="border-collapse: collapse; width: 600px;">
                                    <img style="outline: none; border: 0px; height: auto; line-height: 13px; display: block; width: 600px; font-size: 13px;" src="https://ci3.googleusercontent.com/meips/ADKq_NYrYRMcLDKE_oU8sY5vP5fkC9vRterXgvx70E8XHjq-f64ilSB73Xdj3MyiuCOxJsOEtJM1gmVlQGZERX6Rdy6gsFnYyOiTC5TzyU77yRX_PNOU6x-f3Bf_qeAqjRcSa55DcY31gFOZf5AQRI5Mo7eMVqr8XElawQJVHXrn61a1auDBKSKppaX4ZrOqa4JZ2-AtpmzXzR2B_sK1FQuYd8_b6u21qP2ws-1MgynsyA4myoLpJ7XB9B0_fbzWeNpYSAZjVx3W5gmO3_xaBjww0aBp3VTM-XxNF8XqyV_5HZImNWuLwdiuBy4jupuBjHOnzbJgcwPri-h0qwgeW0sQuhasBykR9NyBi0rkCfPz1HUaqDXcfjWv-kWyowyVB60_hQuvEwit2hTY4z0rD9W3nWj8l02vYglH_kKrLq0-XYikaIoxCXKodBvzTSJX_gq8ZVVp7DM8OgNYZNlbVVqippp7N4cifqGmub-K7FSxhMKnQzMjyOPyOexZAOrHv4AFRz5QO3BYfQnPSaxz2x_OLWhCd6MZxJcndTX72h1VqCtpxp3djS-4a_10=s0-d-e1-ft#https://img.sibmail.numan.com/im/3054120/a65ceb5d7aab1b4fe31cd44cd6f5dcd8b6c64db9fa5b3b3f27bc5eee90f38b3f.png?e=boDAZbVil_0g83obZP7N5HKScg3PTl1q78CjAaiMCvvDWtt_PMAl3lFFZldC911Ma4lnAnQGrycAMM_Q2e9QbzaFjssdRFR5fVD2qHNCqxGLo4dvYc_NLX_Z58EgNNxcaG76SPgFndd50HyTQCid54k32x_N8emXzYJW09oEaeuzW05eP1vZ5W8gguG9yDJaQRBeJ8oh9VyqaCaXBwjJO4dKQKBXx1DeaQDpxUlwaQLr0zD5j0mh8PIO2-fmbQmsXJRj24-RDQB9PuSOaRWOJtdeWF45P0N31g" alt="MedConnectNEU" width="600" height="auto">
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>
<div style="background: #e3e3e3; margin: 0px auto; border-radius: 0px 0px 32px 32px; max-width: 600px;">
  <div style="background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-origin: initial; background-clip: initial; margin: 0px auto; border-radius: 0px; max-width: 600px;">
    <table style="border-collapse: collapse; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-origin: initial; background-clip: initial; width: 600px; border-radius: 0px;" border="0" cellspacing="0" cellpadding="0" align="center">
      <tbody>
        <tr>
          <td style="border-collapse: collapse; border: none; direction: ltr; font-size: 0px; padding: 24px 32px;">
            <div style="max-width: 536px; width: 536px; direction: ltr; display: inline-block; vertical-align: top;">
              <table style="border-collapse: collapse; background-color: transparent; border: none; vertical-align: top;" border="0" width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                  <tr>
                    <td style="border-collapse: collapse; padding: 0px 0px 8px; word-break: break-word;" align="left">
                      <div style="font-family: Helvetica Neue,Arial,sans-serif; font-size: 28px; line-height: 32px; color: #000000;">
                        <span style="font-weight: bold; line-height: 32px; letter-spacing: -1px; text-decoration-line: initial;">Booking confirmation</span>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div style="background: #f9f9f9; margin: 0px auto; border-radius: 0px; max-width: 600px;">
    <table style="border-collapse: collapse; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-origin: initial; background-clip: initial; width: 600px; border-radius: 0px;" border="0" cellspacing="0" cellpadding="0" align="center">
      <tbody>
        <tr>
          <td style="border-collapse: collapse; border: none; direction: ltr; font-size: 0px; padding: 32px 32px 24px;">
            <div style="max-width: 536px; width: 536px; direction: ltr; display: inline-block; vertical-align: top;">
              <table style="border-collapse: collapse; background-color: transparent; border: none; vertical-align: top;" border="0" width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                  <tr>
                    <td style="border-collapse: collapse; padding: 0px 0px 8px; word-break: break-word;" align="left">
                      <div style="font-family: Helvetica Neue,Arial,sans-serif; font-size: 16px; line-height: 24px; color: #000000;">
                        <span style="line-height: 24px; letter-spacing: 0.1px; text-decoration-line: initial;">Hi '.$name.'</span>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td style="border-collapse: collapse; padding: 0px 0px 8px; word-break: break-word;" align="left">
                      <div style="font-family: Helvetica Neue,Arial,sans-serif; font-size: 16px; line-height: 24px; color: #000000;">
                        <span style="line-height: 24px; letter-spacing: 0.1px; text-decoration-line: initial;">Your online consultation booking has been successfully completed and confirmed. Please review your preferences.</span>
                      </div>
                      <div style="font-family: Helvetica Neue,Arial,sans-serif; font-size: 16px; line-height: 24px; color: #000000;">
                        <span style="line-height: 24px; letter-spacing: 0.1px; text-decoration-line: initial;">
                          <br>
                        </span>
                      </div>
                      <div style="font-family: Helvetica Neue,Arial,sans-serif; font-size: 16px; line-height: 24px; color: #000000;">
                        <span style="line-height: 24px; letter-spacing: 0.1px; text-decoration-line: initial;">
                          <strong>Consultation date</strong>: '.$datepicker.'
                        </span>
                      </div>
                      <div style="font-family: Helvetica Neue,Arial,sans-serif; font-size: 16px; line-height: 24px; color: #000000;">
                        <span style="letter-spacing: 0.1px;">
                          <strong>Consultation Time: </strong>'.$time.'
                        </span>
                      </div>
                      <div style="font-family: Helvetica Neue,Arial,sans-serif; font-size: 16px; line-height: 24px; color: #000000;">
                        <span style="letter-spacing: 0.1px;">
                          <strong>Department: </strong>'.$department.'
                        </span>
                      </div>
                      <div style="font-family: Helvetica Neue,Arial,sans-serif; font-size: 16px; line-height: 24px; color: #000000;">
                        <span style="letter-spacing: 0.1px;">
                          <br>
                        </span>
                      </div>
                      <div style="font-family: Helvetica Neue,Arial,sans-serif; font-size: 16px; line-height: 24px; color: #000000;">
                        <span style="letter-spacing: 0.1px;">Your meeting link (via google meet) can be found below. Please ensure to join the meet at the appropriate time. The meeting will last for 20 minutes.</span>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td style="border-collapse: collapse; padding: 0px 0px 8px; word-break: break-word;">
                      <div style="height: 4px; line-height: 4px;">&nbsp;</div>
                    </td>
                  </tr>
                  <tr>
                    <td style="border-collapse: collapse; padding: 0px 0px 8px; word-break: break-word;" align="left">
                      <table style="line-height: 0px;" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                          <tr>
                            <td style="border-collapse: collapse; border: none; border-radius: 8px; background: #000000;" align="center" valign="middle" bgcolor="#000000">
                              <a href="https://meet.google.com/yau-jfdc-tph" style="color: #ffffff; display: inline-block; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-origin: initial; background-clip: initial; margin: 0px; padding: 20px 22px; border-radius: 8px; font-size: 16px; font-family: Arial,sans-serif; font-weight: bold; line-height: 16px; letter-spacing: 0px; text-decoration-line: initial;" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://meet.google.com/yau-jfdc-tph&amp;source=gmail&amp;ust=1712654365932000&amp;usg=AOvVaw2lpgrkgiJ6kp9gROtQ-9l4" rel="noopener">Join meeting</a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div style="background: #f9f9f9; margin: 0px auto; border-radius: 0px; max-width: 600px;">
    <table style="border-collapse: collapse; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-origin: initial; background-clip: initial; width: 600px; border-radius: 0px;" border="0" cellspacing="0" cellpadding="0" align="center">
      <tbody>
        <tr>
          <td style="border-collapse: collapse; border: none; direction: ltr; font-size: 0px; padding: 8px 32px;">
            <div style="max-width: 536px; width: 536px; direction: ltr; display: inline-block; vertical-align: middle;">
              <table style="border-collapse: collapse; background-color: transparent; border: none; vertical-align: middle;" border="0" width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                  <tr>
                    <td style="border-collapse: collapse; padding: 0px; word-break: break-word;" align="center">
                      <p style="margin: 0px auto; border-top: 1px solid #383838; font-size: 1px; width: 536px;">&nbsp;</p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div style="background: #f9f9f9; margin: 0px auto; border-radius: 0px 0px 32px 32px; max-width: 600px;">
    <table style="border-collapse: collapse; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-origin: initial; background-clip: initial; width: 600px; border-radius: 0px 0px 32px 32px;" border="0" cellspacing="0" cellpadding="0" align="center">
      <tbody>
        <tr>
          <td style="border-collapse: collapse; border: none; direction: ltr; font-size: 0px; padding: 24px 32px 60px;">
            <div style="max-width: 100%; width: 536px; line-height: 0; display: inline-block; direction: ltr;">
              <div style="max-width: 100%; width: 536px; direction: ltr; display: inline-block; vertical-align: top;">
                <table style="border-collapse: collapse; background-color: transparent; border: none; vertical-align: top;" border="0" width="100%" cellspacing="0" cellpadding="0">
                  <tbody>
                    <tr>
                      <td style="border-collapse: collapse; padding: 0px 0px 8px; word-break: break-word;" align="left">
                        <div style="font-family: Helvetica Neue,Arial,sans-serif; font-size: 16px; line-height: 24px; color: #000000;">
                          <span style="font-weight: bold; line-height: 24px; letter-spacing: 0.1px; text-decoration-line: initial;">Need help?</span>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td style="border-collapse: collapse; padding: 0px 0px 8px; word-break: break-word;" align="left">
                        <div style="font-family: Helvetica Neue,Arial,sans-serif; font-size: 16px; line-height: 24px; color: #000000;">
                          <span style="line-height: 24px; letter-spacing: 0.1px; text-decoration-line: initial;">If you have any questions, please dont hesitate to get in touch with our customer care team via the link below.</span>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td style="border-collapse: collapse; padding: 0px; word-break: break-word;" align="left">
                        <div style="font-family: Helvetica Neue,Arial,sans-serif; font-size: 16px; line-height: 24px; color: #000000;">
                          <a href="https://medconnectneu.com/en/" style="text-decoration-line: none;" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://medconnectneu.com/en/&amp;source=gmail&amp;ust=1712654365932000&amp;usg=AOvVaw3Mr1ehcquTgSjb0hr3gL_a" rel="noopener">
                            <span style="line-height: 24px; letter-spacing: 0.1px; text-decoration-line: underline; color: #a79291;">Visit our Help Centre</span>
                          </a>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<div style="background: transparent; margin: 0px auto; border-radius: 0px; max-width: 600px;">
  <table style="border-collapse: collapse; background: transparent; width: 600px; border-radius: 0px;" border="0" cellspacing="0" cellpadding="0" align="center">
    <tbody>
      <tr>
        <td style="border-collapse: collapse; border: none; direction: ltr; font-size: 0px; padding: 48px 16px;">
          <div style="max-width: 568px; width: 568px; direction: ltr; display: inline-block; vertical-align: middle;">
            <table style="border-collapse: collapse; background-color: transparent; border: none; vertical-align: middle;" border="0" width="100%" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td style="border-collapse: collapse; padding: 0px; word-break: break-word;" align="center">
                    <table style="border-collapse: collapse; border-spacing: 0px;" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td style="border-collapse: collapse; width: 100px;">
                            <a href="https://www.numan.com/" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.numan.com/&amp;source=gmail&amp;ust=1712654365932000&amp;usg=AOvVaw306IcOrZzTrcFOEn7PbNZL" rel="noopener">
                              <img style="border: 0px; height: auto; line-height: 13px; outline: none; text-decoration-line: none; border-radius: 0px; display: block; width: 170%; font-size: 13px;" src="https://medconnectneu.com/en/assets/icons/MedConnect_Black_Logo.png" alt="MedConnectNEU" width="100">
                            </a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td style="border-collapse: collapse; padding: 0px; word-break: break-word;">
                    <div style="height: 8px; line-height: 8px;">&nbsp;</div>
                  </td>
                </tr>
                <tr>
                  <td style="border-collapse: collapse; padding: 0px; word-break: break-word;" align="center">
                    <div style="font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; line-height: 18px; color: #000000;">
                      <span style="color: #b09d9c; line-height: 18px; letter-spacing: 0px; text-decoration-line: underline;">
                        <a href="https://medconnectneu.com/en/" style="color: #b09d9c;" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://medconnectneu.com/en/&amp;source=gmail&amp;ust=1712654365933000&amp;usg=AOvVaw1N25g7jJfFrc57_wag923q" rel="noopener">MedConnectNEU Website</a>
                      </span> 
                      <span style="color: #808080; line-height: 18px; letter-spacing: 0px; text-decoration-line: initial;">&nbsp;•&nbsp;</span> 
                      <span style="color: #b09d9c; line-height: 18px; letter-spacing: 0px; text-decoration-line: underline;">
                        <a href="https://medconnectneu.com/en/terms-of-service.html" style="color: #b09d9c;" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://medconnectneu.com/en/terms-of-service.html&amp;source=gmail&amp;ust=1712654365933000&amp;usg=AOvVaw02nO-aLY-s0XHV08isAR1m" rel="noopener">Terms of Use</a>
                      </span> 
                      <span style="color: #808080; line-height: 18px; letter-spacing: 0px; text-decoration-line: initial;">&nbsp;•&nbsp;</span> 
                      <span style="color: #b09d9c; line-height: 18px; letter-spacing: 0px; text-decoration-line: underline;">
                        <a href="https://medconnectneu.com/en/privacy.html" style="color: #b09d9c;" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://medconnectneu.com/en/privacy.html&amp;source=gmail&amp;ust=1712654365933000&amp;usg=AOvVaw3b52RHc1_gb41kb3A5-MIB" rel="noopener">Privacy Policy</a>
                      </span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="border-collapse: collapse; padding: 0px; word-break: break-word;">
                    <div style="height: 24px; line-height: 24px;">&nbsp;</div>
                  </td>
                </tr>
                <tr>
                  <td style="border-collapse: collapse; padding: 0px; word-break: break-word;" align="center">
                    <div style="font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; line-height: 18px; color: #000000;">
                      <span style="color: #808080; line-height: 18px; letter-spacing: 0px; text-decoration-line: initial;">Copyright © 2024 MedConnectNEU. 
                        <br>4th Floor, Mount Olympus, 33 Olympus Road, Olympus, EC1M 3JF, Olympus
                      </span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="border-collapse: collapse; padding: 0px; word-break: break-word;">
                    <div style="height: 24px; line-height: 24px;">&nbsp;</div>
                  </td>
                </tr>
                <tr>
                  <td style="border-collapse: collapse; padding: 0px; word-break: break-word;" align="center">
                    <table style="border-collapse: collapse; float: none; display: inline-table;" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tbody>
                        <tr>
                          <td style="border-collapse: collapse; padding: 4px; vertical-align: middle;">
                            <table style="border-collapse: collapse; border-radius: 0px; width: 48px;" border="0" cellspacing="0" cellpadding="0">
                              <tbody>
                                <tr>
                                  <td style="border-collapse: collapse; height: 20px; vertical-align: middle; width: 48px;">
                                    <img style="border: 0px; height: auto; line-height: 0px; outline: none; text-decoration-line: none; border-radius: 0px; display: block;" src="https://ci3.googleusercontent.com/meips/ADKq_Nb6G7Kkab0ghj-9CJssTCHOMCaLQ2Wn8t2znh3c0uAH44csiSFsCPNhZEZzBg6lOy9RZwh21YLfwLe59Nj7n9IkF3gkooggf9jnzliOVAS3eGJjnvKvZXWQrpCJRMbIqujwX2z1PAzKgH8WG6lSHwOP2yLmHDHnElNOJGFntlDcP2ws14obS3RoHM1tfzIBnP5zJ_f45Krv12RidiU3LCyhvdnZzL0QQjq-JVq_jMLm0hLfLz3aknJv5KqD43jJVQCYPig6ZimVQESYsToemj5NGc02krdSnVGCSdWAMMW32sEXkHeshxpabYIfW7j2iXwjn_GQ-NDINFeQP30KrkiLzJoaUdPYClqQTtUxT2gM1mTpMdu4QlngTfqPTnf_V1cqzlUXPjNEOR1_rzlseeEQFKckxhtGehI_sVLJjUj_6wYxXhIGblLPy_6Iqn8VT-pQxc-b06VsEyWiYzI5AIo6hHBlIj4oDWJwPaCh_40cTymuqE8UAzmCazpqLIOQ_9uvVy5hX0as-KgSJLaRLwWadihnOxqLEG2ykhUwOQRY8EUc-AEkw5h4KOBUfA=s0-d-e1-ft#https://img.sibmail.numan.com/im/3054120/16f383ce90962e50e6f2d2f5252e4acf04a37adde48f3f48a14a821cc2fd27c9.png?e=EW1Emf1ueKAdHlK2rMJdMkcRbbqUHUK8Z4V-utX1lVO61GLLDIrbYmZ0bjneVnRCXs9-HEprWe-FbKjzZWsgaFKDaEXkNENy-ngQlz74Zoo9Kcf8_w1RCP4MgQCxcKgPKaNdBP8VoQSMcFFAo6FU2JPfXSOX6WUabBTYrumAfszOU-BXW-JreDfYuHj6-MC6ngv0cC5NdzBusMZ6mBo2YmbYhD9mlRemSz6sKluaVI1EWBwIUw3EkYhTLH6lEvjB442zaZWaNJf3maciAdOVPDxVQK0pMvwD1H_lGw" alt="MedConnectNEU" width="48" height="20">
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
&nbsp;
                    <table style="border-collapse: collapse; float: none; display: inline-table;" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tbody>
                        <tr>
                          <td style="border-collapse: collapse; padding: 4px; vertical-align: middle;">
                            <table style="border-collapse: collapse; border-radius: 0px; width: 48px;" border="0" cellspacing="0" cellpadding="0">
                              <tbody>
                                <tr>
                                  <td style="border-collapse: collapse; height: 20px; vertical-align: middle; width: 48px;">
                                    <img style="border: 0px; height: auto; line-height: 0px; outline: none; text-decoration-line: none; border-radius: 0px; display: block;" src="https://ci3.googleusercontent.com/meips/ADKq_NZ7BQmvIlfw8PWUFAXmHPDehG2GjiEVNUjWZ_2pMo2su9TXO8zZVPeYocfZE3iqJZWH5l3hAqMK7XbptQwtURE2P_IZew6BoysFXQ_2Kv3_gGZlxeQIaOSb0j4RTkgYcAU5k8XIZSNhe701gmRWlkh32AGaSx9Btkufo2JSnkZDbDKD5ISCo_zUqSedSSn9pMAC6Lurq2CAWrqXSPOMkjUr8MwBlidSUjj871Xc1hA3-PSmMo4FjEIocvp0DZYzfegVFhv5eDVLtNzaqrIto5fozEI-1hBPDtvpNnyIZUXHcF82v3kok77slCmxHtaQL8RJo7QAHo5QPaa2X9MRO-1OldC7MkgRzcLSKfrxgBLPZTliU8aag7bMz4iXOaUChR14JS0QXhOXjVtywVCUSz9SS_gmGBRNMpYD0wOpZNLt_ctr3jUd0K2NWYnRSOJ5HMy5NO2coHSFJRLb-FIKnT8Pn64pnrtYf-kZ-v42GHOKQ2EcUHS883INrrmEnJXhSCa4OvSLfIZT_VEw-E1FTrvEKrQv6Bq0ZvrDBr0F2sX4zQSCkIU7H13QopI=s0-d-e1-ft#https://img.sibmail.numan.com/im/3054120/d71042d13aca2a6d1543c5bb653c05441f4560299c4523548d8de13fa1ad45ec.png?e=f18YYnYndRAEoi9ERjRUiE-lfh45-4zKYC13BkIn2YYrcKPIZHj5CpN-t5pq51wvxuB8ZydQiGJbAiM3C2V0B7EjIBgga40IxtAq4pD56YepZ8Sx7OwBxEdYB9GKF7MtgVPZwA83gt5L9Q1C2_F8KiKW3Eyy27__-WoDgqvNF5TUGsIbwYvaNGx5RV6qC4PsKlV-ztPxcLBGv8vR0HrU0N6HehoxBexUIL0fWeoJmiE_qQUGXom4bOlXEu_839b-B0pEZ27ZPsU-NQeKTFGtkJ1wDMkng0Xzet27" alt="MedConnectNEU" width="48" height="20">
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
&nbsp;
                    <table style="border-collapse: collapse; float: none; display: inline-table;" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tbody>
                        <tr>
                          <td style="border-collapse: collapse; padding: 4px; vertical-align: middle;">
                            <table style="border-collapse: collapse; border-radius: 0px; width: 48px;" border="0" cellspacing="0" cellpadding="0">
                              <tbody>
                                <tr>
                                  <td style="border-collapse: collapse; height: 20px; vertical-align: middle; width: 48px;">
                                    <img style="border: 0px; height: auto; line-height: 0px; outline: none; text-decoration-line: none; border-radius: 0px; display: block;" src="https://ci3.googleusercontent.com/meips/ADKq_NZohUwAtOEea5yhFUPOV_x7kkgAqw6xSkZBH4iURnjw1IWa9Ajgn-uNNp9WSwI7YaHM1qc4kFQWNzNj0VrTdgBd4ilCNaqAF5xZSAvsgnUPpVF_HKOqGE1QzazG4h5jYtmO7r3ih1Bo_aoCCxqCgABvpJgU8rA6HMQmmSMp2o7fMMTocUXruieSimHAEXvXy65IDE3eLtPBZxJIOLdDLUBoyE57EPIZF5JmyRbupM8bN3KnjXg7s5QKQIDmTX_5iLBNSfQ7Ls-0Yl8TKsfq4jjRnprMVCMTDddF5o8JIk54-pZgEB5BjuruXKfs5zVIPxg9bTZMdRdD_YtY7H2odSjeqrMrJrancvef-l_LU2jY2I-xx2jEssu6v7ZqHrywqwoiK_s9XfwYxPR3WPddYijj9Q0GK7ZNhgR9cS99ZAJNV8_Z8kOOw82Xk5esJa4Na0lnaWOZ_09idmKnQewMsZf0BeAmCHBNdVaIBdF_rrCAFUfqkKCx4ZBdEkiTFnqX2PX1TJ0A--O66JKD0VyI6i01qyl-eL2_s59ilYSt9pTccVDWacEA=s0-d-e1-ft#https://img.sibmail.numan.com/im/3054120/5f8e7e112c0b876ceb858206c2b079e2ebd745e3cd42c236c733254e4156c5fb.png?e=F26sNUHFSkDlGbikCusC2HNhNoTE6BsN0R5TQGSXGznKx-xzU8A9XobzoCh2LJVRVEFhrApKib-4ZcQCxNlfzrScMPGUCiS-oEnipTWTRoe5zLfKFQZ5CHQGp43Fj5o7FpJMkvxQJXJpiEqK1gXeDVAmf5H8HsdfRcqR6kN48lmtJuOBJGme5P4W8gjSIZBEevmyiTKBHN4pooNkt67cSmhyA5sGkF-9UcmH1ZYz-hr-dGjmIxx-tPofQgU4LgjrV1vdFjmhdsUBoCQXiY2C0lnrSH_ayck" alt="MedConnectNEU" width="48" height="20">
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
&nbsp;
                    <table style="border-collapse: collapse; float: none; display: inline-table;" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tbody>
                        <tr>
                          <td style="border-collapse: collapse; padding: 4px; vertical-align: middle;">
                            <table style="border-collapse: collapse; border-radius: 0px; width: 48px;" border="0" cellspacing="0" cellpadding="0">
                              <tbody>
                                <tr>
                                  <td style="border-collapse: collapse; height: 20px; vertical-align: middle; width: 48px;">
                                    <img style="border: 0px; height: auto; line-height: 0px; outline: none; text-decoration-line: none; border-radius: 0px; display: block;" src="https://ci3.googleusercontent.com/meips/ADKq_NZTHe3WmpnD_7maUmo5Osn_1vYQUUSJmvSsAyXUhUSx0boIchDlvctqffnE8xnr-VTCOuJaysw5MeOizgdUtyukcPS0MGj6sO3xZgPZSkRP_WzfLm64w_S_JInwdDnlDChWOFFKDPWotBnMZy9YKHo9UTosht9_E67Q0vCH6rUAO2xjzdAcChO3ffgMKrj9gcYxoXZMUmAfdBoVKlSDUowGxNF7DEzf_ToFz2eH0f9XRqIwrdmyhLT-j5OU7N9z3TA6TUeWthI2oaBmchPGdLB29Tn3fstKuM6A9YU-y1Tn37IWuY7wJt3c49iGwhCFcNhppScbLdm5o7gTMYGW27mnWXMYYfcJjnh-2KeM1RrVsAV4qOR7iikZD598YMLg43BbvcIwvaR9C-xXhZusU0qtc9txkj_qAvZJ93pBoVACgHiz3r7ax_FgZ9zMoHkOfIpqkOBh5pc3gj9Hc0lHZQ-a7gyOjwW5zTKWzwBrKeL1mhZ34GN2SepfxjQ2t9H174MdJb9AclGIZPMWDn8fn9FTT6MT-RMeNGh5oREo6KMZ7ypD--7aqgHlSw=s0-d-e1-ft#https://img.sibmail.numan.com/im/3054120/7cd8d706bf9fbf3d71847141bba9135cb5aace68c79cce2549cfff85ccf7cc40.png?e=jbxkJWMPXSBiWIg4-aKLsaqyblRRGO18IwHxXawBSPDoHVa3WPjgUCi6evjIbOUxB0zuqxV3LNEcA-mnktjjCmtxIPtcEazwhF7UnPwMGfmOMqDJTJkzJ4y9QFI6VFlF4i8jEe1HAEoH_KGcYF9C4S0HEdPwvTXHDPULJZkYUMjee8Ho8LpgvERVaVgcqxDj3INCFvt7odRiLI5ol85ROeQ5j4CkLnywdHA_DEWL9LJqKX-KxyOSPr6EVmDFXa2BoLSe4_gE3aGJkc5_6WxU6h1c0RhDWAa-uJQ" alt="MedConnectNEU" width="48" height="20">
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>




';
    $mail->AltBody = 'Unable to display HTML Message';

    $mail->send();
    
    header("location:../consultation.html?booking-successful");
	exit();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

	

}
}

    



	
