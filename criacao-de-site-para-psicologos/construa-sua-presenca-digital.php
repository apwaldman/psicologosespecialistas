<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/elementos-compartilhados/monta-paginas.php';

$headerUnico = __DIR__ . '/construa-sua-presenca-digital/header.php';
$bodyUnico   = __DIR__ . '/construa-sua-presenca-digital/construa-sua-presenca-digital.php';
$schemaOrg   = __DIR__ . '/construa-sua-presenca-digital/schema-org.php';

montarPagina($headerUnico, $bodyUnico, $schemaOrg);
?>