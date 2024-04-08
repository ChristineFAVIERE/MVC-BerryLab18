<?php
//Création d'instance de la classe commentaire
require_once('db_trait.php');
class Membre
{
    use PDO;
    private $db;
    private $nomMembre;
    private $prenomMembre;
    private $emailMembre;

    public function getNom()
    {
        return $this->nomMembre;
    }
    public function setNom($nom): self
    {
        $this->nomMembre = $nom;

        return $this;
    }
    public function getPrenom()
    {
        return $this->prenomMembre;
    }
    public function setPrenom($prenom): self
    {
        $this->prenomMembre = $prenom;

        return $this;
    }
    public function getEmailMembre()
    {
        return $this->emailMembre;
    }
    public function setemail($email): self
    {
        $this->emailMembre = $email;

        return $this;
    }
    public function __construct($nom, $prenom, $email)
    {
        $this->$nom = $nom;
        $this->$prenom = $prenom;
        $this->$email = $email;
    }
    //Je prépare mes requêtes SQL
    public function creationMembre($nomMembre, $prenomMembre, $email)
    {
        $stmt = $this->db->prepare("INSERT INTO Membre(nom_membre, prenom_membre, email) VALUES (:nom_membre, :prenom_membre, :email)");
        $stmt->bindParam(':nom_membre', $nomMembre);
        $stmt->bindParam(':prenom_membre', $prenomMembre);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    }

    public function suppressionMembre($idSelection)
    {
        $stmt = $this->db->prepare("DELETE FROM Membre WHERE id_Membre = :id_membre");
        $stmt->bindParam(':id_membre', $idSelection);
        $stmt->execute();
    }

    public function modificationMembre($nomMembre, $prenomMembre, $email, $idSelection)
    {
        $stmt = $this->db->prepare("UPDATE Membre SET nom_membre = :nom_membre, prenom_membre = :prenom_membre, email_membre = :email_membre WHERE id_Membre = :id_membre");
        $stmt->bindParam(':nom_membre', $nomMembre);
        $stmt->bindParam(':prenom_membre', $prenomMembre);
        $stmt->bindParam(':email_membre', $email);
        $stmt->execute();
    }

    public function afficherMembre($idSelection)
    {
        $stmt = $this->db->prepare("SELECT nom_membre, prenom_membre, email FROM Membre WHERE id_Membre = :id_membre");
        $stmt->bindParam(':id_membre', $idSelection);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
        public function verifierConnexionEmailAdministrateur($emailAdministrateur)
        {
            $stmt = $this->db->prepare("SELECT administrateur FROM Administrateur WHERE email_administrateur = :email_administrateur");
            $stmt->bindParam(':email_administrateur', $emailAdministrateur);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function verifierConnexionPasswordAdministrateur($idAdministrateur)
        {
            $stmt = $this->db->prepare("SELECT administrateur FROM Administrateur WHERE id_administrateur = :id_administrateur");
            $stmt->bindParam(':id_administrateur', $idAdministrateur);
            $stmt->execute();
    
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }  
}
