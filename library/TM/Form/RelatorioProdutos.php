<?php

class TM_Form_RelatorioProdutos extends Zend_Form {
    
    public function init()
    {
        $this->setName('report');
        $this->setAttrib('class','formee');
        $url = new Zend_View_Helper_Url;
        $this->setAction($url->url(array('controller'=>'produto','action'=>'relatorio')));
        
        $mapper_produto = new Application_Model_Produto();
        $produtos = new Zend_Form_Element_Select('nome');
        $fetch = $mapper_produto->front_dados();
        $produtos->setLabel('Produto:');
        $produtos->addMultiOption('', '====SELECIONE O PRODUTO====');
        $produtos->setAttrib('class', 'grid');

        foreach($fetch as $value)
        {
            $produtos->addMultiOption($value['nome'],$value['nome']);
        }
        $this->addElement($produtos);
        
        $mapper_tipo_produto = new Application_Model_TipoProduto;
        $tipo_produto = new Zend_Form_Element_Select('codigo_tipo');
        $tipo_produto->setLabel('Tipo do Produto:');
        $fetch = $mapper_tipo_produto->front_dados();
        $tipo_produto->addMultiOption('','====SELECIONE O TIPO DO PRODUTO====');
         $tipo_produto->setAttrib('class', 'grid');

        foreach($fetch as $value)
        {
            $tipo_produto->addMultiOption($value['codigo'],$value['titulo']);
        }
        $this->addElement($tipo_produto);
        
        $mapper_genero_produto = new Application_Model_Genero;
        $genero_produto = new Zend_Form_Element_Select('codigo_genero');
        $genero_produto->setLabel('Gênero do Produto');
        $fetch = $mapper_genero_produto->front_dados();
        $genero_produto->setAttrib('class', 'grid');

        $genero_produto->addMultiOption('', '====SELECIONE O GÊNERO DO PRODUTO====');
        foreach($fetch as $value)
        {
           $genero_produto->addMultiOption($value['codigo'],$value['titulo']);
        }
        $this->addElement($genero_produto);
        
        $mapper_tamanho = new Application_Model_Tamanho;
        $tamanho_produto = new Zend_Form_Element_Select('codigo_tamanho');
        $tamanho_produto->setLabel('Tamanho do Produto:');
        $fetch = $mapper_tamanho->front_dados();
        $tamanho_produto->addMultiOption('','====SELECIONE O TAMANHO DO PRODUTO====');
        $tamanho_produto->setAttrib('class', 'grid');
        foreach($fetch as $value)
        {
            $tamanho_produto->addMultiOption($value['codigo'], $value['titulo']);
        }
        $this->addElement($tamanho_produto);
       
        
        
    }
}

?>
