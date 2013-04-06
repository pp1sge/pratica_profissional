<?php


	class TM_Form_Compra extends Zend_Form
	{
            public function init()
		{
			$this->setName('fCadastro');
			$url = new Zend_View_Helper_Url;
			$this->setAction($url->url(array('controller'=> 'compra','action'=>'save'),'default'));
			$this->setAttrib('class', 'formee');
			$this->setDecorators(array('FormElements',
            array('HtmlTag',array('tag'=>'div','class'=>'form')),'Form'));
       	    $this->setAttrib('onSubmit','return false');
            $codigo = new Zend_Form_Element_Hidden('codigo');
            $this->addElement($codigo);
			
            $mapper = new Application_Model_Fornecedor();
            $fornecedor = new Zend_Form_Element_Select('codigo_fornecedor');
            $fornecedor->setLabel('Fornecedor:');
            $fornecedores = $mapper->fetchAll();
            foreach($fornecedores as $row)
            {
              $fornecedor->addMultiOption($row['codigo'],$row['razao_social']);
            }
            $this->addElement($fornecedor);
			
			$produto = new Zend_Form_Element_Text("produto");
            $produto->setLabel("Produto:")
                 ->addFilter("StripTags")
                 ->addFilter("StringTrim")
                 ->addValidator("notEmpty")
                 ->setAttrib('required', 'required')
                 ->setAttrib('id','nmprod')
                 ->setAttrib('class','grid')
                 ->removeDecorator('HtmlTag',array('tag'=>'dt'));
            $this->addElement($produto);
			$preco = new Zend_Form_Element_Text('preco');
       		$preco->setLabel('Preço:')->addFilter("StripTags")
                  ->addFilter("StringTrim")
                  ->addValidator("notEmpty")
                  ->setAttrib('required', 'required')
                  ->setAttrib('id','preco')
                  ->setAttrib('class','required')
                  ->removeDecorator('HtmlTag',array('tag'=>'dt'));
       		$this->addElement($preco);
      		$qtd = new Zend_Form_Element_Text('qtd');
       		$qtd->setLabel('Quantidade:')->addFilter("StripTags")
                 ->addFilter("StringTrim")
                 ->addValidator("notEmpty")
                 ->setAttrib('required', 'required')
                 ->setAttrib('id','qtd')
                 ->setAttrib('class','required')
                 ->removeDecorator('HtmlTag',array('tag'=>'dt'));
       		$this->addElement($qtd);
			
			$mapper2 = new Application_Model_FormaPagamento();
			$pagamento = new Zend_Form_Element_Select('codigo_forma_pagamento');
			$pagamento->setLabel('Forma de Pagamento:');
			$pagamentos = $mapper2->fetchAll();
			foreach($pagamentos as $row)
            {
              $pagamento->addMultiOption($row['codigo'],$row['pagamento']);
            }
            $this->addElement($pagamento);
			
			$mapper3 = new Application_Model_StatusCompra();
			$status = new Zend_Form_Element_Select('codigo_status_pagamento');
			$status->setLabel('Status do Pagamento:');
			$state = $mapper3->fetchAll();
			foreach($state as $row)
            {
              $status->addMultiOption($row['codigo'],$row['status']);
            }
            $this->addElement($status);
			
		   $button = new Zend_Form_Element_Submit("Salvar");
           $button->setAttrib('class','alt_btn');
           $button->setAttrib('id','btn');
           $button->setDecorators(array(
               "ViewHelper",
               array(array("Div"=>"HtmlTag"),array('tag'=>'div','class'=>'submit_link')),
               array(array("Footer"=>"HtmlTag"),array('tag'=>'footer')),
               "ViewHelper"
           ));
           $button->removeDecorator('DtDdWrapper');
           $this->addElement($button);
			
		}
	}

?>