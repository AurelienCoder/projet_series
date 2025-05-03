<?php
session_start();
require_once "../class/Autoloader.php";
Autoloader::register();

$serieDB = new \sdb\SerieDB();

$nbSeries = $serieDB->countSeries();
$nbTags = $serieDB->countTags();
$nbActs = $serieDB->countActs();

ob_start();
?>

<h1>Statistiques</h1>

<div style="display: flex; gap: 20px;">
    <div style="padding: 20px; background-color: #f0f0f0; border-radius: 10px;">
        <h2>Nombre total de séries</h2>
        <p style="font-size: 30px;"><?= htmlspecialchars($nbSeries) ?></p>
    </div>

    <div style="padding: 20px; background-color: #f0f0f0; border-radius: 10px;">
        <h2>Nombre total de tags</h2>
        <p style="font-size: 30px;"><?= htmlspecialchars($nbTags) ?></p>
    </div>

    <div style="padding: 20px; background-color: #f0f0f0; border-radius: 10px;">
        <h2>Nombre total d'acteurs</h2>
        <p style="font-size: 30px;"><?= htmlspecialchars($nbActs) ?></p>
    </div>
</div>

<br>

<?php
$content = ob_get_clean();
Template::render($content);
?>
