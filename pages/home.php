<?php
session_start();
$logged = isset($_SESSION['nickname']);
require_once "../class/Autoloader.php";
Autoloader::register();
?>

<?php ob_start() ?>

<?php if ($logged): ?>
    <h1 style="text-align:center;">Hi <?php echo htmlspecialchars($_SESSION['nickname']); ?></h1>
<?php endif; ?>

<div style="margin-top: 100px;">
    <div class="home-button-div">
        <button class="category-btn" type="button" onclick="redirectToCategory('animation')">Animation</button>
        <button class="category-btn" type="button" onclick="redirectToCategory('action')">Action</button>
        <button class="category-btn" type="button" onclick="redirectToCategory('comedie')">Comédie</button>
        <button class="category-btn" type="button" onclick="redirectToCategory('aventure')">Aventure</button>
        <button class="category-btn" type="button" onclick="redirectToCategory('horreur')">Horreur</button>
        <button class="category-btn" type="button" onclick="redirectToCategory('drame')">Drame</button>
    </div>

    <div class="title" style="text-align:center; font-size:2rem;">LES SERIES DU MOMENT : </div>

    <?php 
        $serieDB = new \sdb\SerieDB();
        $series = $serieDB->getAllSeries();

        foreach($series as $serie){
            echo $serie->getHTML();
        }

        $tags = $serieDB->getAllTags();

        foreach($tags as $tag){
            echo $tag->getHTML();
        }
    ?>
</div>

<?php $code = ob_get_clean(); ?>
<?php Template::render($code); ?>
