
    $(document).ready(function() {
        // Máscaras
        $('#cpf').mask('000.000.000-00');       
        $('#celular').mask('+55 (00) 00000-0000');
        $('#cep').mask('00000-000');

        // Calcular idade
        $('#data_nascimento').on('change', function() {
            const dob = new Date($(this).val());
            const today = new Date();
            let age = today.getFullYear() - dob.getFullYear();
            const monthDiff = today.getMonth() - dob.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                age--;
            }
            $('#idade').val(age);
        });

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

       
       // Validação de CPF
        $('#cpf').on('blur', function() {
            const cpf = $(this).val().replace(/\D/g, ''); // Remove caracteres não numéricos
            if (cpf.length !== 11) {
                $('#error-cpf').text('CPF inválido.'); // Verifica se o CPF tem 11 dígitos
            } else {
                if (validaCPF(cpf)) { // Verifica se o CPF é válido
                    $('#error-cpf').text(''); // Limpa a mensagem de erro
                    validaCpfBanco(cpf); // Chama a função para verificar no banco de dados
                } else {
                    $('#error-cpf').text('CPF inválido.'); // Exibe mensagem de erro se o CPF for inválido
                }
            }
        });

        // Função para validar o CPF
        function validaCPF(cpf) {
            cpf = cpf.replace(/[^\d]+/g, ''); // Remove caracteres não numéricos
            if (cpf === '') return false; // Verifica se o CPF está vazio

            // Verifica CPFs inválidos conhecidos
            const cpfsInvalidos = [
                "00000000000", "11111111111", "22222222222", "33333333333",
                "44444444444", "55555555555", "66666666666", "77777777777",
                "88888888888", "99999999999", "01234567890"
            ];
            if (cpfsInvalidos.includes(cpf)) return false;

            // Validação do primeiro dígito verificador
            let add = 0;
            for (let i = 0; i < 9; i++) {
                add += parseInt(cpf.charAt(i)) * (10 - i);
            }
            let rev = 11 - (add % 11);
            if (rev === 10 || rev === 11) rev = 0;
            if (rev !== parseInt(cpf.charAt(9))) return false;

            // Validação do segundo dígito verificador
            add = 0;
            for (let i = 0; i < 10; i++) {
                add += parseInt(cpf.charAt(i)) * (11 - i);
            }
            rev = 11 - (add % 11);
            if (rev === 10 || rev === 11) rev = 0;
            if (rev !== parseInt(cpf.charAt(10))) return false;

            return true; // CPF válido
        }
        
        function validaCpfBanco(cpf){
            $.ajax({
                url: 'https://painel.psicologosespecialistas.com.br/modulo_cadastro/repositories/UsuarioRepository.php',
                method: 'POST',
                data: { 
                    action: 'buscarPorCpf',
                    email: cpf
                    
                },
                dataType: 'json',
                success: function(response) {
                    if (response.exists) {
                        $('#error-cpf').text('CPF já cadastrado.');
                        // Exibir popup personalizado
                        $('#cpfPopup').fadeIn();
                    } else if (response.error) {
                        alert('Erro ao verificar CPF: ' + response.error);
                    } else {
                        $('#error-cpf').text('');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Erro ao verificar CPF. Tente novamente.');
                }
            });
        }

        // Fechar popup
        $('#btnFecharPopup').on('click', function() {
            $('#cpfPopup').fadeOut();
        });

        // Redirecionar para recuperar senha
        $('#btnRecuperarSenha').on('click', function() {
            window.location.href = 'recuperar_senha.php';
        });

        // Redirecionar para login
        $('#btnIrParaLogin').on('click', function() {
            window.location.href = 'index.php';
        });

        // Validação de e-mail
        $('#email').on('blur', function() {
            const email = $(this).val();                        
            if (validateEmail(email)) { // Verifica se o email é válido
                $('#error-email').text(''); // Limpa a mensagem de erro
                validaEmailBanco(email); // Chama a função para verificar no banco de dados
            } else {
                $('#error-email').text('Email inválido.'); // Exibe mensagem de erro se o CPF for inválido
            }
        });


        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        function validaEmailBanco(email){
            $.ajax({
                url: 'https://painel.psicologosespecialistas.com.br/modulo_cadastro/repositories/UsuarioRepository.php',
                method: 'POST',
                data: { 
                    action: 'buscarPorEmail',
                    email: email
                    
                },                
                dataType: 'json',
                success: function(response) {
                    if (response.exists) {
                        $('#error-email').text('E-mail já cadastrado.');
                        // Exibir popup personalizado
                        $('#emailPopup').fadeIn();
                    } else if (response.error) {
                        alert('Erro ao verificar Email: ' + response.error);
                    } else {
                        $('#error-email').text('');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Erro ao verificar Email. Tente novamente.');
                }
            });
        }

        // Fechar popup
        $('#btnFecharPopupEmail').on('click', function() {
            $('#emailPopup').fadeOut();
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
        data_nascimento: document.getElementById('data_nascimento').value,
        idade: document.getElementById('idade').value,
        cpf: document.getElementById('cpf').value,        
        profissao: document.getElementById('profissao').value,
        email: document.getElementById('email').value,
        celular: document.getElementById('celular').value,
        cep: document.getElementById('cep').value,
        endereco: document.getElementById('endereco').value,
        numero: document.getElementById('numero').value,
        complemento: document.getElementById('complemento').value,
        bairro: document.getElementById('bairro').value,
        cidade: document.getElementById('cidade').value,
        estado: document.getElementById('estado').value,
        estado_civil: document.getElementById('estado_civil').value,
        naturalidade: document.getElementById('naturalidade').value,
        escolaridade: document.getElementById('escolaridade').value,
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
        document.getElementById('data_nascimento').value = formData.data_nascimento;
        document.getElementById('idade').value = formData.idade;
        document.getElementById('cpf').value = formData.cpf;       
        document.getElementById('profissao').value = formData.profissao;
        document.getElementById('email').value = formData.email;
        document.getElementById('celular').value = formData.celular;
        document.getElementById('cep').value = formData.cep;
        document.getElementById('endereco').value = formData.endereco;
        document.getElementById('numero').value = formData.numero;
        document.getElementById('complemento').value = formData.complemento;
        document.getElementById('bairro').value = formData.bairro;
        document.getElementById('cidade').value = formData.cidade;
        document.getElementById('estado').value = formData.estado;
        document.getElementById('estado_civil').value = formData.estado_civil;
        document.getElementById('naturalidade').value = formData.naturalidade;
        document.getElementById('escolaridade').value = formData.escolaridade;
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

