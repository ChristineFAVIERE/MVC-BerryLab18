 <?php
    //Création d'instance de la classe administrateur
    require_once('db_trait.php');
    class Administrateur
{
    use PDO;
    private $db;
    private $nomAdministrateur;
    private $prenomAdministrateur;
    private $MotPassAdministrateur;
    private $EmailAdministrateur;

    public function getNom()
    {
        return $this->nomAdministrateur;
    }
    public function setNom($nom): self
    {
        $this->nomAdministrateur = $nom;

        return $this;
    }
    public function getPrenom()
    {
        return $this->prenomAdministrateur;
    }
    public function setPrenom($prenom): self
    {
        $this->prenomAdministrateur = $prenom;

        return $this;
    }
    public function getMotPassAdministrateur()
    {
        return $this->MotPassAdministrateur;
    }
    public function setmotPass($motPass): self
    {
        $this->MotPassAdministrateur = $motPass;

        return $this;
    }
    public function getEmailAdministrateur()
    {
        return $this->EmailAdministrateur;
    }
    public function setEmailAdministrateur($email): self
    {
        $this->EmailAdministrateur = $email;

        return $this;
    }

    public function __construct($nom, $prenom, $motPass,$email)
    {
        $this->$nom = $nom;
        $this->$prenom = $prenom;
        $this->$email = $email;
        $this->$motPass = $motPass;
    
    // Je prépare ma requête SQL
       $req = $db->prepare($sql);
       $req->bindParam(':nom',$_POST['nom'],PDO::PARAM_STR);
       $req->bindParam(':prenom',$_POST['prenom'],PDO::PARAM_STR);
       $req->bindParam(':email',$_POST['email'],PDO::PARAM_STR);
       $req->bindParam(':motpass',$motPass,PDO::PARAM_STR);

    // J'execute ma requête avec execute()
       if($req->execute())
    {
        echo 'Utilisateur enregistré';
    }
       else
    {
        echo 'Erreur';
    }
    // Je hashe le mot de passe
       $motPass = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $sql = 'INSERT INTO utilisateurs SET
            nom_utilisateur = :nom,
            prenom_utilisateur = :prenom,
            email_utilisateur = :email,
            password_utilisateur = :motpass';
            
    // J'execute ma requête avec execute
       if($req->execute())
    {
        echo 'sucess';
    } 
       else
    {
        echo 'ça a planté ';
    }}

    public static function suppressionAdministrateur($idAdministrateur)
    {
        $stmt = $this->db->prepare("DELETE FROM administrateur WHERE id_administrateur = :id_administrateur");
        $stmt->bindParam(':id_administrateur', $idAdministrateur);
        $stmt->execute();
    }
    public function modificationAdministrateur($idAdministrateur)
    {
        $stmt = $this->db->prepare("UPDATE administrateur SET administrateur = :WHERE id_administrateur = :id_administrateur");
        $stmt->bindParam(':id_administrateur', $idAdministrateur);
        $stmt->execute();
    }
    public function afficherAdministrateur($idAdministrateur)
    {
        $stmt = $this->db->prepare("SELECT administrateur FROM administrateur WHERE id_administrateur = :id_administrateur");
        $stmt->bindParam(':id_administrateur', $idAdministrateur);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function verifierConnexionEmailAdministrateur($emailAdministrateur)
    {
        $stmt = $this->db->prepare("SELECT administrateur FROM administrateur WHERE email_administrateur = :email_administrateur");
        $stmt->bindParam(':email_administrateur', $emailAdministrateur);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function verifierConnexionPasswordAdministrateur($passwordAdministrateur)
    {
        $stmt = $this->db->prepare("SELECT administrateur FROM administrateur WHERE password_administrateur = :password_administrateur");
        $stmt->bindParam(':password_administrateur', $passwordAdministrateur);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }}
?>






