document.addEventListener('DOMContentLoaded', function() {
    const psicologoCheckbox = document.getElementById('psicologo');
    const crpField = document.getElementById('crp');
    const profissaoField = document.getElementById('profissao');
    
    function toggleCampos() {
        if (psicologoCheckbox.checked) {
            crpField.closest('.row').style.display = 'flex';
            crpField.required = true;
            profissaoField.closest('.row').style.display = 'none';
            profissaoField.required = false;
        } else {
            crpField.closest('.row').style.display = 'none';
            crpField.required = false;
            profissaoField.closest('.row').style.display = 'flex';
            profissaoField.required = true;
        }
    }
    
    // Estado inicial
    toggleCampos();
    
    // Event listener
    psicologoCheckbox.addEventListener('change', toggleCampos);
});