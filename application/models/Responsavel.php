<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Responsavel
 *
 * @author Paulo
 */
class Application_Model_Responsavel extends Application_Model_Pessoa{
    
    protected $_dbTable;

    function __construct(){
        $this->_dbTable = new Application_Model_DbTable_Responsavel();
    }
   public function setDados(array $dados){
        $this->_dados['responsavel']['pessoal']['nome'] = $dados['nome'];
        $this->_dados['responsavel']['pessoal']['grau_parentesco'] =  $dados['grau_parentesco'];
        $this->_dados['responsavel']['pessoal']['rg'] =   $dados['rg_responsavel'];
        $this->_dados['responsavel']['pessoal']['cpf'] =  $dados['cpf_responsavel'];
    }
    public function setTelefone(array $telefone_responsavel){
        $this->_dados['responsavel']['telefone']['ddd'] = $telefone_responsavel['ddd_telefone_responsavel'];
        $this->_dados['responsavel']['telefone']['telefone'] = $telefone_responsavel['telefone_responsavel'];
        $this->_dados['responsavel']['telefone']['tipo_telefone'] = $telefone_responsavel['tipo_telefone_responsavel'];
    }
    public function _insert(array $data){
        return $this->_dbTable->insert($data);
    }
    public function _update(array $data){
        return $this->_dbTable->update($data);
    }


}

?>
