<?php

/**
 * Dutch language for the "vector" DokuWiki template
 * by Theo Klein (14/06/2010)
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
 * @author Theo Klein
 * @author viasnake <https://github.com/viasnake/>
 * @link https://github.com/viasnake/dokuwiki-template-vector
 * @link https://www.dokuwiki.org/config:lang
 * @link https://www.dokuwiki.org/devel:configuration
 */


//check if we are running within the DokuWiki environment
if (!defined("DOKU_INC")) {
    die();
}

//tabs, personal tools and special links
$lang["vector_article"] = "Artikel";
$lang["vector_discussion"] = "Overleg";
$lang["vector_read"] = "Lezen";
$lang["vector_edit"] = "Bewerken";
$lang["vector_create"] = "Aanmaken";
$lang["vector_userpage"] = "Gebruikers Pagina";
$lang["vector_mytalk"] = "Mijn overleg";
$lang["vector_exportodt"] = "Downloaden als ODT";
$lang["vector_exportpdf"] = "Downloaden als PDF";
$lang["vector_translations"] = "Talen";

//headlines for the different bars and boxes
$lang["vector_navigation"] = "Navigatie";
$lang["vector_toolbox"] = "Hulpmiddelen";
$lang["vector_exportbox"] = "Afdrukken/exporteren";

//buttons
$lang["vector_btn_search_title"] = "Zoek naar deze tekst";

//exportbox ("print/export")
$lang["vector_exportbxdef_print"] = "Printbare versie";
$lang["vector_exportbxdef_downloadodt"] = "Download als ODT";
$lang["vector_exportbxdef_downloadpdf"] = "Download als PDF";

//default toolbox
$lang["vector_toolbxdef_whatlinkshere"] = "Links naar deze pagina";
$lang["vector_toolbxdef_siteindex"] = "Site index";
$lang["vector_toolboxdef_permanent"] = "Permanente verwijzing";
$lang["vector_toolboxdef_cite"] = "Deze pagina citeren";

//cite this article
$lang["vector_cite_bibdetailsfor"] = "Bibliografische details voor";
$lang["vector_cite_pagename"] = "Paginanaam";
$lang["vector_cite_author"] = "Auteur";
$lang["vector_cite_publisher"] = "Uitgever";
$lang["vector_cite_dateofrev"] = "Datum van deze revisie";
$lang["vector_cite_dateretrieved"] = "Opgehaald op";
$lang["vector_cite_permurl"] = "Permanente URL";
$lang["vector_cite_pageversionid"] = "Pagina Versie ID";
$lang["vector_cite_citationstyles"] = "Stylen om te verwijzen naar";
$lang["vector_cite_checkstandards"] = "Vergeet niet uw eigen normen of richtlijnen te controleren voor de exacte zinsbouw die voldoet aan uw behoeften.";
$lang["vector_cite_latexusepackagehint"] = "Bij gebruik van URLs in het LaTeX-pakket geeft deze methode veel mooiere opgemaakte webadressen, hint: zoek naar '\usepackage {url} ' in de handleiding'";
$lang["vector_cite_retrieved"] = "Opgehaald op";
$lang["vector_cite_from"] = "van";
$lang["vector_cite_in"] = "In";
$lang["vector_cite_accessed"] = "Op";
$lang["vector_cite_cited"] = "Geciteerd";
$lang["vector_cite_lastvisited"] = "Laatst bezocht op";
$lang["vector_cite_availableat"] = "Beschikbaar op";
$lang["vector_cite_discussionpages"] = "DokuWiki overlegpagina's";
$lang["vector_cite_markup"] = "Opmaak";
$lang["vector_cite_result"] = "Resultaat";
$lang["vector_cite_thisversion"] = "deze versie";

//other
$lang["vector_search"] = "Zoek";
$lang["vector_fillplaceholder"] = "Vul dit veld in";
$lang["vector_donate"] = "Doneer";
$lang["vector_mdtemplatefordw"] = "vector template voor DokuWiki";
$lang["vector_recentchanges"] = "Recent gewijzigd";


// English fallback labels for strings added after the original translation
$lang["vector_qrcodebox"] = "QR Code";
$lang["vector_sidebar"] = "Sidebar";
$lang["vector_qrcodebox_qrcode"] = "QR Code";
$lang["vector_qrcodebox_genforcurrentpage"] = "generated for current page";
$lang["vector_qrcodebox_urlofcurrentpage"] = "Current page as QR Code (scan for easy mobile access)";
$lang["vector_skip_to_content"] = "Skip to content";
$lang["vector_menu"] = "Menu";
