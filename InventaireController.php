<?php
require_once('WebService/models/Inventaire.php');

if (isset($_POST["show"])) {
  if ($_POST["show"] == 1) {
    $Commande = new Inventaire();
    $uid = (isset($_POST['userID'])) ? $_POST['userID'] : 'ID not found';
    $uid2 = (isset($_POST['userID2'])) ? $_POST['userID2'] : 'ID not found';
    if ($uid != 'ID not found') {
      echo $data = $Commande->showOne($uid,$uid2);
    } else {
      echo $data = 1;
    }
  }
}

if (isset($_POST["user"])) {

  if ($_POST["func"] == "update") {

    $data = json_decode($_POST["user"], true);

    if (isset($_POST["user"]) && !empty($_POST["user"])) {

      $WS = "<PARAM>"; 
      $WS .= "<TAB ID=\"SNL0_4\">";
      $i = 1;
      foreach ($data as $d) {
        $WS .= "<LIN  NUM=\" ".$i++."\">";
        $WS .= "<FLD MENULAB=\"Compté\" MENULOCAL=\"2725\" NAME=\"CUNLISSTAD\" TYPE=\"Integer\">" . $d["CUNLISSTAD"] . "</FLD>";
        $WS .= "<FLD NAME=\"SAICOD\" TYPE=\"Char\">" . $d["SAICOD"] . "</FLD>";
        $WS .= "<FLD NAME=\"WRH\" TYPE=\"Char\"/>";
        $WS .= "<FLD NAME=\"LPNNUM\" TYPE=\"Char\"/>";
        $WS .= "<FLD NAME=\"LOC\" TYPE=\"Char\"/>";
        $WS .= "<FLD NAME=\"LOC\" TYPE=\"Char\"/>";
        $WS .= "<FLD NAME=\"LOT\" TYPE=\"Char\"/>";
        $WS .= "<FLD NAME=\"SLO\" TYPE=\"Char\"/>";
        $WS .= "<FLD NAME=\"PCUSTUNEW1\" TYPE=\"Char\"/>";
        $WS .= "<FLD NAME=\"QTYPCUNEW1\" TYPE=\"Decimal\">" . $d["PCUSTUNEW1"] . "</FLD>";
        $WS .= "<FLD NAME=\"QTYSTUNEW1\" TYPE=\"Decimal\">" . $d["QTYSTUNEW1"] . "</FLD>";
        if ($d["QTYSTUNEW"] != 0) {
          $WS .= "<FLD  MENULOCAL=\"1\" NAME=\"ZERSTOFLG1\" TYPE=\"Integer\">1</FLD>";
        }else{
          $WS .= "<FLD  MENULOCAL=\"1\" NAME=\"ZERSTOFLG1\" TYPE=\"Integer\">0</FLD>";
        }
        $WS .= "<FLD NAME=\"QTYPCUNEW2\" TYPE=\"Decimal\">" . $d["QTYPCUNEW2"] . "</FLD>";
        $WS .= "<FLD NAME=\"PCUSTUNEW2\" TYPE=\"Char\"/>";
        $WS .= "<FLD NAME=\"QTYSTUNEW2\" TYPE=\"Decimal\">" . $d["QTYSTUNEW2"] . "</FLD>";
        if ($d["QTYSTUNEW"] != 0) {
          $WS .= "<FLD NAME=\"PCUSTUNEW\" TYPE=\"Char\">" . $d["PCUSTUNEW"] . "</FLD>";
        }else{
          $WS .= "<FLD NAME=\"PCUSTUNEW\" TYPE=\"Char\"> 0,000000</FLD>";
        }
        $WS .= "<FLD NAME=\"SERNUM\" TYPE=\"Char\"/>";
        $WS .= "<FLD NAME=\"PALNUM\" TYPE=\"Char\"/>";
        $WS .= "<FLD NAME=\"CTRNUM\" TYPE=\"Char\"/>";
        $WS .= "<FLD NAME=\"ITMREF\" TYPE=\"Char\">" . $d["ITMREF"] . "</FLD>";
        $WS .= "<FLD NAME=\"ITMDES1\" TYPE=\"Char\">" . $d["ITMDES1"] . "</FLD>";
        $WS .= "<FLD NAME=\"PCU\" TYPE=\"Char\">" . $d["PCU"] . "</FLD>";
        $WS .= "<FLD NAME=\"STA\" TYPE=\"Char\">" . $d["STA"] . "</FLD>";
        $WS .= "<FLD NAME=\"QTYPCU\" >" . $d["QTYPCU"] . "</FLD>";
        $WS .= "<FLD NAME=\"PCUSTUCOE\" TYPE=\"Decimal\">" . $d["PCUSTUCOE"] . "</FLD>";
        $WS .= "<FLD NAME=\"STU\" >" . $d["STU"] . "</FLD>";
        $WS .= "<FLD NAME=\"QTYSTU\" TYPE=\"Decimal\">" . $d["QTYSTU"] . "</FLD>";
        if($d["QTYSTUNEW"] != 0){$WS .= "<FLD MENULAB=\"Non\" MENULOCAL=\"1\" NAME=\"ZERSTOFLG2\" TYPE=\"Integer\">" . $d["ZERSTOFLG2"] . "</FLD>";}
        else{
          $WS .= "<FLD  MENULOCAL=\"1\" NAME=\"ZERSTOFLG2\" TYPE=\"Integer\">0</FLD>";
        }
        if ($d["QTYSTUNEW"] != 0) {
          $WS .= "<FLD NAME=\"QTYPCUNEW\" TYPE=\"Decimal\">" . $d["QTYSTUNEW"] . "</FLD>";
        }else{
          $WS .= "<FLD NAME=\"QTYPCUNEW\" TYPE=\"Decimal\">0</FLD>";
        }
        if ($d["QTYSTUNEW"] != 0) {
          $WS .= "<FLD NAME=\"QTYSTUNEW\" TYPE=\"Decimal\">" . $d["QTYSTUNEW"] . "</FLD>";
        }else{
          $WS .= "<FLD NAME=\"QTYSTUNEW\" TYPE=\"Decimal\">0</FLD>";
        }
        if($d["QTYSTUNEW"] != 0){ $WS .= "<FLD MENULAB=\"Non\" MENULOCAL=\"1\" NAME=\"ZERSTOFLG\" TYPE=\"Integer\">1</FLD>";}
        else{$WS .= "<FLD MENULAB=\"Oui\" MENULOCAL=\"1\" NAME=\"ZERSTOFLG\" TYPE=\"Integer\">2</FLD>";}
       
        if($d["QTYSTUNEW"] != 0){$WS .= "<FLD MENULAB=\"Classe 'A'\" MENULOCAL=\"212\"  NAME=\"ABC\" TYPE=\"Integer\">" . $d["ABC"] . "</FLD>";}
        else{
          $WS .= "<FLD MENULAB=\"Classe 'A'\" MENULOCAL=\"212\"  NAME=\"ABC\" TYPE=\"Integer\">1</FLD>";
        }
        $WS .= "<FLD NAME=\"PRCDEV\" TYPE=\"Decimal\">" . $d["PRCDEV"] . "</FLD>";
        $WS .= "<FLD NAME=\"CUNCST\" TYPE=\"Decimal\">" . $d["CUNCST"] . "</FLD>";
        $WS .= "<FLD NAME=\"CUNAMT\" TYPE=\"Decimal\">" . $d["CUNAMT"] . "</FLD>";
        $WS .= "<FLD NAME=\"CUNAMTNEW\" TYPE=\"Decimal\">" . $d["CUNAMTNEW"] . "</FLD>";
        if($d["QTYSTUNEW"] != 0){$WS .= "<FLD MENULAB=\"Oui\" MENULOCAL=\"2724\" NAME=\"CUNLOKFLG\" TYPE=\"Integer\">" . $d["CUNLOKFLG"] . "</FLD>";}
        else{
          $WS .= "<FLD MENULAB=\"Oui\" MENULOCAL=\"2724\" NAME=\"CUNLOKFLG\" TYPE=\"Integer\"></FLD>";
        }
        if ($d["QTYSTUNEW"] != 0) {
          $WS .= "<FLD MENULAB=\"Ancienne ligne\" MENULOCAL=\"715\" NAME=\"LINFLG\" TYPE=\"Integer\">" . $d["LINFLG"] . "</FLD>";
        }else{
            $WS .= "<FLD MENULAB=\"Ancienne ligne\" MENULOCAL=\"715\" NAME=\"LINFLG\" TYPE=\"Integer\"></FLD>";
          }
            $WS .= "</LIN>";
      }
      $WS .= "</TAB></PARAM>";
      try {
        $Inventaire = new Inventaire();
        $var = explode(" ",$_POST["user2"]);
        $result = $Inventaire->update($var[0],$var[1],$WS);
        if ($result == 1) {
          return print_r(json_encode(1));
        } else {
          return print_r(json_encode(0));
        }
      } catch (SoapFault $e) {

        return print_r(json_encode(2));
      }
    }
  }
}

