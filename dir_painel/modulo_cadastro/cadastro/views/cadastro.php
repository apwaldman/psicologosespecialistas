<?php
// Início seguro do script
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Recupera dados do formulário se existirem
$dadosFormulario = $_SESSION['dados_formulario'] ?? [];
unset($_SESSION['dados_formulario']);

// Verifica se a função já existe antes de declarar
if (!function_exists('getFlashMessage')) {
    /**
     * Recupera e remove uma mensagem flash da sessão
     * 
     * @param string $key Chave da mensagem
     * @return string|null A mensagem ou null se não existir
     */
    function getFlashMessage($key) {
        if (isset($_SESSION[$key])) {
            $message = $_SESSION[$key];
            unset($_SESSION[$key]);
            return $message;
        }
        return null;
    }
}
?>

<div class="container mt-5">
    <h2>Cadastro de Usuário</h2>
    <form action="https://painel.psicologosespecialistas.com.br/modulo_cadastro/cadastro/controllers/CadastroController.php" method="POST" novalidate>
        <div class="alert alert-danger d-none" id="errorMessages"></div>

        <!-- Nome Completo -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="nome_completo" class="form-label">Nome Completo:</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" id="nome_completo" name="nome_completo" required>
                <div class="error-message text-danger" id="erro_nome_completo"></div>                
            </div>
        </div>
        <!-- isPsicologo -->
        <div class="form-check mb-3">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="psicologo" id = "psicologo" value="1"> Marque essa opção se você pretende usar a plataforma como psicólogo(a).
            </label>
        </div>

        <!-- CRP -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="crp" class="form-label">CRP:</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" id="crp" name="crp" required>
                <div class="error-message text-danger" id="erro_crp"></div>
            </div>
        </div>
        <!-- Data de Nascimento -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
            </div>
            <div class="col-md-9">
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                <div class="error-message text-danger" id="erro_data_nascimento"></div>
            </div>
        </div>

        <!-- Idade -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="idade" class="form-label">Idade:</label>
            </div>
            <div class="col-md-9">
                <input type="number" class="form-control" id="idade" name="idade" readonly>
                <div class="error-message text-danger" id="error_idade"></div>
            </div>
        </div>

        <!-- CPF -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="cpf" class="form-label">CPF:</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" id="cpf" name="cpf" required>
                <div class="error-message text-danger" id="erro_cpf"></div>
            </div>
        </div>

        <!-- Profissão -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="profissao" class="form-label">Profissão:</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" id="profissao" name="profissao" required>
                <div class="error-message text-danger" id="erro_profissao"></div>
            </div>
        </div>

        <!-- E-mail -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="email" class="form-label">E-mail:</label>
            </div>
            <div class="col-md-9">
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="error-message text-danger" id="erro_email"></div>
            </div>
        </div>

        <!-- Celular -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="celular" class="form-label">Celular:</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" id="celular" name="celular" required>
                <div class="error-message text-danger" id="erro_celular"></div>
            </div>
        </div>

        <!-- CEP -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="cep" class="form-label">CEP:</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" id="cep" name="cep" required>
                <div class="error-message text-danger" id="erro_cep"></div>
            </div>
        </div>

        <!-- Endereço -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="endereco" class="form-label">Endereço:</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" id="endereco" name="endereco" required>
                <div class="error-message text-danger" id="erro_endereco"></div>
            </div>
        </div>

        <!-- Número -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="numero" class="form-label">Número:</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" id="numero" name="numero" required>
                <div class="error-message text-danger" id="erro_numero"></div>
            </div>
        </div>

        <!-- Complemento -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="complemento" class="form-label">Complemento:</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" id="complemento" name="complemento">               
            </div>
        </div>

        <!-- Bairro -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="bairro" class="form-label">Bairro:</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" id="bairro" name="bairro" required>
                <div class="error-message text-danger" id="erro_bairro"></div>
            </div>
        </div>

        <!-- Cidade -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="cidade" class="form-label">Cidade:</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" id="cidade" name="cidade" required>
                <div class="error-message text-danger" id="erro_cidade"></div>
            </div>
        </div>

        <!-- Estado -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="estado" class="form-label">Estado:</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" id="estado" name="estado" required>
                <div class="error-message text-danger" id="erro_estado"></div>
            </div>
        </div>

        <!-- Estado Civil -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="estado_civil" class="form-label">Estado Civil:</label>
            </div>
            <div class="col-md-9">
                <select class="form-control" id="estado_civil" name="estado_civil" required>
                    <option value="">Selecione</option>
                    <option value="Solteiro">Solteiro</option>
                    <option value="Casado">Casado</option>
                    <option value="União Estável">União Estável</option>
                    <option value="Divorciado">Divorciado</option>
                    <option value="Separado">Separado</option>
                    <option value="Viúvo">Viúvo</option>
                </select>
                <div class="error-message text-danger" id="erro_estado_civil"></div>
            </div>
        </div>

        <!-- Naturalidade -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="naturalidade" class="form-label">Naturalidade:</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" id="naturalidade" name="naturalidade" required>
                <div class="error-message text-danger" id="erro_naturalidade"></div>
            </div>
        </div>

        <!-- Escolaridade -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="escolaridade" class="form-label">Escolaridade:</label>
            </div>
            <div class="col-md-9">
                <select class="form-control" id="escolaridade" name="escolaridade" required>
                    <option value="">Selecione</option>
                    <option value="Médio Incompleto">Médio Incompleto</option>
                    <option value="Médio Completo">Médio Completo</option>
                    <option value="Superior Incompleto">Superior Incompleto</option>
                    <option value="Superior Completo">Superior Completo</option>
                    <option value="Pós-Graduação">Pós-Graduação</option>
                </select>
                <div class="error-message text-danger" id="erro_escolaridade"></div>
            </div>
        </div>

        <!-- Senha -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="senha" class="form-label">Senha:</label>
            </div>
            <div class="col-md-9">
                <input type="password" class="form-control" id="senha" name="senha" required>
                <div class="error-message text-danger" id="erro_senha"></div>
            </div>
        </div>

        <!-- Confirmação de Senha -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="confirmacao_senha" class="form-label">Confirmação de Senha:</label>
            </div>
            <div class="col-md-9">
                <input type="password" class="form-control" id="confirmacao_senha" name="confirmacao_senha" required>
                <div class="error-message text-danger" id="erro_confirmacao_senha"></div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" onclick="saveFormData()">Cadastrar</button>

    </form>
</div>

<?php include('pop-up-cpf-existente.php'); ?>
<?php include('pop-up-email-existente.php'); ?>
<?php include('pop-up-exibe-mensagem-ao-usuario.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="https://painel.psicologosespecialistas.com.br/modulo_cadastro/cadastro/asset/valida-cadastro.js
" type="text/javascript">    
</script>
<script src="https://painel.psicologosespecialistas.com.br/modulo_cadastro/cadastro/asset/exibe-campos-cadastro.js" type="text/javascript"></script>

<?php include('exibe-mensagem-ao-clicar-no-enviar.php'); ?>

<?php
if (isset($_GET['erro']) && $_GET['erro'] === 'cpf_existente') {
    echo '<div class="alert alert-danger">CPF já cadastrado. <a href="recuperar_senha.php">Recuperar senha</a> ou <a href="login.php">ir para o login</a>.</div>';
}
?>