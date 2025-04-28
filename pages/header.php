
<header>
    <nav class="navbar navbar-dark bg-dark">
        <div class="nav-content">
            <a class="navbar-brand" href="home.php">
                <div style="width: 0.5em"></div>
                <h1>Web Series</h1>
            </a>
            

            <div style="flex: 1"></div>

            <?php             
                    //toujours mettre session_start() lorsque nous voulons accéder à $_SESSION
                    //je mets une condition pour éviter de lancer 2 fois une session
                    if(session_status() === PHP_SESSION_NONE) session_start();
                    if(isset($_SESSION['login'])) :
                ?>
                    <a href="logout.php" id="button-header">Logout</a>
                <?php else: ?>
                    <a href="login.php" id="button-header">Login</a>
                <?php endif;?>
            </header>
    
            </div>
        </div>
    </nav>
</header>
