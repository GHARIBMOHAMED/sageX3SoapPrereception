<?php
require_once ('WebService/modelWS/ModelX3.php');
class Reception extends ModelX3 {

    function create($WS) {
        $WS_ORDER = "WREC";
		$this->CAdxResultXml = $this->save ( $WS_ORDER, $WS );
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

