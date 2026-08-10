<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm py-3">
    <div class="container justify-content-center">
        <a class="navbar-brand m-0" href="https://psicologosespecialistas.com.br/" title="Psicólogos Especialistas - Página Inicial">
            <img src="https://psicologosespecialistas.com.br/php-include/image/logo-psicologos-especialistas.webp" 
                 class="img-fluid custom-image-index" 
                 alt="Logo Psicólogos Especialistas" 
                 width="250" height="60"
                 loading="eager"> 
        </a>
    </div>    
</nav>

<?php include 'icone-whatsapp.php'; ?>
<!-- Seção de Ações para Psicólogos -->
<div class="container my-4">
    <div class="row g-3 justify-content-center">
        <!-- Botão 1: Solicitar um Novo Site -->
        <div class="col-12 col-md-6 col-lg-5">
            <a href="https://psicologosespecialistas.com.br/site-para-psicologos.php" target="_blank"
               class="btn btn-outline-primary btn-lg w-100 p-3 d-flex align-items-center justify-content-center gap-2 shadow-sm rounded-3"
               title="Saiba como ter o seu próprio site profissional de psicologia">
                <i class="fas fa-laptop-code fs-4"></i>
                <div class="text-start">
                    <span class="d-block fw-bold fs-6">Quer um site profissional?</span>
                    <small class="d-block text-muted" style="font-size: 0.8rem;">Veja como solicitar seu site exclusivo</small>
                </div>
            </a>
        </div>

        <!-- Botão 2: Divulgar Site Existente -->
        <div class="col-12 col-md-6 col-lg-5">
            <a href="https://psicologosespecialistas.com.br/divulgar-site.php" target="_blank"
               class="btn btn-primary btn-lg w-100 p-3 d-flex align-items-center justify-content-center gap-2 shadow-sm rounded-3"
               title="Divulgue seu site e serviços na nossa página de especialistas">
                <i class="fas fa-bullhorn fs-4"></i>
                <div class="text-start">
                    <span class="d-block fw-bold fs-6">Já tem um site?</span>
                    <small class="d-block text-white-50" style="font-size: 0.8rem;">Divulgue seus serviços aqui no portal</small>
                </div>
            </a>
        </div>
    </div>
</div>

<main>
    <!-- Seção Hero / Apresentação -->
    <section class="container my-5 text-center">
        <h1 class="text-dark fw-bold mb-3">Encontre Psicólogos Especialistas Perto de Você</h1>
        <h2 class="text-secondary fs-4 mb-4">Conectando você ao profissional ideal para suas necessidades</h2>
        <p class="text-muted col-lg-10 mx-auto leading-relaxed">
            Bem-vindo ao nosso portal! Aqui você encontra psicólogos especialistas em diversas áreas, como 
            terapia cognitivo-comportamental, psicologia jurídica, avaliação neuropsicológica e muito mais. 
            Facilitamos sua busca pelo profissional ideal com atendimento personalizado e confiável.
        </p>
    </section>

<!-- Campo de Busca e Tabela -->
<section class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 mb-4">
            <div class="input-group input-group-lg">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input class="form-control border-start-0 shadow-sm" 
                       id="myInput" 
                       type="search" 
                       placeholder="Buscar por nome, cidade ou especialidade..." 
                       aria-label="Buscar psicólogo">
            </div>
        </div>
    </div>

    <div class="table-responsive shadow-sm rounded border">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th scope="col" style="width: 120px;">Foto</th>
                    <th scope="col">Profissional</th>
                    <th scope="col">Especialidades & Palavras-chave</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php include 'monta-tabela.php'; ?>
            </tbody>
        </table>
    </div>
</section>

    <!-- FAQ Accordion -->
    <section class="container my-5">
        <h2 class="text-center mb-4">Perguntas Frequentes</h2>
        <div class="accordion shadow-sm" id="faqAccordion">
            <div class="accordion-item">
                <h3 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Como este site ajuda os psicólogos?
                    </button>
                </h3>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Este site foi criado especialmente para psicólogos que desejam aumentar sua presença online. Cada profissional pode criar uma página personalizada com informações detalhadas e contar com técnicas avançadas de SEO.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h3 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Como os clientes encontram os psicólogos no site?
                    </button>
                </h3>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        O site possui um campo de busca intuitivo que permite encontrar psicólogos por palavras-chave, especialidades ou localização.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h3 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Quais vantagens o site oferece para os psicólogos?
                    </button>
                </h3>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Oferece páginas personalizadas, visibilidade para busca regional (SEO Local) e design totalmente responsivo para dispositivos móveis.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h3 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        O site é seguro para os clientes e psicólogos?
                    </button>
                </h3>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Sim! Utilizamos protocolos de segurança SSL para proteger os dados e garantir uma navegação segura.
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    $("#myInput").on("keyup search", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});
</script>