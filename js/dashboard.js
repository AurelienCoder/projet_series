let infos = document.getElementById('ajout-infos');
let sousDiv = document.getElementById('sous-div');

let h3 = sousDiv.querySelector('h3');

//identifiants uniques dans la base de données
let idSerie = document.querySelector('h1 span').innerText;
let idSaison = document.getElementById('id-saison').innerText;
let idAct = document.getElementById('id-act').innerText;
let idReal = document.getElementById('id-real').innerText;
let idEp = document.getElementById('id-ep').innerText;

//variables pour se réperer dans le formulaire : saison n°1, n°2 de la série... acteur n°1, n°2 de la saison
//mais ça ne correspond pas aux identifiants uniques 
let numSaison = 1;
let numAct = 1;
let numEp = 1;
let numReal = 1;
let numTag = 1;

//correspond aux boutons "Acteur suivant", "Episode suivant", "Saison suivante"...
/*[0] = ajouter la série dans la BD et commencer à ajouter les tags
  [1] = ajouter un tag dans la BD
  [2] = ajouter une saison dans la BD et commencer à ajouter les acteurs/épisodes
  [3] = ajouter un acteur dans la BD
  [4] = ajouter un épisode dans la BD
  [5] = ajouter le réalisateur de l'épisode dans la BD et passer à l'épisode suivante
  [6] = passer à la saison suivante
*/
let valider = document.querySelectorAll('.valider');

//VOIR COURS JS DE M. BOURGUIN -> Fetch & POST
let url = "dashboard.php?value=serie";

function fetchPOST(data){
    let options = {
        method: 'POST',
        headers: { Accept: 'application/json'},
        body: data
    }
    
    fetch(url, options).then(response => {
        if(!response.ok){
            alert("ERREUR avec la requête.", response.statusText);
        }
    }).catch(error => {
        console.log("ERREUR avec le fetch.", error)
    })
}

//SERIE
function formDataSerie(titre, img, synopsis){
    let data = new FormData();
    data.append('id_serie', idSerie);
    data.append('titre_serie', titre);
    data.append('affiche_serie', img);
    data.append('synopsis_serie', synopsis);
    fetchPOST(data);
}

//TAG
function formDataTag(nomTag){
    let data = new FormData();
    data.append('id_serie', idSerie);
    data.append('nom_tag', nomTag);
    fetchPOST(data);
}

//SAISON
function formDataSaison(titre, num, img){
    let data = new FormData();
    data.append('id_saison', idSaison);
    data.append('titre_saison', titre);
    data.append('num_saison', num);
    data.append('affiche_saison', img);
    data.append('id_serie', idSerie);
    fetchPOST(data);
}

//AJOUTER UN ACTEUR
function formDataAct(nom, img){
    let data = new FormData();
    data.append('nom_act', nom);
    data.append('image_act', img);
    data.append('id_act', idAct);
    data.append('id_saison', idSaison);
    fetchPOST(data);
}

//AJOUTER UN EPISODE
function formDataEpisode(titre, synopsis, duree){
    let data = new FormData();
    data.append('id_saison', idSaison);
    data.append('id_ep', idEp);
    data.append('titre_ep', titre);
    data.append('synopsis_ep', synopsis);
    data.append('duree_ep', duree);
    fetchPOST(data);
}

//AJOUTER UN REALISATEUR
function formDataReal(nom, img){
    let data = new FormData();
    data.append('nom_real', nom);
    data.append('image_real', img);
    data.append('id_real', idReal);
    data.append('id_ep', idEp);
    fetchPOST(data);
}

//AJOUTER UNE SERIE DANS LA BD + OUVRIR DIV POUR AJOUTER LES TAGS
valider[0].addEventListener('click', function(){
    let titre = document.getElementById('titre-serie').value;
    let img = document.getElementById('img-serie').value;
    let synopsis = document.getElementById('synopsis-serie').value;
    
    formDataSerie(titre, img, synopsis);

    let titreSerieInput = document.querySelector("input[name='titre']");

    if(titreSerieInput.value == ''){
        alert("Veuillez d'abord choisir un titre !");
    } else{    
        infos.style.display = 'block';
        h3.innerText = "Ajouter la saison n°" + numSaison + " --- id #" + idSaison;
    }
})

