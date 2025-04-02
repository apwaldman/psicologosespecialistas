<div class="container mt-5">
    <h2>Cadastro de Usuário</h2>
    <form action="https://cliente.psicologosespecialistas.com.br/include/cadastro/cadastro-controller.php" method="POST" novalidate>
        <div class="alert alert-danger d-none" id="errorMessages"></div>

        <!-- Nome Completo -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="nome_completo" class="form-label">Nome Completo:</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" id="nome_completo" name="nome_completo" required>
                <div class="error-message text-danger" id="error-nome_completo"></div>
            </div>
        </div>

        <!-- Data de Nascimento -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
            </div>
            <div class="col-md-9">
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                <div class="error-message text-danger" id="error-data_nascimento"></div>
            </div>
        </div>

        <!-- Idade -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="idade" class="form-label">Idade:</label>
            </div>
            <div class="col-md-9">
                <input type="number" class="form-control" id="idade" name="idade" readonly>
                <div class="error-message text-danger" id="error-idade"></div>
            </div>
        </div>

        <!-- CPF -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="cpf" class="form-label">CPF:</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" id="cpf" name="cpf" required>
                <div class="error-message text-danger" id="error-cpf"></div>
            </div>
        </div>

       <!-- E-mail -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="email" class="form-label">E-mail:</label>
            </div>
            <div class="col-md-9">
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="error-message text-danger" id="error-email"></div>
            </div>
        </div>

        <!-- Celular -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="celular" class="form-label">Celular:</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" id="celular" name="celular" required>
                <div class="error-message text-danger" id="error-celular"></div>
            </div>
        </div>
        <!-- Senha -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="senha" class="form-label">Senha:</label>
            </div>
            <div class="col-md-9">
                <input type="password" class="form-control" id="senha" name="senha" required>
                <div class="error-message text-danger" id="error-senha"></div>
            </div>
        </div>

        <!-- Confirmação de Senha -->
        <div class="row mb-3 align-items-center">
            <div class="col-md-3">
                <label for="confirmacao_senha" class="form-label">Confirmação de Senha:</label>
            </div>
            <div class="col-md-9">
                <input type="password" class="form-control" id="confirmacao_senha" name="confirmacao_senha" required>
                <div class="error-message text-danger" id="error-confirmacao_senha"></div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" onclick="saveFormData()">Cadastrar</button>

    </form>
</div>

<?php include('pop-up-cpf-existente.php'); ?>
<?php include('pop-up-email-existente.php'); ?>
<?php include('pop-up-exibe-mensagem-ao-usuario.php'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="https://cliente.psicologosespecialistas.com.br/include/cadastro/valida-cadastro.js"></script>
<?php include('exibe-mensagem-ao-clicar-no-enviar.php'); ?>

<?php
if (isset($_GET['erro']) && $_GET['erro'] === 'cpf_existente') {
    echo '<div class="alert alert-danger">CPF já cadastrado. <a href="recuperar_senha.php">Recuperar senha</a> ou <a href="login.php">ir para o login</a>.</div>';
}
?>

