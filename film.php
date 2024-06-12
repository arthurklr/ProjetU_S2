<?php
session_start();
try {
    $bdd = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8;', 'root', '');
} catch (Exception $err) {
    die('Erreur de la connexion MySQL : ' . $err->getMessage());
}

include 'php/mois_francais.php';

// Récupérer le paramètre GET "tri" s'il est défini
$tri = isset($_GET['tri']) ? $_GET['tri'] : '';
$date = isset($_GET['date']) ? $_GET['date'] : '';

// Initialisation des variables pour les détails du film
$resultat = "";
$informations = "";
$afficherHr = true; // Variable pour gérer l'affichage de la ligne horizontale

// Vérifier si un titre de film est passé en paramètre GET
if (isset($_GET['titre'])) {
    // Désactiver l'affichage de la ligne horizontale
    $afficherHr = false;

    // Récupérer le titre du film depuis l'URL
    $titre = urldecode($_GET['titre']);

    // Préparer la requête pour récupérer les détails du film en fonction de son titre
    $requete = $bdd->prepare("SELECT * FROM films WHERE titre = :titre");
    $requete->bindParam(':titre', $titre);
    $requete->execute();

    // Récupérer les données du film
    $film = $requete->fetch(PDO::FETCH_ASSOC);

    // Vérifier si le film existe dans la base de données
    if ($film) {
        // Récupérer la date de sortie du film depuis la base de données
        $dateDeSortie = new DateTime($film['date_de_sortie']);

        // Formater la date avec le nom du mois en français
        $dateFormatee = $dateDeSortie->format('d F Y');

        // Remplacer le nom du mois en anglais par son équivalent en français
        $dateFormatee = strtr($dateFormatee, $moisEnFrancais);

        $informations .= "<a href='film.php?date=sortie'><div class='rond'>";
        $informations .= "<div class='croix'></div>";
        $informations .= "<div class='croix1'></div></div></a>";

        // Ouvrir la div conteneur seulement s'il y a un film à afficher
        $informations .= "<div class='film_informations'>";
        $informations .= "<img src='img/affiche/" . $film['affiche'] . "' alt='" . $film['titre'] . "' class='affiche_detail'>";

        // Ouvrir la div conteneur seulement s'il y a un film à afficher
        $informations .= "<div class='film_details'>";
        $informations .= "<h3>" . $film['titre'] . "</h3>";
        $informations .= "<div class='realisateurs'><strong>Réalisé par </strong> " . $film['realisateurs'] . "</div>";
        $informations .= "<div class='synopsis'><strong>Résumé</strong><br><div>" . $film['synopsis'] . "</div></div>";

        // Traitement des acteurs pour les afficher dans des div séparées
        $informations .= "<div class='acteurs'><strong>Avec</strong><br>";
        $acteurs = explode(',', $film['acteurs']);
        $informations .= "<div class='flex_acteurs'>";
        foreach ($acteurs as $acteur) {
            $acteur = trim($acteur); // Pour enlever les espaces en trop autour du nom de l'acteur
            $informations .= "<div>" . $acteur . "</div>";
        }
        $informations .= "</div>";
        $informations .= "</div>";

        $informations .= "<div class='genre'><strong>Genre</strong>";
        $genres = explode(',', $film['genre']);
        $informations .= "<div class='flex_genre'>";
        foreach ($genres as $genre) {
            $genre = trim($genre); // Pour enlever les espaces en trop autour du nom de l'acteur
            $informations .= "<div>" . $genre . "</div>";
        }
        $informations .= "</div>";
        $informations .= "</div>";

        // Récupérer et afficher les horaires de ce film
        $idFilm = $film['id_films'];
        $requeteHoraires = $bdd->prepare("SELECT seance.horaire FROM seance WHERE seance.id_films = :id_films");
        $requeteHoraires->bindParam(':id_films', $idFilm);
        $requeteHoraires->execute();
        $horaires = $requeteHoraires->fetchAll(PDO::FETCH_ASSOC);

        if ($horaires) {
            $informations .= "<div class='horaires'><strong>Prochaines séances</strong><br>";
            $informations .= "<div class='flex_horaires'>";
            foreach ($horaires as $horaire) {
                $informations .= "<div>" . $horaire['horaire'] . "</div>";
            }
            $informations .= "</div>";
            $informations .= "</div>";
        } else {
            $informations .= "<div class='flex_horaires'><div>Il n'y a pas de séance prévu pour ce film</div></div>";
        }


        $informations .= "<div class='duree'><img src='img/favicon/clock_noir.svg' alt='horloge noir'>" . $film['duree'] . " min</div>";
        $informations .= "<div class='sortie'><img src='img/favicon/calendar_noir.svg' alt='horloge noir'> " . $dateFormatee . "</div>";
        $informations .= "<div class='ba'><a href='" . $film['bande_annonce'] . "' target='blank' class='lien_ba'>Bande annonce</a></div>";


        $informations .= "</div>"; // Fermeture de la div film_details
        $informations .= "</div>"; // Fermeture de la div film_informations
    } else {
        // Si le film n'existe pas, afficher un message d'erreur
        $resultat = "<p>Le film demandé n'existe pas.</p>";
    }
} else {
    include 'php/tri_film.php';

    if ($date == 'sortie') {
        $requete = $bdd->query("SELECT * FROM films WHERE a_l_affiche = 'oui'");
    } else {
        $requete = $bdd->query("SELECT * FROM films WHERE a_l_affiche = 'prochainement'");
    }

    $films = $requete->fetchAll(PDO::FETCH_ASSOC);

    // Afficher la liste de tous les films
    if ($date == 'sortie') {
        $resultat .= "<h1>Les films à l'affiche</h1>";
    } else {
        $resultat .= "<h1>Les films à venir</h1>";
    }

    $resultat .= "<div class='conteneur'>";
    foreach ($films as $film) {
        // Récupérer les informations spécifiques pour chaque film
        $titreFilm = $film['titre'];
        $afficheFilm = $film['affiche'];

        // Récupérer et afficher les horaires de ce film
        $idFilm = $film['id_films'];
        $requeteHoraires = $bdd->prepare("SELECT seance.horaire FROM seance WHERE seance.id_films = :id_films");
        $requeteHoraires->bindParam(':id_films', $idFilm);
        $requeteHoraires->execute();
        $horaires = $requeteHoraires->fetchAll(PDO::FETCH_ASSOC);

        // Ouverture de la div film
        $resultat .= "<div class='film'>
                        <a href='film.php?titre=" . urlencode($film['titre']) . "'>
                            <img src='img/affiche/" . $afficheFilm . "' alt='" . $titreFilm . "' class='affiche_film'>";

        // Ouverture de la div info_horaires
        $resultat .= "<div class='info_horaires'>";

        if ($horaires) {
            foreach ($horaires as $horaire) {
                $resultat .= "<div>" . $horaire['horaire'] . "</div>";
            }
        } else {
            $resultat .= "<div>Aucune séance</div>";
        }

        // Fermeture de la div info_horaires
        $resultat .= "</div>";

        // Ouverture de la div info_carre
        $resultat .= "<div class='info_carre'>
                        <h3 class='titre_film'>" . $titreFilm . "</h3>
                        <p class='duree_affiche'><img src='img/favicon/clock.svg' alt='horloge'>" . $film['duree'] . " min</p>
                        <p class='genre_affiche'><img src='img/favicon/bobine_film.png' alt='horloge'>" . $film['genre'] . "</p>
                      </div>
                    </a>
                  </div>"; // Fermeture de la div film
    }

    // Fermeture de la div conteneur
    $resultat .= "</div>";
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les films à l'affiche</title>
    <link rel="stylesheet" href="styles/style_film.css">
    <link rel="shortcut icon" href="img/favicon/film.svg" />
</head>

<body>
    <div class="fond">
        <?php include 'placeholder/header.php' ?>
    </div>
    <div class="page1">
        <?= $tri ?>
        <?php if ($afficherHr) {
            echo '<hr>';
        } ?>
        <?= $resultat ?>
        <?= $informations ?>
    </div>
    <?php include 'placeholder/footer.php' ?>

    <script>
        document.querySelector(".bloc-top").addEventListener("click", tourne)

        function tourne() {
            document.querySelector(".bloc-top>span").classList.toggle('tourne')
        }
    </script>
    <script src="js/bouton_tri.js"></script>
    <script src="js/script_tri_titre.js"></script>
    <script src="js/souligner.js"></script>
</body>

</html>