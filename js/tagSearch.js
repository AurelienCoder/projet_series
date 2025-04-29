//utilisé dans home.php : un script qui sélectionne les séries ayant le tag choisi lors du click sur l'un des boutons

//on récupère l'ensemble des boutons
const $buttons = document.querySelectorAll('.category-btn');

const $series = document.querySelectorAll('.model_serie');

//pour chaque bouton, on entre dans la boucle
$buttons.forEach($button => {
    $button.addEventListener('click', function(){

        //on réinitialise l'affichage des séries
        $series.forEach($serie => {
            $serie.style.display = 'initial';
        })

        $series.forEach($serie => {
            //on camoufle les séries qui n'ont pas comme genre celui choisi
            if($serie.getElementsByTagName('span')[0].innerText != $button.innerText && $button.innerText != "Tout"){
                $serie.style.display = 'none';
            }
        })
    })
})