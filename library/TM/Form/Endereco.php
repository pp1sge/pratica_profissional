<?php
    
    class TM_Form_Endereco extends Zend_Form
    {
         public function init()
        {
        	$this->setName('Endreco');
            $codigo = new Zend_Form_Element_Hidden('codigo_endereco');
			$codigo->setAttrib('class', 'grid');
            $this->addElement($codigo);
            $rua = new Zend_Form_Element_Text("rua");
            $rua->setLabel("Rua:")
                     ->addFilter("StripTags")
                     ->addFilter("StringTrim")
                     ->addValidator("notEmpty")
                     ->setAttrib('required', 'required')
                     ->setAttrib('id','rua')
                     ->setAttrib('class','grid')
                     ->addDecorator('fieldset')
                     ->removeDecorator('HtmlTag',array('tag'=>'dt'));
               $this->addElement($rua); 
               $complemento = new Zend_Form_Element_Text("complemento");
               $complemento->setLabel("Complemento:")
                     ->addFilter("StripTags")
                     ->addFilter("StringTrim")
                     ->addValidator("notEmpty")
                     ->setAttrib('required', 'required')
                     ->setAttrib('id','complemento')
                     ->setAttrib('class','grid')
                     ->addDecorator('fieldset')
                     ->removeDecorator('HtmlTag',array('tag'=>'dt'));
               $this->addElement($complemento);
               $bairro = new Zend_Form_Element_Text("bairro");
               $bairro->setLabel("Bairro:")
                     ->addFilter("StripTags")
                     ->addFilter("StringTrim")
                     ->addValidator("notEmpty")
                     ->setAttrib('required', 'required')
                     ->setAttrib('id','bairro')
                     ->setAttrib('class','grid')
                     ->addDecorator('fieldset')
                     ->removeDecorator('HtmlTag',array('tag'=>'dt'));
               $this->addElement($bairro);
               $cidade = new Zend_Form_Element_Text("cidade");
               $cidade->setLabel("Cidade:")
                     ->addFilter("StripTags")
                     ->addFilter("StringTrim")
                     ->addValidator("notEmpty")
                     ->setAttrib('required', 'required')
                     ->setAttrib('id','cidade')
                     ->setAttrib('class','grid')
                     ->addDecorator('fieldset')
                     ->removeDecorator('HtmlTag',array('tag'=>'dt'));
               $this->addElement($cidade);
               $rua = new Zend_Form_Element_Text("rua");
               $mapper = new Application_Model_Estado();
               $categoria = new Zend_Form_Element_Select('codigo_estado');
               $categoria->setLabel('Estado:')->addDecorator('fieldset');
               $categoria->setAttrib('class', 'grid');
               $categories = $mapper->fetchAll();
               foreach($categories as $row1)
               {
                 $categoria->addMultiOption($row1['codigo'],$row1['uf']);
               }
               $this->addElement($categoria);  

                       
    }
    }


?>

