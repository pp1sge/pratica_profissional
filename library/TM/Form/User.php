<?php

class TM_Form_User extends Zend_Form{
    
    public function init()
    {
            $url = new Zend_View_Helper_Url();
            $this->setAction($url->url(array('controller'=> 'user','action'=>'save'),'default'));        
            $this->setName('fCadastro');
            $this->setAttrib('class','formee');
            $this->setDecorators(array('FormElements',
            array('HtmlTag',array('tag'=>'div','id'=>'form')),'Form'));
		
            $this->setAttrib('onSubmit','return false');
            $codigo = new Zend_Form_Element_Hidden('codigo');
            $codigo->setAttrib('class', 'required');
            $this->addElement($codigo);
           $nomeUsuario = new Zend_Form_Element_Text("nome");
           $nomeUsuario->setLabel("Nome:")
                 ->addFilter("StripTags")
                 ->addFilter("StringTrim")
                 ->addValidator("notEmpty")
                 ->setAttrib('required', 'required')
                 ->setAttrib('class','required')
                 ->setAttrib('style','width:100%;');
           $this->addElement($nomeUsuario);
           
           $login = new Zend_Form_Element_Text("login");
           $login->setLabel("Login:")
                 ->addFilter("StripTags")
                 ->addFilter("StringTrim")
                 ->addValidator("notEmpty")
                 ->setAttrib('required', 'required')
                 ->setAttrib('class','required')
                 ->setAttrib('style','width:100%;');
           $this->addElement($login);
           
           $email = new Zend_Form_Element_Text("email");
           $email->setLabel("E-mail:")
                 ->addFilter("StripTags")
                 ->addFilter("StringTrim")
                 ->addValidator("notEmpty")
                 ->setAttrib('required', 'required')
                 ->setAttrib('class','required')
                 ->setAttrib('style','width:100%;');
           $this->addElement($email);
           
           $permissao = new Zend_Form_Element_Select('codigo_permissao');
           $mapper_permissao = new Application_Model_Permissao();
           $fetch  = $mapper_permissao->fetchAll();
           $permissao->setLabel('Permissão do Usuário:')->setAttrib('class', 'required');
           $permissao->addMultiOption("", "====SELECIONE UMA PERMISSÃO====");
           foreach($fetch as $value)
           {
               $permissao->addMultiOption($value['codigo'], $value['titulo']);
           }
           $this->addElement($permissao);
           
           $button = new Zend_Form_Element_Submit("Cadastrar");
           $this->addElement($button);
           $editaSenha = new Zend_Form_Element_Button("Senha");
           $this->addElement($editaSenha);

    }
}

?>
