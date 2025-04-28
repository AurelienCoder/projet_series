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
            <button class="category-btn" type="button">Animation</button>
            <button class="category-btn" type="button">Action</button>
            <button class="category-btn" type="button">Comédie</button>
            <button class="category-btn" type="button">Aventure</button>
            <button class="category-btn" type="button">Horreur</button>
            <button class="category-btn" type="button">Drame</button>
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
