<?php require_once 'inc.conecta.php' ?>
<?php echo $erro; ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">Login</h2>
            <?php echo $erro; ?>
            <form action="autenticar.php" method="POST">
                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
            <div class="mt-3 text-center">
                <p>Ainda não possui cadastro? <a href="../cadastro.php">Registre aqui</a></p>
                <p>Esqueceu sua senha? <a href="../recuperar_senha.php">Recupere</a></p>
            </div>
        </div>
    </div>
</div>

<?php
ob_end_flush(); // Envia o buffer de saída para o navegador