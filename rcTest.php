<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
<form id="mainForm" method="post" action="rcTest2.php">
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    <script>
        var verifyCallback = function(response) {
            document.forms["mainForm"].submit();
        };
        var onloadCallback = function(){
            grecaptcha.render('rcExample',{'sitekey':'6LcYFncUAAAAAHeXKFPQ8bnVFGXo8DEhuNgzSs2G', 'callback':verifyCallback});
        }
    </script>
    <div id="rcExample"></div>
</form>
</body>