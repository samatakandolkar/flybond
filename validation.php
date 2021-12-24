<!DOCTYPE html>
<html>
<head> Form Data</head>
<body> 
<?php
// define variables and set to empty values
echo "on the validation page";
$Fname = $Mname = $Lname = $MNumber = $ONumber = $email = $CCompany = $inputAddress = $inputAddress2 =
$inputCity = $inputState = $inputZip = $inputCustStatus = $CustDesc = $CallNotes = $gridRadios = $callScheduledaytime = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $Fname = test_input($_POST["Fname"]);
  $Mname = test_input($_POST["Mname"]);
  $Lname = test_input($_POST["Lname"]);
  $MNumber = test_input($_POST["MNumber"]);
  $ONumber = test_input($_POST["ONumber"]);
  $email = test_input($_POST["email"]);
  $CCompany = test_input($_POST["CCompany"]);
  $inputAddress = test_input($_POST["inputAddress"]);
  $inputAddress2 = test_input($_POST["inputAddress2"]);
  $inputCity = test_input($_POST["inputCity"]);
  $inputState = test_input($_POST["inputState"]);
  $inputZip = test_input($_POST["inputZip"]);
  $inputCustStatus = test_input($_POST["inputCustStatus"]);
  $CustDesc = test_input($_POST["CustDesc"]);
  $CallNotes = test_input($_POST["CallNotes"]);
  $gridRadios = test_input($_POST["gridRadios"]);
  $callScheduledaytime = test_input($_POST["callScheduledaytime"]);
}

echo $Fname ;
echo $Mname ;
echo $Lname ;
echo $MNumber ;
echo $ONumber ;
echo $email ;
echo $CCompany ;
echo $inputAddress ;
echo $inputAddress2;
echo $inputCity ;
echo $inputState ;
echo $inputZip ;
echo $inputCustStatus;
echo $CustDesc;
echo $CallNotes;
echo $gridRadios;
echo $callScheduledaytime;



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
</body>
</html>