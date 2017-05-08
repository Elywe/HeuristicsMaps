<div id="contenu">
    <?php
    if (isset($carte)) {
        ?>
        <div class = "alert">
            <span class = "closebtn" onclick = "this.parentElement.style.display = 'none';">&times;</span>
            <strong>Partage :</strong> Lien de la carte partagée : <input class = "ajoutBox" type = "text" name = "partage" id = "partage" value = "http://localhost/ProjetWeb/index.php?section=mesCartes&action=voirCarte&carte=<?php echo $carte->getIdentifiant() ?>"/>
		<?php
			if(isset($_SESSION['pseudo'])){
				if($droit=="createur" || $droit=="administrateur"){
		?>
				<form class="utilBox" method="post" action="index.php?section=mesCartes&action=changeDroit">
					<select id="utilisateur" name="utilisateur">
						<?php
						if (!isset($idUtil)) {
							$idUtil = isset($_POST['utilisateur']) ? $_POST['utilisateur'] : -1;
						}
						foreach ($utilisateurs as $utilisateur) {
							if($_SESSION['pseudo']!=$utilisateur->getPseudo()){
								echo "<option value=\"" . $utilisateur->getIdentifiant() . "\"" . ($idUtil == $utilisateur->getIdentifiant() ? " selected" : "") . ">" . $utilisateur->getPseudo() . "</option>";
							}
						}
						?>
					</select>
					<select id="role" name="role">
                        <option value="administrateur">Administrateur</option>
                        <option value="editeur">Editeur</option>
                        <option value="consultant">Consultant</option>
                    </select>
					<input type="hidden" name="idCarte" value=<?php echo $carte->getIdentifiant(); ?>>
					<input type="submit" class="bouton" name="Valider" value="Valider">
                </form>
				
				<table>
					<thead>
						<tr>
							<th>Pseudo</th>
							<th>Role</th>
						</tr>
					</thead>
					<tbody>
				<?php
					
					foreach ($utilCarte as $util) {
						echo '<tr>';
						echo '<td>'.$util['pseudo'].'</td><td>'.$util['role'].'</td>';
						echo '</tr>';
					}
					echo '</tbody>';
					echo '</table>';
				}
				
			}
		?>

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
				<?php
				if (isset($_SESSION['pseudo'])) {
				?>
                <a class="bouton" id="Supprimer">Supprimer</a>
                <a class="bouton" id="Renommer">Renommer</a>
                <a class="bouton" id="Partager">Partager</a>
				<?php }
				?>
			</div>
    </div>
    <div class="affichageNoeuds">
        <table>
            <?php
			
            if (isset($noeuds)) {
				
                foreach ($noeuds as $noeud) {
                    if ($noeud->getParent() == NULL) {
                        echo "<ul>";
                            if (isset($_SESSION["droit"])){ 
				if($_SESSION["droit"]=="createur" || $_SESSION["droit"]=="administrateur" || $_SESSION["droit"]=="editeur"){
                                    $noeud->afficher();
                                }else{
                                    $noeud->afficherSimple();
				}
                            }else{
				$noeud->afficherSimple();
                            }
                        echo "</ul>";
                    }
                }
            }
            ?>
        </table>
    </div>
    <a class="bouton cacherBoutons" onclick="cacher()" id="AfficherBoutons">Cacher</a>
</div>
