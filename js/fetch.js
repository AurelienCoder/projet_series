//VOIR COURS JS DE M. BOURGUIN -> Fetch & POST
//Question : on est d'accord que fetch fait partie de l'AJAX ? ce n'est pas uniquement XMLHttpRequest ?
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
