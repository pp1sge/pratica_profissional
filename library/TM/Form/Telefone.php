<?php


    class TM_Form_Telefone extends Zend_Form
    {
        public function init()
        {
        	$this->setName('Telefone');
			$codigo = new Zend_Form_Element_Hidden('codigo_telefone');
			$codigo->setAttrib('class', 'grid');
            $this->addElement($codigo);
            $titulo = new Zend_Form_Element_Text("ddd");
            $titulo->setLabel("DDD:")
                     ->addFilter("StripTags")
                     ->addFilter("StringTrim")
                     ->addValidator("notEmpty")
                     ->setAttrib('required', 'required')
                     ->setAttrib('id','ddd')
                     ->setAttrib('class','grid-ddd')
					 ->setAttrib('class','grid')
                     ->addDecorator('fieldset')
                     ->removeDecorator('HTMLTag',array('tag'=>'dt'));
               $this->addElement($titulo); 
               $telefone = new Zend_Form_Element_Text("telefone");
               $telefone->setLabel("Telefone:")
                     ->addFilter("StripTags")
                     ->addFilter("StringTrim")
                     ->addValidator("notEmpty")
                     ->setAttrib('required', 'required')
                     ->setAttrib('id','tel')
                     ->setAttrib('class','grid-tel')
					 ->setAttrib('class','grid')
                     ->addDecorator('fieldset')
                     ->removeDecorator('HTMLTag',array('tag'=>'dt'));
               $this->addElement($telefone); 
               $mapper = new Application_Model_TipoTelefone();
               $categoria = new Zend_Form_Element_Select('codigo_tipo_telefone');
               $categoria->setLabel('Tipo do Telefone:')->addDecorator('fieldset');
			   $categoria->setAttrib('class', 'grid');
               $categories = $mapper->fetchAll();
               foreach($categories as $row1)
               {
                 $categoria->addMultiOption($row1['codigo'],$row1['titulo']);
               }
               $this->addElement($categoria);
               
        
    }
    }
?>


