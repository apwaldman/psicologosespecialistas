    <!-- ============================================ -->
    <!-- CSS PRINCIPAL E RECURSOS -->
    <!-- ============================================ -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/style.css">  <!-- ← USA A CONSTANTE -->
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/icone-whatsapp.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>/botoes-pg-inicio.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    <!-- ============================================ -->
    <!-- JQUERY (OTIMIZADO) -->
    <!-- ============================================ -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    
    <!-- ============================================ -->
    <!-- BOOTSTRAP -->
    <!-- ============================================ -->
    <script async src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- ============================================ -->
    <!-- VERIFICAÇÃO BING -->
    <!-- ============================================ -->
    <meta name="msvalidate.01" content="<?php echo BING_VERIFICATION; ?>">
    
    <!-- ============================================ -->
    <!-- GOOGLE ANALYTICS -->
    <!-- ============================================ -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo GA_TRACKING_ID; ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo GA_TRACKING_ID; ?>');
    </script>
    
    <!-- ============================================ -->
    <!-- FECHAMENTO DO HEAD E ABERTURA DO BODY -->
    <!-- ============================================ -->
</head>
<body>