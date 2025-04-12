<?php
// Garantir que $usuario_id está definido
if (!isset($usuario_id)) {
    echo "<div class='alert alert-danger'>Erro: ID do usuário não definido.</div>";
    return;
}

// Buscar nome do paciente
$stmtNome = Conexao::getConnection()->prepare("SELECT nome_completo FROM usuarios WHERE id = ?");
$stmtNome->execute([$usuario_id]);
$dadosUsuario = $stmtNome->fetch(PDO::FETCH_ASSOC);

$stmt = Conexao::getConnection()->prepare("
    SELECT 
		q.numero,
        q.texto,
        e.nome AS esquema_nome,
        i.valor
from usuarios u 
join teste_ysql_resposta_itens i on u.id = i.usuario_id 
join teste_ysql_questoes q on q.id = i.questao_id 
join teste_ysql_esquemas e on e.id = q.esquema_id 
WHERE u.id = ?
ORDER BY q.numero

");

$stmt->execute([$usuario_id]);

$respostas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!-- Modal -->
<div class="modal fade" id="modalRespostas<?= $usuario_id ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h4 class="modal-title">Respostas detalhadas - <?= htmlspecialchars($dadosUsuario['nome_completo'] ?? 'Paciente não encontrado') ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <?php if (count($respostas) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                            <th>Nº</th>
                            <th>Questão</th>
                            <th>Esquema</th>
                            <th>Resposta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($respostas as $resp): ?>
                            <tr>
                                <td><?= htmlspecialchars($resp['numero']) ?></td>
                                <td><?= htmlspecialchars($resp['texto']) ?></td>
                                <td><span class="badge bg-primary"><?= htmlspecialchars($resp['esquema_nome']) ?></span></td>
                                <td>
                                    <?php 
                                        $valor = isset($resp['valor']) && is_numeric($resp['valor']) ? (int)$resp['valor'] : null;

                                        $icon = match($valor) {
                                            1 => 'bi-x-circle-fill text-danger',
                                            2 => 'bi-dash-circle-fill text-warning',
                                            3, 4, 5, 6 => 'bi-check-circle-fill text-success',
                                            default => 'bi-question-circle-fill text-secondary'
                                        };
                                    ?>
                                    <i class="bi <?= $icon ?>"></i> <?= $valor !== null ? $valor : 'N/A' ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                     </table>
                </div>
                 <?php else: ?>
                <div class="alert alert-warning">
                    Nenhuma resposta encontrada para este paciente.
                </div>
                <?php endif; ?>
            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
