
<?php 
function gerarMenuSitesParaPsicologos($id, $itens) {
    $html = '<ul class="dropdown-menu" aria-labelledby="' . $id . '">';
    foreach ($itens as $item) {
        $html .= '<li><a class="dropdown-item text-dark" href="' . $item['link'] . '" title="' . $item['titulo'] . '">' . $item['texto'] . '</a></li>';
    }
    $html .= '</ul>';
    return $html;
}


  $itensMenuServicos = [       
        [
            'titulo' => 'Landing Page para Psicólogos',
            'link' => 'https://criacao-de-site-para-psicologos.psicologosespecialistas.com.br/criacao-de-landingpage-para-psicologos.php',
            'texto' => 'O que são landingpages'
        ],
        [
            'titulo' => 'Sites para Psicólogos',
            'link' => 'https://criacao-de-site-para-psicologos.psicologosespecialistas.com.br/criacao-de-sites-para-psicologos.php',
            'texto' => 'O que são sites'
        ],
        [
            'titulo' => 'Valores de Sites e Landing Pages para Psicólogos',
            'link' => 'https://criacao-de-site-para-psicologos.psicologosespecialistas.com.br/valores-sites-e-landingpage-para-psicologos.php',
            'texto' => 'Valores de Sites e Landing Pages para Psicólogos'
        ],
        [
            'titulo' => 'Criação de sites wordpress para Psicólogos',
            'link' => 'https://criacao-de-site-para-psicologos.psicologosespecialistas.com.br/criacao-de-sites-wordpress-para-psicologos.php',
            'texto' => 'Criação de sites wordpress para Psicólogos'
        ],
        [
            'titulo' => 'Criação de seu perfil no Google Maps',
            'link' => 'https://criacao-de-site-para-psicologos.psicologosespecialistas.com.br/criacao-de-perfil-no-google-maps.php',
            'texto' => 'Criação de seu perfil no Google Maps'
        ]
        ,
        [
            'titulo' => 'Apareça na página Psicólogos Especialistas',
            'link' => 'https://criacao-de-site-para-psicologos.psicologosespecialistas.com.br/divulgue-seu-site-na-pagina-psicologos-especialistas.php',
            'texto' => 'Apareça na página Psicólogos Especialistas'
        ]
    ];
     $itensMenuDicas = [             
        [
            'titulo' => 'Curso do Teste Palográfico de Personalidade',
            'link' => '',
            'texto' => 'Aguarde'
        ],
        [
            'titulo' => 'Avaliação psicológica para concursos públicos',
            'link' => '',
            'texto' => 'Aguarde'
        ]
    ];
    

echo gerarMenuSitesParaPsicologos('navbarMenuCursos', $itensMenuServicos);
echo gerarMenuSitesParaPsicologos('navbarMenuSupervisao', $itensMenuDicas);

?>
