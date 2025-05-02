//VOIR COURS JS DE M. BOURGUIN -> Fetch & POST
function fetchBD(url, nom, image, type){
    let data = new FormData();
    data.append('nom', nom);
    data.append('image', image);
    data.append('type', type);

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
        totalSaison = document.getElementById('nb-saison').value;   
    
        infos.style.display = 'block';
        h3.innerText = "Ajouter la saison n°1";
        
    }
})

//quand on clique sur ce bouton : on ajoute l'élement dans la BD
document.getElementById('valider').addEventListener('click', function(){
    let getNomInput = document.getElementById('nom-ajout').value;
    let getImageInput = document.getElementById('img-ajout').value;

    let url = "dashboard.php?value=serie";

    if(numSaison <= totalSaison){
        fetchBD(url, getNomInput, getImageInput, 'saison');
        numSaison++;
        
        if(numSaison <= totalSaison){
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
