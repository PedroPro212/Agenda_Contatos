function New(){
    var conteudo = document.querySelector('#contatos');
    var criar = document.querySelector('#criar');

    conteudo.style.display = 'none';
    criar.style.display = 'block';

}

function Cancelar(){
    var conteudo = document.querySelector('#contatos');
    var criar = document.querySelector('#criar');

    conteudo.style.display = 'block';
    criar.style.display = 'none';
}