<?php

class TM_Form_ForgotPass extends Zend_Form
{
    public function init()
    {
        $this->setName('form_forgot_pass');
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email:')
              ->addFilter("StripTags")
              ->addFilter("StringTrim")
              ->addValidator("notEmpty")
              ->setAttrib('title', 'Preencha com o e-mail de cadastro')
              ->setAttrib('class','required');
        $this->addElement($email);
        $button = new Zend_Form_Element_Button('Recuperar');
        $button->setAttrib('id','recuperar');
        $this->addElement($button);

    }
}
?>
