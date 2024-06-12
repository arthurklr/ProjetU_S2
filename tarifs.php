<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarifs Cinéma</title>
    <link rel="stylesheet" href="styles/style_tarifs.css">
    <link rel="shortcut icon" href="img/favicon/icons8-tarif.png" />
</head>

<body>
    <?php include 'placeholder/header.php' ?>

    <div class="page">
        <div class="container">
            <h1>Tarifs</h1>
            <ul class="price-list">
                <li class="price-item">
                    <span class="category">Tarif normal : </span>
                    <span class="price">6 €</span>
                </li>
                <li class="price-item">
                    <span class="category">Tarif réduit : </span>
                    <span class="price">5 €</span>
                    <div class="justification">
                        <p>(Pour les enfants et adolescents jusqu'à 16 ans, les étudiants, les porteurs de cartes Cezam et les Comités d'Entreprises Alcon, M.G.E.N. et Zimmer, les demandeurs d'emploi, les séniors à partir de 65 ans)</p>
                    </div>
                </li>
                <li class="price-item">
                    <span class="category">Tarif -14ans : </span>
                    <span class="price">4 €</span>
                    <div class="justification">
                        <p>(Sur présentation d'un justificatif uniquement)</p>
                    </div>
                </li>
                <li class="price-item">
                    <span class="category">Suppléments 3D : </span>
                    <span class="price">1 €</span>
                </li>
            </ul>

            <ul class="pass-list">
                <li class="pass-item">
                    <span class="category">Carnet 8 entrées : </span>
                    <span class="price">36 €</span>
                    <div class="justification">
                        <p>(Supplément 3D non inclus)</p>
                    </div>
                </li>
                <li class="pass-item">
                    <span class="category">Carnet 6 entrées : </span>
                    <span class="price">24 €</span>
                    <div class="justification">
                        <p>(Supplément 3D non inclus)</p>
                    </div>
                </li>
            </ul>

        </div>
    </div>
    <?php include 'placeholder/footer.php' ?>
</body>

</html>