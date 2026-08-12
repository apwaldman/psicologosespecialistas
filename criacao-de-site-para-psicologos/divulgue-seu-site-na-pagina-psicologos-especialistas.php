<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/elementos-compartilhados/monta-paginas.php';

$headerUnico = __DIR__ . '/inc.divulgue-seu-site-na-pagina-psicologos-especialistas/header.php';
$bodyUnico   = __DIR__ . '/inc.divulgue-seu-site-na-pagina-psicologos-especialistas/divulgue-seu-site-na-pagina-psicologos-especialistas.php';
$schemaOrg   = __DIR__ . '/inc.divulgue-seu-site-na-pagina-psicologos-especialistas/schema-org.php';

montarPagina($headerUnico, $bodyUnico, $schemaOrg);
?>