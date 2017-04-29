<!DOCTYPE html>
<html>
	<meta http-equiv="Expires" CONTENT="0">
	<meta http-equiv="Cache-Control" CONTENT="no-cache">
	<meta http-equiv="Pragma" CONTENT="no-cache">
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
                        <li><a href="index.php?section=mesCartes">Mes Cartes</a></li>
						
			<?php
				if (isset($_SESSION['pseudo'])){
                    echo "<li><a href='index.php?section=Connecte'>".$_SESSION['pseudo']."</a></li>";
                    echo "<li><a href='index.php?section=Connexion&action=deco'>Deconnexion</a></li>";
                }else{
					echo "<li><a href='index.php?section=Connexion'>Connexion</a></li>";
				}
			?>
                    </ul>
                </nav>
				
            </header>

