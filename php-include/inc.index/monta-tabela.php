<?php
function gerarLinhasTabela($dados) {
    $html = '';
    foreach ($dados as $dado) {
        // Primeira Coluna - Imagem
        $coluna1 = '<td class="align-middle text-center">
                        <img src="' . $dado['imagem']['src'] . '" 
                             alt="' . $dado['imagem']['alt'] . '" 
                             class="rounded mx-auto d-block img-fluid" 
                             style="max-width: 100px; height: auto; object-fit: cover;" 
                             loading="lazy">
                    </td>';
        
        // Segunda Coluna - Nome e Link
        $coluna2 = '<td class="align-middle">
                        <p class="fw-bold">' . $dado['nome'] . '</p>
                        <p>
                            <a href="' . $dado['link'] . '" 
                               class="btn btn-outline-primary btn-sm" 
                               target="_blank" 
                               title="' . $dado['titulo'] . '">
                                Visite meu site
                            </a>
                        </p>
                    </td>';
        
        // Terceira Coluna - Badges
        $coluna3 = '<td class="align-middle text-wrap">';
        foreach ($dado['badges'] as $badge) {
            $coluna3 .= '<span class="badge rounded-pill bg-' . $badge['cor'] . ' me-1 mb-1">' . $badge['texto'] . '</span> ';
        }
        $coluna3 .= '</td>';

        // Combina as colunas em uma linha
        $html .= '<tr>' . $coluna1 . $coluna2 . $coluna3 . '</tr>';
    }
    return $html;
}
// Dados de Exemplo (pode ser movido para outro arquivo ou configurado dinamicamente)
$dadosTabela = [
    [
        'imagem' => [
            'src' => 'https://psicologosespecialistas.com.br/php-include/image/index/psicologa-especialista-no-tratamento-de-tea-e-de-tdah.webp',
            'alt' => 'Psicóloga especialista em avaliação e tratamento de tea e tdah em adultos'
        ],
        'nome' => 'Daniele Mendes - CRP 07/21763',
        'link' => 'https://tea-tdah-adulto.psicologosespecialistas.com.br/',
        'titulo' => 'Psicóloga especialista em avaliação e tratamento de tea e tdah em adultos',
        'badges' => [
            ['texto' => 'Avaliação neuropsicológica', 'cor' => 'primary'],
            ['texto' => 'Avaliação e tratamento de autismo (TEA)', 'cor' => 'info'],
            ['texto' => 'Avaliação e tratamento de TDAH', 'cor' => 'primary'],
            ['texto' => 'Supervisão', 'cor' => 'info'],
            ['texto' => 'Mentoria', 'cor' => 'primary'],
            ['texto' => 'Atendimento Psicológico', 'cor' => 'info'],
            ['texto' => 'Atendimento psicológico de adultos', 'cor' => 'primary'],
            ['texto' => 'Terapia Cognitivo Comportamental', 'cor' => 'info'],
            ['texto' => 'Psicóloga com especialização', 'cor' => 'primary'],
            ['texto' => 'Atendimento online para todo o Brasil', 'cor' => 'info']
        ]
    ],
    [
        'imagem' => [
            'src' => 'https://psicologosespecialistas.com.br/php-include/image/index/psicologa-andrea-pires-waldman.webp',
            'alt' => 'Psicóloga especialista em avaliação psicológica e em psicologia jurídica'
        ],
        'nome' => 'Andréa Pires Waldman - CRP 07/20531',
        'link' => 'https://waldmanpsicologia.com.br/',
        'titulo' => 'avaliação psicológica e em psicologia jurídica',
        'badges' => [
            ['texto' => 'Avaliação Psicológica', 'cor' => 'primary'],
            ['texto' => 'Psicologia Jurídica', 'cor' => 'info'],
            ['texto' => 'Cursos de Psicologia', 'cor' => 'primary'],
            ['texto' => 'Avaliação Psicológica para concursos', 'cor' => 'info'],
            ['texto' => 'Avaliação Psicológica pré-cirúrgica', 'cor' => 'primary'],
            ['texto' => 'Supervisão', 'cor' => 'info'],
            ['texto' => 'Recurso de avaliação psicológica para concursos', 'cor' => 'primary'],
            ['texto' => 'Psicóloga Perita', 'cor' => 'info'],
            ['texto' => 'Psicóloga com especialização', 'cor' => 'primary'],
            ['texto' => 'Atendimento online para todo o Brasil', 'cor' => 'info']
        ]
    ]
];

// Imprime as linhas da tabela
echo gerarLinhasTabela($dadosTabela);
?>
