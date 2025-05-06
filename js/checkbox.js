// un script qui  sélectionne les séries ayant le tag choisi lors du click sur l'une des checkboxes dans home.php

//on récupère l'ensemble des checkboxes
const checkboxes = document.querySelectorAll('input[type="checkbox"]');

series = document.querySelectorAll('.model');

let labels = document.querySelectorAll('label');

//pour chaque checkbox, on entre dans la boucle
checkboxes.forEach((checkbox,index) => {
    checkbox.addEventListener('change', function(){

        //on enlève les check de toutes les checkboxes sauf celle de la case checkée
        for(let i=0; i<checkboxes.length; i++){
            if(i != index) checkboxes[i].checked = false;
        }

        //on réinitialise l'affichage des séries
        series.forEach(serie => {
            serie.style.display = 'initial';
        })

        if(checkbox.checked){

            //variable récupérant les genres des checkboxes
            let checkbox_tag = labels[index].innerText;

                series.forEach(serie => {

                //variable récupérant les genres des séries
                let serie_tag = serie.querySelector('.tag').innerText;

                if(checkbox_tag != 'Tout'){
        
                    //on doit transformer le genre des checkboxes en expression RegExp car match() ne prend en compte que des RegExp
                    let regex = new RegExp(checkbox_tag);
        
                    //et maintenant on regarde si la série matche avec le regex
                    if(serie_tag.match(regex) == null){
                        serie.style.display = 'none';
                    }
                }
            })
        }
    })
})