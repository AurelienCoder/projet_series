//utilisé dans home.php : un script qui sélectionne les séries ayant le tag choisi lors du click sur l'un des boutons

//on récupère l'ensemble des boutons
const buttons = document.querySelectorAll('.category-btn');

series = document.querySelectorAll('.model_serie');

//pour chaque bouton, on entre dans la boucle
buttons.forEach(button => {
    button.addEventListener('click', function(){

        //on réinitialise l'affichage des séries
        series.forEach(serie => {
            serie.style.display = 'initial';
        })

        series.forEach(serie => {
            //variable récupérant les genres des séries
            let serie_tag = serie.getElementsByTagName('span')[0].innerText;

            //variable récupérant les genres des boutons
            let button_tag = button.innerText;

            //on doit transformer le genre des boutons en expression RegExp car match ne prend en compte que des RegExp
            let regex = new RegExp(button_tag);

            //et maintenant on regarde si la série matche avec le regex du bouton
            if(serie_tag.match(regex) == null  && button.innerText != "Tout"){
                serie.style.display = 'none';
            }
        })
    })
})


//utilisé dans search.php : un script qui sélectionne les réalisateurs correspondant au texte choisi dans l'input

//on récupère l'ensemble des boutons
input = document.getElementById('search-real');

let reals = document.querySelectorAll('.model_serie');

input.addEventListener('change', function(){
alert('test');
    //on réinitialise l'affichage des réalisateurs
    reals.forEach(real => {
        real.style.display = 'initial';
    })

    reals.forEach(real => {
        let serie_tag = real.getElementsByTagName('h2')[0].innerText;
        alert(serie_tag);

        //variable récupérant les genres des boutons

        //on doit transformer le genre des boutons en expression RegExp car match ne prend en compte que des RegExp
        let regex = new RegExp(input.value);

        //et maintenant on regarde si la série matche avec le regex du bouton
        if(serie_tag.match(regex) == null){
            real.style.display = 'none';
        }
    })
})