<?php
class TM_Form_RecuperarSenha extends Zend_Form {
    
    public function init()
    {
        $this->setName('fCadastro');
        $url = new Zend_View_Helper_Url();
            $this->setAction($url->url(array('controller'=> 'user','action'=>'recupera'),'default'));        
            $this->setName('recSenha');
            $this->setAttrib('onsubmit', 'return false');
            $this->setAttrib('class','formee');
            $this->setDecorators(array('FormElements',
            array('HtmlTag',array('tag'=>'div','id'=>'form')),'Form'));
		
            $usuario = new Zend_Form_Element_Text("login");
            $usuario->setLabel("Usuario:")
                 ->addFilter("StripTags")
                 ->addFilter("StringTrim")
                 ->addValidator("notEmpty")
                 ->setAttrib('required', 'required')
                 ->setAttrib('class','required')
                 ->setAttrib('style','width:100%;');
           $this->addElement($usuario);
           
            $senha = new Zend_Form_Element_Password("senha");
            $senha->setLabel("Senha:")
                 ->addFilter("StripTags")
                 ->addFilter("StringTrim")
                 ->addValidator("notEmpty")
                 ->setAttrib('required', 'required')
                 ->setAttrib('class','required')
                 ->setAttrib('style','width:100%;');
           $this->addElement($senha);
           
           $confirmaSenha = new Zend_Form_Element_Password("confirma-senha");
           $confirmaSenha->setLabel("Confirma Senha:")
                 ->addFilter("StripTags")
                 ->addFilter("StringTrim")
                 ->addValidator("notEmpty")
                 ->setAttrib('required', 'required')
                 ->setAttrib('class','required')
                 ->setAttrib('style','width:100%;');
           $this->addElement($confirmaSenha);
           $button = new Zend_Form_Element_Button("Salvar");
           $this->addElement($button);

    }
}

?>
