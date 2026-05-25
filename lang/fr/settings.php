<?php

/**
 * French language for the Config Manager
 *
 * If your language is not/only partially translated or you found an error/typo,
 * have a look at the following files:
 * - /lib/tpl/modernizedvector/lang/<your lang>/lang.php
 * - /lib/tpl/modernizedvector/lang/<your lang>/settings.php
 * If they do not exist, copy and translate the English ones (hint: looking
 * at the Wikipedia for your language might be helpful).
 *
 * Please submit translation updates through GitHub issues or pull requests.
 *
 *
 * LICENSE: This file is open source software (OSS) and may be copied under
 *          certain conditions. See COPYING file for details or try to contact
 *          the author(s) of this file in doubt.
 *
 * @license GPLv2 (https://www.gnu.org/licenses/gpl-2.0.html)
 * @author Julien Revault d'Allonnes <jrevault@gmail.com>
 * @author viasnake <https://github.com/viasnake/>
 * @link https://github.com/viasnake/dokuwiki-template-vector
 * @link https://www.dokuwiki.org/config:lang
 * @link https://www.dokuwiki.org/devel:configuration
 */


//check if we are running within the DokuWiki environment
if (!defined("DOKU_INC")){
    die();
}

//user pages
$lang["vector_userpage"]    = "Utiliser les pages utilisateurs ?";
$lang["vector_userpage_ns"] = "Si oui, utilisez ':namespace:' comme pages racines :";

//discussion pages
$lang["vector_discuss"]    = "Utiliser les onglets discussion ?";
$lang["vector_discuss_ns"] = "Si oui, utilisez':namespace:' comme pages racines :";

//site notice
$lang["vector_sitenotice"]          = "Afficher la notice du site ?";
$lang["vector_sitenotice_location"] = "Si oui, utilisez la page wiki suivante pour la notice :";

//navigation
$lang["vector_navigation"]          = "Afficher la navigation ?";
$lang["vector_navigation_location"] = "Si oui, utilisez la page wiki suivante pour la navigation :";

//exportbox ("print/export")
$lang["vector_exportbox"]          = "Afficher la boite 'imprimer/exporter' ?";
$lang["vector_exportbox_default"]  = "Si oui, utilisez la boite 'imprimer/exporter' par default ?";
$lang["vector_exportbox_location"] = "Si non, utilisez la page wiki suivante :";

//toolbox
$lang["vector_toolbox"]          = "Afficher la outils ?";
$lang["vector_toolbox_default"]  = "Si oui, utilisez la outils par default ?";
$lang["vector_toolbox_location"] = "Si non, utilisez la page wiki suivante :";

//qr code box
$lang["vector_qrcodebox"] = "Show a box with a QR code for the current wiki page URL? This uses an external QR code service.";
//custom copyright notice
$lang["vector_copyright"]          = "Afficher le copyright en pied de page?";
$lang["vector_copyright_default"]  = "Si oui, utilisez la notice de copyright par default ?";
$lang["vector_copyright_location"] = "Si non, utilisez la page wiki suivante :";

//donation link/button
$lang["vector_donate"]          = "Afficher le lien de dons ?";
$lang["vector_donate_url"]      = "HTTPS donation URL:";

//TOC
$lang["vector_toc_position"] = "Sommaire position";

//other stuff
$lang["vector_breadcrumbs_position"]  = "Position du fil d'ariane (si actif) :";
$lang["vector_youarehere_position"]   = "Position du 'Vous êtes ici' (si actif) :";
$lang["vector_cite_author"]           = "Nom de l'auteur dans 'Citer cet article' :";
$lang["vector_loaduserjs"]            = "Charger 'modernizedvector/user/user.js' ?";
$lang["vector_closedwiki"]            = "Wiki fermé (la plupart des liens/onglets/boites sont masquée sans connexion) ?";

$lang["vector_sitenotice_translate"] = "If yes and the Translation plugin is available, load a language-specific site-wide notice. The translated page id is the configured site notice page id followed by an underscore and ISO language code.";
$lang["vector_navigation_translate"] = "If yes and the Translation plugin is available, load language-specific navigation. The translated page id is the configured navigation page id followed by an underscore and ISO language code.";
$lang["vector_copyright_translate"] = "If not using the default and the Translation plugin is available, load a language-specific copyright notice. The translated page id is the configured copyright page id followed by an underscore and ISO language code.";

// English fallback labels for multichoice settings added after the original translation
$lang["vector_toc_position_o_article"] = "Article";
$lang["vector_toc_position_o_sidebar"] = "Sidebar";
$lang["vector_breadcrumbs_position_o_top"] = "Top";
$lang["vector_breadcrumbs_position_o_bottom"] = "Bottom";
$lang["vector_youarehere_position_o_top"] = "Top";
$lang["vector_youarehere_position_o_bottom"] = "Bottom";
