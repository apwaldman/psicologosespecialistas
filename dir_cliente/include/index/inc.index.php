<?php require_once 'inc.conecta.php' ?>


<?php 
session_start();
$erro = $_SESSION['erro'] ?? '';
unset($_SESSION['erro']); // Limpa a mensagem de erro após exibi-la
?>

<?php if (!empty($erro)): ?>
    <div class="alert alert-danger text-center"><?php echo htmlspecialchars($erro); ?></div>
<?php endif; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">Login</h2>
            <?php echo $erro; ?>
            <form action="include/index/autenticar.php" method="POST">
                <div class="mb-3">
                    <label for="id_numero" class="form-label">ID</label>
                    <input type="text" class="form-control" id="id_numero" name="id_numero" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
            <div class="mt-3 text-center">
                <p>Ainda não possui cadastro? <a href="../cadastro.php">Registre aqui</a></p>                
            </div>
        </div>
    </div>
</div>
<?php ob_end_flush(); ?>