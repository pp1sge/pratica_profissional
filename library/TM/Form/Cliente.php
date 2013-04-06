<?php

class TM_Form_Cliente extends Zend_Form{
    
     public function init()
     {
            $this->setName('fCadastro');
            $url = new Zend_View_Helper_Url;
            $this->setAction($url->url(array('controller'=> 'compra','action'=>'save'),'default'));
            $this->setAttrib('class', 'formee');
            $this->setDecorators(array('FormElements',
            array('HtmlTag',array('tag'=>'div','class'=>'form')),'Form'));
            $codigo = new Zend_Form_Element_Hidden('codigo');
            $this->addElement($codigo);			
	    $cpf = new Zend_Form_Element_Text("cpf");
            $cpf->setLabel("Cpf:")
                 ->addFilter("StripTags")
                 ->addFilter("StringTrim")
                 ->addValidator("notEmpty")
                 ->setAttrib('required', 'required')
                 ->setAttrib('id','nmprod')
                 ->setAttrib('class','grid')
                 ->removeDecorator('HtmlTag',array('tag'=>'dt'));
            $this->addElement($cpf);
	    $nome = new Zend_Form_Element_Text('nome');
       		$nome->setLabel('Nome:')->addFilter("StripTags")
                  ->addFilter("StringTrim")
                  ->addValidator("notEmpty")
                  ->setAttrib('required', 'required')
                  ->setAttrib('id','preco')
                  ->setAttrib('class','required')
                  ->removeDecorator('HtmlTag',array('tag'=>'dt'));
       		$this->addElement($nome);
      		$data_nasc = new Zend_Form_Element_Text('data_de_nascimento');
       		$data_nasc->setLabel('Data de Nascimento:')->addFilter("StripTags")
                 ->addFilter("StringTrim")
                 ->addValidator("notEmpty")
                 ->setAttrib('required', 'required')
                 ->setAttrib('id','qtd')
                 ->setAttrib('class','required')
                 ->removeDecorator('HtmlTag',array('tag'=>'dt'));
       		$this->addElement($data_nasc);  	
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
