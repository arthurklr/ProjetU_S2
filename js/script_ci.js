document.addEventListener('DOMContentLoaded', function () {
    const mdpInput = document.getElementById('mdp');
    const strengthBar = document.querySelector('.strength-bar');
    const passwordHints = document.querySelector('.password-hints');
    const hints = {
        uppercase: 'Au moins une lettre majuscule',
        number: 'Au moins un chiffre',
        special: 'Au moins un caractère spécial',
        length: 'Au moins 8 caractères'
    };

    mdpInput.addEventListener('input', function () {
        const mdp = mdpInput.value;
        const longueur = mdp.length;
        let force = 0;
        let hintsText = '';

        // Vérification de la longueur
        if (longueur >= 8) {
            force += 20;
        } else {
            hintsText += '<div class="password-hint">Au moins 8 caractères</div>';
        }

        // Vérification de la présence de lettres minuscules
        if (mdp.match(/[a-z]/)) {
            force += 20;
        } else {
            hintsText += '<div class="password-hint">Au moins une lettre minuscule</div>';
        }

        // Vérification de la présence de lettres majuscules
        if (mdp.match(/[A-Z]/)) {
            force += 20;
        } else {
            hintsText += '<div class="password-hint">Au moins une lettre majuscule</div>';
        }

        // Vérification de la présence de chiffres
        if (mdp.match(/\d/)) {
            force += 20;
        } else {
            hintsText += '<div class="password-hint">Au moins un chiffre</div>';
        }

        // Vérification de la présence de caractères spéciaux
        if (mdp.match(/[#!@$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/)) {
            force += 20;
        } else {
            hintsText += '<div class="password-hint">Au moins un caractère spécial</div>';
        }

        // Mettre à jour la barre de force
        strengthBar.style.width = force + '%';

        // Appliquer les classes CSS en fonction de la force du mot de passe
        strengthBar.className = 'strength-bar';
        if (force < 40) {
            strengthBar.classList.add('weak');
            hintsText += '<div class="password-strength-message-red">Votre mot de passe est faible</div>';
        } else if (force < 80) {
            strengthBar.classList.add('medium');
            hintsText += '<div class="password-strength-message-yellow">Votre mot de passe est moyen</div>';
        } else {
            strengthBar.classList.add('strong');
            hintsText += '<div class="password-strength-message-green">Votre mot de passe est fort</div>';
        }

        // Afficher les indices de mot de passe manquants
        passwordHints.innerHTML = hintsText;
    });
});
