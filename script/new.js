// Função para criar um novo contato
function New(){
    var conteudo = document.querySelector('#contatos');
    var criar = document.querySelector('#criar');

    conteudo.style.display = 'none';
    criar.style.display = 'block';

}

// Função para cancelar a criação de um novo contato
function Cancelar(){
    var conteudo = document.querySelector('#contatos');
    var criar = document.querySelector('#criar');

    conteudo.style.display = 'block';
    criar.style.display = 'none';
}

// Mostrar imagem selecionada
function Image(){
    const inputImagem = document.getElementById("imagem");
    const labelImagem = document.querySelector(".imagem");
    
    // adicionar um listener de mudança de arquivo
    inputImagem.addEventListener("change", function() {
      // criar um objeto FileReader
      const leitorArquivo = new FileReader();
    
      // definir o que fazer quando o leitor ler o arquivo
      leitorArquivo.addEventListener("load", function() {
        // definir o valor da propriedade "background-image" da label como a URL da imagem
        labelImagem.style.backgroundImage = "url("+leitorArquivo.result+")";
      });
    
      // ler o arquivo selecionado pelo usuário
      leitorArquivo.readAsDataURL(inputImagem.files[0]);
    });
}

// Mostrar nome em tempo real
function Nome(){
    var completo = document.querySelector('#nome-completo');
    var nome = document.querySelector('#nome').value;
    var sobrenome = document.querySelector('#sobrenome').value;

    completo.textContent = nome + ' ' + sobrenome;
}