// <FLD MENULAB="Compté" MENULOCAL="2725" NAME="CUNLISSTAD" TYPE="Integer">2</FLD>
// <FLD NAME="SAICOD" TYPE="Char">
// </FLD>
// <FLD NAME="ITMREF" TYPE="Char">WHI01105</FLD>
// <FLD NAME="ITMDES1" TYPE="Char">JACK DANIEL'S 75CL</FLD>
// <FLD NAME="WRH" TYPE="Char"/>
// <FLD NAME="LPNNUM" TYPE="Char"/>
// <FLD NAME="LOC" TYPE="Char"/>
// <FLD NAME="LOT" TYPE="Char"/>
// <FLD NAME="SLO" TYPE="Char"/>
// <FLD NAME="PCU" TYPE="Char">UN</FLD>
// <FLD NAME="STA" TYPE="Char">A</FLD>
// <FLD NAME="QTYPCU" TYPE="Decimal">737</FLD>
// <FLD NAME="PCUSTUCOE" TYPE="Decimal">1</FLD>
// <FLD NAME="STU" TYPE="Char">UN</FLD>
// <FLD NAME="QTYSTU" TYPE="Decimal">737</FLD>
// <FLD NAME="QTYPCUNEW1" TYPE="Decimal">0</FLD>
// <FLD NAME="PCUSTUNEW1" TYPE="Char"/>
// <FLD NAME="QTYSTUNEW1" TYPE="Decimal">0</FLD>
// <FLD MENULAB="Non" MENULOCAL="1" NAME="ZERSTOFLG1" TYPE="Integer">1</FLD>
// <FLD NAME="QTYPCUNEW2" TYPE="Decimal">0</FLD>
// <FLD NAME="PCUSTUNEW2" TYPE="Char"/>
// <FLD NAME="QTYSTUNEW2" TYPE="Decimal">0</FLD>
// <FLD MENULAB="Non" MENULOCAL="1" NAME="ZERSTOFLG2" TYPE="Integer">1</FLD>
// <FLD NAME="QTYPCUNEW" TYPE="Decimal">10</FLD>
// <FLD NAME="PCUSTUNEW" TYPE="Char"> 1,000000</FLD>
// <FLD NAME="QTYSTUNEW" TYPE="Decimal">10</FLD>
// <FLD MENULAB="Non" MENULOCAL="1" NAME="ZERSTOFLG" TYPE="Integer">1</FLD>
// <FLD NAME="SERNUM" TYPE="Char"/>
// <FLD NAME="PALNUM" TYPE="Char"/>
// <FLD NAME="CTRNUM" TYPE="Char"/>
// <FLD MENULAB="Classe 'A'" MENULOCAL="212" NAME="ABC" TYPE="Integer">1</FLD>
// <FLD NAME="QTYSTUDEV" TYPE="Decimal">-637</FLD>
// <FLD NAME="PRCDEV" TYPE="Decimal">-86.431478968792401628222523744912</FLD>
// <FLD NAME="CUNCST" TYPE="Decimal">10.3898</FLD>
// <FLD NAME="CUNAMT" TYPE="Decimal">7657.2826</FLD>
// <FLD NAME="CUNAMTNEW" TYPE="Decimal">1038.98</FLD>
// <FLD MENULAB="Non" MENULOCAL="2724" NAME="CUNLOKFLG" TYPE="Integer">1</FLD>
// <FLD MENULAB="Ancienne ligne" MENULOCAL="715" NAME="LINFLG" TYPE="Integer">2</FLD>



