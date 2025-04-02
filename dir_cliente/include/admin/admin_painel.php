<?php
require_once __DIR__ . '/../auth_check.php';
require_once __DIR__ . '/../conexao.php';

// Verificação básica de permissão
if (!isset($_SESSION['usuario_admin']) || $_SESSION['usuario_admin'] != 1) {
    header('Location: /index.php');
    exit;
}

// Buscar todos os pacientes com seus últimos resultados
$query = "SELECT u.id, u.nome_completo, u.cpf, r.* 
          FROM usuarios u
          JOIN teste_ysql_resultados r ON u.id = r.usuario_id
          WHERE r.id IN (SELECT MAX(id) FROM teste_ysql_resultados GROUP BY usuario_id)
          ORDER BY u.nome_completo";

$pacientes = Conexao::getConnection()->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados dos Pacientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .esquema-card {
            border-left: 4px solid;
            margin-bottom: 10px;
        }
        .esquema-clinico {
            border-color: #dc3545;
            background-color: #fff8f8;
        }
        .esquema-ativado {
            border-color: #fd7e14;
            background-color: #fffaf5;
        }
        .esquema-normal {
            border-color: #28a745;
        }
        .progress-thin {
            height: 6px;
        }
        .accordion-button:not(.collapsed) {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Resultados dos Pacientes</h2>
        
        <div class="accordion" id="pacientesAccordion">
            <?php foreach ($pacientes as $paciente): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#collapse<?= $paciente['id'] ?>">
                            <?= htmlspecialchars($paciente['nome_completo']) ?> - 
                            <?= htmlspecialchars($paciente['cpf']) ?>
                        </button>
                    </h2>
                    <div id="collapse<?= $paciente['id'] ?>" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <h5>Teste realizado em: <?= date('d/m/Y H:i', strtotime($paciente['data_calculo'])) ?></h5>
                            
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <h5>Esquemas e Pontuações</h5>
                                    <?php
                                    $esquemas = [
                                        'Privação Emocional' => $paciente['privacao_emocional'],
                                        'Abandono' => $paciente['abandono'],
                                        'Desconfiança/Abuso' => $paciente['desconfianca_abuso'],
                                        'Isolamento Social' => $paciente['isolamento_social_alienacao'],
                                        'Defectividade/Vergonha' => $paciente['defectividade_vergonha'],
                                        'Fracasso' => $paciente['fracasso'],
                                        'Dependência' => $paciente['dependencia_incompetencia'],
                                        'Vulnerabilidade' => $paciente['vulnerabilidade_dano_doenca'],
                                        'Emaranhamento' => $paciente['emaranhamento'],
                                        'Subjugação' => $paciente['subjugacao'],
                                        'Autossacrifício' => $paciente['autossacrificio'],
                                        'Inibição Emocional' => $paciente['inibicao_emocional'],
                                        'Padrões Inflexíveis' => $paciente['padroes_inflexiveis'],
                                        'Arrogo/Grandiosidade' => $paciente['arrogo_grandiosidade'],
                                        'Autocontrole Insuficiente' => $paciente['autocontrole_autodisciplina_insuficientes'],
                                        'Busca de Aprovação' => $paciente['busca_aprovacao_reconhecimento'],
                                        'Negatividade' => $paciente['negatividade_pessimismo'],
                                        'Postura Punitiva' => $paciente['postura_punitiva']
                                    ];
                                    
                                    foreach ($esquemas as $nome => $pontuacao):
                                        $classe = $pontuacao >= 4 ? 'esquema-clinico' : 
                                                 ($pontuacao >= 2.5 ? 'esquema-ativado' : 'esquema-normal');
                                    ?>
                                        <div class="card esquema-card <?= $classe ?> mb-2">
                                            <div class="card-body p-3">
                                                <div class="d-flex justify-content-between">
                                                    <strong><?= $nome ?></strong>
                                                    <span><?= number_format($pontuacao, 2) ?>/6</span>
                                                </div>
                                                <div class="progress progress-thin mt-1">
                                                    <div class="progress-bar" 
                                                         style="width: <?= ($pontuacao/6)*100 ?>%"></div>
                                                </div>
                                                <small class="text-muted">
                                                    <?= $pontuacao >= 4 ? 'Nível Clínico' : 
                                                       ($pontuacao >= 2.5 ? 'Ativado' : 'Normal') ?>
                                                </small>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Resumo</h5>
                                            <p><strong>Pontuação Geral:</strong> <?= number_format($paciente['total_geral'], 2) ?>/6</p>
                                            
                                            <h6 class="mt-4">Esquemas em Nível Clínico (≥4):</h6>
                                            <?php
                                            $clinicos = array_filter($esquemas, fn($p) => $p >= 4);
                                            if (count($clinicos) > 0):
                                                foreach ($clinicos as $nome => $pontuacao):
                                                    echo "<p>- $nome: ".number_format($pontuacao, 2)."</p>";
                                                endforeach;
                                            else:
                                                echo "<p class='text-muted'>Nenhum esquema em nível clínico</p>";
                                            endif;
                                            ?>
                                            
                                            <h6 class="mt-3">Esquemas Ativados (≥2.5):</h6>
                                            <?php
                                            $ativados = array_filter($esquemas, fn($p) => $p >= 2.5 && $p < 4);
                                            if (count($ativados) > 0):
                                                foreach ($ativados as $nome => $pontuacao):
                                                    echo "<p>- $nome: ".number_format($pontuacao, 2)."</p>";
                                                endforeach;
                                            else:
                                                echo "<p class='text-muted'>Nenhum esquema ativado</p>";
                                            endif;
                                            ?>
                                            
                                            <?php if (!empty($paciente['interpretacao'])): ?>
                                                <div class="alert alert-info mt-3">
                                                    <h6>Interpretação:</h6>
                                                    <?= nl2br(htmlspecialchars($paciente['interpretacao'])) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>