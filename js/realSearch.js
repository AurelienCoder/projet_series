//utilisé dans search.php : un script qui sélectionne les réalisateurs correspondant au texte choisi dans l'input

//on récupère l'ensemble des boutons
const input = document.getElementById('inputt');

let reals = document.querySelectorAll('.model_serie');

input.addEventListener('change', function(){

    //on réinitialise l'affichage des réalisateurs
    reals.forEach(real => {
        real.style.display = 'initial';
    })

    reals.forEach(real => {
        let serie_tag = real.getElementsByTagName('h2')[0].innerText;

        //variable récupérant les genres des boutons

        //on doit transformer le genre des boutons en expression RegExp car match ne prend en compte que des RegExp
        let regex = new RegExp(input.value);

        //et maintenant on regarde si la série matche avec le regex du bouton
        if(serie_tag.match(regex) == null){
            real.style.display = 'none';
        }
    })
})