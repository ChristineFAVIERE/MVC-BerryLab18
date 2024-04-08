<?php
// Je créé la route administrateur
$routes = [
    '/administrateur' => 'administrateur',
];
require_once('../Models/class_administrateur.php');

switch ($_GET['route']) {
    // J'ajoute des administrateurs
    case 'addAdministrateur':
        // je  vérifie si le formulaire est bien saisi
        if (isset($_POST['submit'])) {
            if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                $administrateur = new Administrateur($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password']);

                // J'enregistre l'administrateur dans la session et le cookie
                $_SESSION['administrateur'] = $administrateur;
                setcookie('administrateur', serialize($administrateur), time() + 3600);

                $message = 'Administrateur enregistré';
            } else {
                $message = 'Veuillez saisir tous les champs !!!';
            }
        }
        require_once('views/form-liste.php');
        break;

    // Je modifie l'administrateur
    case 'modificationAdministrateur':
        $id = $_GET['id'];
        $administrateur = Administrateur::findById($id);

        if (isset($_POST['submit'])) {
            if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                $administrateur->setNom($_POST['nom']);
                $administrateur->setPrenom($_POST['prenom']);
                $administrateur->setEmail($_POST['email']);
                $administrateur->setPassword($_POST['password']);

                // Je mets à jour l'administrateur dans la session et le cookie
                $_SESSION['administrateur'] = $administrateur;
                setcookie('administrateur', serialize($administrateur), time() + 3600);

                $message = 'Administrateur modifié';
            } else {
                $message = 'Veuillez saisir tous les champs !!!';
            }
        }
        require_once('views/form-liste.php');
        break;

    // Je supprime l'administrateur
    case 'deleteAdministrateur':
        $id = $_GET['id'];
        Administrateur::delete($id);

        // Je supprime l'administrateur de la session et du cookie
        unset($_SESSION['administrateur']);
        setcookie('administrateur', '', time() - 3600);

        $message = 'Administrateur supprimé';
        require_once('views/form-liste.php');
        break;

    // J'affiche la liste des administrateurs
    case 'afficheListeAdministrateur':
    default:
        // Je récupère la liste des administrateurs
        $liste = Administrateur::getAll();

        // Je charge la vue
        require_once('views/index.php');
        break;
}
?>