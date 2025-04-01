document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('ysq-form');
    
    // Função para salvar no localStorage
    function saveToCache() {
        const formData = new FormData(form);
        const responses = {};
        
        for (const [key, value] of formData.entries()) {
            if (key.startsWith('questao_')) {
                responses[key] = value;
            }
        }
        
        localStorage.setItem('ysq_respostas_cache', JSON.stringify(responses));
    }
    
    // Função para carregar do cache
    function loadFromCache() {
        const cached = localStorage.getItem('ysq_respostas_cache');
        if (cached) {
            const responses = JSON.parse(cached);
            
            for (const [key, value] of Object.entries(responses)) {
                const input = form.querySelector(`input[name="${key}"][value="${value}"]`);
                if (input) {
                    input.checked = true;
                    // Ativa a classe 'active' no Bootstrap
                    input.closest('label').classList.add('active');
                }
            }
        }
    }
    
    // Carrega cache ao iniciar
    loadFromCache();
    
    // Salva no cache ao alterar respostas
    form.addEventListener('change', function(e) {
        if (e.target.name && e.target.name.startsWith('questao_')) {
            saveToCache();
        }
    });
    
   
});