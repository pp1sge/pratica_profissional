<?php


    class TM_Mail_Mail extends Zend_Mail{
        
        protected $_smtp;
        protected $_provider;
        protected $_config;
        protected $_email;
        protected $_to;
        protected $_for;
        protected $_subject;
        protected $_message;
        protected $_transport;
        
        function __construct($ssl,$email,$senha,$provider)
        {
            $this->_provider = $provider;
            $this->_smtp = "smtp." . $this->_provider;
            $this->_config['username'] = $email;
            $this->_config['password'] = $senha;
            $this->_config['ssl'] = $ssl;
            $this->_config['port'] = '465';
            $this->_config['auth'] = 'login';
            $this->_transport = new Zend_Mail_Transport_Smtp($this->_smtp,$this->_config);
            
        }
        public function set_emailTo($_to) {
            $this->_to = $_to;
            $this->addTo($this->_to);
        }
        public function set_emailFrom($_for) {
            $this->_for = $_for;
            $this->setFrom($this->_for);
        }
        public function set_subject($_subject) {
            $this->setSubject($_subject);
        }
        public function set_message($_message) {
            $this->_message = $_message;
            $this->setBodyHtml($this->_message);
        }   
        public function enviar()
        {
            return $this->send($this->_transport);
        }
   }
    
    
?>
