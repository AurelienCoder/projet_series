//VOIR COURS JS DE M. BOURGUIN -> Fetch & POST
//Question : on est d'accord que fetch fait partie de l'AJAX ?
function fetchBD(url, nom, image){
    let data = new FormData();
    data.append('nom', nom);
    data.append('image', image);

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

let totalRealAjout;
let totalActAjout;

let infos = document.getElementById('ajout-infos');
let sousDiv = document.getElementById('sous-div');

document.getElementById('ajouter-real-act-saison').addEventListener('click', function(){
    infos.style.display = 'block';
    totalRealAjout = document.getElementById('nb-real').value;
})

document.getElementById('ajouter-real-act-saison').addEventListener('click', function(){
    infos.style.display = 'block';
    totalActAjout = document.getElementById('nb-act').value;                    
})


let nbReal = 1;

sousDiv.childNodes[1].innerText = 'Réalisateur n°' + nbReal;

document.getElementById('valider').addEventListener('click', function(){
    if(nbReal<totalRealAjout){

        let nom = document.getElementById('nom-ajout').value;
        let image = document.getElementById('img-ajout').value;

        let url = "dashboard.php";
        fetchBD(url, nom, image);
        
        document.getElementById('nom-ajout').value = '';
        document.getElementById('img-ajout').value = '';

        nbReal++;
        sousDiv.childNodes[1].innerText = 'Réalisateur n°' + nbReal;

    }else{
        infos.style.display = 'none';
    }
})
