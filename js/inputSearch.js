//un script qui sélectionne les réalisateurs/séries/acteurs correspondant au texte choisi dans l'input "rechercher..." dans search.php

//on récupère les divs
let divs = document.querySelectorAll('.model');

input = document.getElementById('search-input');

input.addEventListener('change', function(){
    //on réinitialise l'affichage des divs qui ont été cachées lors d'une précédente recherche
    divs.forEach(div => {
        div.style.display = 'initial';
    })

    divs.forEach(div => {

        //on récupère le nom (c-à-d soit le titre d'une série, soit le nom d'un acteur/réal) de chaque div
        let nom = div.getElementsByTagName('h2')[0].innerText;

        //on récupère la valeur de l'input sous forme de RegExp car match() ne fonctionne qu'avec une expression regulière
        let regex = new RegExp(input.value);

        //et maintenant on regarde si le nom matche avec la valeur de l'input
        if(nom.match(regex) == null){
            div.style.display = 'none';
        }
    })
})