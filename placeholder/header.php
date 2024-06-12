<style>
    header {
        padding: 16px 32px;
        display: flex;
        align-items: center;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        background: url(img/background/background_noir.jpg);
    }

    a {
        text-decoration: none;
        margin: 0;
        color: white;
        position: relative;
    }

    header img {
        width: 200px;
    }

    .categorie {
        margin-left: auto;
        display: flex;
        gap: 30px;
        font-size: 19px;
        align-items: center;
    }

    .categorie>div {
        font-size: 19px;
        position: relative;
        cursor: pointer;
        color: white;
    }

    .inscription {
        position: relative;
        top: 0;
        border-radius: 50%;
        height: 40px;
        width: 40px;
        cursor: pointer;
        transition: 0.3s ease;
    }

    .inscription:hover {
        background-color: #696969;
    }

    .inscription svg {
        position: absolute;
        top: 20%;
        right: 20%;
    }

    .deconnexion {
        color: white;
        text-decoration: underline;
        font-size: 13px;
    }

    .fond {
        background-color: #222;
        transition: 0.3s;
    }

    /* Effet de soulignement */
    .categorie>a:not(:nth-child(5)):not(:nth-child(6))::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        display: block;
        margin-top: 5px;
        right: 0;
        background: royalblue;
        transition: width 0.4s ease;
    }

    .categorie>a:not(:nth-child(5)):not(:nth-child(6)):hover::after {
        width: 100%;
        left: 0;
        background: royalblue;
    }

    .active {
        color: royalblue;
        font-weight: bold;
    }
</style>
<header>
    <img src="img/logo/logo_blanc-removebg.png" alt="Logo cinéma orbey">
    <div class="categorie">
        <a href="index.php">Accueil</a>
        <a href="film.php?date=sortie">Les films</a>
        <a href="tarifs.php">Tarifs</a>
        <a href="contact.php">Contact</a>
        <a href="inscription.php">
            <div class="inscription">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
        </a>
        <a href="php/deconnexion.php" class="deconnexion">Se déconnecter</a>
    </div>
</header>
<script src="js/souligner.js"></script>