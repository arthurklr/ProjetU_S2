<?php

$tri = "<div class='tri'>";
$tri .= "<div class='dropdown'>";
$tri .= "<button class='bloc-top'>";
$tri .= "Trier par<span><svg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 24 24' fill='none' stroke='#ffffff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>";
$tri .= "<path d='M12 19V6M5 12l7-7 7 7' /></svg></span>";
$tri .= "</button>";
$tri .= "<div class='bloc-links'>";
$tri .= "<ul>";
$tri .= "<li><a href=''>Trier par titre (A-Z)</a></li>";
$tri .= "<li><a href=''>Trier par titre (Z-A)</a></li>";
$tri .= "</ul>";
$tri .= "</div>"; // fermes `bloc-links`
$tri .= "</div>"; // fermes `dropdown`
$tri .= "<div class='centre'>";
$tri .= "<a href='film.php?date=sortie'><h3>Les films à l'affiche</h3></a>";
$tri .= "<a href='film.php?date=bientot'><h3>Les films à venir</h3></a>";
$tri .= "</div>"; // fermes `centre`
$tri .= "</div>"; // fermes `tri`
