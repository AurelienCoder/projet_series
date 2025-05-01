//VOIR COURS JS DE M. BOURGUIN -> Fetch & POST
//Question : on est d'accord que fetch fait partie de l'AJAX ?
function fetchBD(url, nom, image, value){
    let data = new FormData();
    data.append('nom', nom);
    data.append('image', image);
    data.append('value', value);

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

//on stocke dans ces variables les valeurs des inputs correspondants aux nombres totaux des choses que l'on veut ajouter
let totalRealAjout;
let totalActAjout;
let totalSaisonAjout;

let nbReal = 1;
let nbAct = 1;
let nbSaison = 1;

let infos = document.getElementById('ajout-infos');
let sousDiv = document.getElementById('sous-div');

let h3 = sousDiv.childNodes[1];

//quand on clique sur le bouton noir
document.getElementById('ajouter-real-act-saison').addEventListener('click', function(){
    let titreSerieInput = document.querySelector("input[name='titre']");

    if(titreSerieInput.value == ''){
        alert("Veuillez d'abord choisir un titre !");
    } else{
        totalRealAjout = document.getElementById('nb-real').value;
        totalActAjout = document.getElementById('nb-act').value;   
        totalSaisonAjout = document.getElementById('nb-saison').value;   
    
        infos.style.display = 'block';
        
    
        if(totalRealAjout>0){
            h3.innerText = 'Ajouter le réalisateur n°' + nbReal;
        } else if(totalRealAjout == 0 && totalActAjout>0){
            h3.innerText = "Ajouter l'acteur n°" + nbAct;
        }else{
            h3.innerText = "Ajouter la saison n°" + nbSaison;
        }        
    }
})

document.getElementById('valider').addEventListener('click', function(){
    let getNomInput = document.getElementById('nom-ajout').value;
    let getImageInput = document.getElementById('img-ajout').value;

    let url = "dashboard.php";
    let value;

    if(nbReal<totalRealAjout){
        nbReal++;
        h3.innerText = 'Ajouter le réalisateur n°' + nbReal;
        value = 'real';
    }else if(nbReal>=totalRealAjout && nbAct<totalActAjout){
        nbAct++;
        h3.innerText = "Ajouter l'acteur n°" + nbAct;
        value = 'act';
    }else{
        infos.style.display = 'none';
        value = 'saison';
    }

    fetchBD(url, getNomInput, getImageInput, value);

    document.getElementById('nom-ajout').value = '';
    document.getElementById('img-ajout').value = '';
})
