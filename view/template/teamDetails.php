<?php

if(!isset($team)) {
    echo "Aucune équipe a afficher";
    exit;
}
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
        $hasPlayers = $team->getPlayers();
        if(!empty($hasPlayers) && !is_null($hasPlayers)) {
            foreach ($hasPlayers as $player) {
                echo "<p>" . $player->getUserLogin() . "</p>";
            }
        } else {
            echo "<p>L'équipe n'a aucun joueur</p>";
        }
        ?>
        </div>
    </div>
    <div>
        <?php if(get_current_user_id() == 0): ?>
            <p><small><i> Vous devez vous connecter pour rejoindre une team </i></small></p>
        <?php elseif(is_null($userTeam) || empty($userTeam)) : ?>
            <form action="?p=teams&page=join_team&teamId=<?php echo $team->getId(); ?>" method="post"/>
                <input type="submit" value="Rejoindre l'équipe"/>
            </form>
        <?php elseif($userTeam->getId() == $team->getId()) : ?>
            <p><small><i> Vous êtes déjà inscrit dans cette équipe </i></small></p>
            <form action="?p=teams&page=leave_team&teamId=<?php echo $team->getId(); ?>" method="post"/>
                <input type="submit" value="Quitter l'équipe"/>
            </form>
        <?php else : ?>
            <p><small><i> Vous êtes déjà inscrit dans une autre équipe </i></small></p>
        <?php endif; ?>
    </div>   
</div>

