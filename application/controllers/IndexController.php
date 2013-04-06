<?php

class IndexController extends TM_Controller_Action
{
    public function init()
    {
        $session = new Zend_Session_Namespace('usuario');
        
        $uri = $this->_request->getPathInfo();
        $activeNav = $this->view->navigation()->findByUri($uri);
        @$activeNav->active = true;
    }
    public function indexAction()
    {
      $session = new Zend_Session_Namespace('usuario');
      $this->view->session = $session;
       
       
   
    }
    public function menuAction()
    {
        
    }
    public function headerAction()
    {
        
    }
    public function tabsAction()
    {
       
    }
    public function tabVendasAction()
    {
        
    }
    public function editInfoAction()
    {
        
    }
 }

