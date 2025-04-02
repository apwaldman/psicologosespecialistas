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
            
            header('Location: /../../painel.php');
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



<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste YSQL-S</title>
    <link rel="stylesheet" href="ysq.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-outline-primary.active {
            background-color: #0d6efd;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h2 class="text-center">QUESTIONÁRIO DE ESQUEMAS DE YOUNG – VERSÃO BREVE (YSQ – S3)</h2>
                <i>Jeffrey Young, Ph.D.</i>
            </div>    
            <div>
                <small class="text-muted">Tradução e adaptação oficial para uso no Brasil por Lauren Heineck de Souza, Elisa Steinhorst Damasceno e Margareth
                da Silva Oliveira. Autorização exclusiva do Schema Therapy Institute.</small>
                <hr class="text-center">Instruções</h3>
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
                                    <h5 class="card-title">Questão <?= $questao['numero'] ?></h5>
                                    <p class="card-text"><?= htmlspecialchars($questao['texto'], ENT_QUOTES, 'UTF-8') ?></p>
                                    
                                    <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                                        <?php for ($i = 1; $i <= 6; $i++): ?>
                                        <label class="btn btn-outline-primary <?= isset($cachedResponses['questao_'.$questao['id']]) && $cachedResponses['questao_'.$questao['id']] == $i ? 'active' : '' ?>">
                                            <input type="radio" name="questao_<?= $questao['id'] ?>" value="<?= $i ?>" required 
                                                <?= isset($cachedResponses['questao_'.$questao['id']]) && $cachedResponses['questao_'.$questao['id']] == $i ? 'checked' : '' ?>>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Validação do formulário
        document.getElementById('ysq-form').addEventListener('submit', function(e) {
            const radios = document.querySelectorAll('input[type="radio"]:checked');
            if (radios.length !== <?= count($questoes) ?>) {
                e.preventDefault();
                alert('Por favor, responda todas as questões antes de enviar.');
            }
        });
        
        // Ativa o estado 'active' nos botões de rádio quando selecionados
        document.querySelectorAll('.btn-group-toggle input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                this.closest('label').classList.toggle('active', this.checked);
            });
        });
    </script>
</body>
</html>