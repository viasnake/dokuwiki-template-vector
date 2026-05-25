<?php

/**
 * Basque language for the "vector" DokuWiki template
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
 * @author ander
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
$lang["vector_article"] = "Artikulua";
$lang["vector_discussion"] = "Eztabaida";
$lang["vector_read"] = "Irakurri";
$lang["vector_edit"] = "Aldatu";
$lang["vector_create"] = "Sortu";
$lang["vector_userpage"] = "Erabiltzaile Orria";
$lang["vector_mytalk"] = "Nire Eztabaida";
$lang["vector_exportodt"] = "Esportatu: ODT";
$lang["vector_exportpdf"] = "Esportatu: PDF";
$lang["vector_translations"] = "Hizkuntzak";

//headlines for the different bars and boxes
$lang["vector_navigation"] = "Nabigazioa";
$lang["vector_toolbox"] = "Tresnak";
$lang["vector_exportbox"] = "Imprimatu/esportatu";

//buttons
$lang["vector_btn_search_title"] = "Bilatu testu hau";

//exportbox ("print/export")
$lang["vector_exportbxdef_print"] = "Imprimatzeko bertsioa";
$lang["vector_exportbxdef_downloadodt"] = "Jaitsi ODT formatuan";
$lang["vector_exportbxdef_downloadpdf"] = "Jaitsi PDF formatuan";

//default toolbox
$lang["vector_toolbxdef_whatlinkshere"] = "Orri honetaranzko lotura dutenak";
$lang["vector_toolbxdef_siteindex"] = "Gunearen aurkibidea";
$lang["vector_toolboxdef_permanent"] = "Lotura iraunkorra";
$lang["vector_toolboxdef_cite"] = "Sortu orrialde hau";

//cite this article
$lang["vector_cite_bibdetailsfor"] = "Bibliografiko xehetasunak";
$lang["vector_cite_pagename"] = "Orrialde izena";
$lang["vector_cite_author"] = "Autorea";
$lang["vector_cite_publisher"] = "Argitaratzailea";
$lang["vector_cite_dateofrev"] = "Berrikuspen honen data";
$lang["vector_cite_dateretrieved"] = "Data berreskuratuta";
$lang["vector_cite_permurl"] = "URL iraunkorra";
$lang["vector_cite_pageversionid"] = "Orriaren bertsioaren ID-a";
$lang["vector_cite_citationstyles"] = "Aipatzeko estiloak";
$lang["vector_cite_checkstandards"] = "Gogoan izan zure estilo eskuliburua egiaztatzeao, arau gida edo irakaslearen jarraibideak sintaxia zehatza dela eta zure beharretara egokitzea lortzeko.";
$lang["vector_cite_latexusepackagehint"] = "LaTeX pakete url-a erabiltzean (\ usepackage {url} hitzaurrean nonbait), hobeto formateatutako web helbideak emateko joera duenez, gogokoagoa izan daiteke";
$lang["vector_cite_retrieved"] = "Berreskuratuta";
$lang["vector_cite_from"] = "-tik";
$lang["vector_cite_in"] = "-an";
$lang["vector_cite_accessed"] = "Atzituta";
$lang["vector_cite_cited"] = "Aipatuta";
$lang["vector_cite_lastvisited"] = "Azken bisita";
$lang["vector_cite_availableat"] = "Eskuragarri";
$lang["vector_cite_discussionpages"] = "DokuWiki-ko hitz egiteko orrialdeak";
$lang["vector_cite_markup"] = "Markatu";
$lang["vector_cite_result"] = "Emaitza";
$lang["vector_cite_thisversion"] = "bertsio hau";

//other
$lang["vector_search"] = "Bilatu";
$lang["vector_fillplaceholder"] = "Mesedez bete hauek";
$lang["vector_donate"] = "Dohaintza egin";
$lang["vector_mdtemplatefordw"] = "DokuWikirako Vector txantiloia";
$lang["vector_recentchanges"] = "Aldaketa berriak";

// English fallback labels for strings added after the original translation
$lang["vector_qrcodebox"] = "QR Code";
$lang["vector_sidebar"] = "Sidebar";
$lang["vector_qrcodebox_qrcode"] = "QR Code";
$lang["vector_qrcodebox_genforcurrentpage"] = "generated for current page";
$lang["vector_qrcodebox_urlofcurrentpage"] = "Current page as QR Code (scan for easy mobile access)";
$lang["vector_skip_to_content"] = "Skip to content";
$lang["vector_menu"] = "Menu";
