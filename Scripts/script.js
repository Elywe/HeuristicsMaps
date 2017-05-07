var select = document.getElementById('carte');
var btnSupprimer = document.getElementById('Supprimer');
var btnRenommer = document.getElementById('Renommer');
var btnPartager = document.getElementById('Partager');
var btnAjoutEnfant = document.querySelectorAll('.AjouterEnfant');
var btnSupprimerNoeud = document.querySelectorAll('.SupprimerNoeud');
var btnAfficherBoutons = document.getElementById('AfficherBoutons');
var btnRenommerNoeud = document.querySelectorAll('.RenommerNoeud');
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
btnRenommerNoeud.forEach(btn => {
	btn.onclick = function () {
		var input = document.createElement('input');
		input.type = "text";
		input.classList.add("ajoutBox");
		btn.parentNode.insertBefore(input, btn);
		btn.onclick = function () {
			window.location.href = "index.php?section=mesCartes&action=renommerNoeud&idNoeud=" + btn.dataset.id + "&label=" + input.value + "&carte=" + select.value;
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

function cacher() {
	btnAjoutEnfant.forEach(btn => {
		btn.style.display = "none";
	})
	btnRenommerNoeud.forEach(btn => {
		btn.style.display = "none";
	})
	btnSupprimerNoeud.forEach(btn => {
		btn.style.display = "none";
	})
	btnAfficherBoutons.onclick = afficher;
	btnAfficherBoutons.text = "Afficher";
}

function afficher() {
	btnAjoutEnfant.forEach(btn => {
		btn.style.display = "inline";
	})
	btnRenommerNoeud.forEach(btn => {
		btn.style.display = "inline";
	})
	btnSupprimerNoeud.forEach(btn => {
		btn.style.display = "inline";
	})
	btnAfficherBoutons.onclick = cacher;
	btnAfficherBoutons.text = "Cacher";
}