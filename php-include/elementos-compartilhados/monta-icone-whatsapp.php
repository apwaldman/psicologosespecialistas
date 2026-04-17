<?php
// Recebe o número como parâmetro, com um valor padrão (vazio)
$telefone = isset($telefone) ? $telefone : "5551998001919";
?>

<div class="custom-whatsapp-container" id="customWhatsappPopup">   
    <a href="https://wa.me/<?php echo $telefone; ?>?text=Vim%20por%20meio%20do%20seu%20site%20e%20gostaria%20de%20falar%20sobre..." target="_blank" class="whatsapp-link">
        <i class="fab fa-whatsapp" style="font-size:60px; color:#25D366;"></i>
    </a>
</div>