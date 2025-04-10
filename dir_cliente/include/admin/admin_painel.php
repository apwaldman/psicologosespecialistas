<?php
require_once __DIR__ . '/../auth_check.php';
require_once __DIR__ . '/../conexao.php';

// Basic permission check
if (!isset($_SESSION['usuario_admin']) || $_SESSION['usuario_admin'] != 1) {
    header('Location: /index.php');
    exit;
}


          // Get all patients with their latest results and calculate general average
$query = "SELECT 
u.id, 
u.nome_completo, 
u.id_numero, 
r.*,
(
    (COALESCE(privacao_emocional, 0) + 
     COALESCE(abandono, 0) + 
     COALESCE(desconfianca_abuso, 0) + 
     COALESCE(isolamento_social_alienacao, 0) + 
     COALESCE(defectividade_vergonha, 0) + 
     COALESCE(fracasso, 0) + 
     COALESCE(dependencia_incompetencia, 0) + 
     COALESCE(vulnerabilidade_dano_doenca, 0) + 
     COALESCE(emaranhamento, 0) + 
     COALESCE(subjugacao, 0) + 
     COALESCE(autossacrificio, 0) + 
     COALESCE(inibicao_emocional, 0) + 
     COALESCE(padroes_inflexiveis, 0) + 
     COALESCE(arrogo_grandiosidade, 0) + 
     COALESCE(autocontrole_autodisciplina_insuficientes, 0) + 
     COALESCE(busca_aprovacao_reconhecimento, 0) + 
     COALESCE(negatividade_pessimismo, 0) + 
     COALESCE(postura_punitiva, 0))
    / 18
) AS total_geral
FROM usuarios u
JOIN teste_ysql_resultados r ON u.id = r.usuario_id
WHERE r.id IN (SELECT MAX(id) FROM teste_ysql_resultados GROUP BY usuario_id)
ORDER BY u.nome_completo";

$pacientes = Conexao::getConnection()->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>

    <style>
        .esquema-badge {
            display: inline-block;
            padding: 0.35em 0.65em;
            margin: 0.15em;
            border-radius: 0.25rem;
        }
        .esquema-ativado {
            background-color: #dc3545;
            color: white;
        }
        .compact-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .compact-title {
            margin: 0;
            flex-grow: 1;
        }
        .esquemas-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }
        @media print {
            .no-print { display: none !important; }
            body { font-size: 10px; padding: 0; }
            .accordion-body { padding: 0.5rem !important; }
            .accordion-button { font-size: 0.9rem; padding: 0.5rem 1rem; }
        }
    </style>


<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center no-print">
    <ul class="navbar-nav">            
        <li class="nav-item">
            <a class="nav-link" href="../../logout.php"><i class="bi bi-box-arrow-right"></i> Sair</a>
        </li>      
    </ul>    
</nav>

