<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        $session = new Zend_Session_Namespace('usuario');
        if(!isset($session->usuario))
        {
            return $this->_helper->redirector->goToRoute(array('module'=>'default','controller'=>'index','action'=>'index'),null,true);
        }
    }

    public function indexAction()
    {
        
        $form = new TM_Form_User;
        $this->view->form = $form;
        
        $recuperaSenha = new TM_Form_RecuperarSenha();
        $this->view->formRecuperaSenha = $recuperaSenha;
        
        $model = new Application_Model_User();        
        $pagina = intval($this->_getParam('pagina',1));
        $produtos = Zend_Paginator::factory($model->front_dados());
        $produtos->setItemCountPerPage(2);
        $produtos->setPageRange(10);
        $produtos->setCurrentPageNumber($pagina);
        $this->view->assign('produtos',$produtos);
        $url = new Zend_View_Helper_Url();

        $form_search = new TM_Form_Search;
        $form_search->setAction($url->url(array('controller'=>'user','action'=>'search','module'=>'dashboard'),null,true));
	$pagina = $this->_request->getParam('pagina');	
        $this->view->search = $form_search;
        if($this->_request->isXmlHttpRequest())
        {
           
           $this->_helper->getHelper('layout')->disableLayout();
           $this->_helper->viewRenderer('grid','html');
        }
        $this->view->permissao = new Application_Model_Permissao();
    }
    public function gridAction()
    {
        
    }
    public function editAction()
    {
        $this->_helper->getHelper('layout')->disableLayout();  
        $this->_helper->viewRenderer->setNoRender(true);
        if($this->_request->isPost()){
            $data = $this->_request->getPost();
            $model = new Application_Model_User();
            $find = $model->find($data['id']);
            foreach($find as $key => $data)
            {
                if($key != "codigo_barras" && $key != "codigo_status" )
                {
                    $vCampos[] = $key;
                    $vDados[] =  $data;
                }
            }
            $campos = implode("»",$vCampos);
            $dados = implode("»",$vDados);
            echo "<script>fnPreencheCampos('$dados','".$campos."');</script>";
       }
    }
    public function inativarAction()
    {
        $this->_helper->getHelper('layout')->disableLayout();  
        $this->_helper->viewRenderer->setNoRender(true);
        if($this->_request->isPost())
        {
            $data = $this->_request->getPost();
            $model = new Application_Model_User();
            $model->inativa($data['id']);
            echo "<script>$('tr#".$data['id']."').fadeOut();</script>";
        }
    }
    public function saveAction()
    {
        $this->_helper->getHelper('layout')->disableLayout();  
        //$this->_helper->viewRenderer->setNoRender(true);
        if($this->_request->isPost()){
          $data = $this->_request->getPost();
          $model = new Application_Model_User();
          $codigo = "";
          if(isset($data['codigo']))
          {
              $codigo = base64_decode($data['codigo']);
          }else{
              $codigo = NULL;
          }
          if($model->salvar(new Application_Model_User($codigo,base64_decode($data['nome']),base64_decode($data['login']),
                                                       base64_decode($data['codigo_permissao']),base64_decode(utf8_encode($data['email'])),1))){
              $this->view->error = false;
              $this->view->msg = "<h4 class='alert_success'>Ação executada com sucesso!</h4>";
          }else{
              $this->view->error = true;
              $this->view->msg = "Erro";
          }
       }
  }
    public function searchAction()
    {
       $this->view->permissao = new Application_Model_Permissao();

         
         if($this->_request->isPost())
         {
          $data = $this->_request->getPost();
          
          $model = new Application_Model_User();
		  
          $this->view->search = $model->search('nome','email',$data['key']);
          if($this->_request->isXmlHttpRequest())
          {
              $this->_helper->getHelper('layout')->disableLayout();  
              $this->_helper->viewRenderer('search','html');
          }
      	}
    }
    public function relatorioAction()
    {
                        
        $relatorio1 = new TM_Form_RelatorioProdutos;
        $this->view->formRelatorio = $relatorio1;
        $relatorio = new TM_Report_Report();

        if($this->_request->isPost()){

            $this->_helper->getHelper('layout')->disableLayout();  
            $this->_helper->viewRenderer->setNoRender(true);

                $data = $this->_request->getPost();
                $object = new Application_Model_Produto;
                $filtros = array(
                        'nome'                  => $data['nome'],
                        'codigo_tipo' 	        => $data['codigo_tipo'],
                        'codigo_genero'         => $data['codigo_genero'],
                        'codigo_tamanho'  	=> $data['codigo_tamanho']
                );
                $date = date('d/m/Y');
                $properties = array(
                    'author' => 'Tom Modas Fardamentos',
                    'title'  => 'Relatorio de Produtos',
                    'subject' => 'Relatorio de Produtos',
                    'description' => 'Relatorio de produtos' . $date,
                    'category'  => 'Relatorios'
                );
                $relatorio->setProp($properties);
                $relatorio->setCol("Código de Barras");
                $relatorio->setCol("Nome");
                $relatorio->setCol("Categoria");
                $relatorio->setCol("Quantidade");
                $relatorio->setCol("Tipo do Produto");
                $relatorio->setCol("Preço");
                $relatorio->setCol("Gênero do Produto");
                $relatorio->setCol("Tamanho");

                $mapper_categoria = new Application_Model_Categoria;
                $mapper_tipo = new Application_Model_TipoProduto;
                $mapper_genero = new Application_Model_Genero;
                $mapper_tamanho = new Application_Model_Tamanho;

                foreach($object->returnReportData($filtros) as $value)
                {       

                    $categoria = $mapper_categoria->find($value['codigo_categoria']);
                    $tipo = $mapper_tipo->find($value['codigo_tipo']);
                    $genero = $mapper_genero->find($value['codigo_genero']);
                    $tamanho = $mapper_tamanho->find($value['codigo_tamanho']);

                    $nome = $value['nome'];
                    $codigo_barras = $value['codigo_barras'];
                    $categoria_produto = $categoria->titulo;
                    $tipo_produto = $tipo->titulo;
                    $genero_produto = $genero->titulo;
                    $tamanho_produto = $tamanho->titulo;
                    $preco = $value['preco'];
                    $qtd = $value['qtd'];

                    $relatorio->setRow($codigo_barras);
                    $relatorio->setRow($nome);
                    $relatorio->setRow($categoria_produto);
                    $relatorio->setRow($qtd);
                    $relatorio->setRow($tipo_produto);
                    $relatorio->setRow($preco);
                    $relatorio->setRow($genero_produto);
                    $relatorio->setRow($tamanho_produto);
                }
                    $save = new TM_Report_Report();
                    $relatorio->setContent();
                    $save->saveReport($relatorio);
                }
            }
    public function recuperaAction()
    {
        if($this->_request->isXmlHttpRequest())
        {
            $this->_helper->getHelper('layout')->disableLayout();  
            $this->_helper->viewRenderer->setNoRender(true);
            
        }
        if($this->_request->isPost())
        {
            $data = $this->_request->getPost();
            if($data['senha'] == $data['confirmasenha'])
            {
                $data['senha'] = md5($data['senha']) . md5('PlAnDiGiTaL');
                $data['confirmasenha'] = md5($data['senha']) . md5('PlAnDiGiTaL');
                $usuario = new Application_Model_User();
                //var_dump($data);exit;
                $dados = array(
                    'login' => $data['login'],
                    'senha' => $data['senha'],
                );
                $this->view->atualiza = $usuario->_update($dados);
                $this->view->msg = "<h4 class='alert_success'>Ação executada com sucesso!</div>";
            }else{
                $this->view->msgError = "<h4 class='alert_success'>Falha ao atualizar a senha. Tente Novamente!</div>";
            }
        }
    }
}

