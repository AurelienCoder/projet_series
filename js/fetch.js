//VOIR COURS JS DE M. BOURGUIN -> Fetch & POST
//Question : on est d'accord que fetch fait partie de l'AJAX ? ce n'est pas uniquement XMLHttpRequest ?
function fetchBD(url, nom, image){
    let data = 'nom=' + nom + '&image=' + image;//ajout des données pour le POST

    let options = {
        method: 'POST',
        headers: { Accept: 'application/json' },
        body: data
    }
    
    fetch(url, options).then(response => {
        if (response.ok) {
            response.json().then(data => {
                display.innerHTML = data.id
            })
        } else {
            alert("ERREUR avec la requête.", response.statusText);
        }
    }).catch(error => {
        console.log("ERREUR avec le fetch.", error)
    })
}
