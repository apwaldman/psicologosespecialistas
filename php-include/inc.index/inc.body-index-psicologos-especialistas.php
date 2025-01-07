<nav class="navbar navbar-expand navbar-light bg-light">
    <div class="container d-flex justify-content-center">
        <a class="navbar-brand" href="https://psicologosespecialistas.com.br/" target="_blank" title="Psicólogos especialistas">
            <img src="https://psicologosespecialistas.com.br/php-include/image/logo-psicologos-especialistas.webp" 
                class="img-fluid custom-image-index" 
                alt="Psicólogos especialistas: aqui você encontra o profissional certo!" 
                loading="lazy"> 
        </a>
    </div>    
</nav>
<?php include 'icone-whatsapp.php'; ?>

<div class="container my-5">
    <h1 class="text-dark text-center">Encontre Psicólogos Especialistas Perto de Você</h1>
    <h2 class="text-secondary text-center">Conectando você ao profissional ideal para suas necessidades</h2>
    <p class="text-muted text-center">
        Bem-vindo ao nosso portal! Aqui, você encontra psicólogos especialistas em diversas áreas, como 
        terapia cognitivo-comportamental, psicologia jurídica, avaliação neuropsicológica, e muito mais. 
        Com uma interface intuitiva e otimizada, nosso site facilita sua busca pelo profissional que melhor 
        atende às suas necessidades, garantindo um atendimento personalizado e confiável.
    </p>
</div>

<div class="container my-5">
    <input class="form-control my-5" id="myInput" type="text" 
           style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);" 
           placeholder="Buscar..">    

    <!-- Adicione a classe table-responsive aqui -->
    <div class="table-responsive">
        <table class="table table-hover my-5">
            <thead>
                <tr>
                    <th></th>
                    <th>Profissional</th>
                    <th>Palavras chave</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php include 'monta-tabela.php'; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="container my-5">
    <section itemscope itemtype="https://schema.org/FAQPage">
        <h2 class="text-center mb-4" itemprop="headline">Perguntas Frequentes</h2>
        <div class="accordion" id="faqAccordion">
            <!-- FAQ 1 -->
            <div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <span itemprop="name">Como este site ajuda os psicólogos?</span>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                    <div class="accordion-body" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <p itemprop="text">
                            Este site foi criado especialmente para psicólogos que desejam aumentar sua presença online. 
                            Cada profissional pode criar uma página personalizada com informações detalhadas sobre seus serviços, 
                            especialidades e contato. O site utiliza técnicas avançadas de SEO para garantir que os psicólogos sejam 
                            facilmente encontrados por clientes que buscam serviços específicos.
                        </p>
                    </div>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <span itemprop="name">Como os clientes encontram os psicólogos no site?</span>
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                    <div class="accordion-body" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <p itemprop="text">
                            O site possui um campo de busca intuitivo que permite aos clientes encontrar psicólogos com base em palavras-chave, 
                            especialidades, localização ou outras preferências. A integração de microdados ajuda os motores de busca como o Google 
                            a exibir informações claras e relevantes sobre os profissionais listados, aumentando a visibilidade.
                        </p>
                    </div>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <span itemprop="name">Quais vantagens o site oferece para os psicólogos?</span>
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                    <div class="accordion-body" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <p itemprop="text">
                            Além de aumentar a visibilidade online, o site oferece páginas personalizadas que destacam as especialidades e diferenciais 
                            dos psicólogos. Os profissionais podem alcançar novos públicos e facilitar o agendamento de consultas. Além disso, 
                            o site utiliza design responsivo e estratégias de SEO local para garantir que os psicólogos sejam encontrados 
                            facilmente em dispositivos móveis e buscas regionais.
                        </p>
                    </div>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <span itemprop="name">O site é seguro para os clientes e psicólogos?</span>
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                    <div class="accordion-body" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <p itemprop="text">
                            Sim! O site utiliza protocolos de segurança SSL para proteger os dados dos clientes e psicólogos. As páginas são desenvolvidas 
                            com foco em privacidade e confiabilidade, garantindo uma experiência segura para todos os usuários.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<script>
$(document).ready(function() {
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>