var select = document.getElementById('carte');
var btnSupprimer = document.getElementById('Supprimer');
var btnRenommer = document.getElementById('Renommer');
var btnPartager = document.getElementById('Partager');
var btnAjoutEnfant = document.querySelectorAll('.AjouterEnfant');
var btnSupprimerNoeud = document.querySelectorAll('.SupprimerNoeud');
btnAjoutEnfant.forEach(btn => {
	btn.onclick = function () {
		var input = document.createElement('input');
		input.type = "text";
		input.classList.add("ajoutBox");
		btn.parentNode.insertBefore(input, btn);
		btn.onclick = function () {
			window.location.href = "index.php?section=mesCartes&action=ajoutNoeud&idNoeud=" + btn.dataset.id + "&idCarte=" + select.value + "&label=" + input.value;
		}
	}
})
btnSupprimerNoeud.forEach(btn => {
	btn.onclick = function () {
		window.location.href = "index.php?section=mesCartes&action=supprimerNoeud&idNoeud=" + btn.dataset.id + "&idCarte=" + select.value;
	}
})
select.onchange = function () {
	btnSupprimer.href = "index.php?section=mesCartes&action=supprimerCarte&idCarte=" + select.value;						//récupère le nom de la carte
	btnRenommer.href = "index.php?section=mesCartes&action=renommerCarteFormulaire&idCarte=" + select.value + "&nomCarte=" + select.options[select.selectedIndex].text;
	btnPartager.href = "index.php?section=mesCartes&action=partageCarte&idCarte=" + select.value;
}
select.onchange();