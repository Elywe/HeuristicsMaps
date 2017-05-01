<div id="contenu" class="renommerCarte">
    <div>
        <form method="post" action="index.php?section=mesCartes&action=renommerCarte">
            <h2>Renommer la carte</h2>
            <input type="hidden" name="idCarte" value="<?php echo $idCarte ?>">
            <input class="ajoutBox" value="<?php echo $nomCarte ?>" type="text" name="nom" id="nom" required<br>
            <input class="bouton" type="submit" id="changeCarte" name="changeCarte" value="Valider"/></p>
        </form>
    </div>
</div>