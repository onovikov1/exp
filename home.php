<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
<?php include "files.php"; ?>
<?php authCW(); ?>
<?php callCW(); ?>
<?php getAllowedVals('ACTIONCHOICES'); ?>
//test comment
<script>
	function showCustFields(){
		var problemSid = document.getElementById('problem').value;
		var custFields106 = <?php echo json_encode($custFields106); ?>;

		if(problemSid == '106'){
			<?php showFields106(); ?>
		}
		else{
			<?php hideFields106(); ?>
		}
	}
</script>
<select id="problem" onchange="showCustFields();">
	<option value="" disabled selected>Select An Option</option>
	<option value="106">One</option>
	<option value="107">Two</option>
	<option value="108">Three</option>
</select>
<!--<script>-->
<!--function validateInput() {-->
<!--	var firstName = document.getElementById("firstName").value;-->
<!--	var lastName = document.getElementById("lastName").value;-->
<!--	if(firstName === ""){-->
<!--		document.getElementById("firstName").className = "error-textbox";-->
<!--	}-->
<!--	else{-->
<!--		document.getElementById("firstName").className = "normal-textbox";-->
<!--	}-->
<!--	if(lastName === ""){-->
<!--		document.getElementById("lastName").className = "error-textbox";-->
<!--	}-->
<!--	else{-->
<!--		document.getElementById("lastName").className = "normal-textbox";-->
<!--	}-->
<!--}-->
<!--</script>-->
<!--<div class="title">CLT TechHelp</div>-->
<!--<div class="subtitle">If this is an urgent issue, call <a href="tel:+1-704-359-8324">704-359-8324</a></div>-->
<!--<form>-->
<!--	<input type="text" class="normal-textbox" id="firstName" name="firstName" placeholder="First Name" tabindex="1" autofocus><br>-->
<!--	<input type="text" class="normal-textbox" id="lastName" name="lastName" placeholder="Last Name" tabindex="2"><br>-->
<!--	<input type="tel" class="normal-textbox" id="phoneNum" name="phoneNum" placeholder="Phone #" tabindex="3"><br><br>-->
<!--	<div class="normal-checkbox"><input type="checkbox" id="rememberMe" name="rememberMe" value="rememberMe">Remember Me</div><br><br>-->
<!--	<textarea></textarea>-->
<!--	<div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div><br>-->
<!--	<input type="button" name="validate" value="Validate" onclick="validateInput();">-->
<!--</form>-->
</body>
</html>