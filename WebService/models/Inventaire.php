<?php
require_once ('WebService/modelWS/ModelX3.php');
class Inventaire extends ModelX3 {
    
	function showOne($CUNLISNUM,$CUNSSSNUM) {
		$WS_ORDER = "RINV";
		$cle = new CAdxParamKeyValue ();
		$cle->key = "CUNLISNUM";
		$cle->value = $CUNLISNUM;
		$cle2 = new CAdxParamKeyValue ();
		$cle2->key = "CUNSSSNUM";
		$cle2->value = $CUNSSSNUM;

	
		$this->CAdxResultXml = $this->read ($WS_ORDER, Array($cle,$cle2) );
		if ($this->CAdxResultXml->status==0) {
			return 0;
		}

		$resultJSON = $this->CAdxResultXml->resultXml;
		$data = json_decode($resultJSON,true);
		$newarray = array();

		foreach($data["SNL0_4"] as $ligne){
			$eancod =$this->getBarcode($ligne["ITMREF"]);
			$ligne["EANCOD"] = $eancod["ITM1_2"]["EANCOD"];
			$ligne["QTYSTUNEW"] = 0;
			$newarray["datas"][] = $ligne;
		}

		$array2 = ["CUNSSSNUM" => $data["SNL0_1"]["CUNSSSNUM"],"CUNLISNUM" => $data["SNL0_2"]["CUNLISNUM"]];
		array_push($newarray,$array2);
		 return json_encode($newarray,true);

		// return $data;
	}

	function showListe() {
		$cle = new CAdxParamKeyValue ();
		$cle->key = "CUNLISSTA";
		$cle->value = 1;
        $WS_ORDER = "RINV";
		$this->CAdxResultXml = $this->query ($WS_ORDER, Array($cle), 17 );
		$result = $this->CAdxResultXml->resultXml;
		$data = json_decode($result,true);
		$str = '';
		foreach($data as $article){
			$var = explode(" ",$article["C1"]);
				$str .= '<option value="' . $article["CUNLISNUM"]. ' ' .$var[0]  . '" >';
				$str .= $article["CUNSSSDES"];
				$str .= "</option>";

		}
		
		return $str;
	}
	
	
	function getBarcode($crit) {
		$WS_ORDER = "WITM";
		$cle = new CAdxParamKeyValue ();
		$cle->key = "ITMREF";
		$cle->value = $crit;
	
		$this->CAdxResultXml = $this->read ($WS_ORDER, Array($cle) );
		if ($this->CAdxResultXml->status==0) {
			return 0;
		}
		$resultXml = $this->CAdxResultXml->resultXml;
		$data = json_decode($resultXml,true);
		return $data;
	}

	function update($CUNLISNUM,$CUNSSSNUM,$WS){
		$WS_ORDER = "RINV";
		$cle = new CAdxParamKeyValue ();
		$cle->key = "CUNLISNUM";
		$cle->value = $CUNLISNUM;
		$cle2 = new CAdxParamKeyValue ();
		$cle2->key = "CUNSSSNUM";
		$cle2->value = $CUNSSSNUM;
		$this->CAdxResultXml = $this->modify ( $WS_ORDER,Array($cle,$cle2), $WS );
		$adxResultXml = $this->CAdxResultXml;
		$status = $adxResultXml->status;
		if ($status == 1) {
			return 1;
		} else {
			return 0;
		}
	}

	
}



 ?>
