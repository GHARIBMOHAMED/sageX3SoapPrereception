
<?php
// require_once ('WebService/models/Connect.php');
require_once('WebService/modelWS/ToolsWS.php');
unset($_SESSION["x3Connect"]); 
unset($_SESSION["x3login"]);
unset($_SESSION["x3passwd"]);
header('Location:http://localhost:8888/reception/sign-in.php');
?>