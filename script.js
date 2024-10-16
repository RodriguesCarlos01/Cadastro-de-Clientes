document.addEventListener('DOMContentLoaded', function() {
  // Função para aplicar a máscara dinâmica de CPF ou CNPJ
  const inputPessoaFJ = document.getElementById('cpfoucnpj');

  inputPessoaFJ.addEventListener('input', function () {
    let value = inputPessoaFJ.value.replace(/\D/g, ''); // Remove tudo que não é número
    
    if (value.length <= 14) { // CPF: 11 dígitos
      value = value.replace(/(\d{3})(\d)/, '$1.$2');
      value = value.replace(/(\d{3})(\d)/, '$1.$2');
      value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    } else { // CNPJ: 18 dígitos
      value = value.replace(/(\d{2})(\d)/, '$1.$2');
      value = value.replace(/(\d{3})(\d)/, '$1.$2');
      value = value.replace(/(\d{3})(\d)/, '$1/$2');
      value = value.replace(/(\d{4})(\d{1,2})$/, '$1-$2');
    }
    
    inputPessoaFJ.value = value; // Atualiza o valor do campo
  });

  // Listener para o envio do formulário
  document.getElementById('formulario').addEventListener('submit', function(e){
    e.preventDefault(); // Impede o envio normal do formulário

    const formData = new FormData(this); // Coleta os dados do formulário

    fetch('http://localhost/projeto-banco-de-dados/inserir_cliente.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.text())
    .then(data => {
      console.log(data)
      const urlParams = new URLSearchParams(data); // Supondo que data retorna a URL com id
      const id = urlParams.get('id'); // Pega o ID da URL
      if (id) {
        window.location.href = `resultado_do_cadastro.php?id=${id}`; // Redireciona para a página de resultado
      } 

      document.getElementById('formulario').reset();
    })
    .catch(error => console.log('Erro:', error));
  });
});
