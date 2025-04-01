<?php require_once 'redefinir_senha_controller.php'; ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Redefinir Senha</h2>
                <?php if ($mensagem): ?>
                    <div class="alert alert-info"><?php echo $mensagem; ?></div>
                <?php endif; ?>
                <form action="redefinir_senha.php" method="POST">
                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                    <div class="mb-3">
                        <label for="nova_senha" class="form-label">Nova Senha</label>
                        <input type="password" class="form-control" id="nova_senha" name="nova_senha" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmar_senha" class="form-label">Confirmar Nova Senha</label>
                        <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Redefinir Senha</button>
                </form>
                <div class="mt-3 text-center">
                    <p><a href="index.php">Voltar ao login</a></p>
                </div>
            </div>
        </div>
    </div>
