<div id="contenu"><?php
    if ($carte->getVisibilite() == 'public') {
        ?>
        <div class = "alert">
            <span class = "closebtn" onclick = "this.parentElement.style.display = 'none';">&times;</span>
            <strong>Partage :</strong> Lien de la carte partagée : <input class = "ajoutBox" type = "text" name = "partage" id = "partage" value = "http://localhost/ProjetWeb/index.php?section=partage&numCarte=<?php echo $carte->getIdentifiant() ?>"/>
        </div>
        <?php
    } else {
        echo "<p class=\"erreur\">$erreur</p>";
    }
    ?>
</div>