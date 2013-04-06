<?php


    class TM_Form_Funcionario extends Zend_Form
    {
        public function init()
        {
            $this->setName('fCadastro');
            $url = new Zend_View_Helper_Url();
            $this->setAction($url->url(array('controller'=> 'funcionario','action'=>'save','module'=>'dashboard')));        
            $this->setDecorators(array('FormElements',
                array('HtmlTag',array('tag'=>'div','class'=>'form')),'Form'));
            $this->setAttrib('onSubmit','return false');
            $codigo = new Zend_Form_Element_Hidden('codigo');
            $this->addElement($codigo);
            $cpf = new Zend_Form_Element_Text("cpf");
            $cpf->setLabel("Cpf:")
                     ->addFilter("StripTags")
                     ->addFilter("StringTrim")
                     ->addValidator("notEmpty")
                     ->setAttrib('required', 'required')
                     ->setAttrib('id','cpf')
                     ->setAttrib('class','grid')
                     ->addDecorator('fieldset')
                     ->removeDecorator('HtmlTag',array('tag'=>'dt'));
               $this->addElement($cpf);  
               $nome = new Zend_Form_Element_Text("nome");
               $nome->setLabel("Nome:")
                     ->addFilter("StripTags")
                     ->addFilter("StringTrim")
                     ->addValidator("notEmpty")
                     ->setAttrib('required', 'required')
                     ->setAttrib('id','nome')
                     ->setAttrib('class','grid')
                     ->addDecorator('fieldset')
                     ->removeDecorator('HtmlTag',array('tag'=>'dt'));
               $this->addElement($nome); 
               $clt = new Zend_Form_Element_Text("clt");
               $clt->setLabel("Clt:")
                     ->addFilter("StripTags")
                     ->addFilter("StringTrim")
                     ->addValidator("notEmpty")
                     ->setAttrib('required', 'required')
                     ->setAttrib('id','clte')
                     ->setAttrib('class','grid')
                     ->addDecorator('fieldset')
                     ->removeDecorator('HtmlTag',array('tag'=>'dt'));
               $this->addElement($clt);
               $salario = new Zend_Form_Element_Text("salario");
               $salario->setLabel("Salarios:")
                     ->addFilter("StripTags")
                     ->addFilter("StringTrim")
                     ->addValidator("notEmpty")
                     ->setAttrib('required', 'required')
                     ->setAttrib('id','salario')
                     ->setAttrib('class','grid')
                     ->addDecorator('fieldset')
                     ->removeDecorator('HtmlTag',array('tag'=>'dt'));
               $this->addElement($salario); 
               $data_de_nascimento = new Zend_Form_Element_Text("data_de_nascimento");
               $data_de_nascimento->setLabel("Data de Nascimento:")
                     ->addFilter("StripTags")
                     ->addFilter("StringTrim")
                     ->addValidator("notEmpty")
                     ->setAttrib('required', 'required')
                     ->setAttrib('id','data_de_nascimento')
                     ->setAttrib('class','grid')
                     ->addDecorator('fieldset')
                     ->removeDecorator('HtmlTag',array('tag'=>'dt'));
               $this->addElement($data_de_nascimento); 
               $data_de_admissao = new Zend_Form_Element_Text("data_de_admissao");
               $data_de_admissao->setLabel("Data de Admissao:")
                     ->addFilter("StripTags")
                     ->addFilter("StringTrim")
                     ->addValidator("notEmpty")
                     ->setAttrib('required', 'required')
                     ->setAttrib('id','data_de_admissa')
                     ->setAttrib('class','grid')
                     ->addDecorator('fieldset')
                     ->removeDecorator('HtmlTag',array('tag'=>'dt'));
               $this->addElement($data_de_admissao);  
               $data_de_demissao = new Zend_Form_Element_Text("data_de_demissao");
               $data_de_demissao->setLabel("Data de Demissao:")
                     ->addFilter("StripTags")
                     ->addFilter("StringTrim")
                     ->setAttrib('id','data_de_demissao')
                     ->setAttrib('class','grid')
                     ->addDecorator('fieldset')
                     ->removeDecorator('HtmlTag',array('tag'=>'dt'));
               $this->addElement($data_de_demissao);  
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

