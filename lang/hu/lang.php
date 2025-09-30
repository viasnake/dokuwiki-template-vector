<?php

/**
 * Hungarian language (formal) for the "vector" DokuWiki template
 *
 * If your language is not/only partially translated or you found an error/typo,
 * have a look at the following files:
 * - /lib/tpl/vector/lang/<your lang>/lang.php
 * - /lib/tpl/vector/lang/<your lang>/settings.php
 * If they are not existing, copy and translate the English ones (hint: looking
 * at <http://[your lang].wikipedia.org> might be helpful).
 *
 * Don't forget to mail your translation to ARSAVA <dokuwiki@dev.arsava.com>.
 * Thanks! :-D
 *
 *
 * LICENSE: This file is open source software (OSS) and may be copied under
 *          certain conditions. See COPYING file for details or try to contact
 *          the author(s) of this file in doubt.
 *
 * @license GPLv2 (http://www.gnu.org/licenses/gpl2.html)
 * @author ARSAVA <dokuwiki@dev.arsava.com>
 * @link https://www.dokuwiki.org/template:vector
 * @link https://www.dokuwiki.org/config:lang
 * @link https://www.dokuwiki.org/devel:configuration
 * 
 * Translation credits:
 * @author Szíjártó Levente Pál <szijartoleventepal@gmail.com>
 */


//check if we are running within the DokuWiki environment
if (!defined("DOKU_INC")){
    die();
}

//tabs, personal tools and special links
$lang["vector_article"] = "Szócikk";
$lang["vector_discussion"] = "Vitalap";
$lang["vector_read"] = "Olvasás";
$lang["vector_edit"] = "Szerkesztés";
$lang["vector_create"] = "Létrehozás";
$lang["vector_userpage"] = "Szerkesztői lap";
$lang["vector_specialpage"] = "Speciális lapok";
$lang["vector_mytalk"] = "Saját vitalap";
$lang["vector_exportodt"] = "Exportálás ODT-formátumban";
$lang["vector_exportpdf"] = "Exportálás PDF-formátumban";
$lang["vector_subscribens"] = "Feliratkozás a változásokra"; //original DW lang $lang["btn_subscribens"] is simply too long for common tab configs
$lang["vector_unsubscribens"] = "Leiratkozás a változásokról";  //original DW lang $lang["btn_unsubscribens"] is simply too long for common tab configs
$lang["vector_translations"] = "Nyelvek";

//headlines for the different bars and boxes
$lang["vector_navigation"] = "Navigáció";
$lang["vector_toolbox"] = "Eszközök";
$lang["vector_exportbox"] = "Nyomtatás/exportálás";
$lang["vector_qrcodebox"] = "QR-kód";
$lang["vector_inotherlanguages"] = "Nyelvek";
$lang["vector_printexport"] = "Nyomtatás/exportálás";
$lang["vector_personnaltools"] = "Személyes eszközök";

//buttons
$lang["vector_btn_go"] = "Ugrás";
$lang["vector_btn_search"] = "Keresés";
$lang["vector_btn_search_title"] = "Keresés a megadott szövegre";

//exportbox ("print/export")
$lang["vector_exportbxdef_print"] = "Nyomtatható változat";
$lang["vector_exportbxdef_downloadodt"] = "Letöltés ODT-formátumban";
$lang["vector_exportbxdef_downloadpdf"] = "Letöltés PDF-formátumban";

//default toolbox
$lang["vector_toolbxdef_whatlinkshere"] = "Mi hivatkozik erre?";
$lang["vector_toolbxdef_upload"] = "Fájl feltöltése";
$lang["vector_toolbxdef_siteindex"] = "Tárgymutató";
$lang["vector_toolboxdef_permanent"] = "Állandó hivatkozás";
$lang["vector_toolboxdef_cite"] = "Hogyan hivatkozzon erre a lapra?";

//qr code box
$lang["vector_qrcodebox_qrcode"] = "QR-kód";
$lang["vector_qrcodebox_genforcurrentpage"] = "a megnyitott oldalhoz előállítva";
$lang["vector_qrcodebox_urlofcurrentpage"] = "A megnyitott lap QR-kódja (mobilos hozzáféréshez).";

//cite this article
$lang["vector_cite_bibdetailsfor"] = "A következő oldal részletei:";
$lang["vector_cite_pagename"] = "Lap neve";
$lang["vector_cite_author"] = "Szerzők";
$lang["vector_cite_publisher"] = "Kiadó";
$lang["vector_cite_dateofrev"] = "Ezen változat dátuma";
$lang["vector_cite_dateretrieved"] = "Letöltés dátuma";
$lang["vector_cite_permurl"] = "Állandó hivatkozás";
$lang["vector_cite_pageversionid"] = "Lapváltozat-azonosító";
$lang["vector_cite_citationstyles"] = "Különböző idézési formák a követkaző laphoz:";
$lang["vector_cite_checkstandards"] = "Előfordulhat, hogy az alábbi megfogalmazások nem pontosak. Használat előtt győződjön meg a pontos szintaxisról!";
$lang["vector_cite_latexusepackagehint"] = "Javasolt a LaTeX-csomaghivatkozás (a bevezetőben megtalálható „\usepackage{url}”-ről megállapítható) használata, ugyanis azzal szebben jelennek meg a webcímek – ebben az esetben az alábbi kód használható:";
$lang["vector_cite_retrieved"] = "Letöltés dátuma:";
$lang["vector_cite_from"] = "elérhető:";
$lang["vector_cite_in"] = "Forrás:";
$lang["vector_cite_accessed"] = "Hozzáférés dátuma:";
$lang["vector_cite_cited"] = "Hivatkozás dátuma";
$lang["vector_cite_lastvisited"] = "Legutóbbi látogatás dátuma:";
$lang["vector_cite_availableat"] = "Elérhető:";
$lang["vector_cite_discussionpages"] = "DokuWiki-vitalap";
$lang["vector_cite_markup"] = "Jelölés";
$lang["vector_cite_result"] = "Eredmény";
$lang["vector_cite_thisversion"] = "ezen változat";

//other
$lang["vector_search"] = "Keresés";
$lang["vector_accessdenied"] = "Hozzáférés megtagadva";
$lang["vector_fillplaceholder"] = "Töltse ki vagy tiltsa le ezt a helyőrzőt!";
$lang["vector_donate"] = "Adományok";
$lang["vector_mdtemplatefordw"] = "vector sablon a DokuWikihez";
$lang["vector_recentchanges"] = "Friss változtatások";

