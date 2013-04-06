<?php

class Dashboard_View_Helper_TamanhoProduto extends Zend_View_Helper_Abstract{
    
    
        public function tamanhoProduto($codigo)
        {
            $model = new Application_Model_Tamanho;
            return $model->retorna_tamanho($codigo);
            
        }
    
}

?>
