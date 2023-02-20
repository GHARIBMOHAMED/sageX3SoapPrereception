<?php
require_once('WebService/models/Command.php');

$order = new Commande();
 //var_dump($order->showListe());
 echo "<pre>".print_r(json_decode($order->showOne("ME1402302SON00000003"),true),true)."</pre>";
 //print_r( $order->showOne("SHP2208-00000002"));
 //   echo $order->showListe();


// $url = 'http://192.168.127.128/test.php';
//         $ch = curl_init();
//         curl_setopt($ch, CURLOPT_URL, $url);
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//         $return = curl_exec($ch); 
//         echo $return;
?>