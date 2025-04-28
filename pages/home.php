<?php
session_start();
$logged = isset($_SESSION['nickname']);
require_once "../class/Autoloader.php";
Autoloader::register();

$series = [
    [
        'title' => 'Breaking Bad',
        'duration' => '47 min',
        'image' => '../images/breaking.jpg'
    ],
    [
        'title' => 'Attack on Titan',
        'duration' => '25 min',
        'image' => '../images/attack titan.jpg'
    ],
    [
        'title' => 'Stranger Things',
        'duration' => '50 min',
        'image' => '../images/stranger thing.jpg'
    ]
];
?>

<?php ob_start() ?>

<?php if ($logged): ?>
    <h1>Hi <?php echo htmlspecialchars($_SESSION['nickname']); ?>,</h1>
<?php endif; ?>

<div class="title">WELCOME</div>

<div class="main_content">
    <div class="category-buttons">
        <div class="favorite styled">Toutes les séries</div>
        <button type="button">Animation</button>
        <button type="button">Action</button>
        <button type="button">Comédie</button>
        <button type="button">Aventure</button>
        <button type="button">Horreur</button>
        <button type="button">Drame</button>
    </div>

    <div class="series-list">
    <div id="main-container">
    <?php 
    $serieDB = new \sdb\SerieDB();
    $data = $serieDB->getAllSeries();

    foreach($data as $d){
        echo $d->getHTML();
    }

    $data = $serieDB->getAllTags();

    foreach($data as $d){
        echo $d->getHTML();
    }
    ?>
</div>
    </div>

    <div class="load-more">
        <button type="button">Voir la suite</button>
    </div>
</div>

<?php $code = ob_get_clean(); ?>
<?php Template::render($code); ?>
