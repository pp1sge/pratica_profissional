<?php

class TM_Form_Produto extends Zend_Form
{
    public function init()
    {
        $url = new Zend_View_Helper_Url();
        $this->setAction($url->url(array('controller'=> 'produto','action'=>'save'),'default'));        
        
        $this->setName('fCadastro');
		$this->setAttrib('class','formee');
        $this->setDecorators(array('FormElements',
            array('HtmlTag',array('tag'=>'div','id'=>'form')),'Form'));
		
        $this->setAttrib('onSubmit','return false');
        $codigo = new Zend_Form_Element_Hidden('codigo');
        $this->addElement($codigo);
        $nome = new Zend_Form_Element_Text("nome");
        $nome->setLabel("Nome:")
                 ->addFilter("StripTags")
                 ->addFilter("StringTrim")
                 ->addValidator("notEmpty")
                 ->setAttrib('required', 'required')
                 ->setAttrib('id','nmprod')
                 ->setAttrib('class','grid')
                 ->setAttrib('style', 'width:320px;  height:40px;')
                 ->removeDecorator('HtmlTag',array('tag'=>'dt'));
           $this->addElement($nome);
       $descricao = new Zend_Form_Element_Textarea('descricao');
       $descricao->setLabel('Descrição:');
       $descricao->addFilter("StripTags")
                 ->addFilter("StringTrim")
                 ->addValidator("notEmpty")
                 ->setAttrib('required', 'required')
                 ->setAttrib('id','desc')
                 ->setAttrib('class','required')
                 ->removeDecorator('HtmlTag',array('tag'=>'dt'));
       $this->addElement($descricao);
       $preco = new Zend_Form_Element_Text('preco');
       $preco->setLabel('Preço:')->addFilter("StripTags")
                 ->addFilter("StringTrim")
                 ->addValidator("notEmpty")
                 ->setAttrib('required', 'required')
                 ->setAttrib('id','preco')
                 ->setAttrib('class','required')
                 ->setAttrib('style', 'width:80px; height:40px;')
                 ->removeDecorator('HtmlTag',array('tag'=>'dt'));
       $this->addElement($preco);
       $qtd = new Zend_Form_Element_Text('qtd');
       $qtd->setLabel('Quantidade:')->addFilter("StripTags")
                 ->addFilter("StringTrim")
                 ->addValidator("notEmpty")
                 ->setAttrib('required', 'required')
                 ->setAttrib('id','qtd')
                 ->setAttrib('class','required')
                 ->setAttrib('style', 'width:80px;  height:40px;')
                 ->removeDecorator('HtmlTag',array('tag'=>'dt'));
       $this->addElement($qtd);
           $mapper = new Application_Model_Categoria();
           $categoria = new Zend_Form_Element_Select('codigo_categoria');
           $categoria->setLabel('Categoria:')->setAttrib('class', 'grid');
           $categories = $mapper->fetchAll();
           $categoria->addMultiOption('','====SELECIONE UMA CATEGORIA====');
           foreach($categories as $row1)
           {
             $categoria->addMultiOption($row1['codigo'],$row1['titulo']);
           }
           $this->addElement($categoria);
           
           $mapper_tipo = new Application_Model_TipoProduto;
           $tipo = new Zend_Form_Element_Select('codigo_tipo');
           $tipo->setLabel('Tipo do Produto')->setAttrib('class', 'grid');
		   $tipo->addMultiOption('','====SELECIONE UM TIPO DE PRODUTO====');
			
           foreach($mapper_tipo->fetchAll() as $row)
           {
               $tipo->addMultiOption($row['codigo'],$row['titulo']);
           }
           $this->addElement($tipo);
           
           $mapper_genero = new Application_Model_Genero;
           $genero = new Zend_Form_Element_Select('codigo_genero');
           $genero->setLabel('Gênero:')->setAttrib('class', 'grid');
		   $genero->addMultiOption('','====SELECIONE UM GÊNERO====');

           foreach($mapper_genero->fetchAll() as $row)
           {
               $genero->addMultiOption($row['codigo'],$row['titulo']);
           }
           
           $this->addElement($genero);
           
           $mapper_tamanho = new Application_Model_Tamanho;
           $tamanho = new Zend_Form_Element_Select('codigo_tamanho');
           $tamanho->setLabel('Tamanho:')->setAttrib('class', 'grid');
		   $tamanho->addMultiOption('','====SELECIONE UM TAMANHO====');
		
           foreach($mapper_tamanho->fetchAll() as $row)
           {
               $tamanho->addMultiOption($row['codigo'],$row['titulo']);
           }
           
           $this->addElement($tamanho);
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
