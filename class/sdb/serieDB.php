<?php

namespace sdb;

//IMPORTANT car l'autoloader essaye de charger la classe PDO
use \PDO;

class serieDB{

    private PDO $pdo;

    public function __construct(){
        $db_name = "seriesdb";
        $db_host = "127.0.0.1";
        $db_port = "3306";
        
        $db_user = "root";
        $db_pwd = "";

        $dsn = 'mysql:dbname=' . $db_name . ';host=' . $db_host . ';port=' . $db_port;

        try{
            $this->pdo = new PDO($dsn, $db_user, $db_pwd);
        } catch(\Exception $ex){
            die("Erreur : " . $ex->getMessage());
        }
    }

    public function createGame($name, $description=null, $imgFile=null){ 
        
        //upload dans la base de données
        $query = "INSERT INTO games (name, description, image) VALUES (:name, :description, :image)";
        $statement = $this->pdo->prepare($query);

        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':image', $imgFile['name']);

        $statement->execute() or die(var_dump($statement->errorInfo()));

        //IMPORTANT
        $name = htmlspecialchars($name);
        $description = htmlspecialchars($description);

        $imgName = null;
        //upload de l'image
        if($imgFile != null){
            $tmpName = $imgFile['tmp_name'] ;
            $imgName = $imgFile['name'] ;
            $imgName = urlencode(htmlspecialchars($imgName)) ;

            //Le __DIR__ . DIRECTORY_SEPARATOR est important sinon il crée un fichier à la racine de www
            $dirname = __DIR__ . DIRECTORY_SEPARATOR . "../../uploads/";       

            if(!is_dir($dirname)) mkdir($dirname) ;
            $uploaded = move_uploaded_file($tmpName, $dirname.$imgName);
        }else echo "Pas d'image";

        echo "Le jeu $name a été ajouté.<br>";
        header('Location: games_list.php');
    }

    //IMPORTANT Nous ne sommes pas obligés de spécifier le type de retour
    public function getAllGames(){
        $sql = "SELECT * FROM games";
        $statement = $this->pdo->prepare($sql);

        $statement->execute() or die(var_dump($statement->errorInfo()));

        //IMPORTANT FETCH_ASSOC pour transformer en tableau
        //FETCH_CLASS pour transformer vers une classe
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\gdb\GameRenderer");

        return $results;
    }
}