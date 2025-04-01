<?php
session_start(); // Isso deve vir primeiro, antes de qualquer saída

require_once __DIR__ . '/../auth_check.php';

// Verifica se há mensagem flash para exibir
$flashMessage = null;
if (isset($_SESSION['flash_message'])) {
    $flashMessage = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .menu-teste {
            transition: all 0.3s;
        }
        .menu-teste:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4>Bem-vindo, <?php echo isset($_SESSION['usuario_nome']) ? htmlspecialchars($_SESSION['usuario_nome']) : 'Usuário'; ?></h4>
                        <small class="text-muted">CPF: <?php echo isset($_SESSION['usuario_cpf']) ? preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $_SESSION['usuario_cpf']) : ''; ?></small>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="painel.php">
                                <i class="bi bi-house-door"></i> Início
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../testes/ysq/ysq.php">
                                <i class="bi bi-clipboard-pulse"></i> YSQ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                <i class="bi bi-emoji-frown"></i> Teste de Depressão
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                <i class="bi bi-lightning-charge"></i> Teste de Estresse
                            </a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link text-danger" href="../../logout.php">
                                <i class="bi bi-box-arrow-right"></i> Sair
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Olá, <?php echo isset($_SESSION['usuario_nome']) ? htmlspecialchars($_SESSION['usuario_nome']) : 'Usuário'; ?>!</h1>
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
                               <!-- <a href="testes/depressao.php" class="btn btn-primary">Realizar Teste</a>-->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card menu-teste">
                            <div class="card-body text-center">
                                <h5 class="card-title">Estresse</h5>
                                <p class="card-text">Avalie seus níveis de estresse</p>
                                <!--<a href="testes/estresse.php" class="btn btn-primary">Realizar Teste</a>-->
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>