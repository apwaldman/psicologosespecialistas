<?php
function montarPagina($headerUnico, $bodyUnico, $schemaOrg) {
    // 1. HEADER SUPERIOR (compartilhado)
    include __DIR__ . '/header-superior.php';
    
    // 2. HEADER ÚNICO DA PÁGINA
    if (!empty($headerUnico)) {
        include $headerUnico;
    }
    
    // 3. SCHEMA.ORG ÚNICO DA PÁGINA
    if (!empty($schemaOrg)) {
        include $schemaOrg;
    }
    
    // 4. HEADER INFERIOR (compartilhado)
    include __DIR__ . '/header-inferior.php';
    
    // 5. MENU (compartilhado)
    include __DIR__ . '/menu-sites-para-psicologos.php';
    
    // 6. BODY ÚNICO DA PÁGINA
    if (!empty($bodyUnico)) {
        include $bodyUnico;
    }

    // 7. FOOTER (compartilhado)
    include __DIR__ . '/footer.php';    
}
?>