<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initPlugins()
    {
        $boostrap = $this->getApplication();
        if($boostrap instanceof Zend_Application)
        {
            $boostrap = $this;
        }
        $boostrap->bootstrap("FrontController");
        $front = $boostrap->getResource("FrontController");
        $front->registerPlugin(new TM_Plugins_Layout());
    }
   public function _initAutoLoader()
   {
       $autoloader = Zend_Loader_Autoloader::getInstance();
       $autoloader->registerNamespace('TM');
       return $autoloader;
       
   }
   public function _initViews()
   {
       $this->bootstrap('view');
       $view = $this->getResource('view');
       $view->doctype('HTML5');
       $view->headTitle('SGE - Sistema de Gerenciamento Educacional')->setSeparator('|');
       $view->headMeta()->appendHttpEquiv('Content-type','text/html;charset=UTF-8');
       $session = new Zend_Session_Namespace('usuario');
        $this->view->usuario = $session->usuario;
        $this->view->logado = $session->logado;

       Zend_Registry::set('view',$view);
   }
   public function _initPaginator()
   {

       Zend_Paginator::setDefaultScrollingStyle('Sliding');
       Zend_View_Helper_PaginationControl::setDefaultViewPartial('paginacao.ajax.phtml');

   }
   public function _initJquery()
   {
       
        $this->bootstrap('view');
        $view = $this->getResource('view'); //get the view object      
        $viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
        $view->addHelperPath('ZendX/JQuery/View/Helper','ZendX_JQuery_View_Helper');
        $view->jQuery()
            ->setVersion('1.8.2')
            ->addStylesheet('https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/themes/black-tie/jquery-ui.css')
            ->setUiVersion('1.9.1')
            ->enable()
            ->uiEnable();
   }
   

}

