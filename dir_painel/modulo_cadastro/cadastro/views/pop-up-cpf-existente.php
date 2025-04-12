<!-- Popup Personalizado -->
<div id="cpfPopup" class="popup-overlay">
    <div class="popup-content">
        <h3>CPF Já Cadastrado</h3>
        <p>O CPF informado já está cadastrado. O que você deseja fazer?</p>
        <button id="btnRecuperarSenha" class="btn btn-primary">Recuperar Senha</button>
        <button id="btnIrParaLogin" class="btn btn-secondary">Ir para Login</button>
        <button id="btnFecharPopup" class="btn btn-danger">Fechar</button>
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