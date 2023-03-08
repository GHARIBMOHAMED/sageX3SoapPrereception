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
        if($d["QTYSTUNEW"] != 0){
            $WS .= "<FLD MENULAB=\"Compté\" MENULOCAL=\"2725\" NAME=\"CUNLISSTAD\" TYPE=\"Integer\">" . $d["CUNLISSTAD"] . "</FLD>";
            $WS .= "<FLD NAME=\"ITMREF\" TYPE=\"Char\">" . $d["ITMREF"] . "</FLD>";
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
            $WS .= "<FLD  MENULOCAL=\"1\" NAME=\"ZERSTOFLG1\" TYPE=\"Integer\">1</FLD>";
            $WS .= "<FLD NAME=\"QTYPCUNEW2\" TYPE=\"Decimal\">" . $d["QTYPCUNEW2"] . "</FLD>";
            $WS .= "<FLD NAME=\"PCUSTUNEW2\" TYPE=\"Char\"/>";
            $WS .= "<FLD NAME=\"QTYSTUNEW2\" TYPE=\"Decimal\">" . $d["QTYSTUNEW2"] . "</FLD>";
            $WS .= "<FLD NAME=\"PCUSTUNEW\" TYPE=\"Char\">" . $d["PCUSTUNEW"] . "</FLD>";
            $WS .= "<FLD NAME=\"SERNUM\" TYPE=\"Char\"/>";
            $WS .= "<FLD NAME=\"PALNUM\" TYPE=\"Char\"/>";
            $WS .= "<FLD NAME=\"CTRNUM\" TYPE=\"Char\"/>";
            $WS .= "<FLD NAME=\"ITMDES1\" TYPE=\"Char\">" . $d["ITMDES1"] . "</FLD>";
            $WS .= "<FLD NAME=\"PCU\" TYPE=\"Char\">" . $d["PCU"] . "</FLD>";
            $WS .= "<FLD NAME=\"STA\" TYPE=\"Char\">" . $d["STA"] . "</FLD>";
            $WS .= "<FLD NAME=\"QTYPCU\" >" . $d["QTYPCU"] . "</FLD>";
            $WS .= "<FLD NAME=\"PCUSTUCOE\" TYPE=\"Decimal\">" . $d["PCUSTUCOE"] . "</FLD>";
            $WS .= "<FLD NAME=\"STU\" >" . $d["STU"] . "</FLD>";
            $WS .= "<FLD NAME=\"QTYSTU\" TYPE=\"Decimal\">" . $d["QTYSTU"] . "</FLD>";
            $WS .= "<FLD MENULAB=\"Non\" MENULOCAL=\"1\" NAME=\"ZERSTOFLG2\" TYPE=\"Integer\">" . $d["ZERSTOFLG2"] . "</FLD>";
            $WS .= "<FLD NAME=\"QTYPCUNEW\" TYPE=\"Decimal\">" . $d["QTYSTUNEW"] . "</FLD>";
            $WS .= "<FLD NAME=\"QTYSTUNEW\" TYPE=\"Decimal\">" . $d["QTYSTUNEW"] . "</FLD>";
            $WS .= "<FLD MENULAB=\"Non\" MENULOCAL=\"1\" NAME=\"ZERSTOFLG\" TYPE=\"Integer\">1</FLD>";
            $WS .= "<FLD MENULAB=\"Classe 'A'\" MENULOCAL=\"212\"  NAME=\"ABC\" TYPE=\"Integer\">" . $d["ABC"] . "</FLD>";
            $WS .= "<FLD NAME=\"PRCDEV\" TYPE=\"Decimal\">" . $d["PRCDEV"] . "</FLD>";
            $WS .= "<FLD NAME=\"CUNCST\" TYPE=\"Decimal\">" . $d["CUNCST"] . "</FLD>";
            $WS .= "<FLD NAME=\"CUNAMT\" TYPE=\"Decimal\">" . $d["CUNAMT"] . "</FLD>";
            $WS .= "<FLD NAME=\"CUNAMTNEW\" TYPE=\"Decimal\">" . $d["CUNAMTNEW"] . "</FLD>";
            $WS .= "<FLD MENULAB=\"Oui\" MENULOCAL=\"2724\" NAME=\"CUNLOKFLG\" TYPE=\"Integer\">" . $d["CUNLOKFLG"] . "</FLD>";
            $WS .= "<FLD MENULAB=\"Ancienne ligne\" MENULOCAL=\"715\" NAME=\"LINFLG\" TYPE=\"Integer\">" . $d["LINFLG"] . "</FLD>";
        }else{
            $WS .='<FLD MENULAB="Compté" MENULOCAL="2725" NAME="CUNLISSTAD" TYPE="Integer">2</FLD>';
            $WS .='<FLD NAME="SAICOD" TYPE="Char"/>';
            $WS .='<FLD NAME="ITMREF" TYPE="Char">'. $d["ITMREF"] .'</FLD>';
            $WS .='<FLD NAME="ITMDES1" TYPE="Char">GRANTS WILLIAM WHISKY 100CL</FLD>';
            $WS .='<FLD NAME="WRH" TYPE="Char"/>';
            $WS .='<FLD NAME="LPNNUM" TYPE="Char"/>';
            $WS .='<FLD NAME="LOC" TYPE="Char"/>';
            $WS .='<FLD NAME="LOT" TYPE="Char"/>';
            $WS .='<FLD NAME="SLO" TYPE="Char"/>';
            $WS .='<FLD NAME="PCU" TYPE="Char">UN</FLD>';
            $WS .='<FLD NAME="STA" TYPE="Char">A</FLD>';
            $WS .='<FLD NAME="QTYPCU" TYPE="Decimal">228</FLD>';
            $WS .='<FLD NAME="PCUSTUCOE" TYPE="Decimal">1</FLD>';
            $WS .='<FLD NAME="STU" TYPE="Char">UN</FLD>';
            $WS .='<FLD NAME="QTYSTU" TYPE="Decimal">228</FLD>';
            $WS .='<FLD NAME="QTYPCUNEW1" TYPE="Decimal">0</FLD>';
            $WS .='<FLD NAME="PCUSTUNEW1" TYPE="Char"/>';
            $WS .='<FLD NAME="QTYSTUNEW1" TYPE="Decimal">0</FLD>';
            $WS .='<FLD MENULAB="Oui" MENULOCAL="1" NAME="ZERSTOFLG1" TYPE="Integer">2</FLD>';
            $WS .='<FLD NAME="QTYPCUNEW2" TYPE="Decimal">0</FLD>';
            $WS .='<FLD NAME="PCUSTUNEW2" TYPE="Char"/>';
            $WS .='<FLD NAME="QTYSTUNEW2" TYPE="Decimal">0</FLD>';
            $WS .='<FLD MENULAB="Non" MENULOCAL="1" NAME="ZERSTOFLG2" TYPE="Integer">1</FLD>';
            $WS .='<FLD NAME="QTYPCUNEW" TYPE="Decimal">228</FLD>';
            $WS .='<FLD NAME="PCUSTUNEW" TYPE="Char"> 1,000000</FLD>';
            $WS .='<FLD NAME="QTYSTUNEW" TYPE="Decimal">228</FLD>';
            $WS .='<FLD MENULAB="Non" MENULOCAL="1" NAME="ZERSTOFLG" TYPE="Integer">2</FLD>';
            $WS .='<FLD NAME="SERNUM" TYPE="Char"/>';
            $WS .='<FLD NAME="PALNUM" TYPE="Char"/>';
            $WS .='<FLD NAME="CTRNUM" TYPE="Char"/>';
            $WS .='<FLD  MENULOCAL="212" NAME="ABC" TYPE="Integer">1</FLD>';
            $WS .='<FLD NAME="QTYSTUDEV" TYPE="Decimal">0</FLD>';
            $WS .='<FLD NAME="PRCDEV" TYPE="Decimal">0</FLD>';
            $WS .='<FLD NAME="CUNCST" TYPE="Decimal"></FLD>';
            $WS .='<FLD NAME="CUNAMT" TYPE="Decimal"></FLD>';
            $WS .='<FLD NAME="CUNAMTNEW" TYPE="Decimal"></FLD>';
            $WS .='<FLD MENULAB="Non" MENULOCAL="2724" NAME="CUNLOKFLG" TYPE="Integer">1</FLD>';
            $WS .='<FLD MENULAB="Non" MENULOCAL="1" NAME="MODFLG" TYPE="Integer">1</FLD>';
            $WS .='<FLD NAME="QTYPCUNEWS" TYPE="Decimal">0</FLD>';
            $WS .='<FLD NAME="QTYSTUNEWS" TYPE="Decimal">0</FLD>';
            $WS .='<FLD MENULAB="Oui" MENULOCAL="1" NAME="ZERSTOFLGS" TYPE="Integer">2</FLD>';
            $WS .='<FLD MENULAB="Ancienne ligne" MENULOCAL="715" NAME="LINFLG" TYPE="Integer">2</FLD>';
            $WS .='<FLD MENULAB="Compté" MENULOCAL="2725" NAME="CUNLISSTAM" TYPE="Integer">1</FLD>';
            $WS .='<FLD MENULAB="Compté" MENULOCAL="2725" NAME="CUNLISSTAN" TYPE="Integer">1</FLD>';
            $WS .='<FLD NAME="NBDETAIL" TYPE="Integer">1</FLD>';
            $WS .='<FLD NAME="CUMALLQTY" TYPE="Decimal">0</FLD>';
            $WS .='<FLD NAME="STOCOU" TYPE="Decimal">166419</FLD>';
            $WS .='<FLD NAME="PCUSTUW" TYPE="Decimal">1</FLD>';
            $WS .='<FLD NAME="PCUSTUW1" TYPE="Decimal">0</FLD>';
            $WS .='<FLD NAME="PCUSTUW2" TYPE="Decimal">0</FLD>';
            $WS .='<FLD NAME="CTG" TYPE="Integer">0</FLD>';
            $WS .='<FLD NAME="CTG1" TYPE="Integer">0</FLD>';
            $WS .='<FLD NAME="CTG2" TYPE="Integer">0</FLD>';
            $WS .='<FLD NAME="QTYPCUNEWS1" TYPE="Decimal">0</FLD>';
            $WS .='<FLD NAME="QTYSTUNEWS1" TYPE="Decimal">0</FLD>';
            $WS .='<FLD MENULAB="Non" MENULOCAL="1" NAME="ZERSTOFLGS1" TYPE="Integer">1</FLD>';
            $WS .='<FLD NAME="QTYPCUNEWS2" TYPE="Decimal">0</FLD>';
            $WS .='<FLD NAME="QTYSTUNEWS2" TYPE="Decimal">0</FLD>';
            $WS .='<FLD MENULAB="Non" MENULOCAL="1" NAME="ZERSTOFLGS2" TYPE="Integer">1</FLD>';
            $WS .= '<FLD NAME="SERSEQ" TYPE="Integer">0</FLD>';
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
			// <FLD NAME="SAICOD" TYPE="Char"/>
			// <FLD NAME="ITMREF" TYPE="Char">WHI01135</FLD>
			// <FLD NAME="ITMDES1" TYPE="Char">GRANT'S WILLIAM WHISKY 100CL</FLD>
			// <FLD NAME="WRH" TYPE="Char"/>
			// <FLD NAME="LPNNUM" TYPE="Char"/>
			// <FLD NAME="LOC" TYPE="Char"/>
			// <FLD NAME="LOT" TYPE="Char"/>
			// <FLD NAME="SLO" TYPE="Char"/>
			// <FLD NAME="PCU" TYPE="Char">UN</FLD>
			// <FLD NAME="STA" TYPE="Char">A</FLD>
			// <FLD NAME="QTYPCU" TYPE="Decimal">228</FLD>
			// <FLD NAME="PCUSTUCOE" TYPE="Decimal">1</FLD>
			// <FLD NAME="STU" TYPE="Char">UN</FLD>
			// <FLD NAME="QTYSTU" TYPE="Decimal">228</FLD>
			// <FLD NAME="QTYPCUNEW1" TYPE="Decimal">0</FLD>
			// <FLD NAME="PCUSTUNEW1" TYPE="Char"/>
			// <FLD NAME="QTYSTUNEW1" TYPE="Decimal">0</FLD>
			// <FLD MENULAB="Oui" MENULOCAL="1" NAME="ZERSTOFLG1" TYPE="Integer">2</FLD>
			// <FLD NAME="QTYPCUNEW2" TYPE="Decimal">0</FLD>
			// <FLD NAME="PCUSTUNEW2" TYPE="Char"/>
			// <FLD NAME="QTYSTUNEW2" TYPE="Decimal">0</FLD>
			// <FLD MENULAB="Non" MENULOCAL="1" NAME="ZERSTOFLG2" TYPE="Integer">1</FLD>
			// <FLD NAME="QTYPCUNEW" TYPE="Decimal">228</FLD>
			// <FLD NAME="PCUSTUNEW" TYPE="Char"> 1,000000</FLD>
			// <FLD NAME="QTYSTUNEW" TYPE="Decimal">228</FLD>
			// <FLD MENULAB="Non" MENULOCAL="1" NAME="ZERSTOFLG" TYPE="Integer">2</FLD>
			// <FLD NAME="SERNUM" TYPE="Char"/>
			// <FLD NAME="PALNUM" TYPE="Char"/>
			// <FLD NAME="CTRNUM" TYPE="Char"/>
			// <FLD MENULAB="Classe 'A'" MENULOCAL="212" NAME="ABC" TYPE="Integer">1</FLD>
			// <FLD NAME="QTYSTUDEV" TYPE="Decimal">0</FLD>
			// <FLD NAME="PRCDEV" TYPE="Decimal">0</FLD>
			// <FLD NAME="CUNCST" TYPE="Decimal"></FLD>
			// <FLD NAME="CUNAMT" TYPE="Decimal"></FLD>
			// <FLD NAME="CUNAMTNEW" TYPE="Decimal"></FLD>
			// <FLD MENULAB="Non" MENULOCAL="2724" NAME="CUNLOKFLG" TYPE="Integer">1</FLD>
			// <FLD MENULAB="Non" MENULOCAL="1" NAME="MODFLG" TYPE="Integer">1</FLD>
			// <FLD NAME="QTYPCUNEWS" TYPE="Decimal">0</FLD>
			// <FLD NAME="QTYSTUNEWS" TYPE="Decimal">0</FLD>
			// <FLD MENULAB="Oui" MENULOCAL="1" NAME="ZERSTOFLGS" TYPE="Integer">2</FLD>
			// <FLD MENULAB="Ancienne ligne" MENULOCAL="715" NAME="LINFLG" TYPE="Integer">2</FLD>
			// <FLD MENULAB="Compté" MENULOCAL="2725" NAME="CUNLISSTAM" TYPE="Integer">1</FLD>
			// <FLD MENULAB="Compté" MENULOCAL="2725" NAME="CUNLISSTAN" TYPE="Integer">1</FLD>
			// <FLD NAME="NBDETAIL" TYPE="Integer">1</FLD>
			// <FLD NAME="CUMALLQTY" TYPE="Decimal">0</FLD>
			// <FLD NAME="STOCOU" TYPE="Decimal">166419</FLD>
			// <FLD NAME="PCUSTUW" TYPE="Decimal">1</FLD>
			// <FLD NAME="PCUSTUW1" TYPE="Decimal">0</FLD>
			// <FLD NAME="PCUSTUW2" TYPE="Decimal">0</FLD>
			// <FLD NAME="CTG" TYPE="Integer">0</FLD>
			// <FLD NAME="CTG1" TYPE="Integer">0</FLD>
			// <FLD NAME="CTG2" TYPE="Integer">0</FLD>
			// <FLD NAME="QTYPCUNEWS1" TYPE="Decimal">0</FLD>
			// <FLD NAME="QTYSTUNEWS1" TYPE="Decimal">0</FLD>
			// <FLD MENULAB="Non" MENULOCAL="1" NAME="ZERSTOFLGS1" TYPE="Integer">1</FLD>
			// <FLD NAME="QTYPCUNEWS2" TYPE="Decimal">0</FLD>
			// <FLD NAME="QTYSTUNEWS2" TYPE="Decimal">0</FLD>
			// <FLD MENULAB="Non" MENULOCAL="1" NAME="ZERSTOFLGS2" TYPE="Integer">1</FLD>
			// <FLD NAME="SERSEQ" TYPE="Integer">0</FLD>