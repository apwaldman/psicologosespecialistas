<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/elementos-compartilhados/monta-paginas.php';

$headerUnico = __DIR__ . '/inc.criacao-de-perfil-no-google-maps/header.php';
$bodyUnico   = __DIR__ . '/inc.criacao-de-perfil-no-google-maps/criacao-de-perfil-no-google-maps.php';
$schemaOrg   = __DIR__ . '/inc.criacao-de-perfil-no-google-maps/schema-org.php';

montarPagina($headerUnico, $bodyUnico, $schemaOrg);
?>