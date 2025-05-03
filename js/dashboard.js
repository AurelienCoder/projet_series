//VOIR COURS JS DE M. BOURGUIN -> Fetch & POST

//AJOUTER UNE SERIE
function fetchSerie(url, idSerie, titre, img, synopsis, type){
    
    let data = new FormData();
    data.append('id_serie', idSerie);
    data.append('titre_serie', titre);
    data.append('affiche_serie', img);
    data.append('synopsis_serie', synopsis);

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

//AJOUTER UNE SAISON
function fetchSaison(url, idSaison, titre, num, img, idSerie){
    let data = new FormData();
    data.append('id_saison', idSaison);
    data.append('titre_saison', titre);
    data.append('num_saison', num);
    data.append('affiche_saison', img);
    data.append('id_serie', idSerie);

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

function fetchAct(url, nom, img, idAct, idSaison){
    let data = new FormData();
    data.append('nom', nom);
    data.append('image', img);
    data.append('id_act', idAct);
    data.append('id_saison', idSaison);

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


let infos = document.getElementById('ajout-infos');
let sousDiv = document.getElementById('sous-div');

let h3 = sousDiv.childNodes[1];

let idSerie = document.querySelector('h1 span').innerText;
let idAct = document.getElementById('id-act').innerText;
let idSaison = document.getElementById('id-saison').innerText;

let numSaison = 1;
let numAct = 1;

//correspond aux boutons "Acteur suivant", "Episode suivant", "Saison suivante"...
//genre = [0], serie = [1], saison = [2], act = [3]
let valider = document.querySelectorAll('.valider');

let url = "dashboard.php?value=serie";

//AJOUTER UNE SERIE DANS LA BD+ OUVRIR DIV POUR AJOUTER LES SAISONS
valider[1].addEventListener('click', function(){
    //AJOUTER LA SERIE
    let titre = document.getElementById('titre-serie').value;
    let img = document.getElementById('img-serie').value;
    let synopsis = document.getElementById('synopsis-serie').value;

    fetchSerie(url, idSerie, titre, img, synopsis);
    //OUVRIR LA DIV POUR COMMENCER A AJOUTER LES SAISONS
    let titreSerieInput = document.querySelector("input[name='titre']");

    if(titreSerieInput.value == ''){
        alert("Veuillez d'abord choisir un titre !");
    } else{    
        infos.style.display = 'block';
        h3.innerText = "Ajouter la saison n°" + numSaison;
    }
})

valider[2].addEventListener('click', function(){
    document.getElementById('ajouter-act-real-ep').style.display = 'initial';

    let titre = document.getElementById('titre-saison').value;
    let img = document.getElementById('img-saison').value;

    fetchSaison(url, idSaison, titre, numSaison, img, idSerie);
    numSaison++;
    idSaison++;
    numAct = 1;
    document.querySelector('#sous-div2 h3').innerText = "Ajouter l'acteur n°" + numAct + " (saison " + numSaison + ")";
    h3.innerText = "Ajouter la saison n°" + numSaison;
})

//AJOUTER UN ACTEUR DANS LA BD
validerButtons[1].addEventListener('click', function(){
    let nom = document.getElementById('nom-act').value;
    let img = document.getElementById('img-act').value;

    fetchAct(url, nom, img, idAct, idSaison);
    numAct++;
    document.querySelector('#sous-div2 h3').innerText = "Ajouter l'acteur n°" + numAct + " (saison " + numSaison + ")";
})

document.getElementById('terminer').addEventListener('click', function(){
    infos.style.display = 'none';
})
