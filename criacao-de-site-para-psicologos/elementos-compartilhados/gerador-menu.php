
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
