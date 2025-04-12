<?php
require_once __DIR__ . '/../entities/Usuario.php';
require_once __DIR__ . '/../../../modulo_conexao/conexao.php';

class UsuarioRepository {
    private $conn;

    public function __construct() {
        $conexao = new Conexao();
        $this->conn = $conexao->getConnection();
    }

    public function salvar(Usuario $usuario) {
        $sql = "INSERT INTO usuarios (...) VALUES (...)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome_completo', $usuario->getNomeCompleto());
        $stmt->bindParam(':psicologo', $usuario->getPsicologo());
        $stmt->bindParam(':crp', $usuario->getCrp());
        $stmt->bindParam(':data_nascimento', $usuario->getDataNascimento());
        $stmt->bindParam(':idade', $usuario->getIdade());
        $stmt->bindParam(':cpf', $usuario->getCpf());
        $stmt->bindParam(':profissao', $usuario->getProfissao());
        $stmt->bindParam(':email', $usuario->getEmail());
        $stmt->bindParam(':celular', $usuario->getCelular());
        $stmt->bindParam(':cep', $usuario->getCep());
        $stmt->bindParam(':endereco', $usuario->getEndereco());
        $stmt->bindParam(':numero', $usuario->getNumero());
        $stmt->bindParam(':complemento', $usuario->getComplemento());
        $stmt->bindParam(':bairro', $usuario->getBairro());
        $stmt->bindParam(':cidade', $usuario->getCidade());
        $stmt->bindParam(':estado', $usuario->getEstado());
        $stmt->bindParam(':estado_civil', $usuario->getEstadoCivil());
        $stmt->bindParam(':naturalidade', $usuario->getNaturalidade());
        $stmt->bindParam(':escolaridade', $usuario->getEscolaridade());
        $stmt->bindParam(':senha', $usuario->getSenha());
        $stmt->bindParam(':autoriza_uso_em_pesquisa', $usuario->getAutorizaUsoEmPesquisa());
        $stmt->bindParam(':data_cadastro', $usuario->getDataCadastro());
        $stmt->bindParam(':admin', $usuario->getAdmin());
        $stmt->bindParam(':ativo', $usuario->getAtivo());
        return $stmt->execute();                
    }

    public function buscarPorCpfOuEmail($cpf, $email) {
        if (!empty($cpf)) {
            $cpf = preg_replace('/[^0-9]/', '', $cpf); // Remove caracteres não numéricos            
        }
        $sql = "SELECT * FROM usuarios WHERE cpf = :cpf OR email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':email', $email);
        $stmt->execute();        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorCpf($cpf) {
        if (!empty($cpf)) {
            $cpf = preg_replace('/[^0-9]/', '', $cpf); // Remove caracteres não numéricos            
        }
        $sql = "SELECT * FROM usuarios WHERE cpf = :cpf";       
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->conn->prepare($sql); 
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>