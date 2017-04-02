<?php
/** 
  * @source code designed by Muhsin Mohamed Pc for http://www.howi.in
  * Report bugs and errors to waphunt@gmail.com
  * @This script was coded with the help of many other github projects. I thanks to them
  * @Take backup before editing the script
*/
include('func.php');
error_reporting(0);
set_time_limit(0);
$ser="http://site24.way2sms.com/";
$ckfile = tempnam ("/tmp", "CURLCOOKIE");
$login=$ser."Login1.action";
// * Reciving Username of Way2sms A/c from Html form //
$uid='8770253953';
// * Reciving Password of Way2sms A/c from Html form //
$pwd='manuchutiya';
// * To whome the message send to //
$to=input($_REQUEST['to']);
// * Message to be sended //
$msg=input($_REQUEST['msg']);
if(!$to)
{ $to=$uid; }
if(!$msg)
{ $msg=rword(5).rword(5).rword(5).rword(5).rword(5); }
$captcha=input($_REQUEST['captcha']);
flush();
if($uid && $pwd)
{
$ibal="0";
$sbal="0";
$lhtml="0";
$shtml="0";
$khtml="0";
$qhtml="0";
$fhtml="0";
$te="0";
echo '<div class="content">User: <span class="number"><b>'.$uid.'</b></span><br>';
flush();

$loginpost="gval=&username=".$uid."&password=".$pwd."&Login=Login";

$ch = curl_init();
$lhtml=post($login,$loginpost,$ch,$ckfile);
////curl_close($ch);

if(stristr($lhtml,'Location: '.$ser.'vem.action') || stristr($lhtml,'Location: '.$ser.'MainView.action') || stristr($lhtml,'Location: '.$ser.'ebrdg.action'))
{
preg_match("/~(.*?);/i",$lhtml,$id);
$id=$id['1'];
if(!$id)
{
}
// * Login Sucess Message//
}
elseif(stristr($lhtml,'Location: http://site2.way2sms.com/entry'))
{
}
else
{
// * Login Faild or SMS Send Error Message 2//
}bal:
///$ch = curl_init();
$msg=urlencode($msg);
$main=$ser."smstoss.action";
$ref=$ser."sendSMS?Token=".$id;
$conf=$ser."smscofirm.action?SentMessage=".$msg."&Token=".$id."&status=0";

$post="ssaction=ss&Token=".$id."&mobile=".$to."&message=".$msg."&Send=Send Sms&msgLen=".strlen($msg);
$mhtml=post($main,$post,$ch,$ckfile,$proxy,$ref);
if(stristr($mhtml,'smscofirm.action?SentMessage='))
// * Message Sended Sucessfull Message//
{ }
else
// * Login Faild or SMS Send Error Message 1//
{ }
curl_close($ch);

end:

echo "</div>";
flush();
}
// * You can change the form content from the below code //
echo '<div class="content"><form method="post"><br><label>Mobile Number :</label><input type="text" class="w3-input" name="to"/><label>Message:</label><textarea class="w3-input" name="msg"></textarea><br/><input type="submit" class="w3-btn w3-white w3-border w3-round" value="Send"/></form><br></div>';

/** 
  * @source code designed by Muhsin Mohamed Pc for http://www.howi.in
  * Report bugs and errors to waphunt@gmail.com
  * @This script was coded with the help of many other github projects. I thanks to them
  * @Take backup before editing the script
*/
?>