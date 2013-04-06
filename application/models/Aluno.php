<?php
/**
 * Classe Aluno
 * Classe que lida com os dados de aluno como dados pessoais, endereco e questionario socioeconomico
 * 
 * @package Application_Model
 * @author Paulo Ricardo Rangel da Silveira Monteiro
 */

class Application_Model_Aluno extends Application_Model_Pessoa {
   
    protected $_dbTable;
    protected $_socioEconomico;
    protected $_responsavel;
    protected $_serie;
    protected $_turma;
    protected $_escola;

    function __construct(){
        $this->_dbTable = new Application_Model_DbTable_Aluno();
        $this->_socioEconomico = new Application_Model_SocioEconomico();
        $this->_responsavel = new Application_Model_Responsavel();
        $this->_serie = new Application_Model_Serie();
        $this->_turma = new Application_Model_Turma();
        $this->_escola = new Application_Model_Escola();
        $this->_dbTable = new Application_Model_DbTable_Aluno();
    }
    public function setDados(array $dados_aluno){
        $this->_dados['aluno']['pessoal']['nome'] = $dados_aluno['nome'];
        $this->_dados['aluno']['pessoal']['cpf'] = $dados_aluno['cpf'];
        $this->_dados['aluno']['pessoal']['data_nascimento'] = $dados_aluno['data_nascimento'];
        $this->_dados['aluno']['pessoal']['nome_responsavel'] = $dados_aluno['nome_responsavel'];
        $this->_dados['aluno']['pessoal']['parentesco_responsavel'] = $dados_aluno['parentesco_responsavel'];
	    $this->_dados['aluno']['pessoal']['escola'] = $dados_aluno['escola'];
        $this->_dados['aluno']['pessoal']['turma'] =  $dados_aluno['turma'];
	    $this->_dados['aluno']['pessoal']['serie'] =  $dados_aluno['serie'];
                
    }
    public function setTelefone(array $telefone){
        $this->_dados['aluno']['telefone']['ddd'] = $telefone_aluno['ddd_telefone_aluno'];
        $this->_dados['aluno']['telefone']['telefone'] = $telefone_aluno['telefone_aluno'];
        $this->_dados['aluno']['telefone']['tipo_telefone'] = $telefone_aluno['tipo_telefone_aluno'];
    }
    public function setEndereco(array $endereco){
    	$this->_dados['aluno']['endereco']['cep'] = $endereco_aluno['cep'];
    	$this->_dados['aluno']['endereco']['rua'] = $endereco_aluno['rua'];
    	$this->_dados['aluno']['endereco']['complemento'] = $endereco_aluno['complemento'];
    	$this->_dados['aluno']['endereco']['numero'] = $endereco_aluno['numero'];
    	$this->_dados['aluno']['endereco']['bairro'] = $endereco_aluno['bairro'];
    	$this->_dados['aluno']['endereco']['cidade'] = $endereco_aluno['cidade'];
    	$this->_dados['aluno']['endereco']['estado'] = $endereco_aluno['estado'];
    }
    public function setSocioEconomico(array $pesquisa){
    	$this->_dados['aluno']['pesquisa']['pessoas_familia'] = $pesquisa['pessoas_familia'];
    	$this->_dados['aluno']['pesquisa']['residencia_familiar'] = $pesquisa['residencia_familiar'];
    	$this->_dados['aluno']['pesquisa']['pessoas_empregadas'] = $pesquisa['pessoas_empregadas'];
    	$this->_dados['aluno']['pesquisa']['renda_familiar'] = $pesquisa['renda_familiar'];
    	$this->_dados['aluno']['pesquisa']['estado_civil'] = $pesquisa['estado_civil'];
    	$this->_dados['aluno']['pesquisa']['alcoolismo'] = $pesquisa['alcoolismo'];
    }
    public function _insert(array $data){
        return $this->_dbTable->insert($data);
    }
    public function _update(array $data){
        return $this->_dbTable->update($data);
    }
    public function geraMatricula(){
    	list($ano,$mes,$dia) = date('Y-m-d');
    	
    	//Dois últimos digitos do ano.
    	$ano = substr($ano,2,2);
    	$mes = substr($mes,1,1);
    	$dia = substr($dia,1,1);
    	
    	$matricula = $ano . $dia . $mes;
    	return $matricula;
    }
}

?>
