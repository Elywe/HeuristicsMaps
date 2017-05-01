<div id="contenu">
    <?php
    if (isset($erreur)) {
        echo "<p class=\"erreur\">$erreur</p>";
    }

    if($carte->getVisibilite() == 'public'){
    ?>

        <form action="index.php?section=partage&action=edition" method="post">
            <div>
                <h2>Editer la carte</h2>
                <input type="submit" class="bouton" id="Editer" name="Editer" value="Editer">
            </div>
        </form>
        <?php
    }
    ?>
    <table>
        <?php
        if (isset($noeuds)) {
            echo "<tr><th>identifiant</th><th>label</th><th>parent</th><th>estDansCarte</th></tr>";
            foreach ($noeuds as $noeud) {
                echo "<tr><td>" . $noeud->getIdentifiant() . "</td>";
                echo "<td>" . $noeud->getLabel() . "</td>";
                echo "<td>" . $noeud->getParent() . "</td>";
                echo "<td>" . $noeud->getEstDansCarte() . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</div>