<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/elementos-compartilhados/monta-paginas.php';

$headerUnico = __DIR__ . '/inc.valores-sites-e-landingpage-para-psicologos/header.php';
$bodyUnico   = __DIR__ . '/inc.valores-sites-e-landingpage-para-psicologos/valores-sites-e-landingpage-para-psicologos.php';
$schemaOrg   = __DIR__ . '/inc.valores-sites-e-landingpage-para-psicologos/schema-org.php';

montarPagina($headerUnico, $bodyUnico, $schemaOrg);
?>