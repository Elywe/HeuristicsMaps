<div id="contenu" class="demandeConnexion">
	<?php
	if (isset($erreur)) {
        echo "<p class=\"erreur\">$erreur</p>";
    }
	
    ?>
    <div id="Nouveau">
        <form action="index.php?section=connexion&action=ajoutUtilisateur" method="post">
            <h2>Nouveau ? Inscrivez-vous</h2>
            <input class="ajoutBox" type="text" name="pseudo" id="pseudo" placeholder="pseudo"/><br>
            <input class="ajoutBox" type="password" name="mdp" id="mdp" placeholder="*******"/><br>
            <input type="submit" class="bouton" id="Valider" name="ValInsc" value="Valider">
        </form>
    </div>
    <div id="Inscrit">
        <form action="index.php?section=connexion&action=coUtil " method="post">
            <h2>Connexion </h2>
            <input class="ajoutBox" type="text" name="pseudo" id="pseudo" placeholder="pseudo"/><br>
            <input class="ajoutBox" type="password" name="mdp" id="mdp" placeholder="*******"/><br>
            <input type="submit" class="bouton" id="Valider" name="ValCo" value="Valider">
        </form>
    </div>
</div>