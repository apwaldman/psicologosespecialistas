<nav class="navbar navbar-expand navbar-light bg-light" itemscope itemtype="https://schema.org/Organization">
    <div class="container d-flex justify-content-center bg-light">
        <a class="navbar-brand" href="https://criacao-de-site-para-psicologos.psicologosespecialistas.com.br" target="_blank" title="Psicólogos especialistas" itemprop="url">
            <img src="https://psicologosespecialistas.com.br/php-include/image/logo-psicologos-especialistas.webp"
                class="img-fluid custom-image-index"
                alt="Psicólogos especialistas: aqui você encontra o profissional certo!"
                loading="lazy" width="100" height="100"
                itemprop="logo">
            <meta itemprop="name" content="Psicólogos Especialistas">
            <meta itemprop="description" content="Agência especializada em sites e landing pages para psicólogos.">
        </a>
    </div>
</nav>

<?php include('gerador-menu.php'); ?> 
<?php
// Ensure menu item arrays are defined to avoid undefined variable notices
if (!isset($itensMenuServicos) || !is_array($itensMenuServicos)) {
    $itensMenuServicos = [];
}
if (!isset($itensMenuDicas) || !is_array($itensMenuDicas)) {
    $itensMenuDicas = [];
}
?>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navSitesParaPsicologos" aria-controls="navSitesParaPsicologos" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>        
        <div class="collapse navbar-collapse" id="navSitesParaPsicologos">            
            <ul class="navbar-nav ms-auto">
                <li class="nav-item ">
                    <a class="nav-link" 
                        href="https://criacao-de-site-para-psicologos.psicologosespecialistas.com.br/" 
                        title="Site para psicólogos"
                        target="_blank"                         
                        aria-expanded="false">
                        Início
                    </a> 
                </li>                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"                         
                        title="Cursos para psicólogos e para estudantes de psicologia." 
                        id="navbarMenuSitesParaPsicologos" 
                        role="button" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false">
                        Soluções digitais para psicólogos
                    </a>                
                    <?php echo gerarMenuSitesParaPsicologos('navbarMenuSitesParaPsicologos', $itensMenuServicos); ?>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" 
                        title="Supervisão para psicólogos e para estudantes de psicologia." 
                        id="navbarMenuSEOparaPsicologos" 
                        role="button" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false">
                        Dicas para otimizar seu site
                    </a>                
                    <?php echo gerarMenuSitesParaPsicologos('navbarMenuSEOparaPsicologos', $itensMenuDicas); ?>
                </li>   
                <li><a href="https://api.whatsapp.com/send/?phone=5551998001919" class="nav-btn" target="_blank">Falar no WhatsApp</a></li>                             					
			</ul>
		</div>
	</div>
</nav>