// <FLD MENULAB="Compté" MENULOCAL="2725" NAME="CUNLISSTAD" TYPE="Integer">2</FLD>
// <FLD NAME="SAICOD" TYPE="Char"/>
// <FLD NAME="ITMREF" TYPE="Char">WHI01109</FLD>
// <FLD NAME="ITMDES1" TYPE="Char">JACK DANIEL'S HONEY 37,5CL</FLD>
// <FLD NAME="WRH" TYPE="Char"/>
// <FLD NAME="LPNNUM" TYPE="Char"/>
// <FLD NAME="LOC" TYPE="Char"/>
// <FLD NAME="LOT" TYPE="Char"/>
// <FLD NAME="SLO" TYPE="Char"/>
// <FLD NAME="PCU" TYPE="Char">UN</FLD>
// <FLD NAME="STA" TYPE="Char">A</FLD>
// <FLD NAME="QTYPCU" TYPE="Decimal">25</FLD>
// <FLD NAME="PCUSTUCOE" TYPE="Decimal">1</FLD>
// <FLD NAME="STU" TYPE="Char">UN</FLD>
// <FLD NAME="QTYSTU" TYPE="Decimal">25</FLD>
// <FLD NAME="QTYPCUNEW1" TYPE="Decimal">0</FLD>
// <FLD NAME="PCUSTUNEW1" TYPE="Char"/>
// <FLD NAME="QTYSTUNEW1" TYPE="Decimal">0</FLD>
// <FLD MENULAB="" MENULOCAL="1" NAME="ZERSTOFLG1" TYPE="Integer">0</FLD>
// <FLD NAME="QTYPCUNEW2" TYPE="Decimal">0</FLD>
// <FLD NAME="PCUSTUNEW2" TYPE="Char"/>
// <FLD NAME="QTYSTUNEW2" TYPE="Decimal">0</FLD>
// <FLD MENULAB="" MENULOCAL="1" NAME="ZERSTOFLG2" TYPE="Integer">0</FLD>
// <FLD NAME="QTYPCUNEW" TYPE="Decimal">0</FLD>
// <FLD NAME="PCUSTUNEW" TYPE="Char"> 0,000000</FLD>
// <FLD NAME="QTYSTUNEW" TYPE="Decimal">0</FLD>
// <FLD MENULAB="Oui" MENULOCAL="1" NAME="ZERSTOFLG" TYPE="Integer">2</FLD>
// <FLD NAME="SERNUM" TYPE="Char"/>
// <FLD NAME="PALNUM" TYPE="Char"/>
// <FLD NAME="CTRNUM" TYPE="Char"/>
// <FLD MENULAB="Classe 'A'" MENULOCAL="212" NAME="ABC" TYPE="Integer">1</FLD>
// <FLD NAME="QTYSTUDEV" TYPE="Decimal">-25</FLD>
// <FLD NAME="PRCDEV" TYPE="Decimal">-100</FLD>
// <FLD NAME="CUNCST" TYPE="Decimal">147.02</FLD>
// <FLD NAME="CUNAMT" TYPE="Decimal">3675.5</FLD>
// <FLD NAME="CUNAMTNEW" TYPE="Decimal">0</FLD>
// <FLD MENULAB="Non" MENULOCAL="2724" NAME="CUNLOKFLG" TYPE="Integer">1</FLD>
// <FLD MENULAB="Ancienne ligne" MENULOCAL="715" NAME="LINFLG" TYPE="Integer">2</FLD>