<div class="container mt-4">
    <h2 class="mb-4 no-print">Resultados dos Pacientes</h2>
    
    <div class="accordion" id="pacientesAccordion">
        <?php foreach ($pacientes as $paciente): ?>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                            data-bs-target="#collapse<?= $paciente['id'] ?>" aria-expanded="false" 
                            aria-controls="collapse<?= $paciente['id'] ?>">
                        <?= htmlspecialchars($paciente['nome_completo']) ?> - 
                        <?= htmlspecialchars($paciente['id_numero']) ?>
                    </button>
                </h2>
                <div id="collapse<?= $paciente['id'] ?>" class="accordion-collapse collapse" 
                     data-bs-parent="#pacientesAccordion">
                    <div class="accordion-body">
                        <div class="compact-header">
                            <div>
                                <h6 class="compact-title">Teste: <?= date('d/m/Y H:i', strtotime($paciente['data_calculo'])) ?></h6>
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
                                
                                $esquemas_ativados = array_filter($esquemas, fn($p) => $p >= 4);
                                ?>
                                
                                <?php if (!empty($esquemas_ativados)): ?>
                                    <div class="esquemas-container">
                                        <?php foreach ($esquemas_ativados as $nome => $media): ?>
                                            <span class="esquema-badge esquema-ativado">
                                                <?= $nome ?>: <?= number_format($media, 1) ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <span class="text-muted">Nenhum esquema ativado (≥4.0)</span>
                                <?php endif; ?>
                            </div>
                            
                            
                            <button class="btn btn-sm btn-outline-primary no-print" 
                                onclick="printOnlyActive(this, <?= $paciente['id'] ?>, '<?= htmlspecialchars($paciente['nome_completo']) ?>')">
                            <i class="bi bi-printer"></i> Imprimir
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-info no-print" 
                                    data-bs-toggle="modal" data-bs-target="#modalRespostas<?= $paciente['usuario_id'] ?>">
                                <i class="bi bi-question-circle"></i> Respostas
                            </button>
                            
                            <!-- Novo botão para domínios -->
                            <button type="button" class="btn btn-sm btn-outline-primary no-print" 
                                    data-bs-toggle="modal" data-bs-target="#modalDominios<?= $paciente['usuario_id'] ?>">
                                <i class="bi bi-bar-chart"></i> Domínios
                            </button>
                            <?php 
                            $usuario_id = $paciente['usuario_id'];
                            include(__DIR__.'/modal_respostas.php');
                            include(__DIR__.'/modal_dominios.php'); 
                            ?>
                            
                        </div>
                        
                        <div class="mt-3">
                            <p class="mb-1"><strong>Média Geral:</strong> <?= number_format($paciente['total_geral'], 2) ?></p>
                            <?php if (!empty($paciente['interpretacao'])): ?>
                                <div class="alert alert-info mt-2 p-2">
                                    <strong>Interpretação:</strong><br>
                                    <p>os itens desse questionário correspondem a crenças e pressupostos típicos de cada esquema inicial desadaptativo (EID)(WAINER, 2016, p.94). 
                                        “EIDs são conjuntos de crenças nucleares referentes a temas centrais ao desenvolvimento emocional. (...) são estruturas que armazenam crenças, 
                                        suposições, regras e outras memórias” (Idem, 2016, p. 48-49). O(a) servidor(a) apresentou o seguinte desempenho: </p>
                                    <?= nl2br(htmlspecialchars($paciente['interpretacao'])) ?>
                                </div>
                            <?php endif; ?>                            


                        </div>
                    </div>
                </div>
            </div>            
        <?php endforeach; ?>
       
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Adicione isso no final do arquivo, antes do fechamento do body -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Substitui a função de impressão padrão
    window.printOnlyActive = function(button, pacienteId, pacienteNome) {
        // Encontra o accordion-item pai
        const accordionItem = button.closest('.accordion-item');
        
        // Clona o conteúdo do accordion
        const contentToPrint = accordionItem.cloneNode(true);
        
        // Força a abertura do accordion no clone
        const collapseDiv = contentToPrint.querySelector('.accordion-collapse');
        collapseDiv.classList.add('show');
        collapseDiv.classList.remove('collapse');
        
        // Cria um iframe para impressão
        const printFrame = document.createElement('iframe');
        printFrame.style.position = 'absolute';
        printFrame.style.width = '0';
        printFrame.style.height = '0';
        printFrame.style.border = 'none';
        printFrame.style.left = '-9999px';
        
        printFrame.onload = function() {
            const printDoc = printFrame.contentDocument || printFrame.contentWindow.document;
            printDoc.open();
            
            // Adiciona estilos ao iframe
            printDoc.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Resultado do Teste - ${pacienteNome}</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                    <style>
                        @media print {
                            body { font-size: 10px; padding: 0; }
                            .accordion-body { padding: 0.5rem !important; display: block !important; }
                            .accordion-button { font-size: 0.9rem; padding: 0.5rem 1rem; }
                            .accordion-button::after { display: none !important; }
                            .accordion-button:not(.collapsed) { color: inherit; background-color: inherit; }
                            .no-print { display: none !important; }
                        }
                        .esquema-badge {
                            display: inline-block;
                            padding: 0.35em 0.65em;
                            margin: 0.15em;
                            border-radius: 0.25rem;
                        }
                        .esquema-ativado {
                            background-color: #dc3545;
                            color: white;
                        }
                    </style>
                </head>
                <body>
                    ${contentToPrint.outerHTML}
                </body>
                </html>
            `);
            
            printDoc.close();
            
            // Dispara a impressão após um pequeno delay para garantir que o conteúdo foi carregado
            setTimeout(() => {
                printFrame.contentWindow.focus();
                printFrame.contentWindow.print();
                document.body.removeChild(printFrame);
            }, 500);
        };
        
        document.body.appendChild(printFrame);
    };
});
</script>