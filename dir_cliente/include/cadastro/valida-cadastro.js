
    $(document).ready(function() {
      

        // Validação em tempo real
        $('input').on('blur', function() {
            const input = $(this);
            const errorDiv = $('#error-' + input.attr('name'));
            if (input.val() === '') {
                errorDiv.text('Este campo é obrigatório.');
            } else {
                errorDiv.text('');
            }
        });

       

        // Fechar popup das mensagens de erro
        $('#btnFecharPopupMsgErro').on('click', function() {
            $('#popupOverlay').fadeOut();
        });

    });
// Função para salvar os dados do formulário na variável temporária (sessionStorage)
function saveFormData() {
    const formData = {
        nome_completo: document.getElementById('nome_completo').value,
        id_numero: document.getElementById('id_numero').value,       
        senha: document.getElementById('senha').value,
        confirmacao_senha: document.getElementById('confirmacao_senha').value
    };

    // Salva os dados no sessionStorage
    sessionStorage.setItem('formData', JSON.stringify(formData));
}

// Função para preencher os dados do formulário a partir da variável temporária (sessionStorage)
function populateFormData() {
    const formData = JSON.parse(sessionStorage.getItem('formData'));

    if (formData) {
        document.getElementById('nome_completo').value = formData.nome_completo;
        document.getElementById('id_numero').value = formData.id_numero;       
        document.getElementById('senha').value = formData.senha;
        document.getElementById('confirmacao_senha').value = formData.confirmacao_senha;
    }
}

// Função para limpar os dados do formulário após o envio
function clearFormData() {
   // sessionStorage.removeItem('formData');
}

// Evento para preencher os dados ao carregar a página
window.onload = function() {
    populateFormData();
};

// Evento de envio do formulário
document.querySelector('form').addEventListener('submit', function(event) {
    // Salvar dados no sessionStorage antes do envio
    saveFormData();

    // Simular erro no envio (você pode substituir esta parte com o seu código real de validação)
    const error = false; // Altere para `true` se houver erro na validação

    if (error) {
        event.preventDefault(); // Impede o envio do formulário
        alert("Ocorreu um erro. Verifique os campos.");
    } else {
        // Limpar os dados após envio bem-sucedido
        clearFormData();
    }
});