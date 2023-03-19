<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function email($code,$email){
    return '<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
        <title></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style type="text/css">
            #outlook a {
                padding: 0;
            }
            .ReadMsgBody {
                width: 100%;
            }
            .ExternalClass {
                width: 100%;
            }
            .ExternalClass * {
                line-height: 100%;
            }
            body {
                margin: 0;
                padding: 0;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
            }
            table,
            td {
                border-collapse: collapse;
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
            }
            img {
                border: 0;
                height: auto;
                line-height: 100%;
                outline: none;
                text-decoration: none;
                -ms-interpolation-mode: bicubic;
            }
            p {
                display: block;
                margin: 13px 0;
            }
        </style>
        <!--[if !mso]><!-->
        <style type="text/css">
            @media only screen and (max-width:480px) {
                @-ms-viewport {
                    width: 320px;
                }
                @viewport {
                    width: 320px;
                }
            }
        </style>
        <style type="text/css">
            @media only screen and (min-width:480px) {
                .mj-column-per-100 {
                    width: 100% !important;
                }
            }
        </style>
        <style type="text/css"></style>
    
    </head>
    <body style="background-color:#f9f9f9;">
        <div style="background-color:#f9f9f9;">
            <div style="background:#f9f9f9;background-color:#f9f9f9;Margin:0px auto;max-width:600px;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#f9f9f9;background-color:#f9f9f9;width:100%;">
                    <tbody>
                        <tr>
                            <td style="border-bottom:#333957 solid 5px;direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="background:#fff;background-color:#fff;Margin:0px auto;max-width:600px;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#fff;background-color:#fff;width:100%;">
                    <tbody>
                        <tr>
                            <td style="border:#dddddd solid 1px;border-top:0px;direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">                           
                                <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:bottom;width:100%;">
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:bottom;" width="100%">
                                        <tr>
                                            <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                    <tbody>
                                                        <tr>
                                                            <td style="width:64px;"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:40px;word-break:break-word;">
                                                <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:32px;font-weight:bold;line-height:1;text-align:center;color:#555;">
                                                    Please confirm your email
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:0;word-break:break-word;">
                                                <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                    Yes, we know.
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                    An email to confirm an email. 🤪
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:20px;word-break:break-word;">
                                                <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                    Please validate your email address in order to get started using<br>Handy Manong.
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size:0px;padding:10px 25px;padding-top:30px;padding-bottom:40px;word-break:break-word;">
                                                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;">
                                                    <tr>
                                                        <td align="center" bgcolor="#2F67F6" role="presentation" style="border:none;border-radius:3px;color:#ffffff;cursor:auto;padding:15px 25px;" valign="middle">
                                                            <a href="http://localhost/handy-manong/auth/verify.php?unicode='.$code.'&userid='.$email.'" style="background:#2F67F6;color:#ffffff;font-family:Helvetica Neue,Arial,sans-serif;font-size:15px;font-weight:normal;line-height:120%;Margin:0;text-decoration:none;text-transform:none;">
                                                                Confirm Your Email
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:0;word-break:break-word;">
                                                <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                    Or verify using this link:
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:40px;word-break:break-word;">
                                                <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                    <a href="http://localhost/handy-manong/auth/verify.php?unicode='.$code.'&userid='.$email.'" target="_blank"" style="color:#2F67F6">Verification</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:26px;font-weight:bold;line-height:1;text-align:center;color:#555;">
                                                    Need Help?
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:14px;line-height:22px;text-align:center;color:#555;">
                                                    Please send and feedback or bug info<br> to <a href="mailto:caipower09@gmail.com" style="color:#2F67F6">caipower09@gmail.com</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="Margin:0px auto;max-width:600px;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
                    <tbody>
                        <tr>
                            <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
                                <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:bottom;width:100%;">
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="vertical-align:bottom;padding:0;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                                                        <tr>
                                                            <td align="center" style="font-size:0px;padding:0;word-break:break-word;">
                                                                <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:12px;font-weight:300;line-height:1;text-align:center;color:#575757;">
                                                                    Handy Manong, 666 Diablo St. Cabcaben Mariveles 2105, Philippines
                                                                </div>
                                                            </td>
                                                        <tr>                                                       
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
        </div>
    </body>
    </html>
    ';
}

