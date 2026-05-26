<?php

/**
 * Slovak language for the "vector" DokuWiki template
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
 * @author Peter Bezemek
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
$lang["vector_article"] = "Článok";
$lang["vector_discussion"] = "Diskusia";
$lang["vector_read"] = "Čítať";
$lang["vector_edit"] = "Upraviť";
$lang["vector_create"] = "Vytvoriť";
$lang["vector_userpage"] = "Stránka Používateľa";
$lang["vector_mytalk"] = "Moje Diskusie";
$lang["vector_exportodt"] = "Export: ODT";
$lang["vector_exportpdf"] = "Export: PDF";
$lang["vector_translations"] = "Jazyky";

//headlines for the different bars and boxes
$lang["vector_navigation"] = "Navigácia";
$lang["vector_toolbox"] = "Nástroje";
$lang["vector_exportbox"] = "Tlač/export";

//buttons
$lang["vector_btn_search_title"] = "Hľadať tento text";

//exportbox ("print/export")
$lang["vector_exportbxdef_print"] = "Verzia pre tlač";
$lang["vector_exportbxdef_downloadodt"] = "Stiahnuť ako ODT";
$lang["vector_exportbxdef_downloadpdf"] = "Stiahnuť ako PDF";

//default toolbox
$lang["vector_toolbxdef_whatlinkshere"] = "Čo sem odkazuje";
$lang["vector_toolbxdef_siteindex"] = "Index stránok";
$lang["vector_toolboxdef_permanent"] = "Trvalý odkaz";
$lang["vector_toolboxdef_cite"] = "Citovať túto stránku";

//cite this article
$lang["vector_cite_bibdetailsfor"] = "Bibliografické podrobnosti pre";
$lang["vector_cite_pagename"] = "Názov stránky";
$lang["vector_cite_author"] = "Autor";
$lang["vector_cite_publisher"] = "Vydavateľ";
$lang["vector_cite_dateofrev"] = "Dátum tejto revízie";
$lang["vector_cite_dateretrieved"] = "Dátum načítania";
$lang["vector_cite_permurl"] = "Trvalé URL";
$lang["vector_cite_pageversionid"] = "Identifikátor Verzie Stránky";
$lang["vector_cite_citationstyles"] = "Štýly citácie pre";
$lang["vector_cite_checkstandards"] = "Prosím nezabudnite konzultovať príručku štýlu, normy sprievodcu alebo inštrukcie pre presnú syntax, ktorá vyhovuje vaším potrebám.";
$lang["vector_cite_latexusepackagehint"] = "Ak používate URL balíka LaTeX (\usepackage{url} niekde v preambule), ktorý zvykne dávať oveľa krajšie sformátované webové adresy, vhodnejšie môže byť nasledujúce:";
$lang["vector_cite_retrieved"] = "Načítané";
$lang["vector_cite_from"] = "z";
$lang["vector_cite_in"] = "V";
$lang["vector_cite_accessed"] = "Prístup";
$lang["vector_cite_cited"] = "Citované";
$lang["vector_cite_lastvisited"] = "Posledná návšteva";
$lang["vector_cite_availableat"] = "K dispozícii na";
$lang["vector_cite_discussionpages"] = "Diskusné stránky DokuWiki";
$lang["vector_cite_markup"] = "Anotácia";
$lang["vector_cite_result"] = "Výsledok";
$lang["vector_cite_thisversion"] = "táto verzia";

//other
$lang["vector_search"] = "Hľadať";
$lang["vector_fillplaceholder"] = "Vyplňte prosím tento zástupný symbol";
$lang["vector_donate"] = "Darujte";
$lang["vector_mdtemplatefordw"] = "Šablóna Vector pre DokuWiki";
$lang["vector_recentchanges"] = "Nedávne zmeny";


// English fallback labels for strings added after the original translation
$lang["vector_qrcodebox"] = "QR Code";
$lang["vector_sidebar"] = "Sidebar";
$lang["vector_qrcodebox_qrcode"] = "QR Code";
$lang["vector_qrcodebox_genforcurrentpage"] = "generated for current page";
$lang["vector_qrcodebox_urlofcurrentpage"] = "Current page as QR Code (scan for easy mobile access)";
$lang["vector_skip_to_content"] = "Skip to content";
$lang["vector_menu"] = "Menu";
