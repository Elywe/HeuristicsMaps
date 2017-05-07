<div id="contenu">
    <?php
    if (isset($carte)) {
        ?>
        <div class = "alert">
            <span class = "closebtn" onclick = "this.parentElement.style.display = 'none';">&times;</span>
            <strong>Partage :</strong> Lien de la carte partagée : <input class = "ajoutBox" type = "text" name = "partage" id = "partage" value = "http://localhost/ProjetWeb/index.php?section=mesCartes&action=voirCarte&carte=<?php echo $carte->getIdentifiant() ?>"/>
        </div>
        <?php
    }
    ?>
    <?php
    if (isset($erreur)) {
        echo "<p class=\"erreur\">$erreur</p>";
    }
    if (isset($_SESSION['pseudo'])) {
        ?>
        <div class="ajouterCarte">
            <form action="index.php?section=mesCartes&action=ajoutCarte" method="post">
                <div>
                    <h2>Ajouter une carte</h2>
                    <input class="ajoutBox"  type="text" name="nom" id="nom" required/>
                    <select id="visibilite" name="visibilite">
                        <option value="public">Public</option>
                        <option value="prive">Privé</option>
                    </select>
                    <input type="submit" class="bouton" id="Valider" name="Valider" value="Valider">
                </div>
            </form>
        </div>
        <?php
    }
    ?>
    <div class=visuCartes>
        <h2>Visualiser mes cartes</h2>
        <form class="carteBox" method="post" action="index.php?section=mesCartes">
            <select id="carte" name="carte">
                <?php
                if (!isset($idCarte)) {
                    $idCarte = isset($_POST['carte']) ? $_POST['carte'] : -1;
                }
                foreach ($cartes as $carte) {
                    echo "<option value=\"" . $carte->getIdentifiant() . "\"" . ($idCarte == $carte->getIdentifiant() ? " selected" : "") . ">" . $carte->getNom() . "</option>";
                }
                ?>
            </select>
            <div class="boutonsCartes">
                <input type="submit" class="bouton" name="Valider" value="Valider">
                </form>
                <a class="bouton" id="Supprimer">Supprimer</a>
                <a class="bouton" id="Renommer">Renommer</a>
                <a class="bouton" id="Partager">Partager</a>
            </div>
    </div>
    <div class="affichageNoeuds">
        <table>
            <?php
            if (isset($noeuds)) {
                foreach ($noeuds as $noeud) {
                    if ($noeud->getParent() == NULL) {
                        echo "<ul>";
                        $noeud->afficher();
                        echo "</ul>";
                    }
                }
            }
            ?>
        </table>
    </div>
</div>