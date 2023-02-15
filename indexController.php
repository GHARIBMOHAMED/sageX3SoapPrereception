<?php
require_once('WebService/models/PreCommand.php');

$order = new PreCommande();
$uid = (isset($_POST['userID'])) ? $_POST['userID'] : 'ID not found';
  if ($uid != 'ID not found') {
    echo $data = $order->showOne($uid);
  }else{
    echo $data = 1;
  }

?>