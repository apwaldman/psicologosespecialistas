<div class="custom-whatsapp-container" id="customWhatsappPopup">
    <button class="custom-close-whats-btn" id="customCloseBtn"></button>
    <a href="https://wa.me/5551998001919?text=Vim%20por%20meio%20do%20seu%20site%20e%20gostaria%20de%20falar%20sobre..." target="_blank" class="whatsapp-link">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/WhatsApp.svg/2044px-WhatsApp.svg.png" alt="WhatsApp" width="60" height="60">
    </a>
    <div class="custom-whatsapp-message">
        Boas vindas! Mande sua mensagem por aqui.
    </div>
</div>


<script>
  // Exibir o popup somente se ainda não foi fechado nesta sessão
  const customWhatsappPopup = document.getElementById('customWhatsappPopup');
  const customCloseBtn = document.getElementById('customCloseBtn');

  if (sessionStorage.getItem('customWhatsappClosed') !== 'true') {
    customWhatsappPopup.style.display = 'flex';
  }

  customCloseBtn.addEventListener('click', () => {
    customWhatsappPopup.style.display = 'none';
    sessionStorage.setItem('customWhatsappClosed', 'true');
  });
</script>
