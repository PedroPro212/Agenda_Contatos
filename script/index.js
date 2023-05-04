function Encolher(){
    var div_menu = document.querySelector('#menu');
    var conteudo = document.querySelector('#conteudo');

    if(div_menu.style.display === 'none'){
        div_menu.style.display = 'block';
        conteudo.classList.remove("col-sm-11");
        conteudo.classList.add("col-sm-8");
    }
    else {
        div_menu.style.display = 'none';
        conteudo.classList.remove("col-sm-8");
        conteudo.classList.add("col-sm-11");
    }

}