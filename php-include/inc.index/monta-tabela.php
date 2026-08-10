<?php
function gerarLinhasTabela($dados) {
    $html = '';
    foreach ($dados as $dado) {
        // Coluna 1 - Imagem
        $coluna1 = '<td class="align-middle text-center">
                        <img src="' . htmlspecialchars($dado['imagem']['src']) . '" 
                             alt="' . htmlspecialchars($dado['imagem']['alt']) . '" 
                             class="rounded img-fluid" 
                             style="width: 80px; height: 80px; object-fit: cover;" 
                             width="80" height="80"
                             itemprop="image"
                             loading="lazy">
                    </td>';
        
        // Coluna 2 - Nome e Link
        $coluna2 = '<td class="align-middle">
                        <p class="fw-bold mb-1" itemprop="name">' . htmlspecialchars($dado['nome']) . '</p>
                        <a href="' . htmlspecialchars($dado['link']) . '" 
                           class="btn btn-outline-primary btn-sm mt-1" 
                           target="_blank" 
                           rel="noopener"
                           itemprop="url"
                           title="' . htmlspecialchars($dado['titulo']) . '">
                            Visitar Perfil <i class="fas fa-external-link-alt fa-xs ms-1"></i>
                        </a>
                    </td>';
        
        // Coluna 3 - Badges / Especialidades
        $coluna3 = '<td class="align-middle text-wrap">';
        foreach ($dado['badges'] as $badge) {
            $coluna3 .= '<span class="badge rounded-pill bg-' . htmlspecialchars($badge['cor']) . ' me-1 mb-1 fw-normal">' . htmlspecialchars($badge['texto']) . '</span> ';
        }
        $coluna3 .= '</td>';

        // Monta a linha com escopo Schema.org (Physician)
        $html .= '<tr itemscope itemtype="https://schema.org/Physician">' . $coluna1 . $coluna2 . $coluna3 . '</tr>';
    }
    return $html;
}

// Dados mantidos
$dadosTabela = [
    [
        'imagem' => [
            'src' => 'https://tea-tdah-adulto.psicologosespecialistas.com.br/image/sobre/psicologa-especialista-no-tratamento-de-tea-e-de-tdah-adulto.webp',
            'alt' => 'Foto de Daniele Mendes - Psicóloga especialista'
        ],
        'nome' => 'Daniele Mendes - CRP 07/21763',
        'link' => 'https://tea-tdah-adulto.psicologosespecialistas.com.br/',
        'titulo' => 'Psicóloga especialista em avaliação e tratamento de TEA e TDAH em adultos',
        'badges' => [
            ['texto' => 'Avaliação Neuropsicológica', 'cor' => 'primary'],
            ['texto' => 'Tratamento de Autismo (TEA)', 'cor' => 'info'],
            ['texto' => 'Tratamento de TDAH', 'cor' => 'primary'],
            ['texto' => 'Supervisão', 'cor' => 'info'],
            ['texto' => 'Mentoria', 'cor' => 'primary'],
            ['texto' => 'Atendimento Psicológico Adulto', 'cor' => 'info'],
            ['texto' => 'Terapia Cognitivo Comportamental', 'cor' => 'primary'],
            ['texto' => 'Atendimento Online', 'cor' => 'info']
        ]
    ],
    [
        'imagem' => [
            'src' => 'https://psicologosespecialistas.com.br/php-include/image/index/psicologa-andrea-pires-waldman.webp',
            'alt' => 'Foto de Andréa Pires Waldman - Psicóloga especialista'
        ],
        'nome' => 'Andréa Pires Waldman - CRP 07/20531',
        'link' => 'https://waldmanpsicologia.com.br/',
        'titulo' => 'Avaliação psicológica e psicologia jurídica',
        'badges' => [
            ['texto' => 'Avaliação Psicológica', 'cor' => 'primary'],
            ['texto' => 'Psicologia Jurídica', 'cor' => 'info'],
            ['texto' => 'Avaliação para Concursos', 'cor' => 'primary'],
            ['texto' => 'Avaliação Pré-cirúrgica', 'cor' => 'info'],
            ['texto' => 'Supervisão', 'cor' => 'primary'],
            ['texto' => 'Psicóloga Perita', 'cor' => 'info'],
            ['texto' => 'Atendimento Online', 'cor' => 'primary'],
            ['texto' => 'Porto Alegre', 'cor' => 'info'],
            ['texto' => 'Rio Grande do Sul', 'cor' => 'primary'],
            ['texto' => 'Atendimento Online', 'cor' => 'info']
        ]
    ]
];

echo gerarLinhasTabela($dadosTabela);
?>