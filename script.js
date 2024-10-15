document.getElementById('formulario').addEventListener('submit', function(e){
  e.preventDefault(); //Impede o envio normal do formulário

  const formData = new FormData(this); // Coleta os dados do formulário

  fetch('http://localhost/projeto-banco-de-dados/inserir_cliente.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(data => {
    alert(data); //Exibi a mensagem de sucesso ou erro
  })
  .catch(error => console.log('Erro:', error))
})