<?php

if(!isset($team)) {
    echo "Aucune équipe a afficher";
    exit;
}

$hasPlayers = isset($teamPlayers) && $teamPlayers != null;

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
        <input type="button" value="Rejoindre l'équipe"/>
    </div>   
</div>

