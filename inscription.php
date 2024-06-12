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

        // Vérifier si le mot de passe respecte les critères de complexité
        if (!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#!@$%^&*()_+\-=\[\]{};\'":\\|,.<>\/?])/', $mdp)) {
            $message = "<div class='message'>Le mot de passe doit contenir au moins 8 caractères avec au moins un chiffre, une lettre majuscule et un caractère spécial.</div>";
        } else {
            // Vérifier si le pseudo existe déjà
            $verifPseudo = $bdd->prepare('SELECT * FROM utilisateurs WHERE pseudo = ?');
            $verifPseudo->execute(array($pseudo));

            if ($verifPseudo->rowCount() > 0) {
                $message = "Ce pseudonyme est déjà utilisé.";
            } else {
                $mdp = password_hash($mdp, PASSWORD_DEFAULT);

                // Insérer un nouvel utilisateur
                $insertUser = $bdd->prepare('INSERT INTO utilisateurs(pseudo, mdp)VALUES(?, ?)');
                $insertUser->execute(array($pseudo, $mdp));

                // Récupérer l'utilisateur nouvellement inséré
                $recupUser = $bdd->prepare('SELECT * FROM utilisateurs WHERE pseudo = ? AND mdp = ?');
                $recupUser->execute(array($pseudo, $mdp));

                if ($recupUser->rowCount() > 0) {
                    $userData = $recupUser->fetch();
                    $_SESSION['pseudo'] = $userData['pseudo'];
                    $_SESSION['mdp'] = $userData['mdp'];
                    $_SESSION['id_utilisateur'] = $userData['id_utilisateur'];
                    header('Location: index.php');
                }
            }
        }
    } else {
        $message = "Veuillez compléter tous les champs";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
    <link rel="stylesheet" href="styles/style_ci.css">
    <link rel="shortcut icon" href="img/favicon/edit-3.svg" />
</head>

<body>
    <div class="page1">
        <?php include 'placeholder/header.php' ?>
        <div class="accueil">
            <div class="formulaire">
                <form class="form" action="" method="post">
                    <p class="title">Inscrivez-vous</p>
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
                <div class="creer">Vous avez déjà un compte ? <a href="connexion.php"><span>Connectez-vous</span></a></div>
            </div>
        </div>
    </div>
    <?php include 'placeholder/footer.php' ?>

    <script src="js/script_ci.js"></script>
</body>

</html>