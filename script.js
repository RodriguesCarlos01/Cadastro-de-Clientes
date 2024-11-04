document.addEventListener('DOMContentLoaded', function() {
    const inputTelefone = document.getElementById('telefone');
  
    inputTelefone.addEventListener('input', function() {
        let value = inputTelefone.value.replace(/\D/g, ''); // Remove tudo que não é número
  
        // Aplica a máscara para o formato (XX) XXXXX-XXXX
        if (value.length > 10) {
            value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3'); // (XX) XXXXX-XXXX
        } else if (value.length > 6) {
            value = value.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3'); // (XX) XXXX-XXXX
        } else if (value.length > 2) {
            value = value.replace(/(\d{2})(\d{0,5})/, '($1) $2'); // (XX) XXXX ou (XX) XXXXX
        } else if (value.length > 0) {
            value = value.replace(/(\d{2})/, '($1) '); // (XX)
        }
  
        inputTelefone.value = value; // Atualiza o valor do campo
    });
  
    // Listener para o envio do formulário
    document.getElementById('formulario').addEventListener('submit', function(e) {
        e.preventDefault(); // Impede o envio normal do formulário
  
        const formData = new FormData(this); // Coleta os dados do formulário
  
        fetch('http://localhost/projeto-banco-de-dados/inserir_cliente.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.id) {
                window.location.href = `resultado_do_cadastro.php?id=${data.id}`; // Redireciona para a página de resultado
            } else if (data.error) {
                console.log('Erro:', data.error);
            }
            document.getElementById('formulario').reset(); // Limpa os campos após o envio
        })
        .catch(error => console.log('Erro ao enviar requisição:', error));
    });
  });
  
