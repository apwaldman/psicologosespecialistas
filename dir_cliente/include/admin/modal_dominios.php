<?php
if (!isset($usuario_id)) {
    echo "<div class='alert alert-danger'>Erro: ID do usuário não definido.</div>";
    return;
}

// Buscar nome do paciente
$stmtNome = Conexao::getConnection()->prepare("SELECT nome_completo FROM usuarios WHERE id = ?");
$stmtNome->execute([$usuario_id]);
$dadosUsuario = $stmtNome->fetch(PDO::FETCH_ASSOC);

// Query para obter desempenho por domínio esquemático
$stmt = Conexao::getConnection()->prepare("
    SELECT 
        CASE 
            WHEN e.id BETWEEN 1 AND 5 THEN '1. Desconexão e Rejeição'
            WHEN e.id BETWEEN 6 AND 9 THEN '2. Prejuízo na Autonomia e Desempenho'
            WHEN e.id IN (14,15) THEN '3. Limites Prejudicados'
            WHEN e.id IN (10,11,16) THEN '4. Orientação para o Outro'
            WHEN e.id IN (17,12,13,18) THEN '5. Hipervigilância e Inibição'
        END AS dominio,
        e.nome AS esquema,
        COALESCE(
            CASE e.id
                WHEN 1 THEN r.privacao_emocional
                WHEN 2 THEN r.abandono
                WHEN 3 THEN r.desconfianca_abuso
                WHEN 4 THEN r.isolamento_social_alienacao
                WHEN 5 THEN r.defectividade_vergonha
                WHEN 6 THEN r.fracasso
                WHEN 7 THEN r.dependencia_incompetencia
                WHEN 8 THEN r.vulnerabilidade_dano_doenca
                WHEN 9 THEN r.emaranhamento
                WHEN 10 THEN r.subjugacao
                WHEN 11 THEN r.autossacrificio
                WHEN 12 THEN r.inibicao_emocional
                WHEN 13 THEN r.padroes_inflexiveis
                WHEN 14 THEN r.arrogo_grandiosidade
                WHEN 15 THEN r.autocontrole_autodisciplina_insuficientes
                WHEN 16 THEN r.busca_aprovacao_reconhecimento
                WHEN 17 THEN r.negatividade_pessimismo
                WHEN 18 THEN r.postura_punitiva
            END, 0) AS pontuacao
    FROM teste_ysql_esquemas e
    CROSS JOIN (
        SELECT * FROM teste_ysql_resultados 
        WHERE usuario_id = ? 
        ORDER BY id DESC LIMIT 1
    ) r
    ORDER BY 
        CASE 
            WHEN e.id BETWEEN 1 AND 5 THEN 1
            WHEN e.id BETWEEN 6 AND 9 THEN 2
            WHEN e.id IN (14,15) THEN 3
            WHEN e.id IN (10,11,16) THEN 4
            WHEN e.id IN (17,12,13,18) THEN 5
        END,
        e.id
");

$stmt->execute([$usuario_id]);
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Processar os dados para agrupar por domínio
$dominios = [];
foreach ($resultados as $row) {
    $dominio = $row['dominio'];
    if (!isset($dominios[$dominio])) {
        $dominios[$dominio] = [
            'esquemas' => [],
            'total' => 0,
            'count' => 0
        ];
    }
    $dominios[$dominio]['esquemas'][] = [
        'nome' => $row['esquema'],
        'pontuacao' => $row['pontuacao']
    ];
    $dominios[$dominio]['total'] += $row['pontuacao'];
    $dominios[$dominio]['count']++;
}

// Calcular médias
foreach ($dominios as &$dominio) {
    $dominio['media'] = $dominio['total'] / $dominio['count'];
}
unset($dominio); // Quebra a referência

// Textos descritivos dos domínios
$descricoesDominios = [
    '1. Desconexão e Rejeição' => 'O 1o domínio “Desconexão e rejeição” se refere ao conjunto de esquemas relacionados a dificuldades de formar vínculo seguros e estáveis com os outros. Envolve a expectativa do indivíduo de que não lhe serão supridas as necessidades básicas de afeto, proteção, segurança, empatia, cuidado e estabilidade. A família de origem costuma ser caracterizada como ser fria, distante, rejeitadora, imprevisível, impaciente ou abusiva (Souza et al., 2020). ',
    '2. Prejuízo na Autonomia e Desempenho' => 'O 2o domínio “Autonomia e desempenho prejudicados” está relacionado à dificuldade do indivíduo de reconhecer sua capacidade de viver de forma autônoma ou ter um bom desempenho. A presença de esquemas desse domínio costuma acarretar em problemas para se diferenciar das figuras paternas e maternas para funcionar com independência, sentem-se demasiadamente vulneráveis e dependentes dos outros inclusive para tarefas diárias. A família de origem geralmente é superprotetora, emaranhada ou excessivamente crítica, fornece poucas oportunidades de exploração e autonomia que incentivem a criança e favoreçam um senso adequado de auto confiança (Souza et al., 2020).',
    '3. Limites Prejudicados' => 'No 3o domínio, “Limites prejudicados”, os indivíduos não internalizaram limites adequados para autodisciplina ou senso de reciprocidade e respeito aos diretos dos outros. Muitas vezes têm dificuldades para cumprir metas e realizações pessoais de longo prazo, tolerar frustrações ou respeitar os compromissos com as outras pessoas. Em geral, a família de origem foi excessivamente permissiva ou indulgente, não favorecendo orientações,limites, tolerância a possíveis desconfortos ou senso de reciprocidade (Souza et al., 2020).',
    '4. Orientação para o Outro' => 'O 4o domínio, “Orientação para o outro”, é caracterizado por excessivo atendimento das necessidades dos outros em detrimento das próprias necessidades do paciente. Em geral, esse direcionamento ao outro tem como objetivo receber aprovação, evitar retaliações e manter as conexões emocionais, o que pode levar o paciente a suprimir suas emoções e desejos. A família de origem geralmente ensinou que o amor e a aceitação são condicionais, levando a criança a buscar suprir essas necessidades atendendo às expectativas, muitas vezes irrealistas, dos membros desse grupo (Souza et al., 2020).',
    '5. Hipervigilância e Inibição' => 'O 5o domínio, “Supervigilância e inibição”, tem como aspecto central a ênfase excessiva na inibição de sentimentos e espontaneidade, ou no seguimento de regras rígidas sobre desempenho e ética à custa do relaxamento, felicidade, prazer, autoexpressão, saúde e relacionamento íntimos. A origem na infância geralmente está relacionada à repressão, perfeccionismo, rigidez ou punição. Há constante preocupação com a possibilidade de ocorrência de eventos negativos ou erros e sensação que haverá uma catástrofe caso haja falhas na vigilância (Souza et al., 2020).'
];
?>

<div class="modal fade" id="modalDominios<?= $usuario_id ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl"> <!-- Alterado para modal-xl para melhor visualização -->
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Desempenho por Domínio Esquemático - <?= htmlspecialchars($dadosUsuario['nome_completo'] ?? '') ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if (!empty($dominios)): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th width="15%">Domínio Esquemático</th>
                                    <th width="25%">Esquemas</th>
                                    <th width="15%">Pontuação Média</th>
                                    <th width="45%">Descrição do Domínio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dominios as $nomeDominio => $dados): ?>
                                    <tr>
                                        <td><strong><?= $nomeDominio ?></strong></td>
                                        <td>
                                            <ul class="list-unstyled mb-0">
                                                <?php foreach ($dados['esquemas'] as $esquema): ?>
                                                    <li>
                                                        <?= htmlspecialchars($esquema['nome']) ?>: 
                                                        <span class="badge <?= $esquema['pontuacao'] >= 4 ? 'bg-danger' : ($esquema['pontuacao'] >= 3 ? 'bg-warning' : 'bg-secondary') ?>">
                                                            <?= number_format($esquema['pontuacao'], 1) ?>
                                                        </span>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge <?= $dados['media'] >= 3.5 ? 'bg-danger' : ($dados['media'] >= 2.5 ? 'bg-warning' : 'bg-success') ?>" style="font-size: 1.1em">
                                                <?= number_format($dados['media'], 2) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <small><?= $descricoesDominios[$nomeDominio] ?? 'Descrição não disponível' ?></small>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    
                <?php else: ?>
                    <div class="alert alert-warning">Nenhum resultado encontrado para este paciente.</div>
                <?php endif; ?>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <div class="text-muted small">
                    <em>Souza, L.H. et al. (2020). Adaptação Brasileira do Questionário de Esquemas de Young – Versão Breve (YSQ-S3). Avaliação Psicológica. http://dx.doi.org/10.15689/ap.2020.1904.17377.11</em>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>