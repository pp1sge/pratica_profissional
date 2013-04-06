<?php

class Dashboard_View_Helper_TipoProduto extends Zend_View_Helper_Abstract {
    
   public function tipoProduto($codigo)
    {
       $model = new Application_Model_TipoProduto();
       return $model->retorna_tipo($codigo);
    }
}

?>
