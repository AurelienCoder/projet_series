/*un script qui checke s'il y a des doublons dans les séries car lors de l'INNER JOIN, une série peut apparaitre plusieurs fois. 
exemple : elle peut avoir un tag Aventure et un tag Action : il faut donc supprimer le doublon et juste récuperer le tag */

//tableau de toutes les séries incluant les doublons
let series = document.querySelectorAll('.series-list');

//un tableau récuperant l'objet HTML contenant les tags des titres uniquement si il n'ont pas été ajoutés
let tagsAjoutes = [];

//boucle passant en revue le tableaux des doublons
series.forEach( (serie, i)=> {
    let titre = document.getElementsByTagName('h2')[i].innerText;
    let tagActuel = document.getElementsByClassName('tag')[i].innerText;

    if(tagsAjoutes[titre]){//si un tag est déja inséré dans l'index titre (qui correspond au titre d'une série)

        //si un tag est déja associé à une série, alors la série existe déjà, il ne faut donc pas afficher une nouvelle fois la même série
        // donc on la cache
        serie.style.display = 'none';

        //on ajoute au tag qui existe déjà, le tag actuel
        tagsAjoutes[titre].innerText += " " + tagActuel;
    }else{//sinon on stocke dans l'index titre (qui correspond au titre d'une série), le tag qui correspond à une série qui n'a pas encore été ajouté
        tagsAjoutes[titre] = serie.querySelector('.tag');
    }
});