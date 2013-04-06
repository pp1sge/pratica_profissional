<?php
    
    class Dashboard_View_Helper_Fornecedor extends Zend_View_Helper_Abstract
    {
    	public function fornecedor($codigo)
		{
			$model = new Application_Model_Fornecedor;
			$view = $model->find($codigo);
			$varView = $view['razao_social'];
			
			return $varView;
		}
    }
