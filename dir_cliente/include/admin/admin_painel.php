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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .esquema-card {
            border-left: 4px solid;
            margin-bottom: 10px;
            height: 100%;
        }
        .esquema-alto {
            border-color: #dc3545;
            background-color: #fff8f8;
        }
        .esquema-medio {
            border-color: #fd7e14;
            background-color: #fffaf5;
        }
        .esquema-baixo {
            border-color: #28a745;
            background-color: #f8fff8;
        }
        .progress-thin {
            height: 6px;
        }
        .accordion-button:not(.collapsed) {
            background-color: #f8f9fa;
        }
        .accordion-actions {
            position: absolute;
            right: 15px;
        }
        .esquema-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        .compact-card .card-body {
            padding: 0.75rem;
        }
        .compact-card h5 {
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }
        .compact-card p, .compact-card h6 {
            font-size: 0.85rem;
            margin-bottom: 0.3rem;
        }
        .compact-card .alert {
            padding: 0.5rem;
            margin-top: 0.5rem;
        }
        @media (max-width: 768px) {
            .esquema-grid {
                grid-template-columns: 1fr;
            }
        }
        @media print {
            body {
                font-size: 10px;
            }
            .print-content {
                width: 100%;
                padding: 0;
                margin: 0;
            }
            .no-print {
                display: none !important;
            }
            .card {
                page-break-inside: avoid;
            }
            .esquema-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            @page {
                size: auto;
                margin: 5mm;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-4 no-print">
        <h2 class="mb-4">Resultados dos Pacientes</h2>
        
        <div class="accordion" id="pacientesAccordion">
            <?php foreach ($pacientes as $paciente): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header position-relative">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#collapse<?= $paciente['id'] ?>" aria-expanded="false" 
                                aria-controls="collapse<?= $paciente['id'] ?>">
                            <?= htmlspecialchars($paciente['nome_completo']) ?> - 
                            <?= htmlspecialchars($paciente['cpf']) ?>
                        </button>
                        <div class="accordion-actions no-print">
                            <button class="btn btn-sm btn-outline-primary me-1" 
                                    onclick="printResult(<?= $paciente['id'] ?>)">
                                <i class="bi bi-printer"></i>
                            </button>                           
                        </div>
                    </h2>
                    <div id="collapse<?= $paciente['id'] ?>" class="accordion-collapse collapse" 
                         data-bs-parent="#pacientesAccordion">
                        <div class="accordion-body print-content" id="content-<?= $paciente['id'] ?>">
                            <h5 class="mb-3">Teste realizado em: <?= date('d/m/Y H:i', strtotime($paciente['data_calculo'])) ?></h5>
                            
                            <div class="row g-3">
                                <div class="col-lg-8">
                                    <h5 class="mb-2">Esquemas e Pontuações</h5>
                                    <div class="alert alert-secondary mb-3">
                                        <strong>Legenda:</strong>
                                        <ul class="mb-0">
                                            <li><strong>Alto</strong>: 22 a 30 pontos</li>
                                            <li><strong>Médio</strong>: 14 a 21 pontos</li>
                                            <li><strong>Baixo</strong>: 5 a 13 pontos</li>
                                        </ul>
                                    </div>
                                    <div class="esquema-grid">
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
                                            // Converter a média (1-6) para pontuação total (5-30)
                                            // Assumindo que cada esquema tem 5 itens (padrão no YSQ-S)
                                            $pontuacao_total = $pontuacao * 5;
                                            
                                            if ($pontuacao_total >= 22) {
                                                $classe = 'esquema-alto';
                                                $nivel = 'Alto';
                                            } elseif ($pontuacao_total >= 14) {
                                                $classe = 'esquema-medio';
                                                $nivel = 'Médio';
                                            } else {
                                                $classe = 'esquema-baixo';
                                                $nivel = 'Baixo';
                                            }
                                        ?>
                                            <div class="card esquema-card <?= $classe ?>">
                                                <div class="card-body p-2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <strong style="font-size: 0.9rem;"><?= $nome ?></strong>
                                                        <span><?= number_format($pontuacao_total, 0) ?> pts</span>
                                                    </div>
                                                    <div class="progress progress-thin mt-1">
                                                        <div class="progress-bar" 
                                                             style="width: <?= ($pontuacao_total/30)*100 ?>%"></div>
                                                    </div>
                                                    <small class="text-muted d-block mt-1">
                                                        Nível: <?= $nivel ?>
                                                    </small>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4">
                                    <div class="card compact-card h-100">
                                        <div class="card-body">
                                            <h5 class="card-title">Resumo</h5>
                                            <?php
                                            // Calcular totais
                                            $total_geral = array_sum($esquemas) * 5; // Assumindo 5 itens por esquema
                                            $esquemas_altos = array_filter($esquemas, fn($p) => ($p * 5) >= 22);
                                            $esquemas_medios = array_filter($esquemas, fn($p) => ($p * 5) >= 14 && ($p * 5) < 22);
                                            ?>
                                            
                                            <p><strong>Pontuação Geral:</strong> <?= number_format($total_geral, 0) ?> pts</p>
                                            
                                            <?php if (!empty($esquemas_altos)): ?>
                                                <h6 class="mt-3">Esquemas com Nível Alto (≥22 pts):</h6>
                                                <?php foreach ($esquemas_altos as $nome => $pontuacao): ?>
                                                    <p>- <?= $nome ?>: <?= number_format($pontuacao * 5, 0) ?> pts</p>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            
                                            <?php if (!empty($esquemas_medios)): ?>
                                                <h6 class="<?= !empty($esquemas_altos) ? 'mt-3' : 'mt-2' ?>">Esquemas com Nível Médio (14-21 pts):</h6>
                                                <?php foreach ($esquemas_medios as $nome => $pontuacao): ?>
                                                    <p>- <?= $nome ?>: <?= number_format($pontuacao * 5, 0) ?> pts</p>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            
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
    <script>
        // Função para imprimir
        function printResult(pacienteId) {
            const printWindow = window.open('', '_blank');
            const content = document.getElementById(`content-${pacienteId}`).innerHTML;
            
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Resultado do Paciente</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                    <style>
                        body { font-size: 10px; padding: 10px; }
                        .esquema-card { border-left: 4px solid; margin-bottom: 8px; }
                        .esquema-alto { border-color: #dc3545; background-color: #fff8f8; }
                        .esquema-medio { border-color: #fd7e14; background-color: #fffaf5; }
                        .esquema-baixo { border-color: #28a745; background-color: #f8fff8; }
                        .progress-thin { height: 4px; }
                        .card { page-break-inside: avoid; margin-bottom: 5px; }
                        .esquema-grid { 
                            display: grid; 
                            grid-template-columns: repeat(2, 1fr);
                            gap: 8px;
                        }
                        @page { size: auto; margin: 5mm; }
                    </style>
                </head>
                <body>
                    <div class="container">
                        ${content}
                        <div class="text-end mt-2">
                            <small>Impresso em: ${new Date().toLocaleString()}</small>
                        </div>
                    </div>
                    <script>
                        window.onload = function() {
                            setTimeout(function() {
                                window.print();
                                window.close();
                            }, 200);
                        };
                    <\/script>
                </body>
                </html>
            `);
            
            printWindow.document.close();
        }        
    </script>
</body>
</html>