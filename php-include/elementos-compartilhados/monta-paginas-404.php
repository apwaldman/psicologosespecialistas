<?php
    // Função para incluir o conteúdo da página
    function incluirPaginas404($includeHeaderUnico, $includeFooterUnico) {
        // Inclusão do primeiro arquivo que sempre será uma string diferente que deve ser formatada como include
        if (!empty($includeHeaderUnico)) {
            include($includeHeaderUnico); // Inclui o conteúdo único 1
        }
        // Inclusão dos conteúdos gerais (fixos em um arquivo único)
        include('../php-include/elementos-compartilhados/inc.header-dependencias.php'); // Inclui dependencias compartilhadas
        include('../php-include/inc.404/inc.body.php'); // Inclui o body 404
        
        // Inclusão do terceiro arquivo único
        if (!empty($includeFooterUnico)) {
            include($includeFooterUnico); // Inclui o conteúdo único 3
        }
    }
?>
