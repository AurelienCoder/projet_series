let infos = document.getElementById('ajout-infos');
let sousDiv = document.getElementById('sous-div');

let h3 = sousDiv.querySelector('h3');

//identifiants uniques dans la base de données
let idSerie = document.querySelector('h1 span').innerText;
let idSaison = document.getElementById('id-saison').innerText;
let idAct = document.getElementById('id-act').innerText;
let idEp = document.getElementById('id-ep').innerText;

//variables pour se réperer dans le formulaire : saison n°1, n°2 de la série... acteur n°1, n°2 de la saison
//mais ça ne correspond pas aux identifiants uniques 
let numSaison = 1;
let numAct = 1;

//correspond aux boutons "Acteur suivant", "Episode suivant", "Saison suivante"...
//serie = [0], tag = [1], saison = [2], act = [3]
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

//AJOUTER UNE SERIE
function formDataSerie(idSerie, titre, img, synopsis){
    let data = new FormData();
    data.append('id_serie', idSerie);
    data.append('titre_serie', titre);
    data.append('affiche_serie', img);
    data.append('synopsis_serie', synopsis);
    fetchPOST(data);
}

//AJOUTER UNE SERIE DANS LA BD + OUVRIR DIV POUR AJOUTER LES SAISONS
valider[0].addEventListener('click', function(){
    let titre = document.getElementById('titre-serie').value;
    let img = document.getElementById('img-serie').value;
    let synopsis = document.getElementById('synopsis-serie').value;
    
    formDataSerie(idSerie, titre, img, synopsis);
    //OUVRIR LA DIV POUR COMMENCER A AJOUTER LES SAISONS
    let titreSerieInput = document.querySelector("input[name='titre']");

    if(titreSerieInput.value == ''){
        alert("Veuillez d'abord choisir un titre !");
    } else{    
        infos.style.display = 'block';
        h3.innerText = "Ajouter la saison n°" + numSaison;
    }
})

//AJOUTER UN TAG
function formDataTag(idSerie, nomTag){
    let data = new FormData();
    data.append('id_serie', idSerie);
    data.append('nom_tag', nomTag);
    fetchPOST(data);
}

//AJOUTER UN TAG DANS LA BD
valider[1].addEventListener('click', function(){
    let nomTag = document.getElementById('nom-tag');
    formDataTag(idSerie, nomTag.value);
    nomTag.value = '';
})

//AJOUTER UNE SAISON
function formDataSaison(idSaison, titre, num, img, idSerie){
    let data = new FormData();
    data.append('id_saison', idSaison);
    data.append('titre_saison', titre);
    data.append('num_saison', num);
    data.append('affiche_saison', img);
    data.append('id_serie', idSerie);
    fetchPOST(data);
}

//AJOUTER UNE SAISON DANS LA BD + OUVRIR DIV POUR AJOUTER ACTEURS/REALS/EPISODES
valider[2].addEventListener('click', function(){
    document.getElementById('ajouter-act-real-ep').style.display = 'initial';

    let titre = document.getElementById('titre-saison');
    let img = document.getElementById('img-saison');

    formDataSaison(idSaison, titre.value, numSaison, img.value, idSerie);
    document.querySelector('#sous-div2 h3').innerText = "Ajouter l'acteur n°" + numAct + " (saison " + numSaison + ")";

    titre.value = '';
    img.value = '';
    valider[2].style.display = 'none';
})

//AJOUTER UN ACTEUR
function formDataAct(nom, img, idAct, idSaison){
    let data = new FormData();
    data.append('nom', nom);
    data.append('image', img);
    data.append('id_act', idAct);
    data.append('id_saison', idSaison);
    fetchPOST(data);
}

//AJOUTER UN ACTEUR DANS LA BD
valider[3].addEventListener('click', function(){
    let nom = document.getElementById('nom-act');
    let img = document.getElementById('img-act');

    formDataAct(nom.value, img.value, idAct, idSaison);
    numAct++;
    idAct++;
    document.querySelector('#sous-div2 h3').innerText = "Ajouter l'acteur n°" + numAct + " (saison " + numSaison + ")";

    nom.value = '';
    img.value = '';
})

//AJOUTER UN EPISODE
function formDataEpisode(idEp, titre, synopsis, duree){
    let data = new FormData();
    data.append('id_ep', idEp);
    data.append('titre_ep', titre);
    data.append('synopsis_ep', synopsis);
    data.append('duree_ep', duree);
    fetchPOST(data);
}

//AJOUTER UN EPISODE DANS LA BD
valider[4].addEventListener('click', function(){
    alert('test');
    let titre = document.getElementById('titre-ep').value;
    let synopsis = document.getElementById('synopsis-ep').value;
    let duree = document.getElementById('duree-ep').value;
    let nomReal = document.getElementById('nom-real');
    let imgReal = document.getElementById('img-real');
    formDataEpisode(idEp, titre, synopsis, duree);
    fetchPOST(data);
})

//SAISIR LA SAISON SUIVANTE
valider[5].addEventListener('click', function(){
    numSaison++;
    idSaison++;
    numAct = 1;
    document.querySelector('#sous-div2 h3').innerText = "Ajouter l'acteur n°" + numAct + " (saison " + numSaison + ")";
    h3.innerText = "Ajouter la saison n°" + numSaison;
    document.getElementById('sous-div').scrollTop = 0;
})

document.getElementById('terminer').addEventListener('click', function(){
    window.location.href = 'home.php';
})
