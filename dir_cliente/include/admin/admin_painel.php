<?php
session_start();
require_once __DIR__ . '/../auth_check.php';

// Verificar se o usuário é admin
if (!isset($_SESSION['usuario_admin']) || $_SESSION['usuario_admin'] != 1) {
    header('Location: /acesso-negado.php');
    exit;
}

// Conexão com o banco de dados
require_once __DIR__ . '/../conexao.php';

// Obter lista de usuários
$usuarios = [];
$query = "SELECT id, nome_completo, cpf FROM usuarios WHERE admin = 0 ORDER BY nome_completo";
$stmt = Conexao::getConnection()->prepare($query);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obter resultados se um usuário foi selecionado
$resultados = [];
$esquemas = [];
$usuario_selecionado = null;

if (isset($_GET['usuario_id']) && is_numeric($_GET['usuario_id'])) {
    $usuario_id = intval($_GET['usuario_id']);
    
    // Obter informações do usuário selecionado
    $query = "SELECT nome_completo, cpf FROM usuarios WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$usuario_id]);
    $usuario_selecionado = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Obter resultados do YSQL
    $query = "SELECT r.*, e.nome as esquema_nome, e.descricao as esquema_descricao 
              FROM teste_ysql_resultados r
              JOIN teste_ysql_esquemas e ON r.esquema_id = e.id
              WHERE r.usuario_id = ?
              ORDER BY r.data_calculo DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$usuario_id]);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Obter todos os esquemas para exibição
    $query = "SELECT * FROM teste_ysql_esquemas ORDER BY id";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $esquemas = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Administrador - Resultados YSQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .sidebar {
            background-color: #343a40;
            color: white;
            height: 100vh;
        }
        .nav-link {
            color: rgba(255, 255, 255, 0.75);
        }
        .nav-link:hover, .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .chart-container {
            height: 300px;
            margin-bottom: 30px;
        }
        .resultado-card {
            transition: all 0.3s;
        }
        .resultado-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4>Admin: <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></h4>
                        <small class="text-muted">Painel de Resultados</small>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="admin_painel.php">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_resultados_ysql.php">
                                <i class="bi bi-clipboard-data"></i> Resultados YSQL
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_usuarios.php">
                                <i class="bi bi-people"></i> Gerenciar Usuários
                            </a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link text-danger" href="logout.php">
                                <i class="bi bi-box-arrow-right"></i> Sair
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Resultados YSQL</h1>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Selecionar Usuário</h5>
                        <form method="GET" action="admin_resultados_ysql.php">
                            <div class="row">
                                <div class="col-md-8">
                                    <select class="form-select" name="usuario_id" required>
                                        <option value="">Selecione um usuário...</option>
                                        <?php foreach ($usuarios as $usuario): ?>
                                            <option value="<?= $usuario['id'] ?>" <?= isset($_GET['usuario_id']) && $_GET['usuario_id'] == $usuario['id'] ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($usuario['nome_completo']) ?> (CPF: <?= htmlspecialchars(preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $usuario['cpf'])) ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="bi bi-search"></i> Buscar Resultados
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <?php if ($usuario_selecionado): ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            Resultados para: <?= htmlspecialchars($usuario_selecionado['nome_completo']) ?>
                            <small class="text-muted">CPF: <?= htmlspecialchars(preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $usuario_selecionado['cpf'])) ?></small>
                        </h5>
                    </div>
                    
                    <?php if (empty($resultados)): ?>
                        <div class="card-body">
                            <div class="alert alert-info">Nenhum resultado encontrado para este usuário.</div>
                        </div>
                    <?php else: ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Data</th>
                                            <th>Esquema</th>
                                            <th>Pontuação Total</th>
                                            <th>Média</th>
                                            <th>Interpretação</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($resultados as $resultado): ?>
                                            <tr>
                                                <td><?= date('d/m/Y H:i', strtotime($resultado['data_calculo'])) ?></td>
                                                <td>
                                                    <strong><?= htmlspecialchars($resultado['esquema_nome']) ?></strong>
                                                    <small class="d-block text-muted"><?= htmlspecialchars($resultado['esquema_descricao']) ?></small>
                                                </td>
                                                <td><?= $resultado['total_geral'] ?></td>
                                                <td><?= number_format($resultado['media'], 2) ?></td>
                                                <td><?= nl2br(htmlspecialchars(substr($resultado['interpretacao'], 0, 100) . (strlen($resultado['interpretacao']) > 100 ? '...' : ''))) ?></td>
                                                <td>
                                                    <a href="admin_detalhes_resultado.php?id=<?= $resultado['id'] ?>" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-eye"></i> Detalhes
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS e Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <?php if (!empty($resultados) && !empty($esquemas)): ?>
    <script>
        // Gráfico de médias por esquema
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.createElement('canvas');
            document.querySelector('.card-body').prepend(ctx);
            ctx.classList.add('chart-container');
            
            const labels = <?= json_encode(array_column($esquemas, 'nome')) ?>;
            const data = <?= json_encode(array_map(function($esquema) use ($resultados) {
                $res = array_filter($resultados, function($r) use ($esquema) {
                    return $r['esquema_nome'] === $esquema['nome'];
                });
                return $res ? current($res)['media'] : 0;
            }, $esquemas)) ?>;
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Média por Esquema',
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 6
                        }
                    }
                }
            });
        });
    </script>
    <?php endif; ?>
</body>
</html>