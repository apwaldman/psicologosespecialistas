<?php
require_once __DIR__.'/../../auth_check.php';
require_once __DIR__.'/YsqlTest.class.php';
require_once __DIR__.'/../../conexao.php';
require_once __DIR__.'/YsqCache.class.php';

// Verificação do usuário
if (empty($_SESSION['usuario_id'])) {
    header('Location: /psicologosespecialistas/dir_cliente/login.php?error=not_logged_in');
    exit;
}

$usuario_id = (int)$_SESSION['usuario_id'];
$ysqlTest = new YsqlTest();

// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Salva no cache antes de processar
        YsqCache::saveToCache($_POST);
        
        $result = $ysqlTest->processarRespostas($_POST, $usuario_id);
        
        if ($result['success']) {
              // Define a mensagem de sucesso na sessão
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'title' => 'Sucesso!',
                'message' => 'Teste YSQL-S enviado com sucesso!',
                'duration' => 5000 // 5 segundos
            ];
            
            header('Location: ../../painel.php');
            exit;
            
        } else {
            $error = $result['message'];
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

// Carrega cache se existir
$cachedResponses = YsqCache::loadFromCache();

// Obtém questões
try {
    $questoes = $ysqlTest->getQuestoes();
} catch (Exception $e) {
    die("Erro ao carregar o teste: " . htmlspecialchars($e->getMessage()));
}
?>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">        
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="../../painel.php">Painel</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="../../logout.php"><i class="bi bi-box-arrow-right"></i> Sair</a>
            </li>      
        </ul> 
    </nav>

    <div class="container mt-5 mb-10">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h2 class="text-center">QUESTIONÁRIO DE ESQUEMAS DE YOUNG – VERSÃO BREVE (YSQ – S3)</h2>
                <i>Jeffrey Young, Ph.D.</i>
            </div>    
            <div>
                <small class="text-muted text-center">Tradução e adaptação oficial para uso no Brasil por Lauren Heineck de Souza, Elisa Steinhorst Damasceno e Margareth
                da Silva Oliveira. Autorização exclusiva do Schema Therapy Institute.</small>
                <div class="card shadow-lg p-4 m-3">
                    <h3 class="text-center">Instruções</h3>
                    <p>Abaixo há uma lista de afirmações que as pessoas podem utilizar para descrever a si mesmas. Por favor, leia cada afirmação e então a classifique, 
                        baseando-se em quão bem ela descreve você <strong>ao longo do último ano</strong>. Quando você não tiver certeza, baseie sua resposta nos 
                        <strong>seus sentimentos</strong>, e não no que você acredita racionalmente que é verdade. </p>
                    
                    <p><i>Alguns dos itens se referem a sua relação com seus pais ou parceiro(s) amoroso(s). Se qualquer um deles já tiver falecido,
                        por favor, responda a esses itens baseando-se na sua relação com eles enquanto eram vivos ou na sua relação com a pessoa
                        que fez esse papel. Se você atualmente não tem um(a) parceiro(a) amoroso(a), mas teve parceiros(as) no passado, responda
                        ao item baseando-se no parceiro(a) mais significativo que você teve recentemente.</i></p>   
                        <p>1 – Completamente falso sobre mim</p>
                        <p>2 – Em grande parte falso sobre mim</p>
                        <p>3 – Um pouco mais verdadeiro do que falso sobre mim</p>
                        <p>4 – Moderadamente verdadeiro sobre mim</p>
                        <p>5 – Em grande parte verdadeiro sobre mim</p>
                        <p>6 – Me descreve perfeitamente</p>
                </div>
            </div>
            
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                
                <form method="POST" id="ysq-form">
                    <div class="row">
                        <?php foreach ($questoes as $questao): ?>
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Questão <?= $questao['numero'] ?> <?php include('escalaFlutuante.php'); ?></h5>
                                    <p class="card-text"><?= htmlspecialchars($questao['texto'], ENT_QUOTES, 'UTF-8') ?></p>
                                    
                                    <!-- Grupo de botões ajustado para Bootstrap 5 -->
                                    <div class="btn-group w-100" role="group" data-bs-toggle="buttons" data-question="questao_<?= $questao['id'] ?>">                                        <?php for ($i = 1; $i <= 6; $i++): ?>
                                            <input
                                                type="radio"
                                                class="btn-check"
                                                name="questao_<?= $questao['id'] ?>"
                                                id="questao_<?= $questao['id'] ?>_<?= $i ?>"
                                                value="<?= $i ?>"
                                                autocomplete="off"
                                                <?= isset($cachedResponses['questao_'.$questao['id']]) && $cachedResponses['questao_'.$questao['id']] == $i ? 'checked' : '' ?>
                                            >
                                            <label 
                                                class="btn btn-outline-primary flex-grow-1" 
                                                for="questao_<?= $questao['id'] ?>_<?= $i ?>">
                                                <?= $i ?>
                                            </label>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>                    
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-lg px-5">Enviar Respostas</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="ysq-cache.js"></script>
    <script>
    // Validação do formulário com destaque para questões não respondidas
document.getElementById('ysq-form').addEventListener('submit', function(e) {
    let todasRespondidas = true;
    const cards = document.querySelectorAll('.card'); // Seleciona todos os cards de questões
    
    // Remove qualquer destaque anterior
    cards.forEach(card => {
        card.classList.remove('border-danger', 'text-danger');
        const alertElement = card.querySelector('.alert-responda');
        if (alertElement) {
            alertElement.remove();
        }
    });
    
    // Verifica cada questão
    document.querySelectorAll('[data-question]').forEach(questionGroup => {
        const questionId = questionGroup.dataset.question;
        const card = questionGroup.closest('.card');
        const checkedRadio = questionGroup.querySelector('input[type="radio"]:checked');
        
        if (!checkedRadio) {
            todasRespondidas = false;
            // Adiciona destaque visual
            card.classList.add('border-danger');
            
            // Adiciona mensagem de alerta (se ainda não existir)
            if (!card.querySelector('.alert-responda')) {
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-danger alert-responda mt-2';
                alertDiv.textContent = 'Por favor, responda esta questão';
                card.querySelector('.card-body').appendChild(alertDiv);
            }
        }
    });
    
    if (!todasRespondidas) {
        e.preventDefault();
        // Rolagem suave para a primeira questão não respondida
        const firstUnanswered = document.querySelector('.border-danger');
        if (firstUnanswered) {
            firstUnanswered.scrollIntoView({ 
                behavior: 'smooth', 
                block: 'center' 
            });
        }
    }
});

// Ativa o estado 'active' nos botões de rádio quando selecionados
document.querySelectorAll('.btn-group input[type="radio"]').forEach(radio => {
    radio.addEventListener('change', function() {
        // Remove 'active' de todos os botões do grupo
        const groupName = this.name;
        document.querySelectorAll(`input[name="${groupName}"]`).forEach(r => {
            r.closest('label')?.classList.remove('active');
        });
        
        // Adiciona 'active' apenas ao selecionado
        if (this.checked) {
            this.closest('label')?.classList.add('active');
            
            // Remove o destaque de erro se existir
            const card = this.closest('.card');
            card?.classList.remove('border-danger');
            const alertElement = card?.querySelector('.alert-responda');
            if (alertElement) {
                alertElement.remove();
            }
        }
    });
});
</script>
