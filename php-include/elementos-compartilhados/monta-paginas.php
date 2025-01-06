<?php
    // Função para incluir o conteúdo da página
    function incluirPaginas($includeHeaderUnico, $includeBodyUnico, $includeFooterUnico) {
        // Inclusão do primeiro arquivo que sempre será uma string diferente que deve ser formatada como include
        if (!empty($includeHeaderUnico)) {
            include($includeHeaderUnico); // Inclui o conteúdo único 1
        }

        // Inclusão dos conteúdos gerais (fixos em um arquivo único)
        include('../php-include/elementos-compartilhados/inc.header-dependencias.php'); // Inclui o conteúdo geral 1
        
        // Inclusão do segundo arquivo único
        if (!empty($includeBodyUnico)) {
            include($includeBodyUnico); // Inclui o conteúdo único 2
        }
        
        // Inclusão do terceiro arquivo único
        if (!empty($includeFooterUnico)) {
            include($includeFooterUnico); // Inclui o conteúdo único 3
        }
    }
?>
