<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
<?php
$rcResponse = $_POST['g-recaptcha-response'];

$ch = curl_init();
$data = array('secret'=>'6LcYFncUAAAAAAOC97WPBYMTlcxelAM1uQeMJV2n','response'=>$rcResponse);
curl_setopt($ch,CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify?".http_build_query($data));
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,true);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);
curl_setopt($ch,CURLOPT_CAINFO,"C:\\Users\\95328\\cacert.pem");
$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>
</body>