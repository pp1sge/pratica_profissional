<?php

    class TM_Plugins_Layout extends Zend_Controller_Plugin_Abstract 
    {
        public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request) {
            // Cria um objeto MVC ( Singleton )
            $layout = Zend_Layout::getMvcInstance();
            $layout->setLayout('layout')->setLayoutPath(APPLICATION_PATH . '/views/layouts');
            
        }
    }
?>
