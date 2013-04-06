<?php

abstract class Application_Model_Abstract {
    
    protected $_codigo;
    protected $_codigo_status;
    protected $_dbTable;

    /**
     * Sao todos metodos do zend db table.
     * @param type $id
     * @return type
     */
    public function find($id)
    {
        return $this->_dbTable->find($id)->current();
    }
      public function setCodigo($codigo)
    {
        $this->_codigo = $codigo;
    } 
    public function getCodigo()
    {
        return $this->_codigo;
    }
    
    public function setCodigoStatus($codigo_status){
        $this->_codigo_status = $codigo_status;
    }
    public function getCodigoStatus()
    {
        return $this->_codigo_status;
    }
    public function delete($id)
    {
        return $this->_dbTable->delete(array('codigo'=>$id));
    }
    public function save(array $data)
    {
        if(isset($data['codigo'])){
            return $this->_update($data);
        }else{
            return $this->_insert($data);
        }
    }
    abstract public function _insert(array $data);
    abstract public function _update(array $data);
    //abstract public function front_dados();
    
    public function fetchAll()
    {
        return $this->_dbTable->fetchAll();
    }
    public function inativa($id)
    {
        $db = $this->_dbTable->getAdapter();
        $where = $db->quoteInto('codigo=?',$id);
        $data['codigo_status'] = 2;
        return $this->_dbTable->update(array('codigo_status' => 2),$where);
    }
    public function filter_date($data)
    {
        $dia = substr($data,0,2);
        $mes = substr($data,3,2);
        $ano = substr($data,6,4);

        $final_date = $ano . "-" . $mes . "-" . $dia;
        return $final_date;
    }
    public function show_date($data)
    {
        $ano = substr($data,0,4);
        $mes = substr($data,5,2);
        $dia = substr($data,8,4);

        $final_date = $dia . "/" . $mes . "/" . $ano;
        return $final_date;
    }
    public function setDataNasc($data_nascimento)
    {
        $this->_data_de_nascimento = $this->filter_date($data_nascimento);
    }
    public function getDataNasc()
    {
        return $this->_data_de_nascimento;
    }
    public function search($data,$status = TRUE)
    {
        $select = $this->_dbTable->select();
        foreach($data as $key => $value){
            if(!empty($value)){
            if($key == "nome" || $key == "titulo"){
                    $select->orWhere($key . " LIKE  ?","%" .  $value. "%");
                }
                if($key != "nome" || $key != "titulo"){
                    $select->orWhere($key . " =  ? ",$value);
                }
            }
        }
        if($status == true){
            $select->where('codigo_status = ?',1);
        }
        $row = $this->_dbTable->fetchAll($select);
       // var_dump("$select");var_dump(count($row));exit;
        if(sizeof($row) == 0)
        {
            echo "Nenhum resultado encontrado";
        }
        
        return $row;
    }
}
?>
