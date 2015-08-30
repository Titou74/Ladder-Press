<?php

$hasGuid = isset($userGuid) && $userGuid != null;

$hasTeam = isset($userTeam) && $userTeam != null;

$hasTeamInvitation = isset($userTeamInvitation) && $userTeamInvitation != null;

$hasTeamDemande = isset($userTeamDemande) && $userTeamDemande != null;

$hasHistorique = isset($userHistorique) && $userHistorique != null;

echo "<h2>Mes GUID</h2>";

if($hasTeam) {
    echo "Vos GUID";
} else {
    echo "<p>Vous n'avez saisi actuellement aucun GUID</p>";
}

echo "<a class=\"\" href=\"http://localhost/wordpress/wp-admin/post.php?post=35&action=edit\">Éditer vos GUID</a>";

echo "<hr>";

echo "<h2>Ma team</h2>";

if($hasTeam) {
    echo "<p>Equipe actuelle : " . $userTeam->getName() . "</p>";
} else {
    echo "<p>Vous n'êtes actuellement dans aucune équipe. Vous pouvez en rejoindre une depuis la <a href=\"\">liste  des équipes</a></p>";
}

echo "<h2>Invitation en cours</h2>";

if($hasTeamInvitation) {
    foreach ($userTeamInvitation as $team){
        echo "<p>L'équipe " . $team->getName() . " vous invite à rejoindre ses rangs. <a href=\"\">Répondre à l'invitation</a></p>";
    }
} else {
    echo "<p>Vous n'avez aucune invitation en cours</p>";
}

echo "<h2>Demande en cours</h2>";

if($userTeamDemande) {
    foreach ($userTeamDemande as $team){
        echo "<p>Vous avez une demande auprès de l'équipe " . $team->getName() . " en attente de confirmation.";
    }
} else {
    echo "<p>Vous n'avez aucune demande en cours</p>";
}

echo "<hr>";

echo "<h2>Historique de mon compte</h2>";
