<?php
//Création d'instance de la classe commentaire
require_once('db_trait.php');
class Commentaire
{
    use PDO;
    private $db;
    private $membreCommentaire;

    public function getCommentaire()
    {
        return $this->membreCommentaire;
    }
    public function setCommentaire($nom): self
    {
        $this->membreCommentaire = $nom;

        return $this;
    }
    public function __construct($membre)
    {
        $this->$membre = $membre;
    }

    //Appel à la méthode création commentaire

    public function creationCommentaire($commentaire)
    {
        $stmt = $this->db->prepare("INSERT INTO Commentaire(commentaire) VALUES (:commentaire)");
        $stmt->bindParam(':commentaire', $commentaire);
        $stmt->execute();
    }

    //Appel à la méthode suppression commentaire

    public function suppressionCommentaire($idSelection)
    {
        $stmt = $this->db->prepare("DELETE FROM Commentaire WHERE id_commentaire = :id_commentaire");
        $stmt->bindParam(':id_commentaire', $idSelection);
        $stmt->execute();
    }

    //Appel à la méthode modification commentaire

    public function modificationCommentaire($Selection)
    {
        $stmt = $this->db->prepare("UPDATE Commentaire SET commentaire = :commentaire WHERE id_commentaire = :id_commentaire");
        $stmt->bindParam(':commentaire',$Selection);
        $stmt->execute();
    }

    //Appel à la méthode afficher un commentaire

    public function afficherCommentaire($Selection)
    {
        $stmt = $this->db->prepare("SELECT commentaire FROM Commentaire WHERE id_commentaire = :id_commentaire");
        $stmt->bindParam(':commentaire',$Selection);
        $stmt->execute();
    }
    //Appel à la méthode liste commentaire

    public function afficherListeCommentaire($Selection)
    {
        $stmt = $this->db->prepare("SELECT listeCommentaire FROM ListeCommentaire");
        $stmt->bindParam(':ListeCommentaire',$Selection);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}


    
    
    
    
   

?>
