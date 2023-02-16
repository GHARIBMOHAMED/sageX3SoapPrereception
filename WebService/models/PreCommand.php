<?php
require_once ('WebService/modelWS/ModelX3.php');
class PreCommande extends ModelX3 {
    
	function showOne($crit) {
		$WS_ORDER = "WPPTO";
		$cle = new CAdxParamKeyValue ();
		$cle->key = "SHIPNUM";
		$cle->value = $crit;
	
		$this->CAdxResultXml = $this->read ($WS_ORDER, Array($cle) );
		if ($this->CAdxResultXml->status==0) {
			return 0;
		}
		$resultJSON = $this->CAdxResultXml->resultXml;
		$data = json_decode($resultJSON,true);
		foreach($data["SHIP1_1"] as $ligne){
			$eancod =$this->getBarcode($ligne["ITMREF"]);

			$array["datas"][] = [
				"EANCOD"=>$eancod["ITM1_2"]["EANCOD"],
				"ITMREF"=>$ligne["ITMREF"],
				"SHIQTY"=>$ligne["SHIQTY"],
				"ITMDES"=>$ligne["ITMDES"],
				"PRCPQTY"=>0,
				"POHFCY"=>$ligne["POHFCY"],
				"UOM"=>$ligne["UOM"],
				"NETCUR"=>$ligne["NETCUR"],
				"ITMDES1"=>$ligne["ITMDES1"],
				"PRHFCY"=>$ligne["PRHFCY"],
				"BPSNUM"=>$ligne["BPSNUM"],
				"POHNUM"=>$ligne["POHNUM"],
			];	
		}
		$array2 = ["SHIPNUM" => $data["SHIP0_1"]["SHIPNUM"]];
		array_push($array,$array2);
		return json_encode($array,true);
		//return $data;
	}

	function showListe() {
		$WS = "*";
        $WS_ORDER = "WPPTO";
		$this->CAdxResultXml = $this->query ($WS_ORDER, $WS, 100 );
		$result = $this->CAdxResultXml->resultXml;
		$data = json_decode($result,true);
		$str = '';
		foreach($data as $article){

				$str .= '<option value="' . $article["SHIPNUM"] . '" >';
				$str .= $article["SHIPNUM"];
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
}

 ?>
