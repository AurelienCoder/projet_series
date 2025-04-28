<?php
require_once "config.php" ;

session_start() ;
$logged = isset($_SESSION['nickname']) ;

require $GLOBALS['PHP_DIR']."class/Autoloader.php";
Autoloader::register();
use series\Template ;
?>

<?php ob_start() ?>

<?php if($logged): ?>
<h1>Hi <?php echo $_SESSION['nickname'] ?>, </h1>
<?php endif; ?>

<div class="title">WELCOME </div>


<?php $code = ob_get_clean() ?>
<?php Template::render($code);
