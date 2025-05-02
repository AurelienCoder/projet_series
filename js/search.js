//utilisé dans home.php : un script qui sélectionne les séries ayant le tag choisi lors du click sur l'une des checkboxes

//on récupère l'ensemble des checkboxes
const checkboxes = document.querySelectorAll('.category-btn');

series = document.querySelectorAll('.model_serie');

let labels = document.querySelectorAll('label');

//pour chaque checkbox, on entre dans la boucle
checkboxes.forEach( (checkbox,index) => {
    checkbox.addEventListener('change', function(){



        if(checkbox.checked){
            //on réinitialise l'affichage des séries
            series.forEach(serie => {
                serie.style.display = 'initial';
            })
    
            series.forEach(serie => {

                //si l'index == 0 alors ça veut dire que l'on clique sur 'Tout'
                if(index == 0){
                    //si la case "tout" est cochée, alors on enlève les check de toutes les autres checkboxes sauf celle de "tout"
                    for(let i=0; i<checkboxes.length; i++){
                        if(i != index)checkboxes[i].checked = false;
                    }
                } else{
                    //si on clique un genre, on enlève le check sur 'Tout'
                    checkboxes[0].checked = false;

                    //variable récupérant les genres des séries
                    let serie_tag = serie.getElementsByTagName('span')[0].innerText;
        
                    //variable récupérant les genres des checkboxes
                    let checkbox_tag = '';
                    
                    for(let i=0; i<checkboxes.length; i++){
                        if(checkboxes[i].checked) checkbox_tag += labels[i].innerText;
                    }

                    //alert(checkbox_tag);
        
                    //on doit transformer le genre des checkboxes en expression RegExp car match ne prend en compte que des RegExp
                    let regex = new RegExp(checkbox_tag);
        
                    //et maintenant on regarde si la série matche avec le regex
                    if(checkbox_tag != 'Tout'){
                        if(serie_tag.match(regex) == null){
                            serie.style.display = 'none';
                        }
                    }
                }
            })
        }
    })
})


//utilisé dans search.php : un script qui sélectionne les réalisateurs correspondant au texte choisi dans l'input

//on récupère l'ensemble des boutons

let reals = document.querySelectorAll('.model_serie');

input = document.getElementById('search-input');

input.addEventListener('change', function(){
    //on réinitialise l'affichage des réalisateurs
    reals.forEach(real => {
        real.style.display = 'initial';
    })

    reals.forEach(real => {
        let serie_tag = real.getElementsByTagName('h2')[0].innerText;

        //on doit transformer le genre des boutons en expression RegExp car match ne prend en compte que des RegExp
        let regex = new RegExp(input.value);

        //et maintenant on regarde si la série matche avec le regex du bouton
        if(serie_tag.match(regex) == null){
            real.style.display = 'none';
        }
    })
})