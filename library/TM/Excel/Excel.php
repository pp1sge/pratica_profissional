<?php

class Excel_Excel {
    
    protected $_excel;
    
    public function init(){
        Zend_Loader::loadFile('PHPExcel/PHPExcel.php');
    }
    
    /**
     * Retorna o Objeto Excel.
     * @return type
     */
    
    public function getExcel()
    {
        $this->_excel = new PHPExcel();
        return $this->_excel;
    }
    
    /**
     * Seta as propriedades da planilha
     * @param array $data
     * 
     */
    
    public function setProperties(array $data)
    {
        foreach($data as $key){
        
           $this->_excel->getProperties()->setCreator($key['creator'])
                   ->setTitle($data['title'])
                   ->setSubject($data['subject'])
                   ->setDescription($data['description'])
                   ->setCategory($data['category']);
        }       
    }
    
    /**
     * Seta o cabeçalho da planilha
     * @param array $data
     * @throws Exception
     */
    
    public function setCells(array $data)
    {
        foreach($data as $key => $value)
        {
            $chave = substr($key,1,1);
            $chave_2 = substr($key,0,1);
            if(!is_string($chave_2)){
                throw new Exception("O primeiro caracter deve ser de A a Z");
            }else if($chave != 1){
                throw new Exception("Somente valores acima de 1");
            }else{
                $this->_excel->setActiveSheet(0)->setCellValue($key,$value);
            }
            
        }
    }
    /**
     * Seta os valores das colunas da planilha Excel. 
     *  
     * @param array $data
     * @throws Exception
     */
    public function setRows(array $data)
    {
        foreach($data as $key => $value)
        {
            $chave = substr($key,1,1);
            $chave_2 = substr($key,0,1);
            if(!is_string($chave_2)){
                throw new Exception("O primeiro caracter deve ser de A a Z");
            }else if($chave == 1){
                throw new Exception("Somente 1 é aceito");
            }else{
                $this->_excel->setActiveSheet(0)->setCellValue($key,$value);
            }
            
        }
    }
    public function 
}

?>
