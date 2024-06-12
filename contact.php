<?php
session_start();

$message = "";
$succes = "";


if (isset($_SESSION['id_utilisateur'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération de l'ID de l'utilisateur à partir de la session
        $id_utilisateur = $_SESSION['id_utilisateur'];
        // Récupération des données du formulaire
        $email = htmlspecialchars($_POST['email']);
        $sujet = htmlspecialchars($_POST['sujet']);
        $message_content = htmlspecialchars($_POST['message']);

        try {
            $bdd = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', '');

            // Construire la requête SQL avec les colonnes spécifiées
            $sql = "INSERT INTO contact (id_utilisateur, email, sujet, message) VALUES ('$id_utilisateur', '$email', '$sujet', '$message_content')";

            // Exécuter la requête
            $nombre = $bdd->exec($sql);

            // Vérifier si l'insertion a réussi
            if ($nombre !== false) {
                $succes = "Votre message a été envoyé avec succès !";
            } else {
                $message = "Une erreur est survenue lors de l'envoi de votre message. Veuillez réessayer.";
            }

            $bdd = null;
        } catch (PDOException $err) {
            die('Erreur de la connexion MySQL : ' . $err->getMessage());
        }
    }
} else {
    $message = "Vous devez être connecté pour envoyer un message.";
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous</title>
    <link rel="stylesheet" href="styles/style_contact.css">
    <link rel="shortcut icon" href="img/favicon/help-circle.svg" />
</head>

<body>
    <?php include 'placeholder/header.php'; ?>
    <div class="page">
        <form class="form" action="contact.php" method="post">
            <p class="title">Contactez-nous</p>
            <?php
            if (isset($_SESSION['id_utilisateur'])) {
                echo '<div>Bonjour <span class="pseudo">' . $_SESSION['pseudo'] . '</span></div>';
            } else {
                echo "<div class='obligatoire'>$message</div>";
            }
                
            ?>
            <h4>Une idée, une question, besoin de nous contacter ? Entrez votre adresse e-mail et rédigez un message ci-dessous, nous y répondrons aussi rapidement que possible.</h4>
            <label>
                <input id="email" name="email" required="" placeholder="" type="email" class="input" autocomplete="off">
                <span>Email</span>
            </label>
            <label>
                <input id="sujet" name="sujet" required="" placeholder="" type="text" class="input" autocomplete="off">
                <span>Sujet</span>
            </label>
            <label>
                <textarea id="message" name="message" required="" rows="5" placeholder="" class="input"></textarea>
                <span>Message</span>
            </label>
            <button type="submit" class="submit">Envoyer</button>
            <div class="succes">
                <?= $succes ?>
            </div>
        </form>
    </div>


    <?php include 'placeholder/footer.php' ?>
</body>

</html>