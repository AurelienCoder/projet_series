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
let totalReal;
let totalAct;
let totalSaison;

let numReal = 1;
let numAct = 1;
let numSaison = 1;

let infos = document.getElementById('ajout-infos');
let sousDiv = document.getElementById('sous-div');

let h3 = sousDiv.childNodes[1];

//quand on clique sur le bouton noir pour ouvrir la div qui permettra d'ajouter les act/real/saisons dans la BD
document.getElementById('ajouter-real-act-saison').addEventListener('click', function(){
    let titreSerieInput = document.querySelector("input[name='titre']");

    if(titreSerieInput.value == ''){
        alert("Veuillez d'abord choisir un titre !");
    } else{
        totalReal = document.getElementById('nb-real').value;
        totalAct = document.getElementById('nb-act').value;   
        totalSaison = document.getElementById('nb-saison').value;   
    
        infos.style.display = 'block';
        
        if(totalReal>0){
          h3.innerText = "Ajouter le réalisateur n°1";
        }else if(totalAct>0){
            h3.innerText = "Ajouter l'acteur n°1";
        }else{
            h3.innerText = "Ajouter la saison n°1";
        }
    }
})

//quand on clique sur ce bouton : on ajoute l'élement dans la BD
document.getElementById('valider').addEventListener('click', function(){
    let getNomInput = document.getElementById('nom-ajout').value;
    let getImageInput = document.getElementById('img-ajout').value;

    let url = "dashboard.php";

    if(numReal<=totalReal){
        fetchBD(url, getNomInput, getImageInput, 'real');
        numReal++;

        if(numReal<=totalReal){
            h3.innerText = 'Ajouter le réalisateur n°' + numReal;
        }else if(numAct<=totalAct){
            h3.innerText = "Ajouter l'acteur n°" + numAct;
        }else if(numSaison<=totalSaison){
            h3.innerText = "Ajouter la saison n°" + numSaison;
        }else{
            infos.style.display = 'none';
        }
    }else if(numAct<=totalAct){
        fetchBD(url, getNomInput, getImageInput, 'act');
        numAct++;

        if(numAct<=totalAct){
            h3.innerText = "Ajouter l'acteur n°" + numAct;
        }else if(numSaison <= totalSaison){
            h3.innerText = "Ajouter la saison n°" + numSaison;
        }else{
            infos.style.display = 'none';
        }
    }else{//A MODIFIER : ajouter les saisons
        infos.style.display = 'none';
        value = 'saison';
    }

    document.getElementById('nom-ajout').value = '';
    document.getElementById('img-ajout').value = '';
})
