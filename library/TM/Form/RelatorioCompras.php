<?php
    
    class TM_Form_RelatorioCompras extends Zend_Form
    {
    	public function init()
		{
            $this->setName('report');
            $url = new Zend_View_Helper_Url();
            $this->setAction($url->url(array('controller'=> 'compra','action'=>'relatorio'),'default'));       
            $mapper = new Application_Model_Fornecedor();
            $fornecedor = new Zend_Form_Element_Select('codigo_fornecedor');
            $fornecedor->setLabel('Fornecedor:');
			$fornecedor->setAttrib('class', 'grid');
            $fornecedores = $mapper->front_dados();
			$fornecedor->addMultiOption('','Selecione um fornecedor...');
            foreach($fornecedores as $row1)
            {
              $fornecedor->addMultiOption($row1['codigo'],$row1['razao_social']);
            }
            $this->addElement($fornecedor);
			
			$mapper = new Application_Model_Compra();
            $produto = new Zend_Form_Element_Select('produto');
            $produto->setLabel('Produto:');
			$produto->setAttrib('class', 'grid');
			$produto->addMultiOption('','Selecione um produto...');
            $produtos = $mapper->fetchAll();
            foreach($produtos as $row1)
            {
              $produto->addMultiOption($row1['produto'],$row1['produto']);
            }
            $this->addElement($produto);
			
			$mapper_5 = new Application_Model_FormaPagamento();
            $produto = new Zend_Form_Element_Select('codigo_forma_pagamento');
            $produto->setLabel('Forma de Pagamento:');
			$produto->setAttrib('class', 'grid');
			$produto->addMultiOption('','Selecione uma Forma de Pagamento...');
            $produtos = $mapper_5->fetchAll();
            foreach($produtos as $row1)
            {
              $produto->addMultiOption($row1['codigo'],$row1['pagamento']);
            }
            $this->addElement($produto);
			
			$periodo_inicial = new Zend_Form_Element_Text('periodo_inicial');
			$periodo_inicial->setLabel('Período:');
			$periodo_inicial->setAttrib('placeholder','De...');
			$periodo_inicial->setAttrib('class', 'grid');
			$this->addElement($periodo_inicial);	
			
			$periodo_final = new Zend_Form_Element_Text('periodo_final');
			$periodo_final->setAttrib('class', 'grid');
			$periodo_final->setAttrib('placeholder','Até...');
			$this->addElement($periodo_final);
	}
    }
