<?php
require_once('WebService/models/Command.php');

if (isset($_POST["show"])) {
  if ($_POST["show"] == 1) {
    $Commande = new Commande();
    $uid = (isset($_POST['userID'])) ? $_POST['userID'] : 'ID not found';
    if ($uid != 'ID not found') {
      echo $data = $Commande->showOne($uid);
    } else {
      echo $data = 1;
    }
  }
}

if (isset($_POST["func"])) {
  if ($_POST["func"] == "save") {

    require_once('WebService/models/Livraison.php');
    $data = $_POST["user"];

    if (isset($_POST["user"]) && !empty($_POST["user"])) {

      $WS = "<PARAM><GRP ID=\"SDH0_1\" >";
      $WS .= "<FLD NAME=\"STOFCY\">" . $data[0]["SALFCY"] . "</FLD>";
      $WS .= "<FLD NAME=\"SDHTYP\">SDH</FLD>";
      $WS .= "<FLD NAME=\"SALFCY\">" . $data[0]["SALFCY"] . "</FLD>";
      $WS .= "<FLD NAME=\"BPCORD\">" . $data[0]["BPCORD"] . "</FLD>";
      // $WS .= "<FLD NAME=\"BPAADD\">AD</FLD>";
      $WS .= "</GRP>";
      $WS .= "<TAB ID=\"SDH1_4\">";
      foreach ($data as $d) {
        $WS .= "<LIN>";
        $WS .= "<FLD NAME=\"ITMREF\" TYPE=\"Char\">" . $d["ITMREF"] . "</FLD>";
        $WS .= "<FLD NAME=\"SAU\">UN</FLD>";
        $WS .= "<FLD NAM=\"QTY\">" . $d["PRCPQTY"] . "</FLD>";
        $WS .= "<FLD NAM=\"XSOHNUM\">" . $d["SOHNUM"] . "</FLD>";
        $WS .= "<FLD NAM=\"VCRNUMORI\">" . $d["SOHNUM"] . "</FLD>";
        $WS .= "</LIN>";
      }
      $WS .= "</TAB></PARAM>";
      try {
        $Livraison = new Livraison();
        $result = $Livraison->create($WS);
        if ($result == 1) {
          return print_r(json_encode(1));
        } else {
          return print_r(json_encode(["error"=>"404"]));
        }
      } catch (SoapFault $e) {

        return print_r(json_encode(2));
      }
    }
  }
}
// <PARAM>
// <GRP ID="SDH0_1">
// <FLD NAME="STOFCY" TYPE="Char">VI280</FLD>
// <FLD NAME="SDHTYP" TYPE="Char">SDH</FLD>
// <FLD NAME="SALFCY" TYPE="Char">VI280</FLD>
// <FLD NAME="BPCORD" TYPE="Char">VICTORIAHUGO</FLD>
// <FLD NAME="BPAADD" TYPE="Char">AD</FLD>
// </GRP>
// <TAB DIM="900" ID="SDH1_4" SIZE="1">
// <LIN NUM="1">
// <FLD NAME="ITMREF" TYPE="Char">BIER00325</FLD>
// <FLD NAME="SAU" TYPE="Char">UN</FLD>
// <FLD NAME="QTY" TYPE="Decimal">50</FLD>
// <FLD NAME="XSOHNUM" TYPE="Char">VI2802301SON00000057</FLD>
// <FLD NAME="VCRNUMORI" TYPE="Char">VI2802301SON00000057</FLD>
// </LIN>
// </TAB>
// </PARAM>