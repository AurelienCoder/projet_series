/*un script qui checke s'il y a des doublons dans les séries car lors de l'INNER JOIN, une série peut apparaitre plusieurs fois. 
exemple : elle peut avoir un tag Aventure et un tag Action : il faut donc supprimer le doublon et juste récuperer le tag */

//tableau de toutes les séries incluant les doublons
let series = document.querySelectorAll('.series-list');

//un tableau récuperant l'objet HTML contenant les tags
let tagsAjoutes = [];

//boucle passant en revue le tableaux des doublons
series.forEach( (serie, i)=> {
    let titre = document.getElementsByTagName('h2')[i].innerText;
    let tagActuel = document.getElementsByClassName('tag')[i].innerText;

    
    if(tagsAjoutes[titre]){
        serie.style.display = 'none';

        let tag = tagsAjoutes[titre];

        if(!tag.innerText.includes(tagActuel)){
            tag.innerText += " " + tagActuel;
        }
    }else{
        tagsAjoutes[titre] = serie.querySelector('.tag');
    }
});