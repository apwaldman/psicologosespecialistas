<?php
error_reporting(1);
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/elementos-compartilhados/monta-paginas.php';

$headerUnico = __DIR__ . '/inc.index/header.php';
$bodyUnico   = __DIR__ . '/inc.index/index-landingpage-para-psicologos.php';
$schemaOrg   = __DIR__ . '/inc.index/schema-org.php';

montarPagina($headerUnico, $bodyUnico, $schemaOrg);
?>