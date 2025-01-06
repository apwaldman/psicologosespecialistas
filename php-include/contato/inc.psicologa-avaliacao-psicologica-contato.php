<section class="ftco-section contact-section" itemscope itemtype="http://schema.org/Psychologist">
    <div class="container text-center" role="banner">
        <h1 class="text-secondary" itemprop="name">Waldman Psicologia</h1>
        <p itemprop="jobTitle">Psicóloga Andréa Pires Waldman - CRP 07/20531</p>
        <a class="nav-link" href="https://api.whatsapp.com/send?phone=5551998001919" title="Psicóloga - Porto Alegre" target="_blank" rel="noopener noreferrer">
		    <i class="fab fa-whatsapp"></i> (51) 99800-1919
		</a>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 d-flex">                
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3278.6850307383097!2d-51.21511072454066!3d-30.034335030807522!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9519795708f1dfdd%3A0x755de5279df233e9!2sPsic%C3%B3loga%20perita%20e%20avalia%C3%A7%C3%A3o%20psicol%C3%B3gica%20para%20concursos%20p%C3%BAblicos-%20Waldman%20Psicologia!5e1!3m2!1spt-BR!2sbr!4v1734881519620!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="col-md-6 d-flex">
                <?php
                $erro = null;
                $sucesso = null;
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    include "contato_controller.php";
                    if (!empty($erro)) {
                        echo '<p style="color: red;">' . htmlspecialchars($erro) . '</p>';
                    }
                    if (!empty($sucesso)) {
                        echo '<div id="popup" class="popup" style="display: block;">';
                        echo '<span class="close-btn" onclick="closePopup()">&times;</span>';
                        echo '<p>' . htmlspecialchars($sucesso) . '</p>';
                        echo '</div>';
                    }
                }
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nome">Nome:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input type="tel" class="form-control" id="telefone" name="telefone">
                    </div>
                    <div class="form-group">
                        <label for="assunto">Assunto:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="assunto" name="assunto" required>
                    </div>
                    <div class="form-group">
                        <label for="mensagem">Mensagem:<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="mensagem" name="mensagem" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="arquivo">Arquivo:</label>
                        <input type="file" class="form-control-file" id="arquivo" name="arquivo">
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                    <button type="reset" class="btn btn-secondary">Limpar</button>
                </form>
                <script>
                    function closePopup() {
                        document.getElementById("popup").style.display = "none";
                    }
                </script>
            </div>
        </div>
    </div>
<hr>
    <div class="container">
    <div itemscope itemtype="http://schema.org/Psychologist">
        <div class="contact-info">
            <div class="contact-header">
                <img src="https://waldmanpsicologia.com.br/images/sobre/psicologa-andrea-pires-waldman.webp" alt="Andréa Pires Waldman - Psicóloga" itemprop="image" class="profile-photo">
                <div>
                    <h1 itemprop="name">Andréa Pires Waldman CRP 07/20531 - Psicóloga Especialista em Avaliação Psicológica e Psicologia Jurídica</h1>
                </div>
            </div>

            <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                <p>
                    <i class="fas fa-map-marker-alt"></i>
                    <span itemprop="streetAddress">Rua General João Telles, 542 - sala 403</span> -
                    <span itemprop="addressLocality">Bom Fim</span>,
                    <span itemprop="addressRegion">Porto Alegre</span> -
                    <span itemprop="addressRegion">RS</span>,
                    <span itemprop="postalCode">90035-120</span>
                </p>
            </div>

            <p>
            <i class="fas fa-phone"></i>
            <a href="tel:+5551998001919" itemprop="telephone">+55 (51) 99800-1919</a>
            </p>

            <div class="specialties">
                <h2>Especialidades e Destaques:</h2>
                <p itemprop="description">
                    Psicóloga premiada com o Prêmio Competência Profissional em 2023 e o Prêmio Profissional de Sucesso em 2023, com vasta experiência em Avaliação Psicológica e Psicologia Jurídica. Atuação focada em fornecer um atendimento ético, qualificado e humanizado.
                </p>
            </div>

            <div class="services">
                <h2>Serviços Oferecidos:</h2>
                <ul>
                    <li itemprop="serviceOffered"><strong>Avaliação Psicológica:</strong> Online e presencial; para concursos públicos, cirurgias (vasectomia, laqueadura, bariátrica), CMA ANAC, avaliações psicossociais (NR 33 e 35), avaliações periciais.</li>
                    <li itemprop="serviceOffered"><strong>Psicologia Jurídica:</strong> Perícias psicológicas, assistência técnica, formulação de quesitos, laudos e pareceres em causas cíveis, criminais e de concursos públicos.</li>
                    <li itemprop="serviceOffered"><strong>Cursos:</strong> Síncronos e assíncronos em avaliação psicológica e psicologia jurídica.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<hr>
    <div class="container mt-5" itemprop="description"> 
        <h2>Especialidades em Avaliação Psicológica e Psicologia Jurídica</h2>
        <p>A Psicóloga Andréa Pires Waldman oferece serviços especializados em Avaliação Psicológica e Psicologia Jurídica em Porto Alegre, RS, com atendimento online e presencial. Com vasta experiência e reconhecimento, incluindo o Prêmio Competência Profissional em 2023 e o Prêmio Profissional de Sucesso em 2023, a Psicóloga Andréa proporciona um atendimento ético, qualificado e humanizado.</p>

        <h3>Serviços Oferecidos:</h3>
        <ul>
            <li itemprop="serviceOffered"><strong>Avaliação Psicológica:</strong> Online e presencial; para concursos públicos, cirurgias (vasectomia, laqueadura, bariátrica), CMA ANAC, avaliações psicossociais (NR 33 e 35), avaliações periciais.</li>
            <li itemprop="serviceOffered"><strong>Psicologia Jurídica:</strong> Perícias psicológicas, assistência técnica, formulação de quesitos, laudos e pareceres em causas cíveis, criminais e de concursos públicos.</li>
            <li itemprop="serviceOffered"><strong>Cursos:</strong> Síncronos e assíncronos em avaliação psicológica e psicologia jurídica.</li>
        </ul>

        <p>Entre em contato para agendar sua consulta ou obter mais informações sobre nossos serviços.</p>
    </div>
