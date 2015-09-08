<?php

if(!isset($team)) {
    echo "Aucune équipe a afficher";
    exit;
}

$hasPlayers = isset($teamPlayers) && $teamPlayers != null;

$userTeam = UserTeam::getUserTeam(get_current_user_id(), $_GET['teamId']);
?>

<div>
    
    <img src=" <?php echo $team->getLogoName(); ?> " alt="logo team <?php echo $team->getName(); ?>" width="150" >
    
    <div>
        <div><p>Nom</p></div>
        <div><p> <?php echo $team->getName(); ?> </p></div>
    </div>
    <div>
        <div><p>Tag</p></div>
        <div><p> <?php echo $team->getTag(); ?> </p></div>
    </div>
    <div>
        <div><p>Nom</p></div>
        <div><p>Pseudo sur le site</p></div>
    </div>
    <div>
        <div><p>Site</p></div>
        <div><p><a href="<?php echo $team->getSite(); ?>" ><?php echo $team->getSite(); ?></a></p></div>
    </div>   
    <div>
        <div><p>Joueurs</p></div>
        <div>
        <?php
        if($hasPlayers) {
            foreach ($teamPlayers as $player) {

            }
        } else {
            echo "<p>L'équipe n'a aucun joueur</p>";
        }
        ?>
        </div>
    </div>
    <div>
        <form action="?page=join_team&teamId=<?php echo $team->getId(); ?>" method="post"/>
        <?php if(is_null($userTeam) || empty($userTeam)) : ?>
            <input type="button" value="Rejoindre l'équipe"/>
        <?php else : ?>
            <p><small><i> Vous êtes déjà inscrit dans une team </i></small></p>
        <?php endif; ?>
    </div>   
</div>

