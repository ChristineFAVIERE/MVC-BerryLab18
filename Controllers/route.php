<?php
// Je créé la route commentaire
$routes = [
    '/commentaire' => 'commentaire',
];
require_once('models/class.commentaire.php');

switch ($_GET['route']) {
    // J'ajoute la fonction commentaire
    case 'addCommentaire':
        // je vérifie si le commentaire est bien saisi
        if (isset($_POST['submit'])) {
            if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                $commentaire = new Commentaire($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password']);

                // J'appelle la méthode pour créer le commentaire dans la Session et le cookie
                $commentaire->creationCommentaire($_GET['commentaire']);

                if ($commentaire) {
                    $message = 'Commentaire créé';
                } else {
                    $message = 'Commentaire mal enregistré';
                }
            } else {
                $message = 'Veuillez saisir tous les champs !!!';
            }
        }

        $action = 'Afficher';
        require_once('views/form-liste.php');
        break;

    // Je modifie le commentaire
    case 'modification':
        $commentaire = Commentaire::modificationCommentaire();
        $commentaire = $commentaire[$_GET['commentaire']];
        $administrateur = "Modifier";

        if (isset($_POST['submit'])) {
            if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                $commentaire = new Commentaire($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password']);

                // J'appelle la méthode pour modifier le commentaire dans la Session et le cookie
                $commentaire->modificationCommentaire($_GET['commentaire']);

                if ($commentaire) {
                    $message = 'Commentaire modifié';
                } else {
                    $message = 'Commentaire mal modifié';
                }
            } else {
                $message = 'Veuillez saisir tous les champs !!!';
            }
        }

        require_once('views/form-liste.php');
        break;

    // Je supprime le commentaire
    case 'delete':
        // Je vérifie qu'on a bien le commentaire
        if (!empty($_GET['commentaire'])) {
            Commentaire::deleteCommentaire($_GET['commentaire']);
        }
        break;

    // J'affiche la liste des commentaires
    default:
        // Je récupère la liste des commentaires
        $liste = Commentaire::afficheCommentaire();

        // Je charge la vue
        require_once('views/index.php');
        break;
}
?>