</section>

<div class="container mt-5" itemscope itemtype="http://schema.org/WebPage"> 
    <div itemprop="mainContentOfPage">
        <h2>Avaliação Psicológica e Psicologia Jurídica em Porto Alegre: Andréa Pires Waldman</h2>

        <p>Você está buscando serviços de <strong>avaliação psicológica</strong> ou necessita de um profissional especializado em <strong>psicologia jurídica que atue em todo o Brasil</strong>? A Psicóloga Andréa Pires Waldman, CRP 07/20531, oferece atendimento ético, qualificado e humanizado, com vasta experiência em ambas as áreas. Com o reconhecimento do Prêmio Competência Profissional em 2023 e o Prêmio Profissional de Sucesso em 2023, Andréa se destaca por sua atuação dedicada e comprometida com o bem-estar de seus clientes.</p>

        <h3>Serviços de Avaliação Psicológica:</h3>
        <p>A <strong>avaliação psicológica</strong> é um processo fundamental para diversas finalidades, como:</p>
        <ul>
            <li><strong>Concursos Públicos:</strong> Avaliação psicológica para concursos, assegurando a aptidão para o cargo.</li>
            <li><strong>Cirurgias (Vasectomia, Laqueadura, Bariátrica):</strong> Avaliação pré-operatória, auxiliando na preparação emocional para o procedimento.</li>
            <li><strong>CMA ANAC:</strong> Avaliação psicológica para obtenção ou renovação de licenças aeronáuticas.</li>
            <li><strong>Avaliações Psicossociais (NR 33 e NR 35):</strong> Avaliação para trabalho em altura e espaços confinados, garantindo a segurança no ambiente laboral.</li>
            <li><strong>Avaliações Periciais:</strong> Elaboração de laudos periciais para diversas finalidades.</li>
        </ul>

        <h3>Serviços de Psicologia Jurídica:</h3>
        <p>A <strong>psicologia jurídica</strong> atua em interface com o Direito, oferecendo suporte técnico e científico em diversas demandas, como:</p>
        <ul>
            <li><strong>Perícias Psicológicas:</strong> Elaboração de laudos periciais em processos judiciais.</li>
            <li><strong>Assistência Técnica em Perícias Psicológicas:</strong> Acompanhamento e orientação em perícias, garantindo a defesa dos direitos das partes.</li>
            <li><strong>Formulação de Quesitos:</strong> Elaboração de perguntas técnicas para auxiliar o trabalho do perito.</li>
            <li><strong>Laudos e Pareceres:</strong> Documentos técnicos que auxiliam na tomada de decisões judiciais em causas cíveis, criminais e de concursos públicos.</li>
        </ul>

        <h3>Atuação em Porto Alegre e Online:</h3>
        <p>A Psicóloga Andréa Pires Waldman oferece atendimento em <strong>Porto Alegre, RS</strong>, no bairro Bom Fim, em local de fácil acesso. Além disso, disponibiliza a modalidade de atendimento <strong>online</strong>, ampliando o acesso aos seus serviços para clientes em outras localidades.</p>

        <h3>Entre em Contato:</h3>
        <p>Se você necessita de um profissional qualificado em <strong>avaliação psicológica</strong> ou <strong>psicologia jurídica em Porto Alegre</strong>, entre em contato com a Psicóloga Andréa Pires Waldman. Agende sua consulta e obtenha o suporte necessário para suas demandas.</p>

        <div itemprop="author" itemscope itemtype="http://schema.org/Person"> 
            <meta itemprop="name" content="Andréa Pires Waldman">
            <meta itemprop="jobTitle" content="Psicóloga">
        </div>

        <meta itemprop="datePublished" content="2024-10-27"> 
        <meta itemprop="url" content="https://waldmanpsicologia.com.br/contato.php"> 
    </div>
</div>


