/*un script qui checke s'il y a des doublons dans les séries car lors de l'INNER JOIN, une série peut apparaitre plusieurs fois. 
exemple : elle peut avoir un tag Aventure et un tag Action : il faut donc supprimer le doublon et juste récuperer le tag */

//tableau de toutes les séries incluant les doublons
let series = document.querySelectorAll('.series-list');

//un tableau récuperant le titre des séries
let titresAjoutes = [];

//boucle passant en revue le tableaux des doublons
series.forEach( (serie, i)=> {

    let titre = document.getElementsByTagName('h2')[i].innerText;

    let index = null;
    let tag;

    //on parcourt le tableau des titres
    for(let idTitreAjoute=0; idTitreAjoute<titresAjoutes.length; idTitreAjoute++){
        //si un titre a déjà été ajouté alors il y a un doublon

        if(titre == titresAjoutes[idTitreAjoute]){
            //on stocke dans index l'endroit où existe déjà la série
            index = idTitreAjoute;

            //on stocke dans tag le tag du doublon
            tag = document.getElementsByClassName('tag')[i].innerText;
        }
    }
    
    //si index = null, le titre n'existe pas encore, on peut le rajouter dans titresAjoutes
    if(index==null){
        titresAjoutes.push(titre);
    } else{ //sinon la série existe déjà, il faut donc la cacher et juste récuperer son tag pour l'ajouter à l'endroit où la série existe déjà
        serie.style.display = 'none';
        document.getElementsByClassName('tag')[index].innerText += ' '+ tag;
    }
});