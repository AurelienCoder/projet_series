<?php
session_start();
require_once "../class/Autoloader.php";
Autoloader::register();

$serieDB = new \sdb\SerieDB();

ob_start();
?>

<h1 style="color:white; text-align:center">Statistiques</h1>

<div style="display: flex; gap: 20px; justify-content:center;">
    <div class="stats">
        <h2>Nombre total de séries</h2>
        <p style="font-size: 30px;"><?= $serieDB->countSeries() ?></p>
    </div>

    <div class="stats">
        <h2>Nombre total de tags</h2>
        <p style="font-size: 30px;"><?= $serieDB->countTags() ?></p>
    </div>

    <div class="stats">
        <h2>Nombre total d'acteurs</h2>
        <p style="font-size: 30px;"><?= $serieDB->countActs() ?></p>
    </div>

    <div class="stats">
        <h2>Nombre total de réalisateurs</h2>
        <p style="font-size: 30px;"><?= $serieDB->countReals() ?></p>
    </div>
</div>
<?php
$content = ob_get_clean();
Template::render($content);
?>
