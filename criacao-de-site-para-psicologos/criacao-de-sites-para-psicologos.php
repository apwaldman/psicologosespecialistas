<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/elementos-compartilhados/monta-paginas.php';

$headerUnico = __DIR__ . '/criacao-de-sites-para-psicologos/header.php';
$bodyUnico   = __DIR__ . '/criacao-de-sites-para-psicologos/criacao-de-sites-para-psicologos.php';
$schemaOrg   = __DIR__ . '/criacao-de-sites-para-psicologos/schema-org.php';

montarPagina($headerUnico, $bodyUnico, $schemaOrg);
?>