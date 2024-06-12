<?php
session_start();
try {
    $bdd = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8;', 'root', '');
} catch (Exception $err) {
    die('Erreur de la connexion MySQL : ' . $err->getMessage());
}

$message = "";

if (isset($_POST['envoi'])) {
    if (!empty($_POST['pseudo']) and !empty($_POST['mdp'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mdp = $_POST['mdp'];

        $recupUser = $bdd->prepare('SELECT * FROM utilisateurs WHERE pseudo = ?');
        $recupUser->execute(array($pseudo));

        if ($recupUser->rowCount() > 0) {
            $userData = $recupUser->fetch();
            // Vérification du mot de passe
            if (password_verify($mdp, $userData['mdp'])) {
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['mdp'] = $mdp;
                $_SESSION['id_utilisateur'] = $userData['id_utilisateur'];
                header('Location: index.php');
            } else {
                $message = 'Votre mot de passe ou pseudo est incorrect';
            }
        } else {
            $message = 'Votre mot de passe ou pseudo est incorrect';
        }
    } else {
        $message = 'Veuillez compléter tous les champs';
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <link rel="stylesheet" href="styles/style_ci.css">
    <link rel="shortcut icon" href="img/favicon/edit-3.svg" />
</head>

<body>
    <div class="page1">
        <?php include 'placeholder/header.php' ?>
        <div class="accueil">
        <div class="formulaire">
                <form class="form" action="" method="post">
                    <p class="title">Connectez-vous</p>
                    <label>
                        <input id="text" name="pseudo" required="" placeholder="" class="input" autocomplete="off">
                        <span>Nom d'utilisateur, pseudo</span>
                    </label>
                    <label>
                        <input id="mdp" type="password" name="mdp" required="" placeholder="" type="password" class="input" autocomplete="off">
                        <span>Mot de passe</span>
                        <div class="password-strength">
                            <div class="strength-bar"></div>
                            <div class="password-hints"></div>
                            <?php if (isset($_POST['envoi'])) {
                                echo $message;
                            } ?>
                        </div>
                    </label>
                    <button type="submit" class="submit" name="envoi" id="envoyer" value="S'inscrire">Envoyer</button>
                </form>
            </div>
            <div class="inscrire">
                <div class="creer">Vous n'avez aucun compte ? Créez-en un ! <a href="inscription.php"><span>Inscrivez-vous</span></a></div>
            </div>
        </div>
    </div>
    <?php include 'placeholder/footer.php'?>

    <script src="js/script_ci.js"></script>
</body>

</html>