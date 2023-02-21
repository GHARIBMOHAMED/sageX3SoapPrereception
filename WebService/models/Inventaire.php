<?php
require_once ('WebService/modelWS/ModelX3.php');
class Inventaire extends ModelX3 {
    
	function showOne($crit) {
		$WS_ORDER = "WSOH";
		$cle = new CAdxParamKeyValue ();
		$cle->key = "SOHNUM";
		$cle->value = $crit;
	
		$this->CAdxResultXml = $this->read ($WS_ORDER, Array($cle) );
		if ($this->CAdxResultXml->status==0) {
			return 0;
		}
		$resultJSON = $this->CAdxResultXml->resultXml;
		$data = json_decode($resultJSON,true);
		foreach($data["SOH4_1"] as $ligne){
			$eancod =$this->getBarcode($ligne["ITMREF"]);

			$array["datas"][] = [
				"EANCOD"=>$eancod["ITM1_2"]["EANCOD"],
				"ITMREF"=>$ligne["ITMREF"],
				"QTY"=>$ligne["QTY"],
				"SAU"=>$ligne["SAU"],
				"PRCPQTY"=>0,
				"DSTOFCY"=>$ligne["DSTOFCY"],
				"NUMLIG"=>$ligne["NUMLIG"],
				"ITMDES1"=>$ligne["ITMDES1"],
				"SOHNUM" => $data["SOH0_1"]["SOHNUM"],
				"SALFCY"=> $data["SOH0_1"]["SALFCY"],
				"ORDDAT"=> $data["SOH0_1"]["ORDDAT"],
				"BPCORD"=> $data["SOH0_1"]["BPCORD"],
			];	
		}
		$array2 = ["SOHNUM" => $data["SOH0_1"]["SOHNUM"]];
		array_push($array,$array2);
		return json_encode($array,true);
		//return $data;
	}

	function showListe() {
		$cle = new CAdxParamKeyValue ();
		$cle->key = "CUNLISSTA";
		$cle->value = 1;
        $WS_ORDER = "WINV";
		$this->CAdxResultXml = $this->query ($WS_ORDER, Array($cle), 17 );
		$result = $this->CAdxResultXml->resultXml;
		$data = json_decode($result,true);
		$str = '';
		foreach($data as $article){

				$str .= '<option value="' . $article["CUNLISNUM"] . '" >';
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
}

 ?>
