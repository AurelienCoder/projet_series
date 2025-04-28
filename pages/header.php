<header class="main-header">
  <div class="logo">
    <a href="index.php"><h1>Web Series</h1></a>
  </div>

  <form class="search-form" action="search.php" method="get">
    <input 
      type="text" 
      name="query" 
      placeholder="Rechercher..." 
      maxlength="50"
      class="search-input"
    >
    <button type="submit" class="search-button">
      <i class="fas fa-search"></i>
    </button>
  </form>

  <?php             
      //toujours mettre session_start() lorsque nous voulons accéder à $_SESSION
      //je mets une condition pour éviter de lancer 2 fois une session
      if(session_status() === PHP_SESSION_NONE) session_start();
      if(isset($_SESSION['nickname'])):
  ?>
      <a href="logout.php" id="button-header">Logout</a>
  <?php else: ?>
      <a href="login.php" id="button-header">Login</a>
  <?php endif;?>
</header>