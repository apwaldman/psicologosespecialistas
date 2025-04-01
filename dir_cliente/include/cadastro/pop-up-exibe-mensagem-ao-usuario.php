<!-- Popup Personalizado -->
<div id="popupOverlay" class="popup-overlay">
    <div class="popup-content">
        <h3 id="popupTitle"></h3>
        <p id="popupMessage"></p>
        <button id="btnFecharPopupMsgErro" class="btn btn-danger">Fechar</button>
    </div>
</div>

<!-- Estilos do Popup -->
<style>
    .popup-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .popup-content {
        background: white;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .popup-content h3 {
        margin-top: 0;
    }

    .popup-content button {
        margin: 5px;
    }
</style>

<!-- Script para Controlar o Popup -->
<script>
    function exibirPopup(titulo, mensagem) {
        document.getElementById('popupTitle').innerText = titulo;
        document.getElementById('popupMessage').innerText = mensagem;
        document.getElementById('popupOverlay').style.display = 'flex';
    }

    document.getElementById('btnFecharPopup').addEventListener('click', function() {
        document.getElementById('popupOverlay').style.display = 'none';
    });
</script>