<?php
class Usuario {
    private $id;
    private $nome_completo;
    private $psicologo;
    private $crp;
    private $data_nascimento;
    private $idade;
    private $cpf;
    private $profissao;
    private $email;
    private $celular;
    private $cep;
    private $endereco;
    private $numero;
    private $complemento;
    private $bairro;
    private $cidade;
    private $estado;
    private $estado_civil;
    private $naturalidade;
    private $escolaridade;
    private $senha;
    private $data_cadastro;
    private $admin;
    private $autoriza_uso_em_pesquisa;
    private $ativo = 1;

   // Getters e Setters
   public function getId() { return $this->id; }
   public function setId($id) { $this->id = $id; return $this; }
   
   public function getNomeCompleto() { return $this->nome_completo; }
   public function setNomeCompleto($nome) { 
       $this->nome_completo = strip_tags(trim($nome)); 
       return $this;
   }

    public function getPsicologo() { return $this->psicologo; }
    public function setPsicologo($psicologo) { 
        $this->psicologo = strip_tags(trim($psicologo)); 
        return $this;
    }
    
    public function getCrp() { return $this->crp; }
    public function setCrp($crp) { 
        $this->crp = strip_tags(trim($crp)); 
        return $this;
    }

    public function getDataNascimento() { return $this->data_nascimento; }
    public function setDataNascimento($data_nascimento) { 
        $this->data_nascimento = strip_tags(trim($data_nascimento)); 
        return $this;
    }

    public function getIdade() { return $this->idade; }
    public function setIdade($idade) { 
        $this->idade = strip_tags(trim($idade)); 
        return $this;
    }

    public function getCpf() { return $this->cpf; }
    public function setCpf($cpf) { 
        $this->cpf = preg_replace('/[^0-9]/', '', strip_tags(trim($cpf))); 
        return $this;
    }
    
    public function getProfissao() { return $this->profissao; }
    public function setProfissao($profissao) { 
        $this->profissao = strip_tags(trim($profissao)); 
        return $this;
    }
    public function getEmail() { return $this->email; } 
    public function setEmail($email) { 
        $this->email = filter_var(strip_tags(trim($email)), FILTER_VALIDATE_EMAIL); 
        return $this;
    }
    public function getCelular() { return $this->celular; }
    public function setCelular($celular) { 
        $this->celular = preg_replace('/[^0-9]/', '', strip_tags(trim($celular))); 
        return $this;
    }    
    
    public function getCep() { return $this->cep; }
    public function setCep($cep) { 
        $this->cep = preg_replace('/[^0-9]/', '', strip_tags(trim($cep))); 
        return $this;
    }       

    public function getEndereco() { return $this->endereco; }
    public function setEndereco($endereco) { 
        $this->endereco = strip_tags(trim($endereco)); 
        return $this;
    }

    public function getNumero() { return $this->numero; }
    public function setNumero($numero) { 
        $this->numero = strip_tags(trim($numero)); 
        return $this;
    }

    public function getComplemento() { return $this->complemento; }
    public function setComplemento($complemento) { 
        $this->complemento = strip_tags(trim($complemento)); 
        return $this;
    }

    public function getBairro() { return $this->bairro; }
    public function setBairro($bairro) { 
        $this->bairro = strip_tags(trim($bairro)); 
        return $this;
    }
    public function getCidade() { return $this->cidade; }
    public function setCidade($cidade) { 
        $this->cidade = strip_tags(trim($cidade)); 
        return $this;
    }

    public function getEstado() { return $this->estado; }
    public function setEstado($estado) { 
        $this->estado = strip_tags(trim($estado)); 
        return $this;
    }
    public function getEstadoCivil() { return $this->estado_civil; }
    public function setEstadoCivil($estado_civil) { 
        $this->estado_civil = strip_tags(trim($estado_civil)); 
        return $this;
    }

    public function getNaturalidade() { return $this->naturalidade; }
    public function setNaturalidade($naturalidade) { 
        $this->naturalidade = strip_tags(trim($naturalidade)); 
        return $this;
    }
    public function getEscolaridade() { return $this->escolaridade; }
    public function setEscolaridade($escolaridade) { 
        $this->escolaridade = strip_tags(trim($escolaridade)); 
        return $this;
    }

    public function getSenha() { return $this->senha; }
    public function setSenha($senha) { 
        $this->senha = password_hash(strip_tags(trim($senha)), PASSWORD_BCRYPT); 
        return $this;
    }
    public function getDataCadastro() { return $this->data_cadastro; }
    public function setDataCadastro($data_cadastro) { 
        $this->data_cadastro = strip_tags(trim($data_cadastro)); 
        return $this;
    }

    public function getAdmin() { return $this->admin; }
    public function setAdmin($admin) { 
        $this->admin = strip_tags(trim($admin)); 
        return $this;
    }
    public function getAutorizaUsoEmPesquisa() { return $this->autoriza_uso_em_pesquisa; }
    public function setAutorizaUsoEmPesquisa($autoriza_uso_em_pesquisa) { 
        $this->autoriza_uso_em_pesquisa = strip_tags(trim($autoriza_uso_em_pesquisa)); 
        return $this;
    }

    public function getAtivo() { return $this->ativo; }
    public function setAtivo($ativo) { 
        $this->ativo = strip_tags(trim($ativo)); 
        return $this;
    }


    // Métodos de transformação
    public function toArray() {
        return get_object_vars($this);
    }
    
    public static function fromArray(array $dados) {
        $usuario = new self();
        foreach ($dados as $key => $value) {
            $setter = 'set' . str_replace('_', '', ucwords($key, '_'));
            if (method_exists($usuario, $setter)) {
                $usuario->$setter($value);
            }
        }
        return $usuario;
    }

    // Método para validar os campos obrigatórios
    public function validarCampos() {
        $camposObrigatorios = [
            'nome_completo' => $this->nome_completo,
            'psicologo' => $this->psicologo,
            'data_nascimento' => $this->data_nascimento,
            'cpf' => $this->cpf,
            'email' => $this->email,
            'celular' => $this->celular,
            'cep' => $this->cep,
            'endereco' => $this->endereco,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'estado' => $this->estado,
            'estado_civil' => $this->estado_civil,
            'escolaridade' => $this->escolaridade
        ];

        $erros = [];
        foreach ($camposObrigatorios as $campo => $valor) {
            if (empty($valor)) {
                $erros[$campo] = "O campo " . ucfirst(str_replace('_', ' ', $campo)) . " é obrigatório.";
            }
        }
        return $erros;
    }
}   
?>