<?php

class Application_Model_User extends Application_Model_Abstract
{
    private $_nome;
    private $_email;
    private $_login;
    private $_senha;
    private $_codigo_permissao;

    public function __construct($codigo = NULL,$nome = NULL,$login = NULL,$permissao = NULL,$email = NULL,$codigo_status = NULL)
    {
        $this->_nome = $nome;
        $this->_codigo = $codigo;
        $this->_login = $login;
        $this->_codigo_permissao = $permissao;
        $this->_codigo_status = $codigo_status;
        $this->_email = $email;
        $this->_dbTable = new Application_Model_DbTable_User;
    }
    public function getLogin()
    {
        return $this->_login;
    }
    public function getSenha()
    {
        return $this->_senha;
    }
    public function getPermissao()
    {
        return $this->_codigo_permissao;
    }
    public function getNome()
    {
        return $this->_nome;
    }
    public function getEmail()
    {
        return $this->_email;
    }        
         
    public function salvar(Application_Model_User $usuario) 
    {
        $data = array(
        'codigo' => $usuario->getCodigo(),
        'email' => $usuario->getEmail(),
        'nome' => $usuario->getNome(),
        'login' => $usuario->getLogin(),
        'codigo_permissao' => $usuario->getPermissao(),
        'codigo_status' => $usuario->getCodigoStatus()
        );
        
        if(!empty($data['codigo']))
        {
            if($this->_update($data) > 0)
            {
                return true;       
            }else{
                return sizeof($this->_update($data));
            }
            
        /*
         * Inserir aqui uma checagem se for mudanca de senha;
         */    
            
        }else{
            return $this->_insert($data);
        }
    }
    public function _insert(array $data)
    {
        return $this->_dbTable->insert($data);  
    }
    public function _update(array $data)
    {
       
       if(isset($data['codigo'])){
           
           return $this->_dbTable->update($data,array('codigo=?'=>$data['codigo']));
       }
       else if(isset($data['login']))
       {
         return $this->_dbTable->update($data,array('login=?'=>$data['login']));
       }
       else if(isset($data['email']))
       {
         return $this->_dbTable->update($data,array('email = ?'=>$data['email']));
       }
       
    }
    public function buscaPermissao()
    {
        $row = $this->_dbTable->fetchRow("login = '$this->_login'");
        $this->_codigo_permissao = $row->codigo_permissao;   
    }
    public function nome_permisso($codigo)
    {
        $row = $this->_dbTable->fetchRow("codigo_permissao = $codigo ");
        $permissao = $row->titulo;
        return $permissao;
    }
    public function find_email($email)
    {
        $db = $this->_dbTable->getDefaultAdapter();
        $where = $db->quoteInto('email = ?',$email);
        return $this->_dbTable->fetchAll($where);
    }
    public function front_dados()
    {
        $db = $this->_dbTable->getDefaultAdapter();
        $where = $db->quoteInto('codigo_status = ?',1);
        return $this->_dbTable->fetchAll($where);
        
    }
    
    
}

