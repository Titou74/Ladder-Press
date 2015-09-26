<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


echo '<h2> Que voulez-vous faire ?</h2>';
echo '<ul>';
echo '<li><a href="?p=teams&page=edit&teamId='.$userTeam->getId().'"> Administration de l\'équipe </a></li>';
echo '<li><a href="?p=teams&page=playersManagement&teamId='.$userTeam->getId().'"> Gestion des joueurs </a></li>';
echo '</ul>';
