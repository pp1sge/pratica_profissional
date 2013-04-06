<?php


	class Dashboard_View_Helper_Telefone extends Zend_View_Helper_Abstract {
		
		public function telefone($codigo_telefone)
		{
			$model = new Application_Model_Telefone;
			$telefone = "";
			foreach($model->codigoTelefone($codigo_telefone) as $telefone)
			{
				$telefone = $telefone['telefone'];
			}
			return $telefone;
			
		}
		
	}

?>