<?php
session_start();
$logged = isset($_SESSION['nickname']);
require_once "../class/Autoloader.php";
Autoloader::register();
?>

<?php ob_start() ?>

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

    <!-- script qui checke s'il y a des doublons dans les séries -->
    <script src="../js/doublons.js"></script>

    <!-- script qui sélectionne les séries ayant le tag choisi lors du click sur l'un des boutons du dessus  -->
    <script src="../js/tagSearch.js"></script>
</div>

<?php $code = ob_get_clean(); ?>
<?php Template::render($code); ?>
