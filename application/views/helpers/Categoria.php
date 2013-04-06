<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Filter
 *
 * @author Pulo
 */
class Dashboard_View_Helper_Categoria extends Zend_View_Helper_Abstract {

    
    public function categoria($codigo)
    {
       $model = new Application_Model_Categoria();
       return $model->retorno_categoria($codigo);
    }
    
}

?>
