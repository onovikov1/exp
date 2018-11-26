<?php
/**
 * Created by PhpStorm.
 * User: onovikov
 * Date: 10/1/2018
 * Time: 11:44 AM
 */

$token = "";
$custFields106 = array();

function outputFile(){
    $file = "Capture.png";
    $handle = fopen($file,"rb");
    $size = filesize($file);
    $contents = fread($handle,$size);
    fclose($handle);

    return base64_encode($contents);
}

function recreateFile($encodedFile){
    $file = "copy.png";
    $handle = fopen($file,"wb");
    fwrite($handle,base64_decode($encodedFile));
    fclose($handle);
}

/**
 * @return string The auth token received from Cityworks
 */
function authCW(){
	global $token;
    $ch = curl_init();
    $authCreds = array('data'=>"{'LoginName':'developmentapi','Password':'CLTAirport1!'}");
    curl_setopt($ch,CURLOPT_URL,"https://test.cltcityworks.com/cltcw2015/services/general/authentication/authenticate?".http_build_query($authCreds));
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,true);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);
    curl_setopt($ch,CURLOPT_CAINFO,"C:\\Users\\95328\\cacert.pem");
    $response = curl_exec($ch);
    curl_close($ch);

    //get CW token from JSON response
    $token = json_decode($response,true)["Value"]["Token"];

    return $token;
}

function showFields106(){
	global $custFields106;
	foreach ($custFields106 as $custFieldName){
		echo "document.getElementById('".str_replace(' ','',$custFieldName)."106"."').className = 'normal-textbox';\r\n";
	}
}

function hideFields106(){
	global $custFields106;
	foreach ($custFields106 as $custFieldName){
		echo "document.getElementById('".str_replace(' ','',$custFieldName)."106"."').className = 'hidden-textbox';\r\n";
	}
}

function getAllowedVals($codeType){
	global $token;
	$ch = curl_init();
	$authCreds = array('token'=>$token,'data'=>"{'CodeTypes':['".$codeType."']}");
	curl_setopt($ch,CURLOPT_URL,"https://test.cltcityworks.com/cltcw2015/services/Ams/Codes/ByCodeType?".http_build_query($authCreds));
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,true);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);
    curl_setopt($ch,CURLOPT_CAINFO,"C:\\Users\\95328\\cacert.pem");
	$response = curl_exec($ch);
	curl_close($ch);

	$allowedVals = array();
	$responseArray = json_decode($response,true);
	for($index=0; $index<count($responseArray["Value"][$codeType]);$index++){
		$option = $responseArray["Value"][$codeType][$index]["Description"];
		array_push($allowedVals,$option);
	}

	return $allowedVals;
}

function callCW(){
	global $token;
	global $custFields106;
	$ch = curl_init();
	$authCreds = array('token'=>$token,'data'=>"{'ProblemSid':107}");
	curl_setopt($ch,CURLOPT_URL,"https://test.cltcityworks.com/cltcw2015/services/Ams/ServiceRequest/TemplateCustomFields?".http_build_query($authCreds));
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,true);
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);
	curl_setopt($ch,CURLOPT_CAINFO,"C:\\Users\\95328\\cacert.pem");
	$response = curl_exec($ch);
	curl_close($ch);

	$responseArray = json_decode($response,true);

	for ($index=0; $index < count($responseArray["Value"],0); $index++){
		$custFieldName = str_replace("'","",$responseArray["Value"][$index]["CustFieldName"]);
		$codeType = str_replace("'","",$responseArray["Value"][$index]["CodeType"]);
		if(strlen($codeType)==0){
			echo "<input type='text' class='hidden-textbox' id='".str_replace(' ','',$custFieldName)."106' placeholder=' ".$custFieldName."' >";
		}
		else{
			$allowedVals = getAllowedVals($codeType);
			echo "<select id='".str_replace(' ','',$custFieldName)."106' class='hidden-textbox' >\r\n";
			echo "<option value='' disabled selected>Select An Option</option>\r\n";
			for ($index2=0; $index2 < count($allowedVals); $index2++){
				echo "<option value='".$allowedVals[$index2]."'>".$allowedVals[$index2]."</option>\r\n";
			}
			echo "</select>";
		}
		array_push($custFields106,$custFieldName);
	}
}