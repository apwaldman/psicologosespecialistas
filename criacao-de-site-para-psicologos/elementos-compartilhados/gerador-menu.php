
<?php 
function gerarMenuCursos($id, $itens) {
    $html = '<ul class="dropdown-menu" aria-labelledby="' . $id . '">';
    foreach ($itens as $item) {
        $html .= '<li><a class="dropdown-item text-dark" href="' . $item['link'] . '" title="' . $item['titulo'] . '">' . $item['texto'] . '</a></li>';
    }
    $html .= '</ul>';
    return $html;
}


  $itensMenuCursos = [       
        [
            'titulo' => 'Curso do Teste Palográfico de Personalidade',
            'link' => 'https://cursos.waldmanpsicologia.com.br/curso-online-teste-palografico-com-certificado.php',
            'texto' => 'Curso Palográfico'
        ],
        [
            'titulo' => 'Avaliação psicológica para concursos públicos',
            'link' => 'https://cursos.waldmanpsicologia.com.br/curso-avaliacao-psicologica-para-concursos-publicos.php',
            'texto' => 'Curso Avaliação psicológica para concursos'
        ],
        [
            'titulo' => 'Avaliação psicológica: curso online sobre testes de atenção',
            'link' => 'https://cursos.waldmanpsicologia.com.br/mentoria-vip-laudo-psicologico-incontestavel.php',
            'texto' => 'Mentoria VIP: Laudo Psicológico Incontestável'
        ],
        [
            'titulo' => 'Supervisão em avaliação psicológica',
            'link' => 'https://cursos.waldmanpsicologia.com.br/kit-de-documentos-psicologicos.php',
            'texto' => 'Kit de documentos psicológicos'
        ]
    ];
     $itensMenuSupervisao = [             
        [
            'titulo' => 'Diferença entre testagem psicológica e avaliação psicológica',
            'link' => 'https://cursos.waldmanpsicologia.com.br/diferenca-entre-testagem-psicologica-e-avaliacao-psicologica.php',
            'texto' => 'Diferença entre testagem psicológica e avaliação psicológica'
        ],
        [
            'titulo' => 'Como escrever o laudo psicológico',
            'link' => 'https://cursos.waldmanpsicologia.com.br/supervisao-como-escrever-laudo-psicologico.php',
            'texto' => 'Como escrever o laudo psicológico'
        ]
    ];
    

echo gerarMenuCursos('navbarMenuCursos', $itensMenuCursos);
echo gerarMenuCursos('navbarMenuSupervisao', $itensMenuSupervisao);

?>
