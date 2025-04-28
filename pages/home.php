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
        <button class="favorite styled" type="button">Top séries</button>
        <button type="button">Par défaut</button>
        <button type="button">Animation</button>
        <button type="button">Action</button>
        <button type="button">Comédie</button>
        <button type="button">Aventure</button>
        <button type="button">Horreur</button>
        <button type="button">Drame</button>
    </div>

    <div class="series-list">
        <?php foreach ($series as $serie): ?>
            <div class="model_serie">
                <img src="<?php echo htmlspecialchars($serie['image']); ?>" alt="<?php echo htmlspecialchars($serie['title']); ?>">
                <h2><?php echo htmlspecialchars($serie['title']); ?></h2>
                <span>Durée : <?php echo htmlspecialchars($serie['duration']); ?></span>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="load-more">
        <button type="button">Voir la suite</button>
    </div>
</div>

<?php $code = ob_get_clean(); ?>
<?php Template::render($code); ?>
