<?php

class TM_Form_Categoria extends Zend_Form
{
        public function init()
        {
            $this->setName('fCadastro');
            $url = new Zend_View_Helper_Url();
            $this->setAction($url->url(array('controller'=> 'categoria','action'=>'save','module'=>'dashboard')));        
            $this->addDecorators(array('FormElements',
                array('HtmlTag',array('tag'=>'div','class'=>'form')),'Form'));
            $this->setAttrib('onSubmit','return false');
            $codigo = new Zend_Form_Element_Hidden('codigo');
            $this->addElement($codigo);
            $titulo = new Zend_Form_Element_Text("titulo");
            $titulo->setLabel("Titulo:")
                     ->addFilter("StripTags")
                     ->addFilter("StringTrim")
                     ->addValidator("notEmpty")
                     ->setAttrib('required', 'required')
                     ->setAttrib('id','nmprod')
                     ->setAttrib('class','grid')
                     ->addDecorator('fieldset')
                     ->removeDecorator('HtmlTag',array('tag'=>'dt'));
               $this->addElement($titulo);     
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
