<?php
require_once __DIR__ . '/../services/UsuarioService.php';
require_once __DIR__ . '/../exceptions/ValidationException.php';
require_once __DIR__ . '/../exceptions/BusinessException.php';
require_once __DIR__ . '/../exceptions/PersistenceException.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $service = new UsuarioService();
        
        // Verifica se é psicólogo
        $isPsicologo = isset($_POST['psicologo']) && $_POST['psicologo'] == '1';
        
        // Validação condicional dos campos
        if ($isPsicologo) {
            // Valida CRP para psicólogos
            if (empty($_POST['crp'])) {
                throw new ValidationException(['crp' => 'CRP é obrigatório para psicólogos']);
            }
            
            if (!validarCRP($_POST['crp'])) {
                throw new ValidationException(['crp' => 'CRP inválido']);
            }
            
            // Remove profissão se for psicólogo
            unset($_POST['profissao']);
        } else {
            // Valida profissão para não psicólogos
            if (empty($_POST['profissao'])) {
                throw new ValidationException(['profissao' => 'Profissão é obrigatória']);
            }
            
            // Remove CRP se não for psicólogo
            unset($_POST['crp']);
        }
        
        // Limpa e formata dados
        $dados = [
            'nome_completo' => $_POST['nome_completo'] ?? '',
            'psicologo' => $isPsicologo,
            'crp' => $isPsicologo ? ($_POST['crp'] ?? '') : null,
            'data_nascimento' => $_POST['data_nascimento'] ?? '',
            'idade' => $_POST['idade'] ?? 0,            
            'cpf' => preg_replace('/[^0-9]/', '', $_POST['cpf'] ?? ''),
            'celular' => preg_replace('/[^0-9]/', '', $_POST['celular'] ?? ''),
            'profissao' => !$isPsicologo ? ($_POST['profissao'] ?? '') : null,
            'email' => filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL),
            'cep' => $_POST['cep'] ?? '',
            'endereco' => $_POST['endereco'] ?? '',
            'numero' => $_POST['numero'] ?? '',
            'complemento' => $_POST['complemento'] ?? '',
            'bairro' => $_POST['bairro'] ?? '',
            'cidade' => $_POST['cidade'] ?? '',
            'estado' => $_POST['estado'] ?? '',
            'estado_civil' => $_POST['estado_civil'] ?? '',
            'naturalidade' => $_POST['naturalidade'] ?? '',
            'escolaridade' => $_POST['escolaridade'] ?? '',
            'senha' => $_POST['senha'] ?? '',
            'confirmacao_senha' => $_POST['confirmacao_senha'] ?? '',
            'autoriza_uso_em_pesquisa' => $_POST['autoriza_uso_em_pesquisa'] ?? false
        ];
        
        // Validação de senha (pode ser movida para o service se preferir)
        if ($_POST['senha'] !== $_POST['confirmacao_senha']) {
            throw new BusinessException("As senhas não coincidem");
        }
        
        $usuario = $service->cadastrarUsuario($dados);
        
        $_SESSION['sucesso'] = "Cadastro realizado com sucesso! Um e-mail de confirmação foi enviado.";
        
    } catch (ValidationException $e) {
        // Armazena cada erro no campo correspondente
        foreach ($e->getErrors() as $campo => $erro) {
            $_SESSION['erro_' . $campo] = $erro;
        }
        // Mantém os dados submetidos para repopular o formulário
        $_SESSION['dados_formulario'] = $_POST;
        
    } catch (BusinessException $e) {
        $_SESSION['erro_geral'] = $e->getMessage();
        $_SESSION['dados_formulario'] = $_POST;
        
    } catch (PersistenceException $e) {
        $_SESSION['erro_geral'] = "Erro no sistema. Por favor, tente novamente mais tarde.";
        error_log("PersistenceException: " . $e->getMessage());
        
    } catch (Exception $e) {
        $_SESSION['erro_geral'] = "Ocorreu um erro inesperado";
        error_log("Exception: " . $e->getMessage());
    }
    
    header('Location: https://painel.psicologosespecialistas.com.br/cadastro.php');
    exit();
}

function validarCRP($crp) {
    // Remove caracteres não numéricos
    $crp = preg_replace('/[^0-9]/', '', $crp);
    
    // Verifica se tem o formato básico (pode ajustar conforme suas regras)
    if (strlen($crp) < 5) {
        return false;
    }
    
    return true;
}
?>