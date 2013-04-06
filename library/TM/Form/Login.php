<?php

    class TM_Form_Login extends Zend_Form
    {
        public function init()
        {
           $this->setName('form-login');
           $this->setAttrib('class','formee');
           $login = new Zend_Form_Element_Text("login");
           $login->setLabel("Login:")
                 ->addFilter("StripTags")
                 ->addFilter("StringTrim")
                 ->addValidator("notEmpty")
                 ->setAttrib('required', 'required')
                 ->setAttrib('class','required')
                 ->setAttrib('style', 'float:left;');
           $this->addElement($login);
           $senha = new Zend_Form_Element_Password("senha");
           $senha->setLabel("Senha:")
                 ->addFilter("StripTags")
                 ->addFilter("StringTrim")
                 ->addValidator("notEmpty")
                 ->setAttrib('required', 'required')
                 ->setAttrib('class','required');
           $this->addElement($senha);
           $button = new Zend_Form_Element_Submit("Entrar");
           $this->addElement($button);
        }
    }

?>

