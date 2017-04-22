<h1>Mes Cartes</h1>
<form action="index.php?section=mesCartes&action=ajoutCarte" method="post">
    <p>Nom : <input type="text" name="nom" id="nom" /></p>
    <p><input type="submit" id="Valider" name="Valider" value="Valider"></p>
</form>
<form class="carteBox" method="post" action="index.php?section=mesCartes&action=supprimerCarte">
    <select id="carte" name="carte">
        <?php
        foreach ($cartes as $carte) {
            echo "<option value=\"" . $carte->getIdentifiant() . "\">" . $carte->getNom() . "</option>";
        }
        ?>
    </select>
    <input type="submit" name="Valider" value="Valider">
    <input type="submit" name="Supprimer" value="Supprimer">
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