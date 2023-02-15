<?php
require_once('WebService/models/Connect.php');
require_once('WebService/modelWS/ToolsWS.php');

session_start();
$formlogin = $_POST['formlogin'];
$formpasswd = $_POST['formpasswd'];

$x3Connect = new Connect($formlogin, $formpasswd);
$isConnect = $x3Connect->isConnect();
if ($isConnect) {
	$_SESSION ["x3Connect"] = true;
	$_SESSION["x3login"] = $formlogin;
	$_SESSION["x3passwd"] = $formpasswd;
	header('Location:http://localhost:8888/reception/index.php');
} else {
	$_SESSION ["x3Connect"] = false;
	$_SESSION["x3login"] = "false";
	$_SESSION["x3passwd"] = "false";
	header('Location:http://localhost:8888/reception/sign-in.php');
}
?>
