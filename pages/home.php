<?php
session_start();
$logged = isset($_SESSION['nickname']);
require_once "../class/Autoloader.php";
Autoloader::register();
?>

<?php ob_start() ?>

<?php if ($logged): ?>
<?php endif; ?>

<div style="margin-top: 10px; margin-bottom: 30px;">
    <div id="home-title">LES SERIES DU MOMENT</div>

    <div class="home-button-div" style="margin-top: 10px;">
            <button class="category-btn" type="button">Tout</button>
            <button class="category-btn" type="button">Drame</button>
            <button class="category-btn" type="button">Historique</button>
            <button class="category-btn" type="button">Science-fiction</button>
            <button class="category-btn" type="button">Action</button>
            <button class="category-btn" type="button">Aventure</button>
            <button class="category-btn" type="button">Horreur</button>
        </div>

    <div style="display:flex; overflow-x: auto;">
        <?php 
            $serieDB = new \sdb\SerieDB();
            $series = $serieDB->getAllSeries();
            
            foreach($series as $serie){
                echo $serie->getHTML();
            }
        ?>
    </div>

    <!-- script qui checke s'il y a des doublons de séries -->
    <script>
        //tableau de toutes les séries incluant les doublons
        series = document.querySelectorAll('.series-list');

        //un tableau récuperant le titre des séries
        titresAjoutes = [];

        //boucle passant en revue le tableaux des doublons
        series.forEach( (serie, i)=> {

            let titre = document.getElementsByTagName('h2')[i].innerText;

            let index = -1;
            let tag;

            //on parcourt le tableau des titres
            for(let k=0; k<titresAjoutes.length; k++){
                //si un titre a déjà été ajouté alors il y a un doublon
                if(titre == titresAjoutes[k]){
                    //on stocke dans index l'endroit où existe déjà la série
                    index = k;

                    //on stocke dans tag le tag du doublon
                    tag = document.getElementsByClassName('tag')[i].innerText;
                }
            }
            
            if(index==-1){
                titresAjoutes.push(titre);
            } else{
                serie.style.display = "none";
                document.getElementsByClassName('tag')[index].innerText += " " + tag;
            }
        });

    </script>

</div>

<script>
    const $buttons = document.querySelectorAll('.category-btn');

    const $divs = document.querySelectorAll('.model_serie');

    $buttons.forEach($button => {
        $button.addEventListener('click', function(){

            //on réinitialise l'affichage des séries
            $divs.forEach($div => {
                $div.style.display = 'initial';
            })

            //on affiche les séries correspondantes au bouton
            $divs.forEach($div => {
                if($div.getElementsByTagName('span')[0].innerText != $button.innerText && $button.innerText != "Tout"){
                    $div.style.display = 'none';
                }
            })
        })
    })
</script>

<?php $code = ob_get_clean(); ?>
<?php Template::render($code); ?>