//AJOUTER UN TAG DANS LA BD
valider[1].addEventListener('click', function(){
    let nomTag = document.getElementById('nom-tag');
    formDataTag(nomTag.value);
    nomTag.value = '';
    numTag++;
    document.querySelector('#sous-div label').innerText = 'Tag n°' + numTag + ' (un à la fois svp)';
})

//AJOUTER UNE SAISON DANS LA BD + OUVRIR DIV POUR AJOUTER ACTEURS/EPISODES
valider[2].addEventListener('click', function(){
    document.getElementById('ajouter-act-real-ep').style.display = 'initial';

    let titre = document.getElementById('titre-saison');
    let img = document.getElementById('img-saison');

    formDataSaison(titre.value, numSaison, img.value);
    document.querySelector('#sous-div2 h3').innerText = "Ajouter l'acteur n°" + numAct + " (saison " + numSaison + ")" + " --- id #" + idAct;

    titre.value = '';
    img.value = '';
    valider[2].style.display = 'none';
})

//AJOUTER UN ACTEUR DANS LA BD
valider[3].addEventListener('click', function(){
    let nom = document.getElementById('nom-act');
    let img = document.getElementById('img-act');

    formDataAct(nom.value, img.value);
    numAct++;
    idAct++;
    document.querySelector('#sous-div2 h3').innerText = "Ajouter l'acteur n°" + numAct + " (saison " + numSaison + ")" + " --- id #" + idAct;

    nom.value = '';
    img.value = '';
})

//AJOUTER UN EPISODE DANS LA BD
valider[4].addEventListener('click', function(){
    let titre = document.getElementById('titre-ep').value;
    let synopsis = document.getElementById('synopsis-ep').value;
    let duree = document.getElementById('duree-ep').value;
    formDataEpisode(titre, synopsis, duree);
    valider[4].style.display = 'none';
    document.getElementById('ajouter-real').style.display = 'initial';
})

//AJOUTER LE REALISATEUR DE L'EPISODE DANS LA BD
valider[5].addEventListener('click', function(){
    let nom = document.getElementById('nom-real');
    let img = document.getElementById('img-real');
    formDataReal(nom.value, img.value);

    numEp++;
    idEp++;
    idReal++;
    numReal = 1;
    document.querySelector('#sous-div3 h3').innerText = "Ajouter l'épisode n°" + numEp + " (saison " + numSaison + ")"+ " --- id #" + idEp;
    h3.innerText = "Ajouter la saison n°" + numSaison;
    valider[4].style.display = 'initial';
    document.getElementById('ajouter-real').style.display = 'none';
    document.getElementById('label-real').innerText = "Nom du réalisateur #" + idReal + ' : ';
    nom.value = '';
    img.value = '';
})

//PASSER A LA SAISON SUIVANTE
valider[6].addEventListener('click', function(){
    document.getElementById('ajouter-act-real-ep').style.display = 'none';
    valider[2].style.display = 'initial';
    numSaison++;
    idSaison++;
    numAct = 1;
    numEp = 1;
    numReal = 1;
    document.querySelector('#sous-div2 h3').innerText = "Ajouter l'acteur n°" + numAct + " (saison " + numSaison + ")" + " --- id #" + idAct;
    document.querySelector('#sous-div3 h3').innerText = "Ajouter l'épisode n°" + numEp + " (saison " + numSaison + ")" + " --- id #" + idEp;
    h3.innerText = "Ajouter la saison n°" + numSaison + " --- id #" + idSaison;
    document.getElementById('sous-div').scrollTop = 0;
})

//TERMINER
document.getElementById('terminer').addEventListener('click', function(){
    window.location.href = 'home.php';
})