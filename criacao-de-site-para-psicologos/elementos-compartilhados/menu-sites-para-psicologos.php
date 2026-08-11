<nav class="navbar navbar-expand navbar-light bg-light" itemscope itemtype="https://schema.org/Organization">
    <div class="container d-flex justify-content-center bg-light">
        <a class="navbar-brand" href="https://psicologosespecialistas.com.br/" target="_blank" title="Psicólogos especialistas" itemprop="url">
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
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navCursosParaPsicologos" aria-controls="navCursosParaPsicologos" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>        
        <div class="collapse navbar-collapse" id="navCursosParaPsicologos">            
            <ul class="navbar-nav ms-auto">
                <li class="nav-item ">
                    <a class="nav-link" 
                        href="https://cursos.waldmanpsicologia.com.br/" 
                        title="Cursos online para psicólogos e estudantes de psicologia."
                        target="_blank"                         
                        aria-expanded="false">
                        Início
                    </a> 
                </li>
                <li class="nav-item ">
                    <a class="nav-link" 
                        href="https://cursos.waldmanpsicologia.com.br/moodle/" 
                        title="Acesso ao Moodle."
                        target="_blank"                         
                        aria-expanded="false">
                        Acesso ao Moodle
                    </a> 
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"                         
                        title="Cursos para psicólogos e para estudantes de psicologia." 
                        id="navbarMenuCursos" 
                        role="button" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false">
                        Cursos
                    </a>                
                    <?php echo gerarMenuCursos('navbarMenuCursos', $itensMenuCursos); ?>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" 
                        title="Supervisão para psicólogos e para estudantes de psicologia." 
                        id="navbarMenuSupervisao" 
                        role="button" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false">
                        Supervisão
                    </a>                
                    <?php echo gerarMenuCursos('navbarMenuSupervisao', $itensMenuSupervisao); ?>
                </li>                                					
			</ul>
		</div>
	</div>
</nav>
