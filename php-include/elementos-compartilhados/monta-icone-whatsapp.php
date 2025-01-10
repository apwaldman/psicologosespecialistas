<?php
// Recebe o número como parâmetro, com um valor padrão (vazio)
$telefone = isset($telefone) ? $telefone : "5551998001919";
?>

<div class="custom-whatsapp-container" id="customWhatsappPopup">   
    <a href="https://wa.me/<?php echo $telefone; ?>?text=Vim%20por%20meio%20do%20seu%20site%20e%20gostaria%20de%20falar%20sobre..." target="_blank" class="whatsapp-link">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/WhatsApp.svg/2044px-WhatsApp.svg.png" alt="WhatsApp" width="60" height="60">
    </a>
</div>