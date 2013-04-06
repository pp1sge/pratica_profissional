<?php
   class Dashboard_View_Helper_StatusPagamento extends Zend_View_Helper_Abstract
    {
    	public function statusPagamento($codigo)
		{
			$model = new Application_Model_StatusCompra;
			$view = $model->find($codigo);
			$varView = $view['status'];
			
			return $varView;
		}
    }