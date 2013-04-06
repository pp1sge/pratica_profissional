<?php
   class Dashboard_View_Helper_Pagamento extends Zend_View_Helper_Abstract
    {
    	public function pagamento($codigo)
		{
			$model = new Application_Model_FormaPagamento;
			$view = $model->find($codigo);
			$varView = $view['pagamento'];
			
			return $varView;
		}
    }