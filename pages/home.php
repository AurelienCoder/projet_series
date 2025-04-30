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
        <button class="category-btn" type="button">Thriller</button>

        <!-- si l'administrateur est connecté, alors on ajoute dans home les 2 boutons AJOUTER et Voir les statistiques -->
        <?php if(isset($_SESSION['nickname']) && $_SESSION['nickname'] == 'administrateur'): ?>
            <a href="dashboard.php"><button class="category-btn" type="button" style="background-color: green;">AJOUTER</button></a>
            <a href="stats.php" class="category-btn" style="background-color: black;">Voir les statistiques</a>
        <?php endif; ?>
    </div>

    <!-- div qui affiche les séries via la méthode getAllSeries(), méthode qui recupère les séries avec une requête -->
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

    <!-- script qui en fonction du click sur les boutons du dessus, affiche les préférences, les séries liées au tag choisi  -->
    <script src="../js/search.js"></script>

    <script src="../js/details.js"></script>
</div>

<?php $code = ob_get_clean(); ?>
<?php Template::render($code); ?>
