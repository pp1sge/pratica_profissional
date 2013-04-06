<?php

class Dashboard_View_Helper_Low extends Zend_View_Helper_Abstract {

    public function low()
    {
        $model = new Application_Model_Produto();
           echo "<div>Os produtos 
                    <ul>";
        foreach($model->low() as $produto)
        {
        
               echo "<li style='list-style:decimal;'>Nome:&nbsp;".$produto['nome']."&nbsp; Categoria:&nbsp;".$this->retorno_categoria($produto['codigo_categoria'])."&nbsp; </li>";
                     
        }
        echo "</ul>";
        echo "<p>estão com estoque baixo</p>";
    }
    public function retorno_categoria($codigo)
    {
       $model = new Application_Model_Categoria();
       return $model->retorno_categoria($codigo);
    }
    
}

?>
