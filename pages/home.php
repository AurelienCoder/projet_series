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
<div class="title" style="text-align:center; font-size:2rem; margin-bottom:1rem;">WELCOME</div>

<div class="main_content" style="padding: 0 2rem;">
    <div class="category-buttons" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 10px; margin-bottom: 2rem;">
        <button class="category-btn" type="button" onclick="showDefaultSeries()">Par défaut</button>
        <button class="category-btn" type="button" onclick="redirectToCategory('top')">Top séries</button>
        <button class="category-btn" type="button" onclick="redirectToCategory('animation')">Animation</button>
        <button class="category-btn" type="button" onclick="redirectToCategory('action')">Action</button>
        <button class="category-btn" type="button" onclick="redirectToCategory('comedie')">Comédie</button>
        <button class="category-btn" type="button" onclick="redirectToCategory('aventure')">Aventure</button>
        <button class="category-btn" type="button" onclick="redirectToCategory('horreur')">Horreur</button>
        <button class="category-btn" type="button" onclick="redirectToCategory('drame')">Drame</button>
    </div>

    <div class="series-list" id="series-list" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1.5rem;">
        <?php foreach ($series as $index => $serie): ?>
            <div class="model_serie" onclick="openSerie(<?php echo $index; ?>)" style="cursor: pointer; background: #f8f9fa; padding: 1rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); transition: transform 0.3s;">
                <img src="<?php echo htmlspecialchars($serie['image']); ?>" alt="<?php echo htmlspecialchars($serie['title']); ?>" style="width:100%; height: auto; border-radius: 10px;">
                <h2 style="font-size:1.2rem; margin-top: 0.5rem;"><?php echo htmlspecialchars($serie['title']); ?></h2>
                <span>Durée : <?php echo htmlspecialchars($serie['duration']); ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</div>


<script>

const series = <?php echo json_encode($series); ?>;


const seriesLinks = <?php echo json_encode(array_column($series, 'source')); ?>;

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
    

function openSerie(index) {
    const link = seriesLinks[index];
    if (link) {
        window.open(link, '_blank');
    } else {
        alert('Aucun lien source disponible pour cette série.');
    }
}


function showDefaultSeries() {
    const list = document.getElementById('series-list');
    list.innerHTML = ''; 

    series.forEach((serie, index) => {
        const card = document.createElement('div');
        card.className = 'model_serie';
        card.style.cursor = 'pointer';
        card.style.background = '#f8f9fa';
        card.style.padding = '1rem';
        card.style.borderRadius = '10px';
        card.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
        card.style.transition = 'transform 0.3s';
        card.onclick = () => openSerie(index);

        card.innerHTML = `
            <img src="${serie.image}" alt="${serie.title}" style="width:100%; height:auto; border-radius:10px;">
            <h2 style="font-size:1.2rem; margin-top:0.5rem;">${serie.title}</h2>
            <span>Durée : ${serie.duration}</span>
        `;
        list.appendChild(card);
    });
}


function redirectToCategory(category) {
    window.location.href = "category.php?cat=" + category;
}
</script>


<?php $code = ob_get_clean(); ?>
<?php Template::render($code); ?>
