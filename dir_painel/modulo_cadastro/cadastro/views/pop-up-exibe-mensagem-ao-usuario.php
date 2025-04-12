<!-- Popup Personalizado -->
<div id="popupOverlayMsgUsuario" class="popup-msg-usuario-cadastro">
    <div class="popup-content-msg-usuario-cadastro">
        <h3 id="popupTitleMsgUsuario"></h3>
        <p id="popupMessageUsuario"></p>
        <button id="btnFecharPopupMsgErro" class="btn btn-danger">Fechar</button>
    </div>
</div>

<!-- Estilos do Popup -->
<style>
    .popup-msg-usuario-cadastro {
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

    .popup-content-msg-usuario-cadastro {
        background: white;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .popup-content-msg-usuario-cadastro h3 {
        margin-top: 0;
    }

    .popup-content-msg-usuario-cadastro button {
        margin: 5px;
    }
</style>

<!-- Script para Controlar o Popup -->
<script>
    function exibirPopupMsgUsuario(titulo, mensagem) {
        document.getElementById('popupTitleMsgUsuario').innerText = titulo;
        document.getElementById('popupMessageUsuario').innerText = mensagem;
        document.getElementById('popupOverlayMsgUsuario').style.display = 'flex';
    }

    document.getElementById('btnFecharPopupMsgErro').addEventListener('click', function() {
        document.getElementById('popupOverlayMsgUsuario').style.display = 'none';
    });
</script>