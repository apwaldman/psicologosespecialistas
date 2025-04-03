<?php
session_start(); // Isso deve vir primeiro, antes de qualquer saída
require_once __DIR__ . '/../auth_check.php';
?>
<?php
// Verifica se há mensagem flash para exibir
$flashMessage = null;
if (isset($_SESSION['flash_message'])) {
    $flashMessage = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
}
?>
<!-- Grey with black text -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
    
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="https://cliente.psicologosespecialistas.com.br/painel.php">Painel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../../testes/ysq/ysq.php"><i class="bi bi-clipboard-pulse"></i> YSQ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../../logout.php"><i class="bi bi-box-arrow-right"></i> Sair</a>
            </li>      
        </ul>    
       
</nav>

<!-- Main content -->
<div class="container mt-5">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4>Bem-vindo(a), <?php echo isset($_SESSION['usuario_nome']) ? htmlspecialchars($_SESSION['usuario_nome']) : 'Usuário'; ?></h4>
        <small class="text-muted">CPF: <?php echo isset($_SESSION['usuario_cpf']) ? preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $_SESSION['usuario_cpf']) : ''; ?></small>
    </div>
    
    <?php if ($flashMessage): ?>
    <div class="alert alert-<?= $flashMessage['type'] ?> alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($flashMessage['message'], ENT_QUOTES, 'UTF-8') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Seus Testes Disponíveis</h5>
                    <p class="card-text">Selecione abaixo o teste que deseja realizar:</p>
                </div>
            </div>
        </div>

        <!-- Cards de testes -->
        <div class="col-md-4 mb-4">
            <div class="card menu-teste">
                <div class="card-body text-center">
                    <h5 class="card-title">YSQ-S</h5>
                    <p class="card-text">Avalie EIDS</p>
                    <a href="../../testes/ysq/ysq.php" class="btn btn-primary">Realizar Teste</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card menu-teste">
                <div class="card-body text-center">
                    <h5 class="card-title">Depressão</h5>
                    <p class="card-text">Avalie seus níveis de depressão</p>
                    <a href="#" class="btn btn-secondary disabled">Realizar Teste</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card menu-teste">
                <div class="card-body text-center">
                    <h5 class="card-title">Estresse</h5>
                    <p class="card-text">Avalie seus níveis de estresse</p>
                    <a href="#" class="btn btn-secondary disabled">Realizar Teste</a>
                </div>
            </div>
        </div>
    </div>            
</div>

    
    
