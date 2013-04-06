<?php


    class TM_Form_Fornecedor extends Zend_Form
    {
         public function init()
        {
            $this->setName('fCadastro');
            $url = new Zend_View_Helper_Url();
            $this->setAction($url->url(array('controller'=> 'fornecedor','action'=>'save','module'=>'dashboard')));   
	   $this->setAttrib('class', 'ym-form');     
            $this->setDecorators(array('FormElements',
                array('HtmlTag',array('tag'=>'div','class'=>'form')),'Form'));
            $this->setAttrib('onSubmit','return false');
            $codigo = new Zend_Form_Element_Hidden('codigo');
			$codigo->setAttrib('class', 'grid');
            $this->addElement($codigo);
            $titulo = new Zend_Form_Element_Text("cnpj");
            $titulo->setDecorators(array(array('data' => 'HtmlTag'), array('tag' => 'div', 'class' => 'ym-fbox-input')));
            $titulo->setLabel("Cnpj:")
                     ->addFilter("StripTags")
                     ->addFilter("StringTrim")
                     ->addValidator("notEmpty")
                     ->setAttrib('required', 'required')
                     ->setAttrib('id','cnpj')
                     ->setAttrib('class','grid-cnpj')
		     ->setAttrib('class','grid')
                     ->addDecorator('fieldset')
                     ->removeDecorator('HtmlTag',array('tag'=>'dt'));
               $this->addElement($titulo);    
               $responsavel = new Zend_Form_Element_Text("nome");
               $responsavel->setLabel("Responsável:")
                     ->addFilter("StripTags")
                     ->addFilter("StringTrim")
                     ->addValidator("notEmpty")
                     ->setAttrib('required', 'required')
                     ->setAttrib('id','nmresp')
                     ->setAttrib('class','grid')
                     ->addDecorator('fieldset')
                     ->removeDecorator('HtmlTag',array('tag'=>'dt'));
               $this->addElement($responsavel);  
               $razao_social = new Zend_Form_Element_Text("razao_social");
               $razao_social->setLabel("Razão Social:")
                     ->addFilter("StripTags")
                     ->addFilter("StringTrim")
                     ->addValidator("notEmpty")
                     ->setAttrib('required', 'required')
                     ->setAttrib('id','nmresp')
                     ->setAttrib('class','grid')
                     ->addDecorator('fieldset')
                     ->removeDecorator('HtmlTag',array('tag'=>'dt'));
               $this->addElement($razao_social);   
               
        
    }
    }
?>

