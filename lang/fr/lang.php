<?php

/**
 * French language for the "vector" DokuWiki template
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

//tabs, personal tools and special links
$lang["vector_article"] = "Article";
$lang["vector_discussion"] = "Discussion";
$lang["vector_read"] = "Lire";
$lang["vector_edit"] = "Editer";
$lang["vector_create"] = "Créer";
$lang["vector_userpage"] = "Page utilisateur";
$lang["vector_mytalk"] = "Mes discussions";
$lang["vector_exportodt"] = "Exporter : ODT";
$lang["vector_exportpdf"] = "Exporter : PDF";
$lang["vector_translations"] = "Langages";

//headlines for the different bars and boxes
$lang["vector_navigation"] = "Navigation";
$lang["vector_toolbox"] = "Outils";
$lang["vector_exportbox"] = "Imprimer/exporter";

//buttons
$lang["vector_btn_search_title"] = "Rechercher ce texte";

//exportbox ("print/export")
$lang["vector_exportbxdef_print"] = "Version imprimable";
$lang["vector_exportbxdef_downloadodt"] = "Télécharger en ODT";
$lang["vector_exportbxdef_downloadpdf"] = "Télécharger en PDF";

//default toolbox
$lang["vector_toolbxdef_whatlinkshere"] = "Page amont liées";
$lang["vector_toolbxdef_siteindex"] = "Site index";
$lang["vector_toolboxdef_permanent"] = "Lien permanent";
$lang["vector_toolboxdef_cite"] = "Citer cette page";

//cite this article
$lang["vector_cite_bibdetailsfor"] = "Détail bibliographique pour";
$lang["vector_cite_pagename"] = "Nom de page";
$lang["vector_cite_author"] = "Auteur";
$lang["vector_cite_publisher"] = "Publieur";
$lang["vector_cite_dateofrev"] = "Date de revision";
$lang["vector_cite_dateretrieved"] = "Date récupérée";
$lang["vector_cite_permurl"] = "URL permanente";
$lang["vector_cite_pageversionid"] = "Version ID de la page";
$lang["vector_cite_citationstyles"] = "Style de citation pour";
$lang["vector_cite_checkstandards"] = "Veuillez vérifier dans un manuel, un guide standards ou avec un instructeur pour la syntaxe exacte lié à vos besoins.";
$lang["vector_cite_latexusepackagehint"] = "Lorsque vous utilisez l'URL de packaging LaTeX (\usepackage{url} quelquepart au début), qui donne souvent des addresses webs mieux formatées, ce qui suit peut être préféré";
$lang["vector_cite_retrieved"] = "Récupéré";
$lang["vector_cite_from"] = "depuis";
$lang["vector_cite_in"] = "Dans";
$lang["vector_cite_accessed"] = "Accès";
$lang["vector_cite_cited"] = "Cité";
$lang["vector_cite_lastvisited"] = "Dernière visite";
$lang["vector_cite_availableat"] = "Dipso à";
$lang["vector_cite_discussionpages"] = "DokuWiki discussion";
$lang["vector_cite_markup"] = "Annotation";
$lang["vector_cite_result"] = "Resultat";
$lang["vector_cite_thisversion"] = "cette version";

//other
$lang["vector_search"] = "Recherche";
$lang["vector_fillplaceholder"] = "Remplissez cet espace réservé";
$lang["vector_donate"] = "Dons";
$lang["vector_mdtemplatefordw"] = "vector template pour DokuWiki";
$lang["vector_recentchanges"] = "Changements récents";


// English fallback labels for strings added after the original translation
$lang["vector_qrcodebox"] = "QR Code";
$lang["vector_sidebar"] = "Sidebar";
$lang["vector_qrcodebox_qrcode"] = "QR Code";
$lang["vector_qrcodebox_genforcurrentpage"] = "generated for current page";
$lang["vector_qrcodebox_urlofcurrentpage"] = "Current page as QR Code (scan for easy mobile access)";
$lang["vector_skip_to_content"] = "Skip to content";
$lang["vector_menu"] = "Menu";
