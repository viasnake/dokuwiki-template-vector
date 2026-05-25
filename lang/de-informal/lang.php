<?php

/**
 * German language (informal, "Du") for the "vector" DokuWiki template
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
 * @author ARSAVA <dokuwiki@dev.arsava.com>
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
$lang["vector_article"] = "Artikel";
$lang["vector_discussion"] = "Diskussion";
$lang["vector_read"] = "Lesen";
$lang["vector_edit"] = "Bearbeiten";
$lang["vector_create"] = "Erstellen";
$lang["vector_userpage"] = "Benutzerseite";
$lang["vector_mytalk"] = "Meine Diskussion";
$lang["vector_exportodt"] = "Export: ODT";
$lang["vector_exportpdf"] = "Export: PDF";
$lang["vector_translations"] = "In anderen Sprachen";

//headlines for the different bars and boxes
$lang["vector_navigation"] = "Navigation";
$lang["vector_toolbox"] = "Werkzeuge";
$lang["vector_exportbox"] = "Drucken/exportieren";
$lang["vector_qrcodebox"] = "QR-Code";

//buttons
$lang["vector_btn_search_title"] = "Suche nach Seiten, die diesen Text enthalten";

//exportbox ("print/export")
$lang["vector_exportbxdef_print"] = "Druckversion";
$lang["vector_exportbxdef_downloadodt"] = "Als ODT herunterladen";
$lang["vector_exportbxdef_downloadpdf"] = "Als PDF herunterladen";

//default toolbox
$lang["vector_toolbxdef_whatlinkshere"] = "Links auf diese Seite";
$lang["vector_toolbxdef_siteindex"] = "Seitenindex";
$lang["vector_toolboxdef_permanent"] = "Permanenter link";
$lang["vector_toolboxdef_cite"] = "Seite zitieren";

//qr code box
$lang["vector_qrcodebox_qrcode"] = "QR-Code";
$lang["vector_qrcodebox_genforcurrentpage"] = "erstellt für aktuelle Seite";
$lang["vector_qrcodebox_urlofcurrentpage"] = "Aktuelle Seite als QR Code (scannen für einfachen, mobilen Zugriff)";

//cite this article
$lang["vector_cite_bibdetailsfor"] = "Bibliografische Details für";
$lang["vector_cite_pagename"] = "Seitenname";
$lang["vector_cite_author"] = "Autor";
$lang["vector_cite_publisher"] = "Herausgeber";
$lang["vector_cite_dateofrev"] = "Datum dieser Revision";
$lang["vector_cite_dateretrieved"] = "Datum des Abrufs";
$lang["vector_cite_permurl"] = "Permanente URL";
$lang["vector_cite_pageversionid"] = "Seiten-Versions-ID";
$lang["vector_cite_citationstyles"] = "Zitatstile für";
$lang["vector_cite_checkstandards"] = "Denke bitte daran die Angaben mit den dir vorliegenden Vorgaben oder den Vorgaben deines Professors zu vergleichen um die exakte Syntax, welche die Anforderungen erfüllt, zu erhalten.";
$lang["vector_cite_latexusepackagehint"] = "Bei Benutzung der LaTeX-Paketes „url“ (\usepackage{url} im Bereich der Einleitung), welches eine schöner formatierte Internetadresse ausgibt, oder „hyperref“ (\usepackage{hyperref}, nur bei Erzeugung von PDF-Dokumenten), welches diese zusätzlich noch verlinkt, kann die folgende Ausgabe genommen werden";
$lang["vector_cite_retrieved"] = "Abgefragt";
$lang["vector_cite_from"] = "von";
$lang["vector_cite_in"] = "In";
$lang["vector_cite_accessed"] = "Abgerufen";
$lang["vector_cite_cited"] = "Zitiert";
$lang["vector_cite_lastvisited"] = "Zuletzt besucht";
$lang["vector_cite_availableat"] = "Verfügbar auf";
$lang["vector_cite_discussionpages"] = "DokuWiki Diskussionsseiten";
$lang["vector_cite_markup"] = "Markup";
$lang["vector_cite_result"] = "Ergebnis";
$lang["vector_cite_thisversion"] = "Diese Version";

//other
$lang["vector_search"] = "Suche";
$lang["vector_fillplaceholder"] = "Diesen Platzhalter bitte füllen oder deaktivieren";
$lang["vector_donate"] = "Spenden";
$lang["vector_mdtemplatefordw"] = "vector-Template für DokuWiki";
$lang["vector_recentchanges"] = "Neuste Änderungen";


// English fallback labels for strings added after the original translation
$lang["vector_sidebar"] = "Sidebar";
$lang["vector_skip_to_content"] = "Skip to content";
$lang["vector_menu"] = "Menu";
