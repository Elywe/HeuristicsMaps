<h1>Mes Cartes</h1>
<form class="carteBox" method="post" action="index.php?section=formulaire">
    <select id="carte" name="carte">
        <option value="Carte_1">Carte 1</option>
        <option value="Carte_2">Carte 2</option>
        <option value="Carte_3">Carte 3</option>
        <option value="Carte_4">Carte 4</option>
    </select>
    <input type="submit" name="Valider" value="Valider">
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