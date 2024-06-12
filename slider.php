<?php
// index.php    
// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8;', 'root', '');
} catch (Exception $err) {
    die('Erreur de la connexion MySQL : ' . $err->getMessage());
}

$reponse = $bdd->query("SELECT * FROM films WHERE a_l_affiche = 'oui'");

// Lecture de toutes les lignes de la réponse dans un tableau associatif
$table = $reponse->fetchAll(PDO::FETCH_ASSOC);

$bdd = null;

// Initialisation du résultat pour la section slider
$film_slider = "";

// Début de la section tranding
$film_slider .= "<section id='tranding'>";
$film_slider .= "<div class='container'>";
$film_slider .= "<h1 class='text-center section-heading'>Les films à l'affiche</h1>";
$film_slider .= "</div>";
$film_slider .= "<div class='container'>";
$film_slider .= "<div class='swiper tranding-slider'>";
$film_slider .= "<div class='swiper-wrapper'>";

// Boucle pour chaque film
foreach ($table as $ligne) {
    $film_slider .= "<div class='swiper-slide tranding-slide'>";
    $film_slider .= "<div class='tranding-slide-img'>";
    $film_slider .= "<a href='film.php?titre=" . urlencode($ligne['titre']) . "'><img src='img/affiche/" . $ligne['affiche'] . "' alt='" . $ligne['titre'] . "'></a>";
    $film_slider .= "</div>";
    $film_slider .= "</div>";
}

// Fin de la boucle et de la structure
$film_slider .= "</div>"; // Fin de swiper-wrapper
$film_slider .= "</div>"; // Fin de swiper tranding-slider

// Ajout des flèches de contrôle pour le slider
$film_slider .= "<div class='tranding-slider-control'>";
$film_slider .= "<div class='swiper-button-prev slider-arrow'>";
$film_slider .= "<ion-icon name='arrow-back-outline'></ion-icon>";
$film_slider .= "</div>";
$film_slider .= "<div class='swiper-button-next slider-arrow'>";
$film_slider .= "<ion-icon name='arrow-forward-outline'></ion-icon>";
$film_slider .= "</div>";
$film_slider .= "<div class='swiper-pagination'></div>";
$film_slider .= "</div>"; // Fin de tranding-slider-control

$film_slider .= "</div>"; // Fin de container
$film_slider .= "</section>"; // Fin de section tranding



?>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="styles/style_slider.css">
    <?= $film_slider ?>



    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="js/script_slider.js"></script>