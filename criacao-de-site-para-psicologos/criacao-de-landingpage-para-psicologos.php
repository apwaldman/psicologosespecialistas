<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/elementos-compartilhados/monta-paginas.php';

$headerUnico = __DIR__ . '/criacao-de-landingpage-para-psicologos/header.php';
$bodyUnico   = __DIR__ . '/criacao-de-landingpage-para-psicologos/criacao-de-landingpage-para-psicologos.php';
$schemaOrg   = __DIR__ . '/criacao-de-landingpage-para-psicologos/schema-org.php';

montarPagina($headerUnico, $bodyUnico, $schemaOrg);
?>