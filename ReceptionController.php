
<?php
require_once('WebService/models/Reception.php');
$data = $_POST["user"];
if(isset($_POST["user"]) && !empty($_POST["user"])){
    
    $site = $data[0]["POHFCY"];
    $fournisseur = $data[0]["BPSNUM"];
    $CUR = $data[0]["NETCUR"];
    $RCPDAT = date("Ymd");
    $NDEDAT = date("Ymd");

    $WS = "<PARAM><GRP ID=\"PTH0_1\" >";
    $WS .= "<FLD NAME=\"PRHFCY\">$site</FLD>";
    $WS .= "<FLD NAME=\"BPSNUM\">$fournisseur</FLD>";
    $WS .= "<FLD NAME=\"RCPDAT\">$RCPDAT</FLD>";
    $WS .= "<FLD NAME=\"NDEDAT\">$NDEDAT</FLD>";
    $WS .= "<FLD NAME=\"CUR\">$CUR</FLD>";
    $WS .= "</GRP>";

    $WS .= "<TAB ID=\"PTH1_2\">";
    foreach($data as $d) {
        $WS .= "<LIN>";
        $WS .= "<FLD NAME=\"PTHNUM\" TYPE=\"Char\">". $d["POHNUM"]."</FLD>";
        $WS .= "<FLD NAME=\"ITMREF\">". $d["ITMREF"] ."</FLD>";
        $WS .= "<FLD NAM=\"ITMKND\">1</FLD>";
        $WS .= "<FLD NAM=\"UOM\">". $d["UOM"] ."</FLD>";
        $WS .= "<FLD NAM=\"QTYUOM\">". $d["PRCPQTY"] ."</FLD>";
        $WS .= "<FLD NAM=\"WSOLDE\">1</FLD>";
        $WS .= "</LIN>";
    }
    $WS .= "</TAB></PARAM>";
    try {
         $Reception = new Reception();
         $result = $Reception->create($WS);
        if($result == 1){
            return print_r(json_encode(1)) ;
        }else{
            return print_r(json_encode(0)) ;
        }
    } catch (SoapFault $e) {
        
        return print_r(json_encode(0)) ;
    }
}

