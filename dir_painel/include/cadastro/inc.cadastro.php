<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-body">
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

                        <!-- ID Numérico -->
                        <div class="row mb-3 align-items-center">
                            <div class="col-md-3">
                                <label for="id_numero" class="form-label">ID:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" class="form-control" id="id_numero" name="id_numero" required min="1" step="1">
                                <div class="error-message text-danger" id="error-id"></div>
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

                        <div class="form-check mb-3">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="autoriza_pesquisa" id = "autoriza_pesquisa" value="1"> <?php include('modal-autoriza-uso-pesquisa.php'); ?>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary" onclick="saveFormData()">Cadastrar</button>
                        <a href="https://cliente.psicologosespecialistas.com.br/index.php" class="btn btn-success">Voltar</a>
                    </form>
                </div>                    
            </div>
        </div>
    </div>
</div>


<?php include('pop-up-exibe-mensagem-ao-usuario.php'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="https://cliente.psicologosespecialistas.com.br/include/cadastro/valida-cadastro.js"></script>
<?php include('exibe-mensagem-ao-clicar-no-enviar.php'); ?>



