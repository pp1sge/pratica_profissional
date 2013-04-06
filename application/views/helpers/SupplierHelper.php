<?php

class Dashboard_View_Helper_SupplierHelper extends Zend_View_Helper_Abstract
{
    
    public function supplierHelper($codigo)
    {
       $model = new Application_Model_Telefone;
       return $model->retorno_telefone($codigo);
    }
    public function retorna_telefone()
    {
       
    }
    
    
}

?>
