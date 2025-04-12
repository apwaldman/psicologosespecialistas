<?php require_once 'inc.recuperar_senha_control.php'; ?>

<!DOCTYPE html>
<html lang="pt-BR">


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h2 class="text-center">Recuperação de Senha</h2>
                        <p class="text-center text-muted">Informe seu e-mail para receber um link de redefinição</p>

                        <?php if (!empty($mensagem)): ?>
                            <div class="alert alert-info">
                                <?php echo htmlspecialchars($mensagem); ?>
                            </div>
                        <?php endif; ?>

                        <form action="../../recuperar_senha.php" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Enviar</button>
                        </form>

                        <div class="mt-3 text-center">
                            <a href="../../index.php">Voltar ao login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

