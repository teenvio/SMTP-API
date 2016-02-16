<?php
/**
 * @copyright Ipdea Land, S.L. / Teenvio
 *
 * LGPL v3 - GNU LESSER GENERAL PUBLIC LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU LESSER General Public License as published by
 * the Free Software Foundation, either version 3 of the License.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU LESSER General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *
 */

require 'lib/PHPMailer/PHPMailerAutoload.php';

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

//Create a new PHPMailer instance
$mail = new PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'text';

//Set the hostname of the mail server
$mail->Host = 'api.teenvio.com';

//Set the SMTP port number
$mail->Port = 58700;

//Set the encryption system to use: ssl
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full user for teenvio
$mail->Username = "[user].[plan]";

//Password to use for SMTP authentication
$mail->Password = "[password]";

//Set who the message is to be sent from
$mail->setFrom('info@teenvio.com', 'teenvio');

//Set who the message is to be sent to
$mail->addAddress('victor@dominio.com', 'Víctor J. Chamorro');

//Set the subject line
$mail->Subject = 'PHPMailer Teenvio SMTP test';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML('

<html>
<head>
  <meta http­equiv="content­type" content="text/html; charset=ISO­8859­1">
</head>
<body bgcolor="#FFFFFF" text="#000000">
 Buenas,<br>
 <br>
 Esto es un email <b>html</b> para probar el servidor smtp­api de teenvio<br>
 <br>
 Un saludo,<br>
 <br>
 <u>V&iacute;ctor J. Chamorro</u> ­ teenvio.com<br>
 <br>
</body>
</html>


', dirname(__FILE__));

//Replace the plain text body with one created manually
$mail->AltBody = '

 Buenas,
 Esto es un email *html* para probar el servidor smtp­api de teenvio
 Un saludo,
 _Victor J. Chamorro_ ­ teenvio.com


';

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
?>