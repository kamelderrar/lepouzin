<?php
/**
 * bloc de commentaire au format PHPDoc
 * fonction aui permet d'afficher class="active" sur le code du lien actif
 * @param string $page nom du fichier ciblé par le lien
 * @return string chaine vide si le lien est inactif, class="active" si le lien est actif
 */

function isActive( $page )
{
	if (!isset($_GET['page'])){
		return FALSE;
	}
	if ($_GET['page'] == $page) {
		return'class="active"';
	}else{
		return'';
	}	
}

?>