<!DOCTYPE html>
<html>
    <head>
        <title>ProjetWeb</title>
        <meta charset="utf8"/>
    </head>
    <body>
        <div class="page-wrap">
            <header>
                <h1><?php echo $titre; ?></h1>
				
                <nav>
                    <ul class="menu">
                        <li><a href="index.php?section=Accueil">Accueil</a></li>
                        <li><a href="index.php?section=Connexion">Connexion</a></li>
                        <li><a href="index.php?section=mesCartes">Mes Cartes</a></li>
						
						<?php
						if (isset($_SESSION['nom'])){
							echo "<li>".$_SESSION['nom']."</li>";
							echo "<li><a href='index.php?section=Connexion&action=deco'>Deconnexion</a></li>";
						}
						?>
                    </ul>
                </nav>
				
            </header>

