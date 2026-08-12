<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/elementos-compartilhados/monta-paginas.php';

$headerUnico = __DIR__ . '/divulgacao-de-sites-psicologicos/header.php';
$bodyUnico   = __DIR__ . '/divulgacao-de-sites-psicologicos/divulgacao-de-sites-psicologicos.php';
$schemaOrg   = __DIR__ . '/divulgacao-de-sites-psicologicos/schema-org.php';

montarPagina($headerUnico, $bodyUnico, $schemaOrg);
?>