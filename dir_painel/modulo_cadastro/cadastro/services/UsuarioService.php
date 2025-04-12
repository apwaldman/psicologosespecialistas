<?php
require_once __DIR__ . '/../entities/Usuario.php';
require_once __DIR__ . '/../repositories/UsuarioRepository.php';
require_once __DIR__ . '/../utils/EmailService.php';
require_once __DIR__ . '/../exceptions/ValidationException.php';
require_once __DIR__ . '/../exceptions/BusinessException.php';
require_once __DIR__ . '/../exceptions/PersistenceException.php';

class UsuarioService {
    private $repository;
    private $emailService;

    public function __construct(UsuarioRepository $repository = null, EmailService $emailService = null) {
        $this->repository = $repository ?? new UsuarioRepository();
        $this->emailService = $emailService ?? new EmailService();
    }

    public function cadastrarUsuario(array $dados) {
        // Cria entidade
        $usuario = Usuario::fromArray($dados);
        
        // Validações
        $erros = $usuario->validarCampos();
        if (!empty($erros)) {
            throw new ValidationException($erros);
        }
        
        // Verifica se já existe
        $existente = $this->repository->buscarPorCpfOuEmail(
            $usuario->getCpf(), 
            $usuario->getEmail()
        );
        
        if ($existente) {
            throw new BusinessException("Já existe um usuário com este CPF ou e-mail");
        }
        
        // Persiste
        $resultado = $this->repository->salvar($usuario);
        if (!$resultado) {
            throw new PersistenceException("Erro ao salvar usuário no banco de dados");
        }
        
        try {
            $this->emailService->enviarEmailConfirmacao($usuario);
        } catch (Exception $e) {
            // Loga o erro mas não interrompe o fluxo
            error_log("Erro ao enviar email: " . $e->getMessage());
        }
        
        return $usuario;
    }
}
?>