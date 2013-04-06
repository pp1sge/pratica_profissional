<?php

class Application_Model_Pessoa extends Application_Model_Abstract{
    
    protected $_db;
	protected $_dados = array();
    protected $_endereco;
    protected $_telefone;
    
    function __construct(){
      $this->_telefone = new Application_Model_Telefone();
      $this->_endereco = new Application_Model_Endereco();
      $this->_db = new Application_Model_DbTable_Pessoa();
    }
    public function getDados($tipo_pessoa,$sessao){
        return $this->_dados[$tipo_pessoa][$sessao];
    }
    abstract function setTelefone(array $telefone);
    abstract function setDados(array $dados);
    
    
}

?>
