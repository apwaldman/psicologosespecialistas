<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/elementos-compartilhados/monta-paginas.php';

$headerUnico = __DIR__ . '/index/header.php';
$bodyUnico   = __DIR__ . '/index/index-landingpage-para-psicologos.php';
$schemaOrg   = __DIR__ . '/index/schema-org.php';

montarPagina($headerUnico, $bodyUnico, $schemaOrg);
?>