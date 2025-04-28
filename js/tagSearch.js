//utilisé dans home.php : un script qui sélectionne les séries ayant le tag choisi lors du click sur l'un des boutons

//on récupère l'ensemble des boutons
const $buttons = document.querySelectorAll('.category-btn');

const $divs = document.querySelectorAll('.model_serie');

//pour chaque bouton, on entre dans la boucle
$buttons.forEach($button => {
    $button.addEventListener('click', function(){

        //on réinitialise l'affichage des séries
        $divs.forEach($div => {
            $div.style.display = 'initial';
        })

        $divs.forEach($div => {
            //on camoufle les séries qui n'ont pas comme genre celui choisi
            if($div.getElementsByTagName('span')[0].innerText != $button.innerText && $button.innerText != "Tout"){
                $div.style.display = 'none';
            }
        })
    })
})