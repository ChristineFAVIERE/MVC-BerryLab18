<?php

//Création d'instance de la classe outil

require_once('db_trait.php');
class Outil
{
    use PDO;
    private $db;
    private $libelOutil;
    private $photoOutil;
    private $descriptionOutil;

    public function get()
    {
        return $this->libelOutil;
    }
    public function setOutil($libel): self
    {
        $this->libelOutil = $libel;

        return $this;
    }
    public function getOutil()
    {
        return $this->descriptionOutil;
    }
    public function setRealisation($description): self
    {
        $this->descriptionOutil = $description;

        return $this;
    }
    public function getPhoto()
    {
        return $this->photoOutil;
    }
    public function setphoto($photo): self
    {
        $this->photoOutil = $photo;

        return $this;
    }
    public function __construct($libel, $photo, $description)
    {
        $this->$libel = $libel;
        $this->$photo = $photo;
        $this->$description = $description;

        //Je prépare mes requêtes SQL

    }
    public function creationOutil($nomOutil, $photo, $description)
    {
        $stmt = $this->db->prepare("INSERT INTO Outil(libel_outil, photo_outil, description_outil) VALUES (:libel_outil, :photo_outil, :description_outil)");
        $stmt->bindParam(':libel_outil', $nomOutil);
        $stmt->bindParam(':photo_outil', $photo);
        $stmt->bindParam(':description_outil', $description);
        $stmt->execute();
    }

    public function suppressionOutil($idSelection)
    {
        $stmt = $this->db->prepare("DELETE FROM Outil WHERE id_outil = :id_outil");
        $stmt->bindParam(':id_outil', $idSelection);
        $stmt->execute();
    }

    public function modificationOutil($nomOutil, $photo, $description, $idSelection)
    {
        $stmt = $this->db->prepare("UPDATE Outil SET libel_outil = :libel_outil, photo_outil = :photo_outil, description_outil = :description_outil WHERE id_outil = :id_outil");
        $stmt->bindParam(':libel_outil', $nomOutil);
        $stmt->bindParam(':photo_outil', $photo);
        $stmt->bindParam(':description_outil', $description);
        $stmt->bindParam(':id_outil', $idSelection);
        $stmt->execute();
    }

    public function afficherOutil($idSelection)
    {
        $stmt = $this->db->prepare("SELECT libel_outil, photo_outil, description_outil FROM Outil WHERE id_outil = :id_outil");
        $stmt->bindParam(':id_outil', $idSelection);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
