/*un script qui checke s'il y a des doublons dans les séries car lors de l'INNER JOIN, une série peut apparaitre plusieurs fois 
par exemple, elle peut avoir un tag Aventure et un tag Action : il faut donc supprimer le doublon et juste récuperer le tag */

//tableau de toutes les séries incluant les doublons
series = document.querySelectorAll('.series-list');

//un tableau récuperant le titre des séries
titresAjoutes = [];

//boucle passant en revue le tableaux des doublons
series.forEach( (serie, i)=> {

    let titre = document.getElementsByTagName('h2')[i].innerText;

    let index = -1;
    let tag;

    //on parcourt le tableau des titres
    for(let k=0; k<titresAjoutes.length; k++){
        //si un titre a déjà été ajouté alors il y a un doublon
        if(titre == titresAjoutes[k]){
            //on stocke dans index l'endroit où existe déjà la série
            index = k;

            //on stocke dans tag le tag du doublon
            tag = document.getElementsByClassName('tag')[i].innerText;
        }
    }
    
    if(index==-1){
        titresAjoutes.push(titre);
    } else{
        serie.style.display = "none";
        document.getElementsByClassName('tag')[index].innerText += " " + tag;
    }
});