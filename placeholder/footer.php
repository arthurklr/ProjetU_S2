<style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
    }

    footer {
        background-color: #333;
        color: #fff;
        padding: 40px 0;
        font-size: 16px;
    }

    .footer-container {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        max-width: 1200px;
        margin: auto;
        padding: 0 20px;
    }

    .footer-section {
        flex: 1;
        padding: 20px;
        min-width: 250px;
        box-sizing: border-box;
    }

    .footer-section h2 {
        margin-bottom: 15px;
        font-size: 18px;
        border-bottom: 2px solid royalblue;
        padding-bottom: 5px;
    }

    .footer-section p,
    .footer-section ul {
        margin-top: 10px;
        padding: 0;
    }

    .footer-section ul {
        list-style: none;
    }

    .footer-section ul li {
        margin-bottom: 10px;
    }

    .footer-section ul li a {
        color: #fff;
        text-decoration: none;
        transition: color 0.3s;
    }

    .footer-section ul li a:hover {
        color: royalblue;
    }

    .footer-section .social a {
        margin-right: 15px;
        display: inline-block;
        width: 90px;
        height: 90px;
        transition: transform 0.3s;
    }

    .footer-section .social img {
        width: 100%;
        height: 100%;
    }

    .footer-section .social a:hover {
        transform: scale(1.1);
    }

    .footer-bottom {
        text-align: center;
        padding: 10px;
        background-color: #222;
    }

    .footer-bottom p {
        margin: 0;
        font-size: 14px;
        color: #bbb;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .footer-container {
            flex-direction: column;
            align-items: center;
        }

        .footer-section {
            margin-bottom: 20px;
        }
    }
</style>
<footer>
    <div class="footer-container">
        <div class="footer-section links">
            <h2>Liens rapides</h2>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="film.php">Les films</a></li>
                <li><a href="tarifs.php">Tarifs</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="inscription.php">S'inscrire</a></li>
            </ul>
        </div>
        <div class="footer-section contact">
            <h2>Contact</h2>
            <p>Email: contact@cinemaorbey.fr</p>
            <p>Téléphone: +33 3 89 71 26 18.</p>
            <p>Adresse: 23 rue Charles de Gaulle, 68370 ORBEY</p>
        </div>
        <div class="footer-section">
            <div class="social">
                <h2>Suivez-nous</h2>
                <a href="#"><img src="https://img.icons8.com/?size=100&id=ZRiAFreol5mE&format=png&color=000000" alt="Instagram"></a>
                <a href="https://www.facebook.com/CinemaOrbey" target="_blank"><img src="https://img.icons8.com/?size=100&id=118497&format=png&color=000000" alt="Facebook"></a>
                <a href="https://x.com/CinemaOrbey" target="_blank"><img src="https://img.icons8.com/?size=100&id=5MQ0gPAYYx7a&format=png&color=000000" alt="Twitter"></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 Arthur KIENTZLER. Tous droits réservés.</p>
    </div>
</footer>
</body>

</html>