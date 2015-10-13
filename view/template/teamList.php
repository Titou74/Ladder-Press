<?php

$hasTeams = isset($allTeams) && $allTeams != null;

if($hasTeams) {

    echo "<table id=\"ladder-press-team-list\">";

    echo "<thead>" .
             "<tr>" .
                 "<th><p>Nom</p></th> <th><p>Tag</p></th> <th><p>Logo</p></th> <th><p>Nombre de joueur</p></th> <!--<th><p>Nombre de lineup</p></th>--> <th></th>" .
             "</tr>" .
         "</thead>";

    echo "<tbody>";

       foreach ($allTeams as $team) {
           echo "<tr>";
               echo "<td><p>" . $team->getName() . "</p></td>";
               echo "<td><p>" . $team->getTag() . "</p></td>";
               echo "<td><img src=\"" .wp_get_attachment_url( $team->getLogoName() ). "\" alt=\"logo team " . $team->getName()  . "\" width=\"150\" ></td>";
               echo "<td><p>" . $team->getNumberOfUsers($team->getId()). "</p></td>";
               echo "<!--<td><p>" . "TODO" . "</p></td>-->"; // TODO
               echo "<td>";
               echo "<form style=\"display:inline;\" action=\"?p=teams&page=details&teamId=" . $team->getId() . "\" method=\"post\">" .
                        "<input id=\"submit\" class=\"button button-primary\" type=\"submit\" value=\"Détails de l'équipe\" />" .
                    "</form>";
                echo "</td>";
           echo "</tr>";
       }
       echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>Il n'y a pour l'instant aucune équipe.</p>";
}

echo "<form style=\"display:inline;\" action=\"?p=teams&page=create\" method=\"post\">" .
         "<input id=\"submit\" class=\"button button-primary\" type=\"submit\" value=\"Créer une équipe\" />" .
     "</form>";

?>

<script type='text/javascript'>
    jQuery(document).ready( function () {
        jQuery('#ladder-press-team-list').DataTable();
    } );
</script>