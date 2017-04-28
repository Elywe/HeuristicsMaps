<div id="contenu">
    <?php
    if (isset($erreur)) {
        echo "<p class=\"erreur\">$erreur</p>";
    }
    ?>
    <form action="index.php?section=mesCartes&action=ajoutCarte" method="post">
        <div>
            <h2>Ajouter une carte</h2>
            <input class="ajoutBox" type="text" name="nom" id="nom" required/>
            <input type="submit" class="bouton" id="Valider" name="Valider" value="Valider">
        </div>
    </form>
    <h2>Visualiser mes cartes</h2>
    <form class="carteBox" method="post" action="index.php?section=mesCartes&action=supprimerCarte">
        <select id="carte" name="carte">
            <?php
            foreach ($cartes as $carte) {
                echo "<option value=\"" . $carte->getIdentifiant() . "\">" . $carte->getNom() . "</option>";
            }
            ?>
        </select>
        <input type="submit" class="bouton" name="Valider" value="Valider">
        <input type="submit" class="bouton" name="Supprimer" value="Supprimer">
        <table>
            <tr>
                <th>identifiant</th>
                <th>nom</th>
            </tr>
            <?php
            foreach ($cartes as $carte) {
                echo "<tr><td>" . $carte->getIdentifiant() . "</td>";
                echo "<td>" . $carte->getNom() . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </form>
</div>