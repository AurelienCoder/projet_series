<?php

namespace sdb;

//IMPORTANT car l'autoloader essaye de charger la classe PDO
use \PDO;

/**
 * Cette classe récupère la base de données seriesdb et s'occupe de mettre en place les différentes requêtes
 */
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

    //IMPORTANT Nous ne sommes pas obligés de spécifier le type de retour
    public function getAllSeries(){
        $sql = "SELECT * FROM serie INNER JOIN serie_tag, tag 
        WHERE serie.id_serie = serie_tag.id_serie AND tag.id_tag = serie_tag.id_tag";

        $statement = $this->pdo->prepare($sql);

        $statement->execute() or die(var_dump($statement->errorInfo()));

        //IMPORTANT FETCH_ASSOC pour transformer en tableau
        //FETCH_CLASS pour transmettre les données vers une classe
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\SerieRender");

        return $results;
    }

    public function getAllActors(){
        $sql = "SELECT * FROM acteur";

        $statement = $this->pdo->prepare($sql);

        $statement->execute() or die(var_dump($statement->errorInfo()));

        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\ActorRender");

        return $results;
    }

    public function getAllRealisators(){
        $sql = "SELECT * FROM realisateur";

        $statement = $this->pdo->prepare($sql);

        $statement->execute() or die(var_dump($statement->errorInfo()));

        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\RealRender");

        return $results;
    }

    public function getSpecialRequest($titre= null, $tag=null, $acteur=null){
        
        if($titre != null){
            $sql= "SELECT * FROM serie WHERE $titre = serie.titre_serie";
        }

        else if($tag != null){
            $sql= "SELECT * FROM serie WHERE $tag = tag.nom_tag
            INNER JOIN serie_tag WHERE serie.id_serie = serie_tag.serie_id
            INNER JOIN tag WHERE serie_tag.id_tag = tag.id_tag
            ";
        }

        else if($acteur != null){
            $sql= "SELECT * FROM serie WHERE $acteur = acteur.nom_acteur
            INNER JOIN saison WHERE serie.id_serie = saison.id_serie
            INNER JOIN saison_acteur WHERE saison saison.id_saison = saison_acteur.id_saison
            INNER JOIN acteur WHERE saison_acteur.id_acteur = acteur.id_acteur
            ";
        }

        $statement = $this->pdo->prepare($sql);

        $statement->execute() or die(var_dump($statement->errorInfo()));

        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\SerieRender");

        return $results;
    }

    public function getAllTags() {
        $sql = "SELECT * FROM tag";
        $statement = $this->pdo->prepare($sql);
        $statement->execute() or die(var_dump($statement->errorInfo()));

        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\TagRender");
        return $results;
    }

    public function getSerieById($id) {
        $sql = "SELECT * FROM serie WHERE id_serie = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $statement->setFetchMode(PDO::FETCH_CLASS, "\sdb\SerieRender");

        $serie = $statement->fetch();
        return $serie ?: null;
    }

    public function addSerie($titre, $affiche, $synopsis) {
        $sql = "INSERT INTO serie (titre_serie, affiche_serie, synopsis_serie) 
                VALUES (:titre, :affiche, :synopsis)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':titre', $titre, PDO::PARAM_STR);
        $statement->bindParam(':affiche', $affiche, PDO::PARAM_STR);
        $statement->bindParam(':synopsis', $synopsis, PDO::PARAM_STR);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function updateSerie($id, $titre, $affiche, $synopsis) {
        $sql = "UPDATE serie 
                SET titre_serie = :titre, 
                    affiche_serie = :affiche, 
                    synopsis_serie = :synopsis 
                WHERE id_serie = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':titre', $titre, PDO::PARAM_STR);
        $statement->bindParam(':affiche', $affiche, PDO::PARAM_STR);
        $statement->bindParam(':synopsis', $synopsis, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function deleteSerie($id) {
        $sql = "DELETE FROM serie WHERE id_serie = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function countSeries(): int {
        $sql = "SELECT COUNT(*) FROM serie";
        $statement = $this->pdo->prepare($sql);
        $statement->execute() or die(var_dump($statement->errorInfo()));

        return (int) $statement->fetchColumn();
    }

    public function countTags(): int {
        $sql = "SELECT COUNT(*) FROM tag";
        $statement = $this->pdo->prepare($sql);
        $statement->execute() or die(var_dump($statement->errorInfo()));

        return (int) $statement->fetchColumn();
    }
}