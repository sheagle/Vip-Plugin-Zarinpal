<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
global $core;
$MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX';
$Amount = $_GET['am']; //Amount will be based on Toman
$Authority = $_GET['Authority'];

if ($_GET['Status'] == 'OK')
{

$client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

$result = $client->PaymentVerification(
[
'MerchantID' => $MerchantID,
'Authority' => $Authority,
'Amount' => $Amount,
]
);
if ($result->Status == 100)
{
		$core->temp['gateway']['call']['msg']='پرداخت انجام شد !';
		$core->temp['gateway']['call']['trac']='-';
		$core->temp['gateway']['call']['erja']=$result->RefID;
		$core->temp['gateway']['call']['cart']='-';
		$core->temp['gateway']['call']['status']=true;
} 
else
{
$core->temp['gateway']['call']['msg']='پرداخت صورت نگرفت !';
		$core->temp['gateway']['call']['trac']='-';
		$core->temp['gateway']['call']['erja']='-';
		$core->temp['gateway']['call']['cart']='-';
		$core->temp['gateway']['call']['status']=false;
}
}
else{
	$core->temp['gateway']['call']['msg']='پرداخت صورت نگرفت !';
		$core->temp['gateway']['call']['trac']='-';
		$core->temp['gateway']['call']['erja']='-';
		$core->temp['gateway']['call']['cart']='-';
		$core->temp['gateway']['call']['status']=false;
}