function forgot($code,$email){
    return '<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
        <title></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style type="text/css">
            #outlook a {
                padding: 0;
            }
            .ReadMsgBody {
                width: 100%;
            }
            .ExternalClass {
                width: 100%;
            }
            .ExternalClass * {
                line-height: 100%;
            }
            body {
                margin: 0;
                padding: 0;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
            }
            table,
            td {
                border-collapse: collapse;
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
            }
            img {
                border: 0;
                height: auto;
                line-height: 100%;
                outline: none;
                text-decoration: none;
                -ms-interpolation-mode: bicubic;
            }
            p {
                display: block;
                margin: 13px 0;
            }
        </style>
        <!--[if !mso]><!-->
        <style type="text/css">
            @media only screen and (max-width:480px) {
                @-ms-viewport {
                    width: 320px;
                }
                @viewport {
                    width: 320px;
                }
            }
        </style>
        <style type="text/css">
            @media only screen and (min-width:480px) {
                .mj-column-per-100 {
                    width: 100% !important;
                }
            }
        </style>
        <style type="text/css"></style>
    
    </head>
    <body style="background-color:#f9f9f9;">
        <div style="background-color:#f9f9f9;">
            <div style="background:#f9f9f9;background-color:#f9f9f9;Margin:0px auto;max-width:600px;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#f9f9f9;background-color:#f9f9f9;width:100%;">
                    <tbody>
                        <tr>
                            <td style="border-bottom:#333957 solid 5px;direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="background:#fff;background-color:#fff;Margin:0px auto;max-width:600px;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#fff;background-color:#fff;width:100%;">
                    <tbody>
                        <tr>
                            <td style="border:#dddddd solid 1px;border-top:0px;direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">                           
                                <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:bottom;width:100%;">
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:bottom;" width="100%">
                                        <tr>
                                            <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                    <tbody>
                                                        <tr>
                                                            <td style="width:64px;"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:40px;word-break:break-word;">
                                                <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:32px;font-weight:bold;line-height:1;text-align:center;color:#555;">
                                                    Forgot Password
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:0;word-break:break-word;">
                                                <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                    No need to worries!
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                    Your account is safe. Just remember your password next time.
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:20px;word-break:break-word;">
                                                <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                    Please reset your password in order to continue using<br>Handy Manong.
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size:0px;padding:10px 25px;padding-top:30px;padding-bottom:40px;word-break:break-word;">
                                                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;">
                                                    <tr>
                                                        <td align="center" bgcolor="#2F67F6" role="presentation" style="border:none;border-radius:3px;color:#ffffff;cursor:auto;padding:15px 25px;" valign="middle">
                                                            <a href="http://localhost/handy-manong/auth/signup.php?unicode='.$code.'" style="background:#2F67F6;color:#ffffff;font-family:Helvetica Neue,Arial,sans-serif;font-size:15px;font-weight:normal;line-height:120%;Margin:0;text-decoration:none;text-transform:none;">
                                                                Reset Your Password
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:0;word-break:break-word;">
                                                <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                    Or user this other link:
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:40px;word-break:break-word;">
                                                <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                    <a href="http://localhost/handy-manong/auth/signup.php?unicode='.$code.'" target="_blank"" style="color:#2F67F6">Reset Link</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:26px;font-weight:bold;line-height:1;text-align:center;color:#555;">
                                                    Need Help?
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:14px;line-height:22px;text-align:center;color:#555;">
                                                    Please send and feedback or bug info<br> to <a href="mailto:caipower09@gmail.com" style="color:#2F67F6">caipower09@gmail.com</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="Margin:0px auto;max-width:600px;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
                    <tbody>
                        <tr>
                            <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
                                <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:bottom;width:100%;">
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="vertical-align:bottom;padding:0;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                                                        <tr>
                                                            <td align="center" style="font-size:0px;padding:0;word-break:break-word;">
                                                                <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:12px;font-weight:300;line-height:1;text-align:center;color:#575757;">
                                                                    Handy Manong, 666 Diablo St. Cabcaben Mariveles 2105, Philippines
                                                                </div>
                                                            </td>
                                                        <tr>                                                       
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
        </div>
    </body>
    </html>
    ';
}

function composeEmail($finder_email,$email_subject,$email_content){
    require '../vendor/autoload.php';
          
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);
    
    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'caipower09@gmail.com';
        $mail->Password   = 'fesglngeazbhipvc';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;
    
        // Recipients
        $mail->setFrom('caipower09@gmail.com', 'Handy Manong');
        $email = filter_var($finder_email, FILTER_SANITIZE_EMAIL);
        $mail->addAddress($email, 'Finder');
    
        // Content
        $mail->isHTML(true);
        $mail->Subject = $email_subject;

        $mail->Body    = $email_content;
    
        $mail->send();
        
    } catch (Exception $e) {
      return "Mailer Error: {$mail->ErrorInfo}";
    }
}