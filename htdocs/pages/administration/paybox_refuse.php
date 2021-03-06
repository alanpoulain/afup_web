<?php

// Impossible to access the file itself
/** @var \AppBundle\Controller\LegacyController $this */
if (!defined('PAGE_LOADED_USING_INDEX')) {
    trigger_error("Direct access forbidden.", E_USER_ERROR);
    exit;
}

require_once dirname(__FILE__) .'/../../../sources/Afup/Bootstrap/Http.php';

$paybox  = "<p>Votre paiement a été refusé. Désolé.</p>";
$paybox .= "<p>Une questions ? N'hésitez pas à contacter <a href=\"mailto:tresorier@afup.org\">le trésorier</a>.</p>";
$paybox .= "<p><strong></srong><a href=\"index.php\">retour à votre compte</a></strong></p>";

$smarty->assign('paybox', $paybox);
$smarty->display('paybox.html');
?>
