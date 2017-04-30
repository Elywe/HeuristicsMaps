<?php

session_start();

function afficherVues($vue, $donnees) {
    //création variables (cartes, titre)
    foreach ($donnees as $k => $v) {
        $$k = $v;
    }
    include_once("Vues/vueMenu.php");
    include_once($vue);
    include_once("Vues/vueFooter.html");
}
